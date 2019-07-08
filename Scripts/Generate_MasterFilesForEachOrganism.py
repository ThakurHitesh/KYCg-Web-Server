#Author: Pulkit Anupam Srivastava
#Date: 25 June, 2018
#Description: Generate initial files for plot, pcc and erichment analysis.
#Note: Replace the organism name with the new organism name.
import math
import re
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
import copy
from scipy.stats import binom_test
#
#Read Expression Data
inputFile_Expression_Atlas = 'ExpressionAtlas_Sorghum_bicolor.txt'#Change File Name of the expression data
with open(inputFile_Expression_Atlas) as f:
    lines=f.read()
f.close()
data_exp_atlas=(lines.strip()).split("\n")
lines=""
#
#Read GO_BP GMT file
inputFile_EnrchRef='GMTFile_Sorghum_bicolor_BP.txt'#GMT file
with open(inputFile_EnrchRef) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataGO_RefMatrix = { row[0]:row[1:] for row in rows }
    lines=f.read()
f.close()
data_enrch_ref=(lines.strip()).split("\n")
lines=""
#
#Read Pathway GMT file
inputFile_EnrchRef='GMTFile_Sorghum_bicolor_PlantCyc.txt'#Pathway GMT File
with open(inputFile_EnrchRef) as f:
    rows = ( (line.strip()).split('\t') for line in f )
    DataPlantCyc_RefMatrix = { row[0]:row[1:] for row in rows }
    lines=f.read()
f.close()
data_enrch_ref_plantcyc=(lines.strip()).split("\n")
lines=""
#
#Read Defline file for each gene
inputFile_Defline='Defline_Sorghum_bicolor.txt'#Defline
with open(inputFile_Defline) as f_def:
    rows = ( (line.strip()).split('\t') for line in f_def )
    DataGene_Defline = { row[0]:row[1] for row in rows }
f_def.close()
#
#Store all genes infromation from respective GMT file
gene_list_enrch_ref= { key:re.sub(r'^"|"$', '',DataGO_RefMatrix[key][9]).split(",") for key in DataGO_RefMatrix}
gene_list_enrch_ref_1=[re.sub(r'^"|"$', '',DataGO_RefMatrix[key][9]).split(",") for key in DataGO_RefMatrix]
all_genes_ref=[j for sub in gene_list_enrch_ref_1 for j in sub]
total_genes_ref=len(set(all_genes_ref))
#
gene_list_enrch_ref_plantcyc= { key:re.sub(r'^"|"$', '',DataPlantCyc_RefMatrix[key][1]).split(",") for key in DataPlantCyc_RefMatrix}
gene_list_enrch_ref_plantcyc_1=[re.sub(r'^"|"$', '',DataPlantCyc_RefMatrix[key][1]).split(",") for key in DataPlantCyc_RefMatrix]
all_genes_ref_plantcyc=[j for sub in gene_list_enrch_ref_plantcyc_1 for j in sub]
total_genes_ref_plantcyc=len(set(all_genes_ref_plantcyc))
#
#Give names to output files
outputFileName_forPlot='Log2Data_forPlot.txt'
outputFileName_forPCCPairs='PCCPairs_Top15.txt'
outputFileName_forBP='BP.txt'
outputFileName_forPlantCyc="PlantCyc.txt"
#
#Generating file for plot.
#File will discard all genes whose sum of expression values across the samples is below 10.
#The log file generated for plot contains log2 values of initial values.
str2ryt_plot=(data_exp_atlas.pop(0)).strip()+"\n"
for i in data_exp_atlas:
    lineContent_arr_2=i.split("\t")
    exp_sum=0
    val_list_float=[float(x) for x in lineContent_arr_2[1:]] #(math.log2(float(x)+1))
    exp_sum=sum(val_list_float)
    if exp_sum >= 10:
        val_list_str=[str(math.log2(float(x)+1)) for x in lineContent_arr_2[1:]] #(math.log2(float(x)+1))
        str2ryt_plot+=lineContent_arr_2[0]+"\t"+("\t".join(val_list_str)).strip()+"\n"
#
str2rytm_plot=str2ryt_plot.strip()
with open(outputFileName_forPlot, "w+") as f_plot:
    f_plot.write(str2rytm_plot)
f_plot.close()
print("Successfully completed Log2 conversion.")
#
#Generate file containing co-expressed genes with PCC threshold >= 0.98 for each gene.
#Change the threshold value as per your requirement.
data_log2=(str2ryt_plot.strip()).split("\n")
lines=""
log2_matrix=[(i.strip()).split("\t") for i in data_log2[1:]]
gene_list_pcc=[log2_matrix[i].pop(0) for i in range(0,len(log2_matrix))]
values_matrix=[list(map(float,log2_matrix[i])) for i in range(0,len(log2_matrix))]
pcc_matrix_all=np.corrcoef(values_matrix)#ed(values_matrix,values_matrix)
#
#Initialize variables for stroing various values
str2ryt_Genes_top15_PccPairs=""
str2ryt_Gene_enrch_GOTerms_BP=""
str2ryt_Gene_enrch_PlantCycTerms=""
Genes_top15_PccPairs=dict()
Gene_enrch_GOTerms_BP=dict()
Gene_enrch_PlantCycTerms=dict()
#
#Generate master dictionary that contains all GO_BP terms mapped to each gene
Gene_GOTerms=dict()
for i in gene_list_pcc:
    Gene_GOTerms[i]=[]
for key in DataGO_RefMatrix:
    #print (key)
    for z in gene_list_enrch_ref[key]:
        flag=0
        for key_2 in Gene_GOTerms:
            if z in key_2:
                flag=1
                break
        if (flag == 1):
           tmp_goterms=Gene_GOTerms[key_2]
           tmp_goterms.append(key)
           Gene_GOTerms[key_2]=tmp_goterms
#
#Generate master dictionary that contains all Pathway terms mapped to each gene
Gene_PlantCycTerms=dict()
for i in gene_list_pcc:
    Gene_PlantCycTerms[i]=[]
for key in DataPlantCyc_RefMatrix:
    for z in gene_list_enrch_ref_plantcyc[key]:
        flag=0
        for key_2 in Gene_PlantCycTerms:
            if z in key_2:
                flag=1
                break
        if (flag == 1):
           tmp_plantcycterms=Gene_PlantCycTerms[key_2]
           tmp_plantcycterms.append(key)
           Gene_PlantCycTerms[key_2]=tmp_plantcycterms
#
#Perfor over-representation test for each gene in the expression file by first extracting all genes having
#correlation above a threshold value for that genes.
for k in range(0,len(gene_list_pcc)):
    pcc_matrix=[m for m in pcc_matrix_all[k]]
    high_corr_var=[pcc_matrix.index(i) for i in pcc_matrix if i >= 0.98] #PCC Threshold value
    high_corr_var=[[gene_list_pcc[x],"{0:.3f}".format(pcc_matrix[x]),DataGene_Defline.get(gene_list_pcc[x],"NA")] for x in high_corr_var]
    sorted_arr=sorted(high_corr_var,key=lambda x: float(x[1]),reverse=True)
    PccPairs=("~".join("^".join(i) for i in sorted_arr[:17] if (gene_list_pcc[k]!=i[0]))).strip()         
    Genes_top15_PccPairs[gene_list_pcc[k]]=PccPairs
    str2ryt_Genes_top15_PccPairs+=gene_list_pcc[k]+"\t"+PccPairs+"\n"
    #Variables
    gene_list_enrichment=[i[0] for i in sorted_arr]
    count_gene_inp_bp=dict() #For biological process
    count_gene_ref_bp=dict()
    go_defline_bp=dict()
    binom_test_bp=dict()
    count_gene_inp_plantcyc=dict() #For Pathway
    count_gene_ref_plantcyc=dict()
    defline_plantcyc=dict()
    binom_test_plantcyc=dict()
    #
    for i in range(0,len(gene_list_enrichment)):
        Gene_GOList=Gene_GOTerms[gene_list_enrichment[i]]
        for j in Gene_GOList:
            GO_ID=j
            GO_Defline=re.sub(r'^"|"$', '',DataGO_RefMatrix[j][0])
            if "BP" in DataGO_RefMatrix[j][1]:
                if GO_ID in count_gene_inp_bp:
                    count_gene_inp_bp[GO_ID]+=1
                else:
                    count_gene_inp_bp[GO_ID]=1
                    go_defline_bp[GO_ID]=GO_Defline
                    count_gene_ref_bp[GO_ID]=len(gene_list_enrch_ref[j])
        #
        Gene_PlantCycList=Gene_PlantCycTerms[gene_list_enrichment[i]]
        for j in Gene_PlantCycList:
            PlantCyc_ID=j
            PlantCyc_Defline=re.sub(r'^"|"$', '',DataPlantCyc_RefMatrix[j][0])
            if PlantCyc_ID in count_gene_inp_plantcyc:
                count_gene_inp_plantcyc[PlantCyc_ID]+=1
            else:
                count_gene_inp_plantcyc[PlantCyc_ID]=1
                defline_plantcyc[PlantCyc_ID]=PlantCyc_Defline
                count_gene_ref_plantcyc[PlantCyc_ID]=len(gene_list_enrch_ref_plantcyc[j])
    #
    enriched_GOTerms_BP=[]
    for key in count_gene_inp_bp:
        binom_test_bp=binom_test(count_gene_inp_bp[key],len(sorted_arr),count_gene_ref_bp[key]/total_genes_ref,alternative='greater')
        if binom_test_bp <=0.1:
            tmp_list=[key,go_defline_bp[key],"BP",str(count_gene_inp_bp[key])+"/"+str(len(sorted_arr)),str(count_gene_ref_bp[key])+"/"+str(total_genes_ref),str(binom_test_bp)]
            tmp_str="^".join(tmp_list)
            enriched_GOTerms_BP.append(tmp_str)
    Gene_enrch_GOTerms_BP[gene_list_pcc[k]]="~".join(enriched_GOTerms_BP)
    str2ryt_Gene_enrch_GOTerms_BP+=gene_list_pcc[k]+"\t"+"~".join(enriched_GOTerms_BP)+"\n"
    #
    enriched_PlantCycTerms=[]
    for key in count_gene_inp_plantcyc:
        binom_test_plantcyc=binom_test(count_gene_inp_plantcyc[key],len(sorted_arr),count_gene_ref_plantcyc[key]/total_genes_ref_plantcyc,alternative='greater')
        if binom_test_plantcyc <=0.1:
            tmp_list=[key,defline_plantcyc[key],str(count_gene_inp_plantcyc[key])+"/"+str(len(sorted_arr)),str(count_gene_ref_plantcyc[key])+"/"+str(total_genes_ref_plantcyc),str(binom_test_plantcyc)]
            tmp_str="^".join(tmp_list)
            enriched_PlantCycTerms.append(tmp_str)
    Gene_enrch_PlantCycTerms[gene_list_pcc[k]]="~".join(enriched_PlantCycTerms)
    str2ryt_Gene_enrch_PlantCycTerms+=gene_list_pcc[k]+"\t"+"~".join(enriched_PlantCycTerms)+"\n"
#
str2rytm_PCCPairs=str2ryt_Genes_top15_PccPairs.strip()
with open(outputFileName_forPCCPairs, "w+") as f_plot:
    f_plot.write(str2rytm_PCCPairs)
f_plot.close()
print("Successfully completed PCC Pairs.")
#
str2rytm_BP=str2ryt_Gene_enrch_GOTerms_BP.strip()
with open(outputFileName_forBP, "w+") as f_BP:
    f_BP.write(str2rytm_BP)
f_BP.close()
print("Successfully completed BP.")
#
str2rytm_PlantCyc=str2ryt_Gene_enrch_PlantCycTerms.strip()
with open(outputFileName_forPlantCyc, "w+") as f_PlantCyc:
    f_PlantCyc.write(str2rytm_PlantCyc)
f_PlantCyc.close()
print("Successfully completed PlantCyc.")
#
print ("All files generated successfully.")
