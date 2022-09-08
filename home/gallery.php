<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Gallery';

$f = $op->select('gallery');

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
<title>Liberation Mandate | Gallery</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<?php include 'utils/css.php';?>
</head>
<body>
<!-- header -->
<?php include 'utils/head_bar.php';?>
<?php include 'utils/header.php';?>	

<!-- header -->
<!-- banner1 -->
	<div class="banner1">
	</div>
<div class="gallery">
		<div class="container"> 
			<div class="w3layouts_header">
				<h2>Our <span> Gallery</span></h2>
				<p><span><i class="fa fa-picture-o" aria-hidden="true"></i></span></p>
			</div>
		<div class="gallery-grids">
			<div class="gallery-top-grids">
			<?php
			if(is_array($f))
			{
			foreach($f as $f1)
			{
				$add = explode('.', $f1->passport);
				$lt = end($add);
				$im_a =  array('jpg', 'png', 'gif', 'jpeg', 'bmp' );
				$vid_a =  array('mp4', 'wma', '3gpp', 'flv' );
			if(in_array($lt, $im_a))
			{
			?>
				<div class="col-sm-3 gallery-grids-left">
					<div class="gallery-grid">
						<a class="example-image-link" href="<?php echo $f1->passport ;?>" data-lightbox="example-set" data-title="<?php echo $f1->title ;?>">
							<img src="<?php echo $f1->passport ;?>" alt="" />
							<div class="w3captn-agileits">
								<h4>Expand</h4>
								<p><?php echo $f1->title ;?></p>
							</div>
							
						</a>
					</div>
				</div>
			<?php
		    }
		}
			
			}
			?>
				
				<div class="clearfix"> </div>
				<br>
            <div class="w3layouts_header">
				<h2>Our <span> Videos</span></h2>
				<p><span><i class="fa fa-picture-o" aria-hidden="true"></i></span></p>
			</div>
			<div class="gallery-grids">
			<div class="gallery-top-grids">
			<?php
			if(is_array($f))
			{
			foreach($f as $f1)
			{
				$add = explode('.', $f1->passport);
				$lt = end($add);
				$im_a =  array('jpg', 'png', 'gif', 'jpeg', 'bmp' );
				$vid_a =  array('mp4', 'wma', '3gpp', 'flv' );
			if(in_array($lt, $vid_a))
			{	
			?>
				<div class="col-sm-6 gallery-grids-left">
					<div class="gallery-grid">
						
							<video width='380px' height='250px'   controls><source src="<?php echo $f1->passport ;?>" type="video/<?php echo $lt;?>">  
							</video>
							
							
						
					</div>
				</div>
			<?php
		    }
		}
		}
			?>
				
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
			<script src="js/lightbox-plus-jquery.min.js"> </script>
		</div>
	</div>
	</div>
	
<?php include 'utils/footer.php';?>
<?php include 'utils/script.php';?>
</body>
</html>