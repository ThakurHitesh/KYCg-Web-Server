<?php
// Start the session
session_start();
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'), range('A','Z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

$_SESSION['token']=random_string(25);

$deletefiles=array("Results/FunctionalAnnotation/Sorghum_bicolor/*","Trait_Module/TraitStudiesGeneId/*","Results/CAtlasPlot/Sorghum_bicolor/*","Results/CoexpressionPlot/Sorghum_bicolor/*","Results/TraitWise/*");
for ($d=0;$d<sizeof($deletefiles);$d++){
  $files = glob($deletefiles[$d]);
  foreach($files as $file) { // iterate files
    // if file creation time is more than 5 minutes
    if ((time() - filectime($file)) > 86400) {  // 86400 = 60*60*24
        unlink($file);
    }
}
}
?>
<?php
  function emptyDir($subdir) {
    if (is_dir($subdir)) {
        $scn = scandir($subdir);
        foreach ($scn as $files) {
            if ($files !== '.') {
                if ($files !== '..') {
                    if (!is_dir($subdir . '/' . $files)) {
                        unlink($subdir . '/' . $files);
                    } else {
                        emptyDir($subdir . '/' . $files);
                        rmdir($subdir . '/' . $files);
                    }
                }
            }
        }
    }
}

$dir = glob("Results/DAtlasPlot/Sorghum_bicolor/*");
foreach ($dir as $subdir) {
  emptyDir($subdir);
  if ((time() - filectime($subdir)) > 86400) {
  rmdir($subdir);
  }
}
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
    <link rel="icon" type="image/png" href="contactform/images/icons/favicon.ico"/>
      <link rel="stylesheet" type="text/css" href="contactform/css/main.css">

<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>

<style type="text/css">#msubmit:focus{
    outline:none;
    outline-offset: none;
    }
    #tssrsubmit:focus{
    outline:none;
    outline-offset: none;
    }
    #tfpsubmit:focus{
    outline:none;
    outline-offset: none;
    }
    .button_loader {
    background-color: transparent;
    border: 4px solid #f3f3f3;
    border-radius: 20%;
    border-top: 4px solid #969696;
    border-bottom: 4px solid #969696;
    width: 35px;
    height: 35px;
    -webkit-animation: spin 0.8s linear infinite;
    animation: spin 0.8s linear infinite;
    }

    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    99% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    99% { transform: rotate(360deg); }
    }
    @media only screen and (max-width: 750px) {
    #aligngenebox{
      margin-left: 33.5%;
    }
    @media only screen and (max-width: 690px) {
    #aligngenebox{
      margin-left: 30%;
    }
     @media only screen and (max-width: 550px) {
    #aligngenebox{
      margin-left: 24%;
    }
    @media only screen and (max-width: 380px) {
    #aligngenebox{
      margin-left: 10%;
    }
  }
    </style>
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
<div class="wrapper bgded overlay" style="background-image:url('Images/indexbg.jpg');">
  <div id="pageintro" class="hoc clear"> 
    <article>
      <h3 class="heading" style="font-size: 43px;">Knowledge miner of Your Candidate Gene</h3>
      <footer>
        <ul class="nospace inline pushright">
          <li><a class="btn" href="#introblocks">Run Knowledge Miner</a></li>
        </ul>
      </footer>
    </article>
  </div>
</div>
<form action="index.php#introblocks" method="post">
<div class="wrapper row3">
  <main class="hoc container clear"> 
      <section id="introblocks">
      <div class="sectiontitle" >
        <p style="font-size:16px;font-family: arial;">Select the species of interest and enter the gene ID</p>
      </div>
      <ul class="nospace btmspace-80 group">
        <li class="one_third">
                <select class="selectpicker" data-style="btn btn-default" multiple data-max-options="1" data-live-search="true" name="spicie">
                          <option value="Sorghum_bicolor">Sorghum bicolor</option>
                          <option value="Zea_mays">Zea mays</option>
                          <option value="Oryza_sativa">Oryza sativa</option>
                          <option value="Arabidopsis_thaliana" disabled="">Arabidopsis thaliana</option>
                </select>
        </li>
        <li class="one_third">
              <div class="form-group">
                  <input type="text" id='aligngenebox' style="width:210px; border-color: red;" class="form-control" placeholder="GeneID" name="geneid">
              </div>
        </li>
      </ul>
      <p class="center alert">Example : Select "Sorghum bicolor" and use "Sobic.001G009900" as Gene ID</p>
      <p class="center"><input type="submit" class="btn" name="genesub" value="Click to submit your inputs"></p>
      <p class="center" style="color: #cc0000;">
      <?php
        $checker=0;
          if(isset($_POST["genesub"])){
              if(!empty($_POST["spicie"]) && !empty($_POST["geneid"])){
                  $x=$_POST["spicie"];
                  $y=$_POST["geneid"];
                  if($x=='Sorghum_bicolor'){
                  $substr= substr($y,0,8);
                  $lastext=substr($y,strripos($y,"G")+1);
                  $lenlastext=strlen($lastext);
                  if (($substr=="Sobic.00" || $substr=="Sorbi_30") && $lenlastext==6) {
                    $checker=1;
                    $_SESSION['selectsp']=$x;
                    $_SESSION['selectgene']=$y;
                    echo "<br><div class='alert alert-success' style='text-align:center;border-radius:0px;'><span class='glyphicon glyphicon-ok-sign'></span>  Submitted successfully ! Hit RUN now</div>";
                  }
                  else{
                    echo "<br><div class='alert' style='text-align:center;border-radius:0px;background-color:#ff7d66;'><span class='glyphicon glyphicon-exclamation-sign'></span>  Enter a valid gene ID</div>";
                  }
                }
                if($x=='Zea_mays'){
                  $substr=substr($y,0,5);
                  $lastext=substr($y,strripos($y,"G")+1);
                  $newlastext=substr($y, 10, 4);
                  $pos=strpos($y, ".");
                  $lenlastext=strlen($lastext);
                   if (($substr=="GRMZM" || $newlastext=="_FG0") && ($lenlastext==6 || $pos==8)) {
                    $checker=1;
                    $_SESSION['selectsp']=$x;
                    $_SESSION['selectgene']=$y;
                    echo "<br><div class='alert alert-success' style='text-align:center;border-radius:0px;'><span class='glyphicon glyphicon-ok-sign'></span>  Submitted successfully ! Hit RUN now</div>";
                  }
                  else{
                    echo "<br><div class='alert' style='text-align:center;border-radius:0px;background-color:#ff7d66;'><span class='glyphicon glyphicon-exclamation-sign'></span>  Enter a valid gene ID</div>";
                  }
                }
                if($x=="Oryza_sativa"){
                  $substr=substr($y,0,6);
                  $lastext=substr($y,strripos($y,"g")+1);
                  $newlastext=substr($y, 5, 14);
                  $posstart=substr($y, 0, 3);
                  $lenlastext=strlen($lastext);
                   if (($substr=="LOC_Os" || $newlastext==".fgenesh.gene.") && ($lenlastext==5 || $posstart=="Chr")) {
                    $checker=1;
                    $_SESSION['selectsp']=$x;
                    $_SESSION['selectgene']=$y;
                    echo "<br><div class='alert alert-success' style='text-align:center;border-radius:0px;'><span class='glyphicon glyphicon-ok-sign'></span>  Submitted successfully ! Hit RUN now</div>";
                  }
                  else{
                    echo "<br><div class='alert' style='text-align:center;border-radius:0px;background-color:#ff7d66;'><span class='glyphicon glyphicon-exclamation-sign'></span>  Enter a valid gene ID</div>";
                  }

                }
              }
              else{
                  echo "<br><div class='alert' style='text-align:center;border-radius:0px;background-color:#ff7d66;'><span class='glyphicon glyphicon-exclamation-sign'></span>  First select the spicies and enter the gene ID</div>";
                }
            }
      ?>
      </p>
      <br>
        <div class="form-group" style="text-align: center;"><input type="button" id="<?php if($checker==1){ echo "msubmit";} else echo ""; ?>" onclick="location.href='<?php if($checker==1){ echo "result.php";} else echo "#"; ?>'" class=" btn btn-md" style="background: red;color: #ffffff;" value="RUN"/><br><span id="mJB" style="visibility: hidden; font-size: 24px; color: #1B4F72; font-variant-caps: small-caps; position: relative; top: 8px;">job running...</span></div>
          <script type="text/javascript">$('#msubmit').click(function(){
          document.getElementById("mJB").style.visibility="visible";   
          $(this).addClass('button_loader').attr("value","");
          window.setTimeout(function(){
          $('#msubmit').removeClass('button_loader').attr("value","\u2713");
          $('#msubmit').prop('disabled', true);
          },infinite);
          });</script>
        </div>
    </section>
  </main>
</div>
</form>
<div style="background-color: #003300;"> 
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
        <p class="nospace btmspace-15" style="color:#ffffff;">Enable users more information about the function or biological role of the gene, which should help them in finding causal gene(s).</p>
        <form method="post" action="#">
          <fieldset>
            <p style="color: #FFFFFF; font-size: 20px;">Send Us A Mail :</p>
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
      <p class="fl_right">Published by <a target="_blank">SDBM Unit, ICRISAT</a></p>
    </div>
  </div>
</div>
</body>
</html>