<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Tutorial</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>

  <link rel="icon" type="image/png" href="contactform/images/icons/favicon.ico"/>    
  <link rel="stylesheet" type="text/css" href="contactform/css/main.css">
    </head>
<body id="top">
<div class="wrapper row0" style="background-color: #003300">
  <div id="topbar" class="hoc clear"> 
    <div class="fl_left">
      <ul class="nospace">
        <li><a href="index.php"><i class="fa fa-lg fa-home"></i></a></li>
        <li><a href="tutorial.php" style="color: #ffffff">Tutorial</a></li>
        <li><a href="about.php" style="color: #ffffff">About</a></li>
        <li><a href="contact.php" style="color: #ffffff">Contact</a></li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace">
        <li style="color: #ffffff"><i class="fa fa-phone"></i> +91-8629857986</li>
        <li style="color: #ffffff"><i class="fa fa-envelope-o"></i> hiteshthakur20@gmail.com</li>
      </ul>
    </div>
  </div>
</div>
  <nav class="navbar" style="margin-top: 19px; border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" style="border-color: red" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar" style="background-color: red"></span>
        <span class="icon-bar" style="background-color: red"></span>
        <span class="icon-bar" style="background-color: red"></span> 
      </button>
      <a class="navbar-brand" href="#" style="font-family: 'Aldrich';font-size: 46px; margin-left:15%;">KYCg</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right" style="font-size: 16px; margin-right:10%;">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="tutorial.php">Tutorial</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>  
      </ul>
    </div>
  </div>
</nav>
<div class="container" style="padding-top: 0px;padding-bottom: 0px;">
<div class="row" >
	<div class="col-md-12" style="text-align: center;font-size: 250%;color: #343232;">User Guide Version 0.1</div>
	<hr style="border-width: 2px;border-color: #343232;">
</div>

<div class='alert' style='border-radius:0px;background-color:#004d00;font-size: 21px;font-weight: bold;color:#ffffff;'>I. Overview:</div>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">This is a knowledge miner for candidate genes obtained from any genetic or genomic study. This is meant only for major plant species whose genomes as well as some transcriptome studies are available. While a few knowledge miners are already publicly available, but a few new features have been added to enable users more information about the function or biological role of the gene, which should help them in finding causal gene(s).</p> 

<br>
<br>
<div class='alert' style='border-radius:0px;background-color:#004d00;font-size: 21px;font-weight: bold;color:#ffffff'>II. Target species and query gene:</div> 
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">On the home page, first select the plant species* from the drop-down menu whose gene need to be searched. Then enter a valid gene ID in the designated text-box. The gene ID should be from the latest version of genome assembly/annotation of the respective species. </p>
<p style="font-size: 16px;text-align: justify;font-family: arial;">
* The web-application is currently functional for only one plant species: Sorghum bicolor. The gene ID will have following format: <i>Sobic.0<'two_digit_chromosome_code'>G<'six_digit_code_for_gene'>.</i>
</p>
<br>
<br>
<div class='alert' style='border-radius:0px;background-color:#004d00;font-size: 21px;font-weight: bold;color:#ffffff'>III. Results page</div>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">The results will be displayed under four tabs namely, functional annotation, Orthologs, Gene expression atlas, Co-expression and Trait-wise gene expression.</p> 
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-weight: bold;">1. Functional Annotation</p> 
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">Under this tab, a range of existing functional information is obtained for the query gene:</p>

<p style="font-size: 16px;text-align: justify;font-family: arial;font-style: italic;"><u>Defline</u>: A basic description what the gene is.</p>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-style: italic;"><u>Protein Family details</u>: Details of the protein family to which the gene belongs. If the precise role of gene is unknown, then the family details give a broader idea about its function. </p>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-style: italic;"><u>Gene Ontology details</u>: Information provided for each of the three classes of ontologies (Biological process, Molecular function, Cellular location).  </p>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-style: italic;"><u>Pathway details</u>: Metabolic pathway information from multiple pathway databases like, Kyoto Encyclopedia for Genes and Genomes (KEGG), PlantCyc database.</p>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-style: italic;"><u>Enzyme class</u>: If the gene happens to encode an enzyme, then its EC number along with description will be provided.</p>
<br> 
<img src="Images/tut1.png">
<br>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-weight: bold;">2. Orthologs</p>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">The orthologs of the query gene in common plant genomes such as, maize, rice, Arabidopsis, foxtail millet, is provided. Along with the ortholog ID, the defline is also provided to help users in exploring what this gene is doing in close or distant relatives. The orthology is established using a leading tool named OrthoFinder (Emms, D.M. and Kelly, S. Genome Biology 2015, 16:157), which uses OrthoMCl along with rigorous phylogenetic analysis to infer orthologs. </p>
<br>
<img src="Images/tut2.png">
<br>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-weight: bold;">3. Gene expression atlas</p>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">Under this tab, expression of query gene across the plant life cycle and major tissues will be displayed as bar plots. The default plot includes all samples, and will be grouped based on tissue and/or developmental stage. In order to capture trend within each group of samples based on tissue/development stage, additional plots are also provided; they can be browsed by clicking right and left arrow marks. Please note that expression values will be in Reads Per Kilobase Per Million (RPKM) unit and log2 transformed.</p>
<br>
<img src="Images/tut3.png">
<br>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-weight: bold;">4. Co-expression</p>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;">Under Co-expression tab, optimized value of Pearson Correlation Coefficient (PCC>=0.98, pvalue<'0.1, minimum expression in FPKM units across samples'> 2) were used for generating a set of genes having similar expression profile as that of query gene in Expression atlas data of the concerned species. It has got three sections:</p>
<ul >
<li style="list-style-type: square;display: list-item;"><p style="font-size: 16px;text-align: justify;font-family: arial;">In the upper panel, a table of co-expressed genes along with their defline is displayed.</p></li>
<li style="list-style-type: square;display: list-item;"><p style="font-size: 16px;text-align: justify;font-family: arial;">In the next panel, expression profile of both query and co-expressed genes in the gene expression atlas are displayed separately using line plot. If no genes are found co-expressed then only the profile of query gene is displayed. The expression values will be in Reads Per Kilobase Per Million (RPKM) unit and log2 transformed.</p></li>
<li style="list-style-type: square;display: list-item;"><p style="font-size: 16px;text-align: justify;font-family: arial;">In the last panel, a table of pathway terms which were found over-represented in the list of co-expressed genes will be displayed. This will be particularly useful when the functional annotation of query gene is unavailable. </p></li>
</ul>
<br>
<img src="Images/tut4.png">
<br>
<br>
<p style="font-size: 16px;text-align: justify;font-family: arial;font-weight: bold;">5. Trait-wise gene expression</p>
    <br> 
<p style="font-size: 16px;text-align: justify;font-family: arial;">This is a new feature which have been introduced for knowledge mining. While searching details for the candidate genes, sometimes the existing functional information fails to help users to decide about their causality. If at all transcript abundance of these genes happen to be available, in particular, in the related traits as for the candidate gene, can it can be of high importance in associating candidate gene with phenotype. Through this knowledge miner we allow the users to get such information.</p>

<p style="font-size: 16px;text-align: justify;font-family: arial;">Under this tab, the user will have to select the relevant trait from the drop down menu, followed by relevant transcriptome study available for the selected trait. Clicking submit button will display  a summary of the study (purpose and experiment design) along with expression of the gene or its ortholog in that study. The expression values will be in Reads Per Kilobase Per Million (RPKM) unit and log2 transformed.</p>
<br><img src="Images/tut5.png">
<br>
<br>
</div>
<br>
<div style="background-color: #003300"> 
  <div class="wrapper row4 row">
    <footer id="footer" class="hoc clear"> 
      <div class="col-md-6" style="margin-top: 20px">
        <h6 class="heading" style="font-family: 'Aldrich';">Contact Us</h6>
        <ul class="nospace btmspace-30 linklist contact">
          <li><i class="fa fa-map-marker"></i>
            <address>
            Jaypee University of Information Technology, Solan
            </address>
          </li>
          <li><i class="fa fa-phone"></i> +91-8629857986</li>
          <li><i class="fa fa-envelope-o"></i> hiteshthakur20@gmail.com</li>
        </ul>
        <ul class="faico clear">
          <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
      </div>
      <div class="col-md-6" style="margin-top: 20px">
        <h6 class="heading" style="font-family: 'Aldrich';">Know Your Candidate-gene</h6>
        <p class="nospace btmspace-15" style="color: #FFFFFF;">Enable users more information about the function or biological role of the gene, which should help them in finding causal gene(s).</p>
        <form method="post" action="#">
          <fieldset>
            <p style="color: #FFFFFF;font-size: 20px">Send Us A Mail :</p>
            <input class="btmspace-15" type="text" value="" placeholder="Name">
            <input class="btmspace-15" type="text" value="" placeholder="Email">
            <button type="submit" value="submit">Submit</button>
          </fieldset>
        </form>
      </div>
    </footer>
  </div>
  <div class="wrapper row5">
    <div id="copyright" class="hoc clear"> 
      <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">ICRISAT</a></p>
      <p class="fl_right">Published by <a target="_blank" >SDBM Unit, ICRISAT</a></p>
    </div>
  </div>
</div>
</body>
</html>