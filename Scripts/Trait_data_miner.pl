#!/usr/bin/perl

# Programme for extracting trait related data.
# save all the Trait specific data files in "Species******Trait.txt" format and all files should present along with this programe.
# perl Trait_data_miner.pl Maize_leaf_gradient_coexpression_clusters

if($ARGV[0] eq ""){ die "Please try again"; }

open IN, "K_miner_result.txt";
$Trait = $ARGV[0];
$l_line;
while(<IN>) {chomp;
   $l_line = $_ if eof;
}
open IN2, "$Trait\_Trait.txt";
$head = <IN2>;
chomp $head;
open OUT, ">Trait_data_output.txt";
print OUT "Gene Id\t";
$head =~ s/\r//g;
$head =~ m/\t/;
print OUT "$'\n";
@genNspe = split("\t", $l_line);
@speName = split("\_", $Trait);
open IN3, "Ortho_info.txt";
$orthos = <IN3>;
@Ortholog = split(/[\t, ]+/, $orthos);
if($genNspe[1] eq $speName[0]){
	while(<IN2>){ chomp;
		$line2 = $_;
		$line2 =~ s/\r//g;
		@split2 = split("\t", $line2);
		if($split2[0] =~ m/$genNspe[0]/ig){
			print OUT "$line2\n";
		}
	}
}
else{ 
	foreach(@Ortholog){chomp;
		$ortho = $_;
		open IN2, "$Trait\_Trait.txt";
		while(<IN2>){ chomp;
			$line2 = $_;
			$line2 =~ s/\r//g;
			@split2 = split("\t", $line2);
			if($split2[0] =~ m/^$ortho/ig){
				print OUT "$line2\n";
			}
		}
	}
}
close IN; close IN2; close IN3;
close OUT;
exit;
