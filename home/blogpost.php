<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Blog post';
require_once 'utils/connect.php';
$data = $op->selectOne('blogs', NULL, array('id'=>$_GET['id']));
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
<title>Liberators | Blog</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Andragogy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700&amp;subset=latin-ext" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- header -->
	<?php include 'utils/head_bar.php';?>
<?php include 'utils/header.php';?>	
	
<!-- header -->
<!-- banner1 -->
	<div class="banner1">
	</div>
<!-- about -->
	<div class="services">
		<div class="container">
			<div class="w3layouts_header">
				<h2>Liberators<span>Blog</span></h2>
				<p><span><i class="fa fa-info-circle" aria-hidden="true"></i></span></p>
			</div>
			<h3 class="bars"><?php echo $data->title;?><small>
				<br>
				<?php
				$liberator = $op->selectOne('mandates', NULL, array('id'=>$data->liberatorID));
				?>
					<ul class="agileits_social_list">
					    <li>by <?php echo $data->author;?> <?php echo $liberator->fullname;?></li>
						<li><a target="_blank" href="<?php echo $liberator->facebook;?>" class="fb-xfbml-parse-ignore"  class="w3_agile_facebook"><i class="fa fa-facebook" style='color:red' aria-hidden="true"></i></a></li>
						<li><a href="<?php echo $liberator->twitter;?>" class="agile_twitter"><i class="fa fa-twitter" style='color:red' aria-hidden="true"></i></a></li>
						<?php
						if(isset($liberator->phone) && strlen($liberator->phone) > 0)
						{
						?>
						<li><a href="https://wa.me/<?php echo $liberator->phone ;?>/?Welcome" class="agile_whatsapp"><i class="fa fa-whatsapp" style='color:red' aria-hidden="true"></i></a></li>
						<?php
					}
						?>
						<li>Share Content</li>
						<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($absolute_url);?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"  class="w3_agile_facebook"><i class="fa fa-facebook" style='color:red' aria-hidden="true"></i></a></li>
						
						
					</ul>
				
			</small></h3>
			
				<div class="col-md-12">

					<?php echo $data->content;?>
				
				</div>
				<style type="text/css">
					.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}

.tip-up {
  top: -25px; /* Same as body margin top + border */
  left: 10px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-top-color: transparent;
}

.tip-down {
  bottom: -25px;
  left: 10px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}

.tip-left {
  top: 10px;
  left: -25px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}

.tip-right {
  top: 10px;
  right: -25px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;  
}

.dialogbox .body {
  position: relative;
  max-width: 600px;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #212121;
  border-radius: 3px;
  border: 5px solid red;
}

.body .message {
  min-height: 30px;
  border-radius: 3px;
  font-family: Arial;
  font-size: 14px;
  line-height: 1.5;
  color: white;
}


				</style>
				<div class="clearfix"> </div>
				<div class="col-md-12">
				<h4>Comments</h4>
				<div class="fb-comments" data-href="<?PHP $absolute_url ;?>" data-numposts="5"></div>
				

				</div>
			</div>
		</div>
	</div>
<!-- //about -->
<!-- team -->
	
<!-- //team -->
<!-- stats -->
	
<!-- //stats -->
<!-- subscribe -->
	
<!-- //subscribe -->
<!-- copy-right -->
	<?php include 'utils/footer.php';?>
<!-- //copy-right -->
<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
		<script>
			$('.counter').countUp();
		</script>
<!-- //stats -->
<!-- start-smooth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smooth-scrolling -->
<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>