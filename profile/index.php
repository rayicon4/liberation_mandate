<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

$id = $_GET['q'];
$rid = $_GET['r'];
if(isset($id)  && $id > 0 && strlen($id) > 0 && is_numeric($id)){
require_once("../connect/connect.php"); 

$op = new DB;


require_once '../home/utils/connect.php';



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

$raff = $op->selectOne('raffles', NULL, array('id'=>$rid));
}
else
{
	header('location:../home/index.php');
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
<meta name="keywords" content="Creative Resume Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
<style>
.w3ls-banner-left-info > p{
	font-size: 20px
}
#holla > span{
	font-size: 14px !important;
	font-family: Arial;
}

</style>
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
				<li class="m_nav_item" id="m_nav_item_1"> <a href="../home/index.php">Home</a> </li>
				<li class="m_nav_item" id="moble_nav_item_2"> <a href="../home/raffle.php">Raffles</a> </li>
				<li class="m_nav_item" id="moble_nav_item_3"> <a href="../home/about.php">About</a> </li>
				<li class="m_nav_item" id="moble_nav_item_6"> <a href="../home/contact.php">Contact</a> </li>
			  </ul>
			</div>
		<!-- menu -->
		<div class="container">
			<div class="agile-logo">
				<h1><a href="index.html">LIBERATOR'S<span>Profile</span></a></h1>
			</div>
			<div class="w3l-banner-grids">
				<div class="col-md-8 w3ls-banner-right">
					<div class="banner-right-img">
						<img src="<?php echo $passport;?>" alt=""/>
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
						<p ><?php echo $position;?></a></p>
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
						<p><span id='holla'><?php echo $address;?></span></p>
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
					<h4><?php echo $aboutme;?></p>
				</div >
				<div class="col-md-6 wthree-about-right">
					<h3><i span='fa fa-trophy'></i> Raffles Draws <small><?php echo $m_name;?></small></h3>
	
		<div class="containerx">

		<?php
		$r = $op->selectOne('raffle_log'.$id, null, array('raffleID'=>$rid, 'clientID' => $m_id));
		if(isset($r) && $r->id > 0)
		{
		?>
		<div class ='alert alert-success'>
			<strong>Successfull!</strong> 
			You have Registered successfully for <?php echo $name;?> raffle draw ending <?php echo date('d M Y h:i:s', strtotime($raff->raffle_end));?>  . Your winning Code is <?php echo $op->enrcode(str_pad($id, 2, "0", STR_PAD_LEFT).str_pad($r->id, 6, "0", STR_PAD_LEFT));?> 
		</div> 
		<div class="w3-button-info m_nav_item">
			<a class=" btn-success btn-lg btn"  href="../home/raffle.php" >Go back to Raffles</a>
		</div>
		<?php
		}
		else
		{
		?>			
				<form action="../home/utils/raffle.php" method="post">
					<div class="form-group">
					<input type="hidden" name='rid' value='<?php echo $rid;?>'>
					<input type="hidden" name='id' value='<?php echo $id;?>'>	
					<input type="hidden" name='user' value='<?php echo $m_id;?>'> 
					<div class='form-group  row'>
					<label>Gift Redeeming Center</label>
					<?php
					
					$centers = $op->select('centers', NULL, array('lga'=>$m_array->lga));
					$gifs = $op->select('centers_gifts', NULL, array('centers_id'=>$m_array->centers));
					?>

					<select class='form-control input input-sm ' name='centerID' id='centerID' data-id='<?php echo $rid;?>'>
					<option></option>
					<?php
					$rCen = unserialize($raff->centers);

					foreach($rCen as $rC )
					{
						$centersMain = $op->selectOne('centers', NULL, array('id'=>$rC));
						echo '<option value="'.$centersMain->id.'">'.$centersMain->name.' '.$centersMain->address.'</option>';						
					}
					?>
					</select>
					
					</div>
					<div class='form-group  row'>
					<label>Which Gift do you want?</label>
					<select class='form-control input input-sm'  name='giftID' id='giftID'>
					

					</select>
					</div>
					</div>	
					<div class ='alert alert-warning'>
						<strong>Warning !</strong> Once submitted you can not make any changes
					</div> 
		<button type="submit" class="btn btn-lg btn-block btn-success" name='sub'> <i class='fa fa-gift'></i> LOG ME IN !!! </button>
				</form>
				<?php
			}
				?>
	
		</div>
	
				</div >
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	
	<div class="agileits-w3layouts-footer">
		<div class="container">
			<p>© 2018 Liberators.com. All rights reserved | Design by <a href="">Flexsummer.ng</a></p>
		</div>
	</div>
	<!-- //copyright -->
	<script src="js/bars.js"></script>
	<script src="js/owl.carousel.js"></script> 
	<script type="text/javascript">

		$(document).on('change', '#centerID', function(){ 
        	var id = $(this).val();
        	var mid = $(this).attr('data-id');
        	var b = {id:id, mid:mid};
        	$('#giftID').html('');
        	$.post('../admin/utils/loadRaffleGift.php', b,  function(dat, status){ 
	            if(status == 'success')
	            {

	                var obj = JSON.parse(dat);
	                var txt ='';
	                for(var i = 0; i < obj.length; ++i)
	                {

	                	txt += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
	                }
	                $('#giftID').html('');
	                $('#giftID').html(txt);
	            }
   			 });
        
      	});


	</script>
</body>	
</html>