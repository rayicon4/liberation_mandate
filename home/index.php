<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 


$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Liberators Mandate';
require_once 'utils/connect.php';
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Liberation Manadate</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Liberators" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<?php include 'utils/css.php';?>
</head>
	
<body>
<!-- header -->
	<!-- header -->
<?php include 'utils/head_bar.php';?>
<?php include 'utils/header.php';?>	

<!-- header -->
<!-- header -->
<!-- banner -->
<!-- banner-slider -->
			<div class="banner-slider">
					<div class="slider">
						<div class="callbacks_container">
							<ul class="rslides callbacks callbacks1" id="slider4">
								<li>
									<div class="agileits-banner-info agileits-banner-info">
										<div class="container">
											<div class="w3ls-banner-shadow">
												<h3>A MATCH FOR PROGRESS</h3>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="agileits-banner-info agileits-banner-info1">
										<div class="container">
											<div class="w3ls-banner-shadow">
												<h3>WEEKLY RAFFLE DRAWS</h3>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="agileits-banner-info agileits-banner-info3">
										<div class="container">
											<div class="w3ls-banner-shadow">
												<h3>A COLLECTIVE WALK TO VICTORY</h3>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="agileits-banner-info agileits-banner-info2">
										<div class="container">
											<div class="w3ls-banner-shadow">
												<h3>THE PLACE FOR HAPPY AND CREATIVE LEARNING</h3>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="clearfix"> </div>
						<script src="js/responsiveslides.min.js"></script>
						<script>
							// You can also use "$(window).load(function() {"
							$(function () {
							  // Slideshow 4
							  $("#slider4").responsiveSlides({
								auto: true,
								pager:true,
								nav:false,
								speed: 2000,
								namespace: "callbacks",
								before: function () {
								  $('.events').append("<li>before event fired.</li>");
								},
								after: function () {
								  $('.events').append("<li>after event fired.</li>");
								}
							  });
						
							});
						 </script>
						<!--banner Slider starts Here-->
					</div>
			</div>
			<!-- //banner-slider -->

<!-- services -->
	<div class="services">
		<div class="container">
			<div class="w3layouts_header">
				<h2>Liberators <span>Mandate </span></h2>
				<p><span><i class="fa fa-universal-access" aria-hidden="true"></i></span></p>

			</div>
			<p>
				Liberators Mandate is founded by people of like-minds upon social democratic principles and inclusive governance, to provide a veritable platform for all Abians, irrespective of clan and religion with special focus on young minds with active energy, skills, innovation, current ideas and modern technology to participate in political processes and form governance structure that will enhance progress, reforms and sustainable development in our state.... <a href='about.php'> Read more..</a>
				</p>
		</div>
	</div>
	
<!-- //services -->
<!-- statistics -->
	<div class="statistics">
		<div class="container">
		<div class="w3layouts_header">
				<h2>Raffle<span>Draws</span></h2>
				<p><span><i class="fa fa-trophy" aria-hidden="true"></i></span></p>
		</div>
			<div class="col-md-6 w3layouts_statistics_grid_left">
				<div class="w3_statistics_grid_left_grid">
					<img src="images/raffle.fw.png" alt=" " class="img-responsive" />	
				</div>
				<a href='raffle.php' class='btn btn-info btn-block btn-lg' style='margin-top: 10px; width:94%; align:center'> Click to Win </a>
				
			</div>
			<div class="col-md-6 col-xs-12 w3layouts_statistics_grid_right">
				<div class='row'>
<style>

@media (max-width: 475px){

#countdown{
  width: 325px;
  height: 50px;
  text-align: center;
  border-radius: 5px;
  margin: 3px;
  padding: 15px 0;
 
}
#countdown #tiles > span{
  width: 52px;
  max-width: 52px;
  font: bold 38px 'Droid Sans', Arial, sans-serif;
  text-align: center;
  margin: 0 2px;
  padding: 1px 0;
  display: inline-block;
  position: relative;
}

#countdown #tiles > span:before{
  content:"";
  width: 100%;
  height: 13px;
  background: #111;
  display: block;
  padding: 0 3px;
  position: absolute;
  top: 41%; left: -3px;
  z-index: -1;
}

#countdown #tiles > span:after{
  content:"";
  width: 100%;
  height: 1px;
  background: #eee;
  border-top: 1px solid #333;
  display: block;
  position: absolute;
  top: 48%; left: 0;
}
#countdown{
	margin-bottom: none; 
}
#countdown .labels li{
  width: 52px;
  
}
#magic{
	margin-bottom:2px;
}
.statistics {
    height:800px;
}

.odometer{
	font-size:2em;
}
}

</style>

				<h4 id='magic' >Count Down to Next Raffle Draw</h4>
				<div class="col-md-12" style='display:block' >
					<div id="countdown">
					  <div id='tiles' ></div>
					  <div class="labels">
					    <li>Days</li>
					    <li>Hours</li>
					    <li>Mins</li>
					    <li>Secs</li>
					  </div>
					</div>
				</div> 
				
				<div class="col-md-12 col-sm-12 col-xs-12" style='margin-top:90px; display:block'>
					<div class="col-md-6 col-xs-6  w3_stats_grid">
						<div class="w3layouts_stats_grid1">
							<i class="fa fa-trophy" aria-hidden="true"></i>
						</div>
						<h3 id="w3l_stats2" class="odometer">0</h3>
						<p style='margin-top:5px !important'>Awards</p>
					</div>
					<div class="col-md-6 col-xs-6  w3_stats_grid">
						
					</div>
					<div class="col-md-6 col-xs-6  w3_stats_grid">
						<div class="w3layouts_stats_grid1">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>
						<h3 id="w3l_stats3" class="odometer">0</h3>
						<p style='margin-top:5px !important'>Winners</p>
					</div>
				</div>


				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //statistics -->

<!-- odometer-script -->
	<script src="js/odometer.js"></script>
	<script>
		window.odometerOptions = {
		  format: '(ddd).dd'
		};
	</script>
	<script>
		setTimeout(function(){
			jQuery('#w3l_stats1').html(25);
		}, 1500);
	</script>
	<script>
		setTimeout(function(){
			jQuery('#w3l_stats2').html(330);
		}, 1500);
	</script>
	<script>
		setTimeout(function(){
			jQuery('#w3l_stats3').html(542);
		}, 1500);
	</script>
<!-- //odometer-script -->
<!-- featured-services -->
	<div class="services">
		<div class="container">
			<div class="w3layouts_header">
				
				<h5>PORTAL  <span>BENEFITS</span></h5>
				<p><span><i class="fa fa-book" aria-hidden="true"></i></span></p>
			</div>
			<div class="w3layouts_skills_grids w3layouts_featured_services_grids">
				<div class="col-md-6 w3_featured_services_left">
					<div class="w3_featured_services_left_grid">
						<div class="col-xs-4 w3_featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-cubes"> </i>
							</div>
						</div>
						<div class="col-xs-8 w3_featured_services_left_gridr">
							<h4>Where is the best place to discuss Politics ?</h4>
							<p></i></p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3_featured_services_left_grid">
						<div class="col-xs-4 w3_featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa-gift"> </i>
							</div>
						</div>
						<div class="col-xs-8 w3_featured_services_left_gridr">
							<h4>Weekly raffle draws. Win fantastic prizes</h4>
							<p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
		</div>

		<div class="w3layouts_skills_grids w3layouts_featured_services_grids">	
				<div class="col-md-6 w3_featured_services_right">
					<img src="images/3.jpg" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 w3_featured_services_right">
					<img src="images/4.jpg" alt=" " class="img-responsive" />
				</div>
				<div class="col-md-6 w3_featured_services_left">
					<div class="w3_featured_services_left_grid">
						<div class="col-xs-4 w3_featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class="hi-icon fa fa-trophy"> </i>
							</div>
						</div>
						<div class="col-xs-8 w3_featured_services_left_gridr">
							<h4>Secondary School Essay Competiton</h4>
							<p><i>What I want my Government to do for me</i> <a> learn More</a></p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3_featured_services_left_grid">
						<div class="col-xs-4 w3_featured_services_left_gridl">
							<div class="hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a">
								<i class=" hi-icon fa-university"> </i>
							</div>
						</div>
						<div class="col-xs-8 w3_featured_services_left_gridr">
							<h4>Tertiary School Essay Competiton</h4>
							<p><i></i><a> learn More</a> </p>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>



<!-- //featured-services -->
<?php include 'utils/footer.php';?>
<?php include 'utils/script.php';?>
<script type="text/javascript">

//function getLastTime(a, callback)
//{
	//var r = 0;
 $.post('utils/getLastTime.php', {id:1},  function(dat, status){ 
            if(status == 'success')
            {

				var target_date = new Date().getTime() + parseInt( dat ) * 1000; // set the countdown datealert(target_date);
				var days, hours, minutes, seconds; // variables for time units
				var countdown = document.getElementById("tiles"); // get tag elementgetCountdown(target_date)
				setInterval(function () { getCountdown(); }, 1000);
            } 

            function getCountdown(){
	// find the amount of "seconds" between now and target
			var current_date = new Date().getTime();
			var seconds_left = (target_date - current_date) / 1000;

			days = pad( parseInt(seconds_left / 86400) );
			seconds_left = seconds_left % 86400;
				 
			hours = pad( parseInt(seconds_left / 3600) );
			seconds_left = seconds_left % 3600;
				  
			minutes = pad( parseInt(seconds_left / 60) );
			seconds = pad( parseInt( seconds_left % 60 ) );

			// format countdown string + set tag value
			if(parseInt(days) > -1 && parseInt(hours) > -1 && parseInt(minutes) > -1 && parseInt(seconds) > 0)
			{
			countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";
			}
			 else
			 {
			 	countdown.innerHTML = "<span>00</span><span>00</span><span>00</span><span>00</span>";
			 }
		}     
    }) ;
   
//}

function returnBack(param){
 return param;
}




function pad(n) {
	return (n < 10 ? '0' : '') + n;
}







</script>
</body>
</html>