#!/usr/bin/perl

# Programme for extracting information for the given input candidated genes list.
# perl Gene_knowledge_miner_ADV.pl species_name Gene_id (Example: perl Gene_knowledge_miner_ADV.pl Sorghum_bicolor Sobic.001G009900)

if($ARGV[1] eq ""){ die "Please try again";}
$SpeciesN = $ARGV[0];
@speci = split("\_", $SpeciesN);
$Species = $speci[0];
$Gene_id = $ARGV[1];
$file_token = $ARGV[2];
$Gene_id =~ s/^SORBI_3/Sobic./i;
$Gene_id =~ s/\,|\!|\@|\#|\$|\+|\%|\~|\&|\*|\(|\)|\^|\s//g;
open IN, "FunctionalAnnotation/$SpeciesN/$Species\_annotation.txt";
$header = <IN>;
$path = "Results/FunctionalAnnotation/$SpeciesN";
$pathtrait="Trait_Module/TraitStudiesGeneId";
open (OUT, ">$path/".$file_token."K_miner_result_ADV.txt");
chomp $header;
@head = split("\t", $header);
open IN2, "FunctionalAnnotation/$SpeciesN/$Species\_orthologsIN_diffSpecies.txt";
$header2 = <IN2>;
$header2 =~ s/\t\n//g;
chomp $header2;
@head2 =~ split("\t", $header2);
@data;
while(<IN>){ chomp; 
	$line = $_;
	$line =~ s/\r//g;
	@split = split("\t", $line);
	if($split[0] =~ m/^$Gene_id$/i){
		push(@data, $line);
	}
} push(@data, "\t");
##open OUT2, ">Ortho_info.txt";
while(<IN2>){ chomp;
	$line2 = $_;
	@split2 = split("\t", $line2);
	if($split2[0] =~ m/^$Gene_id$/i){
		$line2 =~ m/\t/;
		##print OUT2 "$'";
		push(@data, $');
	}
}push(@data, "\t");
$dataAll = join(/[\t ]+/, @data); 
$dataAll =~ s/\t /\t/g;
@datasplit = split("\t", $dataAll); #print "@datasplit\n";
$dataLen = @datasplit;
print OUT "Gene \: \t$datasplit[0]\n";
print OUT "Location \:\t$datasplit[1]\:$datasplit[2]\-$datasplit[3]\nProtein primary transcript \:\t$datasplit[4]\nFunctional Annotations\n";
open IN3, "FunctionalAnnotation/$SpeciesN/$Species\_defline.txt";
while(<IN3>){chomp;
	$_ =~ s/\r//g;
	@splitline = split("\t", $_);
	if($splitline[0] =~ m/$datasplit[4]/i){
		print OUT "Defline\n$datasplit[0]\t$splitline[2]\n";
	}
}
%MapmanName; %MapmanDescription;
open IN4, "FunctionalAnnotation/$SpeciesN/$Species\_MapMan_annotation.txt";
while(<IN4>){chomp;
	@line2 = split("\t", $_);
	@id_n = split /\.\d$/, $line2[2];
	$MapmanName{$id_n[0]} = "$line2[1]"; $MapmanDescription{$id_n[0]} = "$line2[3]";
}
print OUT "Protein family details\n";
@pfam = split("\,", $datasplit[6]);
@pfam_name = split("\,", $datasplit[7]);
%pfamh;
@pfamh{@pfam} = @pfam_name;
foreach(@pfam){
	print OUT "PFAM\t$_\t$pfamh{$_}\n";
}
@panther_id = split(/[,|]+/, $datasplit[11]);
@panther_nam = split(/[|!]+/, $datasplit[12]);
%pantherH;
@pantherH{@panther_id} = @panther_nam;
foreach(@panther_id){chomp;
	print OUT "PANTHER\t$_\t$pantherH{$_}\n";
}
print OUT "Gene ontology details\n";
@Go_id = split(/[;,|]+/, $datasplit[8]);
$datasplit[9] =~ s/molecular_function/MF/g; $datasplit[9] =~ s/biological_process/BP/g; $datasplit[9] =~ s/cellular_component/CC/g;
@Go_pro = split(/[,|]+/, $datasplit[9]);
@Go_term = split(/[,|]+/, $datasplit[10]);
%Go_proH; %Go_termH; 
@Go_proH{@Go_id} = @Go_pro;
@Go_termH{@Go_id} = @Go_term;
foreach(@Go_id){
	if($_ =~ m/^GO:/g){
		print OUT "$_\t$Go_termH{$_}\t$Go_proH{$_}\n";
	}
}
print OUT "Mapman Annotation\n$MapmanName{$datasplit[0]}\t$MapmanDescription{$datasplit[0]}\n";
print OUT "Pathway details\n";
#$datasplit[14] =~ s/\|//;
#$datasplit[14] =~ s/\|NA/\|/g;
#@pathw = split(/[>;|]+/, $datasplit[14]); #print "$datasplit[14]\n";
#foreach(@pathw){chomp;
	#@pwid = split("\#", $_);
	#print OUT "$pwid[1]\t$pwid[0]\n";
#}
@KEGGpathway = split /\|/, $datasplit[21];
#print "$datasplit[21]\t@KEGGpathway\n";
foreach(@KEGGpathway){chomp; print OUT "KEGG\t$_\n";
}
@CYCpathway = split /\|/,$datasplit[22];
#print "$datasplit[21]\t@CYCpathway\n";
foreach(@CYCpathway){chomp; print OUT "PlantCyc \t$_\n";
}
print OUT "Enzyme class details\n";
open INP, "FunctionalAnnotation/$SpeciesN/ECclass_details_BrendaDB.txt";
%ECnum; @ECid = split("\,", $datasplit[20]); 
while(<INP>){chomp; 	
	@ECline = split("\t", $_);
	$ECnum{$ECline[0]} = "$ECline[1]";
}
foreach(@ECid){chomp; $ECID = $_; #print "$_\n";
		print OUT "$ECID\t$ECnum{$_}\n";
}
#print OUT "Protein class details\n";
#$datasplit[13] =~ s/\|NA/\|/g;
#@protein_clas = split(/[;|]+/, $datasplit[13]);
#foreach(@protein_clas){chomp;
	#@proClass = split("\#", $_);
	#print OUT "$proClass[1]\t$proClass[0]\n";
#}
#print OUT "Ortholog details\nA. thaliana\tO. sativa\tB. distachyon\tP. virgatum\tS. italica\tZ. mays\n";
print OUT "Orthologs details\nArabidopsis thaliana\tOryza sativa\tBrachypodium distachyon\tPanicum virgatum\tSetaria italica\tZea mays\n";
$datasplit[23] =~ s/\, /\|/g; $datasplit[25] =~ s/\, /\|/g; $datasplit[26] =~ s/\, /\|/g; $datasplit[27] =~ s/\, /\|/g;
#$datasplit[23] =~ s/\;/\|/g;$datasplit[25] =~ s/\;/\|/g;$datasplit[26] =~ s/\;/\|/g;$datasplit[27] =~ s/\;/\|/g; 
print OUT "$datasplit[15]\t$datasplit[18]\t$datasplit[23]\t$datasplit[25]\t$datasplit[26]\t$datasplit[27]\n";
@listids = ("$datasplit[23]","$datasplit[25]","$datasplit[26]","$datasplit[27]");
#@speslist = ("Bdistachyon","Pvirgatum","Sitalica","Zmays");
@speslist = ("Bdistachyon","Pvirgatum","Sitalica","Zmays");
print OUT "$datasplit[17]\t$datasplit[19]\t";
%orthoHash;
@orthoHash{@speslist} = @listids; @allin;
foreach(@speslist){chomp;
	$species = $_;
	$SpeOrthoid = $orthoHash{$_};
	#@SpeOrID = split("\;", $SpeOrthoid);
	@SpeOrID = split /\|/, $SpeOrthoid;
	@input; 
	foreach(@SpeOrID){chomp;
		$specID = $_; 
		open FILE, "FunctionalAnnotation/$SpeciesN/$species\_defline.txt";
		Found_exit: {
			while(<FILE>){chomp; 
				@def = split("\t", $_);
				if($def[0] =~ m/$specID/ig){
					push(@input, $def[2]);
					last Found_exit;
				}
			}
		}
	}
	$inputdata = join("\|", @input); undef @input;
	push(@allin, $inputdata);
} 
$Allinputdata = join("\t", @allin); undef @allin;
print OUT "$Allinputdata\nCoexpression\n";
@Spe_key = ("Arabidopsis thaliana","Oryza sativa","Brachypodium distachyon","Panicum virgatum","Setaria italica","Zea mays");
@Spe_val = ("$datasplit[15]","$datasplit[18]","$datasplit[23]","$datasplit[25]","$datasplit[26]","$datasplit[27]");
%speNgenId; @speNgenId{@Spe_key} = @Spe_val;
open Trait, "FunctionalAnnotation/$SpeciesN/Curated_files_list.txt";
open (OUT2, ">$pathtrait/".$file_token."Trait_Studieslist_Geneid.txt");	
while(<Trait>){chomp;
	$traitline = $_;
	@traitlin = split("\t", $traitline);
	$SpeciesN =~ s/\_/ /g;
	#print "$SpeciesN\n";
	if($traitlin[1] eq $SpeciesN){print OUT2 "$traitline\t$datasplit[0]\n";}
	else{print OUT2 "$traitline\t$speNgenId{$traitlin[1]}\n";}
}
undef @data;
close IN; close IN2; close IN3; close IN4; close FILE; close INP;	
close OUT; close OUT2;
exit;
