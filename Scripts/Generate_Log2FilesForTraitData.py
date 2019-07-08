#Author: Pulkit Anupam Srivastava
#Date: 25 June, 2018
#Description: Generate initial files for plot for trait specific data.
#Make sur file are tab delimited and in txt format.
import sys
import glob
import os
import math
inputPath = '../Trait_Module/FPKM_Values/*/*'
inputFiles = glob.glob(inputPath)
#print (inputFiles)
for name in inputFiles:
    pathsplit=name.split("/")
    print (pathsplit)
    outputFileName_forPlot='../Trait_Module/Log2_Values/'+pathsplit[-1]
    #
    with open(name) as f_exp:
        lines=f_exp.read()
    f_exp.close()
    data_exp=(lines.strip()).split("\n")
    lines=""
    #
    str2ryt_plot=(data_exp.pop(0)).strip()+"\n"
    for i in data_exp:
        lineContent_arr_2=i.split("\t")
        val_list_str=[str(math.log2(float(x)+1)) for x in lineContent_arr_2[1:]] #(math.log2(float(x)+1))
        str2ryt_plot+=lineContent_arr_2[0]+"\t"+("\t".join(val_list_str)).strip()+"\n"
    #
    str2rytm_plot=str2ryt_plot.strip()
    with open(outputFileName_forPlot, "w+") as f_plot:
        f_plot.write(str2rytm_plot)
    f_plot.close()
#
print ("Done")
