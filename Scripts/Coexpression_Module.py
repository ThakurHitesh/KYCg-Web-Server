#Author: Pulkit
#Date: 13 June, 2018
#Description: 
#import matplotlib.pyplot as plt
#import pylab
#import numpy as np
import sys
import os
#
def rytfile(DataGenes_ExpressionAtlas,Org_Name,Gene_ID):
    #
    tmppath='Results/DAtlasPlot/'+Org_Name+'/'+Token
    os.mkdir(tmppath)
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
        str2ryt+=Gene_ID+"\t"+"\t".join(val_list)+"\n"
        str2ryt_m=str2ryt.strip()
        outputFileName_forPlot='Results/DAtlasPlot/'+Org_Name+'/'+Token+"/"+i+'.txt'
        with open(outputFileName_forPlot, "w+") as f_Plot:
            f_Plot.write(str2ryt_m)
        f_Plot.close()
    #
    #print (str2ryt_all_header_arr)
    str2ryt_all="_Samples\t"+"\t".join(str2ryt_all_header_arr)+"\t\t"
    str2ryt_all=(str2ryt_all)+"\n"+Gene_ID+"\t"+"\t".join(str2ryt_all_val_arr)+"\n"
    str2rytm_all=str2ryt_all.strip()
    outputFileName_forPlot='Results/CAtlasPlot/'+Org_Name+'/'+Token+'ExpressionAtlas.txt'
    with open(outputFileName_forPlot, "w+") as f_Plot:
        f_Plot.write(str2rytm_all)
    f_Plot.close()
#
#
Org_Name=sys.argv[1]
Gene_ID=sys.argv[2]
Token=sys.argv[3]
#
#Read Log2 Expression Atlas
inputFile_Expression_Atlas = 'CoExpression_Module/Data/'+Org_Name+'/Log2Data_forPlot.txt'
with open(inputFile_Expression_Atlas) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataGenes_ExpressionAtlas = { row[0]:row[1:] for row in rows }
f.close()
inputFile_PCCPairs = 'CoExpression_Module/Data/'+Org_Name+'/PCCPairs_Top15.txt'
with open(inputFile_PCCPairs) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataGenes_PCCPairs = { row[0]:row[1:] for row in rows }
f.close()
inputFile_BP = 'CoExpression_Module/Data/'+Org_Name+'/BP.txt'
with open(inputFile_BP) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataGenes_BP = { row[0]:row[1:] for row in rows }
f.close()
inputFile_PC = 'CoExpression_Module/Data/'+Org_Name+'/PlantCyc.txt'
with open(inputFile_PC) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataGenes_PC = { row[0]:row[1:] for row in rows }
f.close()
#
flag=0
for key in DataGenes_ExpressionAtlas:
    if Gene_ID in key:
        Gene_ID=key
        flag=1
        break
#
if flag == 1:
    #
    try:
        pccpairs=DataGenes_PCCPairs[Gene_ID][0].split("~")
        str2ryt_PccPairs="\n".join(pccpairs)
        str2rytm_PCCPairs=str2ryt_PccPairs
    except IndexError:
        pccpairs=[]
        str2rytm_PCCPairs=""
    outputFileName_forPCCPairs='Results/CoexpressionPlot/'+Org_Name+'/'+Token+'PCCPairs_Top15.txt'
    with open(outputFileName_forPCCPairs, "w+") as f_PCCPairs:
        f_PCCPairs.write(str2rytm_PCCPairs)
    f_PCCPairs.close()
    #
    try:
        bp=DataGenes_BP[Gene_ID][0].split("~")
        str2ryt_GO="\n".join(bp)+"\n"
        str2rytm_GO=str2ryt_GO
    except IndexError:
        str2rytm_GO=""
    outputFileName_forGO='Results/CoexpressionPlot/'+Org_Name+'/'+Token+'GSEA_GO.txt'
    with open(outputFileName_forGO, "w+") as f_GO:
        f_GO.write(str2rytm_GO)
    f_GO.close()
    #
    try:
        pc=DataGenes_PC[Gene_ID][0].split("~")
        str2ryt_PC="\n".join(pc)+"\n"
        str2rytm_PC=str2ryt_PC
    except IndexError:
        str2rytm_PC=""
    outputFileName_forPC='Results/CoexpressionPlot/'+Org_Name+'/'+Token+'GSEA_Pathway.txt'
    with open(outputFileName_forPC, "w+") as f_PC:
        f_PC.write(str2rytm_PC)
    f_PC.close()
    #
    rytfile(DataGenes_ExpressionAtlas,Org_Name,Gene_ID)
    #
    labels=DataGenes_ExpressionAtlas["Gene_ID"]
    str2ryt_coplot="Gene_ID\t"+"\t".join(labels)+"\n"
    str2ryt_coplot+=Gene_ID+"\t"+"\t".join(DataGenes_ExpressionAtlas[Gene_ID])+"\n"
    for i in pccpairs:
        str2ryt_coplot+=i[:i.index("^")]+"\t"+"\t".join(DataGenes_ExpressionAtlas[i[:i.index("^")]])+"\n"
    str2rytm_coplot=str2ryt_coplot
    outputFileName_coPlot='Results/CoexpressionPlot/'+Org_Name+'/'+Token+'Plot.txt'
    with open(outputFileName_coPlot, "w+") as f_coPlot:
        f_coPlot.write(str2rytm_coplot)
    f_coPlot.close()
    #
#
