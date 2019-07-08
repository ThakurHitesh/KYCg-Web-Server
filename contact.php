<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="icon" type="image/png" href="contactform/images/icons/favicon.ico"/>  
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="contactform/css/util.css">
  <link rel="stylesheet" type="text/css" href="contactform/css/main.css">
<!--===============================================================================================-->
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
<div class="container-contact100">
    

    <div class="wrap-contact100">
      <span class="contact100-form-symbol">
        <img src="contactform/images/icons/symbol-01.png" alt="SYMBOL-MAIL">
      </span>

      <form class="contact100-form validate-form flex-sb flex-w">
        <span class="contact100-form-title">
          Drop Us A Message
        </span>

        <div class="wrap-input100 rs1 validate-input" data-validate = "Name is required">
          <input class="input100" type="text" name="name" placeholder="Name">
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 rs1 validate-input" data-validate = "Email is required: e@a.z">
          <input class="input100" type="text" name="email" placeholder="Email Address">
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Message is required">
          <textarea class="input100" name="message" placeholder="Write Us A Message"></textarea>
          <span class="focus-input100"></span>
        </div>

        <div class="container-contact100-form-btn">
          <button class="contact100-form-btn">
            Send
          </button>
        </div>
      </form>
    </div>
  </div>



  <div id="dropDownSelect1"></div>

  <div class="wrapper row5" style="background-color: #001a00">
    <div id="copyright" class="hoc clear"> 
      <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">ICRISAT</a></p>
      <p class="fl_right">Published by <a target="_blank">SDBM Unit, ICRISAT</a></p>
    </div>
  </div>
</div>
    <script src="js/classie.js"></script>
    <script src="js/selectFx.js"></script>
    <script>
      (function() {
        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {  
          new SelectFx(el, {
            stickyPlaceholder: false,
            onChange: function(val){
              document.querySelector('span.cs-placeholder').style.backgroundColor = val;
            }
          });
        } );
      })();
    </script>
    <!--===============================================================================================-->
  <script src="contactform/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="contactform/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="contactform/vendor/bootstrap/js/popper.js"></script>
  <script src="contactform/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="contactform/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="contactform/vendor/daterangepicker/moment.min.js"></script>
  <script src="contactform/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="contactform/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
  <script src="contactform/js/map-custom.js"></script>
<!--===============================================================================================-->
  <script src="contactform/js/main.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
  </script>
</body>
</html>
