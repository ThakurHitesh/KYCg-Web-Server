#Author: Pulkit Anupam Srivastava
#Date: 25 June, 2018
#Description: Generate file for plot for trait specific data
import sys
#
def rytfile(DataGenes_ExpressionAtlas,Gene_ID):
    #
    str2ryt_all_header_arr=[]
    str2ryt_all_val_arr=[]
    labels=("\t".join(DataGenes_ExpressionAtlas["Gene_ID"])).split("\t")
    no_samples=list(set([i[:i.find("_")] for i in labels]))
    for i in no_samples:
        str2ryt=""
        val_index_i=[j for j in range(0,len(labels)) if labels[j][:labels[j].find("_")] == i]
        label_list=[DataGenes_ExpressionAtlas["Gene_ID"][j] for j in val_index_i]
        #
        str2ryt_all_header_arr.extend(label_list)
        str2ryt_all_header_arr.extend(("",""))
        
        #
        str2ryt+=i+"_Samples\t"+"\t".join(label_list)+"\n"
        val_list=[DataGenes_ExpressionAtlas[Gene_ID][j] for j in val_index_i]
        #
        str2ryt_all_val_arr.extend(val_list)
        str2ryt_all_val_arr.extend(("0","0"))
        #
    #
    #print (str2ryt_all_header_arr)
    str2ryt_all="_Samples\t"+"\t".join(str2ryt_all_header_arr)+"\n"
    str2ryt_all+=Gene_ID+"\t"+"\t".join(str2ryt_all_val_arr)+"\n"
    str2rytm_all=str2ryt_all.strip()
    return (str2rytm_all)
#
#Org_name=sys.argv[1]
File_name=sys.argv[1]
Gene_List=sys.argv[2]
Token=sys.argv[3]
#
inputFile_Expression = 'Trait_Module/Log2_Values/'+File_name
with open(inputFile_Expression) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataGenes_Expression = { row[0]:row[1:] for row in rows }
f.close()
outputFileName_forPlot='Results/TraitWise/'+Token+'Plot.txt'
#
str2ryt=""#tmpstr='Samples\t'+"\t".join(DataGenes_Expression["Gene_ID"])+"\n"
flag=0
for Gene_ID in Gene_List.split(";"):
    #Expression=tmpstr+Gene_ID+"\t"+"\t".join(DataGenes_Expression[Gene_ID])+"\n"
    if (flag == 0):
        if Gene_ID in DataGenes_Expression:
            str2ryt+=rytfile(DataGenes_Expression,Gene_ID)+"\n"
            flag=1
        else:
            str2ryt+=""
    else:
        if Gene_ID in DataGenes_Expression:
            tmpstr=rytfile(DataGenes_Expression,Gene_ID).split("\n")[-1]
            str2ryt+=tmpstr+"\n"
        else:
            str2ryt+=""
str2ryt_m=str2ryt.strip()
with open(outputFileName_forPlot, "w+") as f_plot:
    f_plot.write(str2ryt_m)
f_plot.close()
