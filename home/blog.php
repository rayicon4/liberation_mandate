<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
require_once 'utils/connect.php';

$absolute_url = $op->full_url( $_SERVER );

$pg = $_GET['pg'];
if(isset($pg) && $pg > 0)
{

}
else
{
	$pg = 0;
}
$datanum = $op->select('blogs', NULL, array('active'=>0));
$datanum = count($datanum)/30;
$data = $op->selectBlogs($pg, 30);
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
			<h3 class="bars">Topics</h3>
			<div class="well">
						DISCLAIMER:You are liable for any post, comments , pictures etc posted on this blog. Avoid the use of foul lamguages, insults etc.
				</div>

				<div class="col-md-12">
				<ul class="list-group w3-agile">
				<?php
				foreach ($data as $d) 
				{
				?>
			     <a class='cpost' data-id ='<?php echo $d->id;?>'  href='blogpost.php?id=<?php echo $d->id;?>' target='_blank'>
			      <li class="list-group-item">
			      	</small> <?php echo $d->title;?><small><b style="color:black"> by <?php echo $d->author;?> </b></small>
			      	<span class="badge badge-primary pull-right"><?php echo $d->views  ;?></span> <i class="ti ti-eye"></i> <small><i style='color:black '><?php echo date('d D m Y h i a',strtotime($d->date_created));?></i> </a>
			      </li>
			     </a>
				<?php
				}
				?>
				</ul>
				</div>
				<div class="clearfix"> </div>
				<div class="col-md-12">
					<nav>
						<ul class="pagination pagination-sm">
						   <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php 

							for($ft = 0; $ft < $datanum; ++$ft)
							{
							   $pg1 = $ft + 1;

							   if($ft == $pg)
							   {
									echo '<li class="active"><a href="'.$_SERVER['PHP_SELF'].'?pg='.$ft.'">'.$pg1.'</a></li>';
							   }
							   else
							   {
							   	echo '<li><a href="'.$_SERVER['PHP_SELF'].'?pg='.$ft.'">'.$pg1.'</a></li>';
							   }

							   
							}
							?>
							
							
						</ul>
					</nav>

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


	$(document).on('click', '.cpost', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id};

        $.post('utils/logPost.php', b,  function(dat, status){
            if(status == 'success')
            {
            	
            }
    		}) ;
       
      });
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>