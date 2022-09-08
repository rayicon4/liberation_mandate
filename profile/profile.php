<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();


$id = $_GET['q'];

if(isset($id)  && $id > 0  ){
require_once("../connect/connect.php"); 

$op = new DB;


//require_once '../home/utils/connect.php';



$f = $op->selectOne('mandates', NULL, array('id'=>$id, 'active'=> 0));

$name = $f->fullname;
$sex = $f->sex;
$position = $f->position;
$aboutme = $f->aboutme;
$manifesto = $f->manifesto;
$facebook = $f->facebook;
$twitter = $f->twitter;
$address = $f->address;
$email = $f->email;
$phrase = $f->phrase;
$passport = $f->passport;

	if(isset($passport) && is_file($passport) && file_exists($passport))
	{
		$passport = $passport;
	}
	else
	{
		$passport = '../admin/img/images.png';
	}


}
else
{
	#header('location:../home/index.php');
}

?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Liberators.com | Profile :: <?php echo $name;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all">
<link href="css/owl.theme.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="css/cm-overlay.css" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<!-- menu -->
<link rel="stylesheet" href="css/main.css">
<script type="text/javascript" src="js/main.js"></script>
<!-- //menu --> 
<script>
$(document).ready(function() { 
	$("#owl-demo").owlCarousel({
 
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		autoPlay:true,
		items : 3,
		itemsDesktop : [640,5],
		itemsDesktopSmall : [414,4]
 
	});
	
}); 
</script>
</head>
<body>
	<!-- banner -->
	<div class="banner" id="home">
		<!-- menu -->
			<div id="toggle_m_nav">
			  <div id="m_nav_menu" class="m_nav">
				<div class="m_nav_ham" id="m_ham_1"></div>
				<div class="m_nav_ham" id="m_ham_2"></div>
				<div class="m_nav_ham" id="m_ham_3"></div>
			  </div>
			</div>

			<div id="m_nav_container" class="m_nav">
			  <ul id="m_nav_list" class="m_nav">
				<li class="m_nav_item" id="m_nav_item_1"> <a href="../admin/liberators.php">Liberators</a> </li>
				<li class="m_nav_item" id="moble_nav_item_2"> <a href="../admin/mandatesAdd.php">Edit</a> </li>
				<li class="m_nav_item" id="moble_nav_item_3"> <a href="../admin/mandatesProfile.php">Passport</a> </li>
			  </ul>
			</div>
		<!-- menu -->
		<div class="container">
			<div class="agile-logo">
				<h1><a href="index.html">liberator's<span>Profile</span></a></h1>
			</div>
			<div class="w3l-banner-grids">
				<div class="col-md-8 w3ls-banner-right">
					<div class="banner-right-img">
						<img src="<?php echo $passport;?>" alt="" />
					</div>
					<div class="banner-right-info">
						<h2><?php echo $phrase;?></h2>
						<p><?php echo $manifesto;?></p>
					</div>
					<div class="clearfix"> </div>
					<div class="w3-button">
						<div class="w3-button-info m_nav_item">
							<a class="hvr-sweep-to-bottom" href="#contact">Contact Me</a>
						</div>
					</div>
					<div class="social-grids">
						<div class="social-info">
							<h4>Follow : </h4>
						</div>
						<div class="agileinfo-social-grids">
							<ul>
								<li><a target='_blank' href="<?php echo $facebook;?>"><i class="fa fa-facebook"></i></a></li>
								<li><a target='_blank' href="<?php echo $twitter;?>"><i class="fa fa-twitter"></i></a></li>
								
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-4 w3ls-banner-left">
					<div class="w3ls-banner-left-info">
						<h4>Position</h4>
						<p><?php echo $position;?></p>
					</div>
					<div class="w3ls-banner-left-info">
						<h4>Name</h4>
						<p><?php echo $name;?></p>
					</div>
					<div class="w3ls-banner-left-info">
						<h4>Sex</h4>
						<p><?php echo $sex;?></p>
					</div>
					<div class="w3ls-banner-left-info">
						<h4>Address</h4>
						<p><?php echo $address;?></p>
					</div>
					<div class="w3ls-banner-left-info">
						<h4>Email Address</h4>
						<p><a href="mailto:example@email.com"><?php echo $email;?></a></p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- about -->
	<div class="about" id="about">
		<div class="container">
			<div class="wthree-about-grids">
				<div class="col-md-6 wthree-about-left">
					<h3>About <?php echo $name;?></h3>
					<h5><?php echo $aboutme;?></h5>
				</div >
				<div class="col-md-6 wthree-about-right">
			
							
						<a class='btn btn-block btn-lg btn-info' href='../admin/mandatesAdd.php?id=<?php echo $id;?>'><i class='fa fa-edit'></i> Edit</a>
						<a class='btn btn-block btn-lg btn-info' href='../admin/profilephoto.php?id=<?php echo $id;?>'><i class='fa fa-image'></i> Photo</a>
						<a class='btn btn-block btn-lg btn-info' href='../admin/Mandates.php'><i class='fa fa-users'></i> Liberators</a>
				
	
				</div >
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //about -->
	<!-- statistics -->
	
	
	<!-- projects -->
	
	<!-- //projects -->
	
	<!-- contact -->
	
	<!-- //contact -->
	<!-- copyright -->
	<div class="agileits-w3layouts-footer">
		<div class="container">
			<p>© 2017 Liberators.com. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
		</div>
	</div>
	<!-- //copyright -->
	<script src="js/bars.js"></script>
	<script src="js/owl.carousel.js"></script> 
</body>	
</html>