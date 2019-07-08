<?php
// Start the session
session_start();
?>
  <?php
                  // Handle AJAX request (start)
                  if( isset($_POST['ajax']) && isset($_POST['choices']) ){
                    if($_POST['choices']!=""){ 
                    //echo $_POST['choices'];
                    $sendingOFG=explode("~", $_POST['choices']);

                    //$geneidwithunderscore=str_replace(" ", "_", $sendingOFG[0]);
                    shell_exec("python ./Scripts/Trait_Module.py '".$sendingOFG[2]."' '".$sendingOFG[3]."' '".$_SESSION['token']."'");
                  echo  '<hr style="border-style:solid;border-color:#000000;border-width:1px;">
                         <br>
                         <div class="panel panel-success" id="#traitsummarysize">
                         <div class="panel-heading" data-toggle="collapse" href="#collapseplottraitsum" style="padding: 1%;font-size: 16px;">
                              <strong>Summary </strong><span class="caret" style="border-width:7px;float:right;"></span>
                            </div>
                            <div id="collapseplottraitsum" class="panel-body panel-collapse collapse in">
                      <div class="container" style="padding-bottom:0px;padding-top:0px;width:100%;font-family:arial;text-align:justify;font-size:14px;">'.$sendingOFG[1].'</div></div></div>
                  '; 
                  echo  '<div class="panel panel-success" id="#traitplotsize">
            <div class="panel-heading" data-toggle="collapse" href="#collapseplottrait" style="padding: 1%;font-size: 16px;">
            <strong>Transcript abundance of query gene in selected study </strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapseplottrait" class="panel-body panel-collapse collapse in">
    <div class="container">';
      if(file_exists("Results/TraitWise/".$_SESSION['token']."Plot.txt")&&filesize("Results/TraitWise/".$_SESSION['token']."Plot.txt")){
     echo '<div id="charttrait" class="c3" align="center" style="height: 600px;width: 90%;"></div> ';
      echo "<script type='text/javascript'>
  var chart = c3.generate({
    bindto: '#charttrait',
    data: {
      columns: [";
      $fileplot=file_get_contents("Results/TraitWise/".$_SESSION['token']."Plot.txt");
    $expfileplot=explode("\n", $fileplot);
    $labels=explode("\t", $expfileplot[0]);
    $totgenes=sizeof($expfileplot);
    $eachgene=array();
    for($h=1;$h<$totgenes;$h++){
      $values=explode("\t", $expfileplot[$h]);
      array_push($eachgene, $values);
    }
    for($h=0;$h<sizeof($eachgene);$h++){
      echo "['data";
      echo $h+1;
      echo "',";
        for ($t=1;$t<sizeof($eachgene[$h]);$t++){
            echo $eachgene[$h][$t];
            if($t<sizeof($values)-1){
              echo ",";
      }
    }
    echo "],";
    }
        echo "],
      type: 'bar',
      names: {";
            for($h=0;$h<sizeof($eachgene);$h++){
                echo "data";
                echo $h+1;
                echo ":";
                echo "'".$eachgene[$h][0]."'";
                echo ",";
              }
        echo "},},
    axis: {
        x: {
            tick: {
              fit: true,
              rotate: 90,
              multiline: false
            },
            label: '";
            echo $labels[0];
            echo "',
            type: 'category',
            categories: [";
    for ($t=1;$t<sizeof($labels);$t++){
      echo "'".$labels[$t]."'";
      if($t<sizeof($labels)-1){
        echo ",";
      }
    }
            echo "]
        },
        y: {
            label: '";
            echo "Log2Value";
            echo "',
        }
    }
});
</script>";
}
else{
  echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Trait-Wise Plot</i> available for this study. </div>";
}
echo '</div>
    </div>
    </div>';
                   exit;
                  }
                  else{
                  echo "<div class='alert' style='text-align:center;border-radius:0px;background-color:#ff7d66;'><span class='glyphicon glyphicon-exclamation-sign'></span>  First select the trait</div>";
                  exit;
                }
                }
                  // Handle AJAX request (end)  
                  ?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<title>Result</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="contactform/css/main.css">
<link rel="icon" type="image/png" href="contactform/images/icons/favicon.ico"/>
<link href="c3-0.6.2/c3canvas.css" rel="stylesheet">

<!-- Load d3.js and c3.js -->
<script src="c3-0.6.2/d3-5.4.0.min.js"></script>
<script src="c3-0.6.2/c3.js"></script>
  <style>
    .table-responsive{
      max-height: 350px;
    }
    #chartall .c3-axis-x > .tick{
      font-size: 0.5vw;
    } 
    .c3-axis-y-label{
      font-size: 0.6vw;
    }
    .c3-axis-x-label{
      font-size: 0.6vw;
    }
  </style>
  <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
  <style type="text/css">
    /* bootstrap hack: fix content width inside hidden tabs */
.tab-content > .tab-pane:not(.active),
.pill-content > .pill-pane:not(.active) {
    display: block;
    height: 0;
    overflow-y: hidden;
} 
/* bootstrap hack end */ 
.carousel-inner > .item:not(.active){
      display: block;
    height: 0;
    overflow-y: hidden;
}
#traitplotsize:not(.active){
   display: block;
    height: 0;
    overflow-y: hidden;
}
#traitsummarysize:not(.active){
   display: block;
    height: 0;
    overflow-y: hidden;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {  
    background-color:#006600;
    }
  </style>
</head>
 <?php include "bgprocess.php" ?>
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
<?php $file=file_get_contents("Results/FunctionalAnnotation/".$_SESSION['selectsp']."/".$_SESSION['token']."K_miner_result_ADV.txt");?>
<div class="container-fluid" style="margin-left: -.75%;">
  <button type="button" class="btn btn-lg" data-toggle="collapse" data-target="#demo" style="background-color:#006600;border-radius:0px;padding-left: 7%;padding-right: 7%;border-style: none; text-transform: capitalize;" in><?php echo $_SESSION['selectsp']." "; ?><span class="caret"></span></button>
  <div id="demo" class="collapse in">
  <br>
<p style="font-size: 115%;font-family: arial;">Query Gene ID : <span><?php echo $_SESSION['selectgene'] ?></span> &nbsp;&nbsp;&nbsp; <?php   preg_match_all("/^Location(.*)$/m",$file, $matchloc);$valueonlyloc=$matchloc[0];echo $valueonlyloc[0]."  &nbsp;&nbsp;&nbsp;";preg_match_all("/^Protein primary transcript(.*)$/m",$file, $matchppt); $valueonlyppt=$matchppt[0];  echo $valueonlyppt[0]; ?></p>
  </div>
</div>
<hr style="color: grey; height: 1px;border: none; background-color: grey;">
      <ul class="nav nav-pills nav-justified" id="Tpills" style="border-bottom-style: solid;border-bottom-width: 3px;border-bottom-color: #001a00;">
        <li class="active"><a style="border-radius: 0px;" data-toggle="pill" href="#tab1">FUNCTIONAL ANNOTATION</a></li>
        <li><a style="border-radius: 0px;" data-toggle="pill" href="#tab2">ORTHOLOGS</a></li>
        <li><a style="border-radius: 0px;" data-toggle="pill" href="#tab3">GENE ATLAS</a></li>
        <li><a style="border-radius: 0px;" data-toggle="pill" href="#tab4">CO-EXPRESSION</a></li>
        <li><a style="border-radius: 0px;" data-toggle="pill" href="#tab5">TRAIT-WISE GENE EXPRESSION</a></li>
      </ul>
      <div class="tab-content" id="Tcontent">
        <br>
        <div class="tab-pane fadein active container" id="tab1" style="padding-top: 0px;padding-bottom: 0px;">
        <div class="panel panel-success">
          <div class="panel-heading" data-toggle="collapse" href="#collapsedef" style="padding: 1%;font-size: 16px;">
            <strong>Defline </strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapsedef" class="panel-body panel-collapse collapse in">
            <?php $posfun=strpos($file, "Functional Annotations");
                                                                $posorth=strpos($file, "Orthologs details");
                                                                $block1len=$posorth-$posfun;
                                                                $block1=substr( $file, $posfun, $block1len);
                                                                $posdef=strpos($block1, "Defline");
                                                                $pospfam=strpos($block1, "Protein family details");
                                                                $block11len=$pospfam-$posdef;
                                                                $block11=substr($block1, $posdef, $block11len);
                                                                $expblock11=explode("\n", $block11);
                                                                $sizeexpblock11=sizeof($expblock11);
                                                                $DEF=array();               #FOR DEFLINE store organisms on index DEF[0][0] and description on DEF[0][1]
                                                                for ($x=1; $x<$sizeexpblock11-1; $x++){
                                                                  $splitx = explode("\t", $expblock11[$x]);
                                                                  array_push($DEF, $splitx);
                                                                } 
                                                                ?>
                                                                <?php 
                                                                if($sizeexpblock11!=2){
                                                                echo '<div class="panel" style="border: 0; box-shadow:none;">
                                                                  <div class="panel-heading"> <div class="row">
                                                                  <div class="col-sm-3"><b>Gene Id</b></div>
                                                                    <div class="col-sm-9"><b>Description</b></div>
                                                                  </div>
                                                                  </div>
                                                                  
                                                                  <div class="panel-body">';
                                                                  $label=array("col-sm-3","col-sm-9");
                                                                  for ($i=0; $i<$sizeexpblock11-2; $i++){

                                                                    echo "<div class='row'>"; for($j=0; $j<sizeof($DEF[0]); $j++){
                                                                        echo "<p class=".$label[$j].">".ucfirst(strtolower($DEF[$i][$j]))."</p>";
                                                                        };
                                                                    echo "<br>";
                                                                    echo "</div>";
                                                                  }
                                                                  echo "</div>";
                                                                  echo "</div>";
                                                                }
                                                                else {
                                                                echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Defline information</i> available. </div>";
                                                                 }
                                                                ?>
          </div>
        </div>
      
    <div class="panel panel-success" >
          <div class="panel-heading" data-toggle="collapse" href="#collapsepfam" style="padding: 1%;font-size: 16px;">
            <strong>Protein Family Details </strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapsepfam" class="panel-body panel-collapse collapse in">
          <?php  $posgo=strpos($block1, "Gene ontology details");
                                                  $block12len=$posgo-$pospfam;
                                                  $block12=substr($block1, $pospfam, $block12len);
                                                  $expblock12=explode("\n", $block12);
                                                  $sizeexpblock12=sizeof($expblock12);
                                                  $PFAM=array();                #FOR POTEIN FAMILY DETAILS store description on index PFAM[0][0] and ID on PFAM[0][1]
                                                  for ($x=1; $x<$sizeexpblock12-1; $x++){ 
                                                    $splitx = explode("\t", $expblock12[$x]);
                                                    array_push($PFAM, $splitx);
                                                  }
                                                  ?>
                                                  <?php
                                                  if($sizeexpblock12!=2){
                                                      echo '<div class="panel" style="border: 0; box-shadow:none;">
                                                        <div class="panel-heading"><div class="row">
                                                              <div class="col-sm-3"><b>Source</b></div>
                                                              <div class="col-sm-3"><b>Source Id</b></div>
                                                              <div class="col-sm-6"><b>Description</b></div>
                                                        </div>
                                                      </div>
                                                        <div class="panel-body">';
                                                            $label=array("col-sm-3","col-sm-3","col-sm-6");
                                                            for ($i=0; $i<$sizeexpblock12-2; $i++){

                                                              echo "<div class='row'>"; for($j=0; $j<sizeof($PFAM[0]); $j++){
                                                                  echo "<p class=".$label[$j].">".ucfirst(strtolower($PFAM[$i][$j]))."</p>";
                                                                  };
                                                              echo "<br>";    
                                                              echo "</div>";
                                                            }
                                                            echo "</div>";
                                                            echo "</div>";
                                                          }
                                                   else {
                                                                echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Protein Family information</i> available. </div>";
                                                                 }       
                                                             ?>
          </div>
        </div>  

          <div class="panel panel-success" >
          <div class="panel-heading" data-toggle="collapse" href="#collapsego" style="padding: 1%;font-size: 16px;">
            <strong>Gene Ontology Details </strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapsego" class="panel-body panel-collapse collapse in">
          <?php $posmapman=strpos($block1, "Mapman Annotation");
                                                    $block13len=$posmapman-$posgo;
                                                    $block13=substr($block1, $posgo, $block13len);
                                                    $expblock13=explode("\n", $block13);
                                                    $sizeexpblock13=sizeof($expblock13);
                                                    $GO=array();                #FOR GENE ONTOLOGY DETAILS store ID on index GO[0][0], TERM on GO[0][1], BP on GO[0][2], MF on GO[0][3], CL on GO[0][4]
                                                    for ($x=1; $x<$sizeexpblock13-1;$x++){
                                                      $splitx = explode("\t", $expblock13[$x]);
                                                      array_push($GO, $splitx);
                                                    } 
                                                    ?>
                                                    <?php 
                                                    if($sizeexpblock13!=2){
                                                    echo '<div class="panel" style="border: 0; box-shadow:none;">';
                                                          echo '<div class="panel-heading"><div class="row">
                                                              <div class="col-sm-2"><b>GO Id</b></div>
                                                              <div class="col-sm-4"><b>GO Term</b></div>
                                                              <div class="col-sm-6"><b>Category</b><br> (BP:Biological Process, MF: Molecular Function, CC: Cellular Location)</div>
                                                              </div>
                                                                </div>';
                                                          echo '<div class="panel-body">';
                                                    $label=array("col-sm-2","col-sm-4","col-sm-6");
                                                    for ($i=0; $i<$sizeexpblock13-2; $i++){

                                                    echo "<div class='row'>"; for($j=0; $j<sizeof($GO[0]); $j++){
                                                        echo "<p class=".$label[$j].">";
                                                        if($j!=2)
                                                          {
                                                            echo ucfirst(strtolower($GO[$i][$j]));
                                                          }
                                                          else{
                                                            echo $GO[$i][$j];
                                                          }
                                                          echo "</p>";
                                                        };
                                                    echo "<br>";    
                                                    echo "</div>";
                                                    }
                                                    echo '</div>';
                                                  echo '</div>';
                                                  }
                                                  else {
                                                    echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Gene Ontology information</i> available. </div>";
                                                  }
                                                  ?>
            </div>
        </div> 

          <div class="panel panel-success" >
          <div class="panel-heading" data-toggle="collapse" href="#collapsemap" style="padding: 1%;font-size: 16px;">
            <strong>Mapman Annotaion </strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapsemap" class="panel-body panel-collapse collapse in">
              <?php  $pospath=strpos($block1, "Pathway details");
                                                          $block14len=$pospath-$posmapman;
                                                          $block14=substr($block1,$posmapman,$block14len);
                                                          $expblock14=explode("\n", $block14);
                                                          $sizeexpblock14=sizeof($expblock14);
                                                          $MAP=array();               #FOR MAPMAN ANNOTATION store ID on index MAP[0][0] and DESCRIPTION on MAP[0][1]
                                                          for ($x=1; $x<$sizeexpblock14-1; $x++){
                                                            $splitx = explode("\t", $expblock14[$x]);
                                                            array_push($MAP, $splitx);
                                                          } 
                                                          ?>
                                                          <?php
                                                          if($sizeexpblock14!=2){
                                                              echo '<div class="panel" style="border: 0; box-shadow:none;">
                                                                <div class="panel-heading"><div class="row">
                                                                    <div class="col-sm-3"><b>Mapman Term</b></div>
                                                                    <div class="col-sm-9"><b>Description</b></div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">';
                                                      $label=array("col-sm-3","col-sm-9");
                                                              for ($i=0; $i<$sizeexpblock14-2; $i++){

                                                                echo "<div class='row'>"; for($j=0; $j<sizeof($MAP[0]); $j++){
                                                                    echo "<p class=".$label[$j].">".ucfirst(strtolower($MAP[$i][$j]))."</p>";
                                                                    };
                                                                echo "<br>";
                                                                echo "</div>";
                                                              }
                                                              echo "</div>";
                                                                  echo "</div>";
                                                            }
                                                           else {
                                                               echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Mapman Annotation information</i> available. </div>";
                                                                } 
                                                                  ?>
        </div>
        </div>

        <div class="panel panel-success" >
          <div class="panel-heading" data-toggle="collapse" href="#collapsepath" style="padding: 1%;font-size: 16px;">
            <strong>Pathways Details</strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapsepath" class="panel-body panel-collapse collapse in">
            <?php $posenz=strpos($block1, "Enzyme class details");
                                                          $block15len=$posenz-$pospath;
                                                          $block15=substr($block1,$pospath,$block15len);
                                                          $expblock15=explode("\n", $block15);
                                                          $sizeexpblock15=sizeof($expblock15);
                                                          $PATH=array();                #FOR PATHWAY DETAILS store PATHWAYNAME on index PATH[0][0] and DESCRIPTION on PATH[0][1]
                                                          for ($x=1; $x<$sizeexpblock15-1; $x++){
                                                            $splitx = explode("\t", $expblock15[$x]);
                                                            array_push($PATH, $splitx);
                                                          } 
                                                          ?>
                                                          <?php
                                                          if($sizeexpblock15!=2){
                                                              echo '<div class="panel" style="border: 0; box-shadow:none;">
                                                                <div class="panel-heading"><div class="row">
                                                                  <div class="col-sm-3"><b>Source</b></div>
                                                                  <div class="col-sm-9"><b>Description</b></div>
                                                                  </div>
                                                                </div>
                                                                <div class="panel-body">';
                                                      $label=array("col-sm-3","col-sm-9");
                                                      for ($i=0; $i<$sizeexpblock15-2; $i++){

                                                        echo "<div class='row'>"; for($j=0; $j<sizeof($PATH[0]); $j++){
                                                            echo "<p class=".$label[$j].">".ucfirst(strtolower($PATH[$i][$j]))."</p>";
                                                            };
                                                        echo "<br>";
                                                        echo "</div>";
                                                      }
                                                      echo "</div>";
                                                                  echo "</div>";
                                                    }
                                                    else {
                                                               echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Pathways information</i> available. </div>";
                                                                }
                                                          ?>
            </div>
        </div>

       <div class="panel panel-success" >
          <div class="panel-heading" data-toggle="collapse" href="#collapseenz" style="padding: 1%;font-size: 16px;">
            <strong>Enzyme Class Details </strong><span class="caret" style="border-width:7px;float:right;"></span>
          </div>
          <div id="collapseenz" class="panel-body panel-collapse collapse in">
              <?php
                                                          $block16=substr($block1,$posenz);
                                                          $expblock16=explode("\n", $block16);
                                                          $sizeexpblock16=sizeof($expblock16);
                                                          $ENZ=array();               #FOR ENZYMES store EC-CLASS on index ENZ[0][0] and DESCRIPTION on ENZ[0][1]
                                                          for ($x=1; $x<$sizeexpblock16-1; $x++){
                                                            $splitx = explode("\t", $expblock16[$x]);
                                                            array_push($ENZ, $splitx);
                                                          } 
                                                          ?>
                                                          <?php
                                                          if($sizeexpblock16!=2){
                                                             echo '<div class="panel" style="border: 0; box-shadow:none;">
                                                                <div class="panel-heading"><div class="row">
                                                                  <div class="col-sm-3"><b>Enzyme Class</b></div>
                                                                  <div class="col-sm-9"><b>Description</b></div>
                                                                  </div>
                                                                </div>
                                                                <div class="panel-body">';
                                                      $label=array("col-sm-3","col-sm-9");
                                                      for ($i=0; $i<$sizeexpblock16-2; $i++){

                                                        echo "<div class='row'>"; for($j=0; $j<sizeof($ENZ[0]); $j++){
                                                            echo "<p class=".$label[$j].">".ucfirst(strtolower($ENZ[$i][$j]))."</p>";
                                                            };
                                                        echo "<br>";
                                                        echo "</div>";
                                                      }
                                                      echo "</div>";
                                                                  echo "</div>";
                                                    }
                                                    else {
                                                               echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Enzymes information</i> available. </div>";
                                                           }        
                                                          ?>
            </div>
        </div>
  </div>
        <div class="tab-pane fadein container" id="tab2" style="padding-top: 0px;padding-bottom: 0px;">
  <div class="panel panel-success">
              <?php 
              $poscoexp=strpos($file, "Coexpression");
            $block2len=$poscoexp-$posorth;
            $block2=substr( $file, $posorth, $block2len);
            $expblock2=explode("\n", $block2);
            $sizeexpblock2=sizeof($expblock2);
                if($sizeexpblock2!=2){
                  echo '<div class="panel-heading"><div class="row">
                              <div class="col-sm-3"><b>Species</b></div>
                              <div class="col-sm-3"><b>Gene Id</b></div>
                              <div class="col-sm-6"><b>Description</b></div>
                                  </div>
              </div>
              <div class="panel-body">';
            $orthsub=array();
            for ($x=1; $x<$sizeexpblock2-1;$x++){
              $expsub=explode("\t", $expblock2[$x]);
              array_push($orthsub, $expsub);
            }
            $orthdeep=array();
            for ($x=1; $x<sizeof($orthsub);$x++){
              for ($y=0; $y<sizeof($orthsub[$x]);$y++){
                $expdeep=explode("|", $orthsub[$x][$y]);
                array_push($orthdeep, $expdeep);
              }
            }
            function partition( $list, $p ) {
              $listlen = count( $list );
              $partlen = floor( $listlen / $p );
              $partrem = $listlen % $p;
              $partition = array();
              $mark = 0;
              for ($px = 0; $px < $p; $px++) {
                  $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
                  $partition[$px] = array_slice( $list, $mark, $incr );
                  $mark += $incr;
              }
              return $partition;
            }

            $fragment=partition( $orthdeep, 2 );
            for ($u=0;$u<sizeof($orthsub[0]);$u++){
              echo "<div class='row'>";
              echo "<div class='col-sm-3' style='color:#330000;'>";
              echo ucfirst(strtolower($orthsub[0][$u]));                  ####Species#####
              echo "</div>";
              echo "<div class='col-sm-3' style='color:#662200;'>";
              for ($q=0;$q<sizeof($fragment[0][$u]);$q++){
                echo "<p>";
                if($fragment[0][$u][$q]!=""){
                echo ucfirst(strtolower($fragment[0][$u][$q]));
                }
                else{
                  echo "-";
                }
                echo "</p>";       #####Ids#####
              }
              echo "</div>";
              echo "<div class='col-sm-6' style='color:#993300;'>";
              for ($q=0;$q<sizeof($fragment[1][$u]);$q++){
                echo "<p>";
                if($fragment[1][$u][$q]!=""){
                echo ucfirst(strtolower($fragment[1][$u][$q]));
                }
                else{
                  echo "-";
                }
                echo "</p>";       #####Description####
              }
              echo "</div>";
              echo "</div>";
              echo "<br>";
            };
            echo "</div>";
                }
             else{
              echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Orthologs information</i> available. </div>";
             }   
              ?>
              </div>
  </div>
    <div class="tab-pane fadein" id="tab3">

<?php
  if(file_exists("Results/CAtlasPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."ExpressionAtlas.txt")&&filesize("Results/CAtlasPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."ExpressionAtlas.txt")){
  echo '<div class="container" style="padding-top: 2%;padding-bottom: 0;">
 <p style="font-size: 26px;"><strong> Transcript abundance in Gene Expression Atlas:</strong></p>
    </div>';
    $dirplot="Results/DAtlasPlot/".$_SESSION["selectsp"]."/".$_SESSION['token']."/";    
    $dirDplots=scandir($dirplot);
    $dirDplotslen=sizeof($dirDplots); 
echo '<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" style="background-color: #4d4d4d;" data-slide-to="0" class="active"></li>'; 
          for($i=2;$i<$dirDplotslen;$i++){
              $indi=$i-1;
              echo "<li data-target='#myCarousel' style='background-color: #4d4d4d;' data-slide-to='".$indi."'></li>";
          }
    echo '</ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
<div class="item active">
        <div class="container">
     <div id="chartall" class="c3" align="center" style="height: 600px;width: 100%;"></div>'; 
  echo "<script type='text/javascript'>
  var chart = c3.generate({
    bindto: '#chartall',
    data: {
      columns: [
        ['data1',";    
    $dircombine="Results/CAtlasPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."ExpressionAtlas.txt";   
    $fileplot=file_get_contents($dircombine);
    $expfileplot=explode("\n", $fileplot);
    $labels=explode("\t", $expfileplot[0]);
    $values=explode("\t", $expfileplot[1]);
    for ($t=1;$t<sizeof($values);$t++){
      echo $values[$t];
      if($t<sizeof($values)-1){
        echo ",";
      }
    }
        echo "],";
      echo "],
      type: 'bar',
      colors: {
        data1: '#009900',
      },
      names: {
            data1: '";
            echo $values[0];
        echo "'}
    },
    axis: {
        x: {
            tick: {
              fit: true,
              rotate: 90,
              multiline: false
            },
            label: '";
            echo $labels[0];
            echo "',
            type: 'category',
            categories: [";
    for ($t=1;$t<sizeof($labels);$t++){
      echo "'".$labels[$t]."'";
      if($t<sizeof($labels)-1){
        echo ",";
      }
    }
            echo "]
        },
        y: {
            label: '";
            echo "Expression[Log2(FPKM)]";
            echo "',
        }
    }
});
</script>";
$Dtotplots=$dirDplotslen-1;
echo "</div>
<br>
        <div class='carousel-caption' style='color: #000000;'>
          <p style='text-shadow: none;font-size:22px;'>Expression atlas of all tissues <b>(1/".$Dtotplots.")</b></p>
        </div>
      </div>";      
  for($i=2;$i<$dirDplotslen;$i++){
    $cplotindex=$i-1;
   echo  "<div class='item'>
     <div class='container'>
     <div id='chart".$cplotindex."' class='c3' align='center' style='height: 600px;width: 100%;'></div> 
  <script type='text/javascript'>
  var chart = c3.generate({
    bindto: '#chart".$cplotindex."',
    data: {
      columns: [
        ['data1',"; 
    $cplots=$dirplot.$dirDplots[$i];    
    $fileplot=file_get_contents($cplots);
    $expfileplot=explode("\n", $fileplot);
    $labels=explode("\t", $expfileplot[0]);
    $values=explode("\t", $expfileplot[1]);
    for ($t=1;$t<sizeof($values);$t++){
      echo $values[$t];
      if($t<sizeof($values)-1){
        echo ",";
      }
    }
        echo "],";
    echo "['data2',"; 
    $fileplot=file_get_contents($cplots);
    $expfileplot=explode("\n", $fileplot);
    $labels=explode("\t", $expfileplot[0]);
    $values=explode("\t", $expfileplot[1]);
    for ($t=1;$t<sizeof($values);$t++){
      echo $values[$t];
      if($t<sizeof($values)-1){
        echo ",";
      }
    }
        echo "]";

      echo "],
      type: 'bar',
      types: {
        data2: 'line',
      },
      colors: {
        data1: '#009933";
        echo "',
      },
      names: {
            data1: '";
            echo $values[0];
            echo "',";
            echo "data2: null,";
        echo "}
    },
    axis: {
        x: {
            tick: {
              fit: true,
              rotate: 90,
              multiline: false
            },
            label: '";
            echo $labels[0];
            echo "',
            type: 'category',
            categories: [";
    for ($t=1;$t<sizeof($labels);$t++){
      echo "'".$labels[$t]."'";
      if($t<sizeof($labels)-1){
        echo ",";
      }
    }
            echo "]
        },
        y: {
            label: '";
            echo "Expression[Log2(FPKM)]";
            echo "',
        }
    }
});
</script>";
$Dtotplots=$dirDplotslen-1;
$cindexcaption=$cplotindex+1;
echo "</div>
<br>
        <div class='carousel-caption' style='color: #000000;'>
          <p style='text-shadow: none;font-size:22px;'>".strtoupper(substr($dirDplots[$i],0,strpos($dirDplots[$i],'.')))." <b>(".$cindexcaption."/".$Dtotplots.")</b></p>
        </div>
      </div>";
}
echo '<a class="left carousel-control" style="background-image: none; color: #000000;" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" style="font-size:3vw"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" style="background-image: none; color: #000000;" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" style="font-size:3vw"></span>
      <span class="sr-only">Next</span>
    </a>
        </div></div>';
}
else{
  echo '<div class="container">
  <div class="alert alert-warning">
  <strong>Sorry!</strong> No <i>Gene Atlas </i>information available </a>.
</div>
</div>';
}

?>
        </div>
        <div class="tab-pane fadein" id="tab4">
        <br>
        <?php 
        echo '<div class="panel panel-success" style="margin-left: 15%;margin-right: 15%;">'; 
          echo '<div class="panel-heading" data-toggle="collapse" href="#collapsepcc" style="padding: 1%;font-size: 16px;">
            <strong>List of co-expressed genes </strong><span style="border-width:7px;float:right;" class="caret"></span>
          </div>
          <div id="collapsepcc" class="panel-body panel-collapse collapse in table-responsive">';
          if(file_exists("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."PCCPairs_Top15.txt")&&filesize("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."PCCPairs_Top15.txt")){
          echo '<table class="table table-hover">
                  <thead>
                    <tr>
                    <th>Gene Id</th>
                    <th>Pearson Correlation Coefficient</th>
                    <th>Defline</th>
                    </tr>
                  </thead>
                  <tbody>'; 
                      $coexpfile=file_get_contents("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."PCCPairs_Top15.txt");
                      $expcoexpfile=explode("\n", $coexpfile);
                      $expcoexpfilelen=sizeof($expcoexpfile);
                      for ($i=0;$i<$expcoexpfilelen-1;$i++){
                        $splitcoexp=explode("^", $expcoexpfile[$i]);
                        echo "<tr>";
                        for ($j=0;$j<sizeof($splitcoexp);$j++){
                          echo "<td>".$splitcoexp[$j]."</td>";
                        }
                      echo "</tr>";
                      }      
                  echo '</tbody>
                </table>';
              }
          else{
              echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Co-expressed genes</i> list available. </div>";
               }
    echo '</div></div>';
    echo '<div class="panel panel-success" style="margin-left: 15%;margin-right: 15%;">
          <div class="panel-heading" data-toggle="collapse" href="#collapseplot1" style="padding: 1%;font-size: 16px;">
            <strong>Co-expression plot of all co-expressed genes </strong><span style="border-width:7px;float:right;" class="caret"></span>
          </div>
          <div id="collapseplot1" class="panel-body panel-collapse collapse in">
    <div class="container">';
    if(file_exists("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."Plot.txt")&&filesize("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."Plot.txt")){
      echo '<div id="chartexp" class="c3" align="center" style="height: 600px;width: 100%;"></div> ';
      echo "<script type='text/javascript'>
      var chart = c3.generate({
          bindto: '#chartexp',
          data: {
            columns: [";
            $fileplot=file_get_contents("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."Plot.txt");
          $expfileplot=explode("\n", $fileplot);
          $labels=explode("\t", $expfileplot[0]);
          $totgenes=sizeof($expfileplot);
          $eachgene=array();
          for($h=1;$h<$totgenes-1;$h++){
            $values=explode("\t", $expfileplot[$h]);
            array_push($eachgene, $values);
          }
          for($h=0;$h<sizeof($eachgene);$h++){
            echo "['data";
            echo $h+1;
            echo "',";
              for ($t=1;$t<sizeof($eachgene[$h]);$t++){
                  echo $eachgene[$h][$t];
                  if($t<sizeof($values)-1){
                    echo ",";
            }
          }
          echo "],";
          }
              echo "],
            type: 'line',
            colors: {
              data1: '#ff5050',";
            for($h=0;$h<sizeof($eachgene);$h++){
                      echo "data";
                      echo $h+2;
                      echo ":";
                      echo "'#00cc44'";
                      echo ",";
                    }

            echo "},
            names: {";
                  for($h=0;$h<sizeof($eachgene);$h++){
                      echo "data";
                      echo $h+1;
                      echo ":";
                      echo "'".$eachgene[$h][0]."'";
                      echo ",";
                    }
              echo "},},
          axis: {
              x: {
                  tick: {
                    fit: true,
                    rotate: 90,
                    multiline: false
                  },
                  label: '";
                  echo $labels[0];
                  echo "',
                  type: 'category',
                  categories: [";
          for ($t=1;$t<sizeof($labels);$t++){
            echo "'".$labels[$t]."'";
            if($t<sizeof($labels)-1){
              echo ",";
            }
          }
                  echo "]
              },
              y: {
                  label: '";
                  echo "Log2Value";
                  echo "',
              }
          }
      });
      </script>";
    }
      else{
            echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Co-expression Plot</i> available. </div>";
      }
echo '</div>
    </div>
    </div>
    <div class="panel panel-success" style="margin-left: 15%;margin-right: 15%;">
          <div class="panel-heading" data-toggle="collapse" href="#collapseenrich" style="padding: 1%;font-size: 16px;">
            <strong>Enriched GO terms in co-expressed genes </strong>[pvalue < 0.1] <span style="border-width:7px;float:right;" class="caret"></span>
          </div>
          <div id="collapseenrich" class="panel-body panel-collapse collapse in table-responsive">';
          if(file_exists("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."GSEA_GO.txt")&&filesize("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."GSEA_GO.txt")){
          echo '<table class="table table-hover">
            <thead>
              <tr>
                <th>GO Id</th>
                <th>GO Description</th>
                <th>Category(BP/MF/CL)</th>
                <th>Frequency of GO Id in list</th>
                <th>Frequency of GO Id in reference sequence</th>
                <th>p-Value</th>
              </tr>
            </thead>
            <tbody>';
              $enrichfile=file_get_contents("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."GSEA_GO.txt");
            $expenrichfile=explode("\n", $enrichfile);
            $expenrichfilelen=sizeof($expenrichfile);
            for ($i=0;$i<$expenrichfilelen-1;$i++){
              $splitenrich=explode("^", $expenrichfile[$i]);
              echo "<tr>";
              for ($j=0;$j<sizeof($splitenrich);$j++){
                echo "<td>".$splitenrich[$j]."</td>";
              }
              echo "</tr>";
            }
            echo '</tbody>
          </table>';
          } 
          else{
            echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Enriched GO terms</i> available. </div>";
      }
    echo '</div> </div>';

     echo '<div class="panel panel-success" style="margin-left: 15%;margin-right: 15%;">
          <div class="panel-heading" data-toggle="collapse" href="#collapsepathwayck" style="padding: 1%;font-size: 16px;">
            <strong>Enriched pathway terms in co-expressed genes </strong>[pvalue < 0.1] <span style="border-width:7px;float:right;" class="caret"></span>
          </div>
          <div id="collapsepathwayck" class="panel-body panel-collapse collapse in table-responsive">';
          if(file_exists("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."GSEA_Pathway.txt")&&filesize("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."GSEA_Pathway.txt")){
          echo '<table class="table table-hover">
            <thead>
              <tr>
                <th>Pathway Name</th>
                <th>Pathway Description</th>
                <th>Frequency in co-expreseed genes</th>
                <th>Frequency in genome</th>
                <th>p-Value</th>
              </tr>
            </thead>
            <tbody>';
              $pathfile=file_get_contents("Results/CoexpressionPlot/".$_SESSION['selectsp']."/".$_SESSION['token']."GSEA_Pathway.txt");
            $exppathfile=explode("\n", $pathfile);
            $exppathfilelen=sizeof($exppathfile);
            for ($i=0;$i<$exppathfilelen-1;$i++){
              $splitpath=explode("^", $exppathfile[$i]);
              echo "<tr>";
              for ($j=0;$j<sizeof($splitpath);$j++){
                echo "<td>".$splitpath[$j]."</td>";
              }
              echo "</tr>";
            }
            echo '</tbody>
          </table>';
        }
         else{
            echo "<div class='alert' style='padding:1%;'><strong>Sorry!</strong> No <i>Enriched Pathway terms</i> available. </div>";
      } 
    echo '</div></div>';  
    ?>
  </div>        
        <div class="tab-pane fadein" id="tab5">
              <br>
              <p style="margin-left:15%; margin-right: 15%;color: #343232;font-size: 160%;">Select relevant trait and transcriptome study :</p>
              <div class="container" style="padding-top: 2%;padding-bottom: 2%;">
              <form action method="post" id="demoForm" class="demoForm">
              <div class="row" ng-app="myApp" ng-controller="myCtrl"> 
              <div class="form-group col-md-4">
              <label for="sel1" style="font-weight: normal;">Select trait from the list:</label>
                <select id="sel1" name="category" class="form-control" ng-model="selectedtrait">
                          <option value="" selected disabled hidden>Choose here</option>
                          <option ng-repeat="x in trait" value="{{x.model}}">{{x.model}}</option>
                </select>
              </div>
              <div class="form-group col-md-8">
              <label for="choices" style="font-weight: normal;">Select the desired study for {{selectedtrait}}:</label>
                 <select name="choices" id="choices" class="form-control">
                          <!-- populated using JavaScript -->
                 </select>
              </div>
              </div>
              <script>
              var app = angular.module('myApp', []);
              app.controller('myCtrl', function($scope) {
                $scope.trait = [
                    {model : "Kernal Development"},
                    {model : "Hormonal Regulation"},
                    {model : "Biotic Stress"},
                    {model : "Endosperm Development"},
                    {model : "Embryo Development"},
                    {model : "C4 Leaf Development"},
                    {model : "Nitrogen use Efficiency"},
                    {model : "C4 Photosynthesis"},
                    {model : "Internode Development"},
                    {model : "Tillering"},
                ];
              });
              </script>  
              <br>
              
                <div class="form-group row"> 
                <div class="col-sm-12" align="center">
                  <button type="button" id='tab5submit' name="tab5press" class="btn btn-success btn-lg" onclick="hidesub();">Submit</button>
                </div>
              </div>
              </form>
              <br>
              <div id='response'></div>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script>
                /*function hidesub() {
                    var x = document.getElementById("tab5submit");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                }*/
              $(document).ready(function(){
                $('#tab5submit').click(function(){
                 var choices = $('#choices').val();

                 $.ajax({
                  type: 'post',
                  data: {ajax: 1,choices: choices},
                  success: function(response){
                   $('#response').html(response);
                  }
                 });
                });
              });
              </script>
               </div> 
               <?php
              $eachtraitentry=array();
              $traitfile=file_get_contents("Trait_Module/TraitStudiesGeneId/".$_SESSION['token']."Trait_Studieslist_Geneid.txt");
              $exptraitfile=explode("\n", $traitfile);
              $exptraitfilelen=sizeof($exptraitfile);
              for($k=0;$k<$exptraitfilelen;$k++){
                $splittrait=explode("\t", $exptraitfile[$k]);
                array_push($eachtraitentry, $splittrait);
              }
              echo "<script>";
echo "var Select_List_Data = {
    
    'choices': { 
        'Kernal Development': {
            text: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Kernal Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Kernal Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Hormonal Regulation': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Hormonal Regulation", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Hormonal Regulation", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Biotic Stress': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Biotic Stress", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Biotic Stress", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Endosperm Development': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Endosperm Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Endosperm Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Embryo Development': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Embryo Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Embryo Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";                                
        echo "'C4 Leaf Development': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("C4 Leaf Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("C4 Leaf Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Nitrogen use Efficiency': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Nitrogen use Efficiency", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Nitrogen use Efficiency", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'C4 Photosynthesis': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("C4 Photosynthesis", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("C4 Photosynthesis", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Internode Development': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Internode Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Internode Development", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";
        echo "'Tillering': {
            text: [";
            for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Tillering", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][2]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                        }
                        }
                        }
                        echo "],";
            echo "value: ["; 
                        for($i=0;$i<sizeof($eachtraitentry);$i++){
                        if(in_array("Tillering", $eachtraitentry[$i])){
                        echo "'".$eachtraitentry[$i][1]."~".$eachtraitentry[$i][3]."~".$eachtraitentry[$i][4]."~".$eachtraitentry[$i][5]."'";
                        if($i<sizeof($eachtraitentry)-2){
                        echo ",";
                      }
                        }
                        }
                        echo "]},";                                                                
   echo "}    
};";
echo "</script>";
              ?>
        </div>
</div>
<br>
<div style="margin-left: -1%; margin-right: -1%;background-color: #003300" > 
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
            <p style="color: #FFFFFF;font-size: 20px;">Send Us A Mail :</p>
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
<script type="text/javascript">
// removes all option elements in select box 
// removeGrp (optional) boolean to remove optgroups
function removeAllOptions(sel, removeGrp) {
    var len, groups, par;
    if (removeGrp) {
        groups = sel.getElementsByTagName('optgroup');
        len = groups.length;
        for (var i=len; i; i--) {
            sel.removeChild( groups[i-1] );
        }
    }
    
    len = sel.options.length;
    for (var i=len; i; i--) {
        par = sel.options[i-1].parentNode;
        par.removeChild( sel.options[i-1] );
    }
}

function appendDataToSelect(sel, obj) {
    var f = document.createDocumentFragment();
    var labels = [], group, opts;
    
    function addOptions(obj) {
        var f = document.createDocumentFragment();
        var o;
        
        for (var i=0, len=obj.text.length; i<len; i++) {
            o = document.createElement('option');
            o.appendChild( document.createTextNode( obj.text[i] ) );
            
            if ( obj.value ) {
                o.value = obj.value[i];
            }
            
            f.appendChild(o);
        }
        return f;
    }
    
    if ( obj.text ) {
        opts = addOptions(obj);
        f.appendChild(opts);
    } else {
        for ( var prop in obj ) {
            if ( obj.hasOwnProperty(prop) ) {
                labels.push(prop);
            }
        }
        
        for (var i=0, len=labels.length; i<len; i++) {
            group = document.createElement('optgroup');
            group.label = labels[i];
            f.appendChild(group);
            opts = addOptions(obj[ labels[i] ] );
            group.appendChild(opts);
        }
    }
    sel.appendChild(f);
}
// anonymous function assigned to onchange event of controlling select box
document.forms['demoForm'].elements['category'].onchange = function(e) {
    // name of associated select box
    var relName = 'choices';
    
    // reference to associated select box 
    var relList = this.form.elements[ relName ];
    
    // get data from object literal based on selection in controlling select box (this.value)
    var obj = Select_List_Data[ relName ][ this.value ];
    
    // remove current option elements
    removeAllOptions(relList, true);
    
    // call function to add optgroup/option elements
    // pass reference to associated select box and data for new options
    appendDataToSelect(relList, obj);
};


// populate associated select box as page loads
(function() { // immediate function to avoid globals
    
    var form = document.forms['demoForm'];
    
    // reference to controlling select box
    var sel = form.elements['category'];
    sel.selectedIndex = 0;
    
    // name of associated select box
    var relName = 'choices';
    // reference to associated select box
    var rel = form.elements[ relName ];
    
    // get data for associated select box passing its name
    // and value of selected in controlling select box
    var data = Select_List_Data[ relName ][ sel.value ];
    
    // add options to associated select box
    appendDataToSelect(rel, data);
    
}());
</script>
</body>
</html>