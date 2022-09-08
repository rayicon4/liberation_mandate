<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Contact us';
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
<title>Liberation Mandate | Contact Us</title>
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
<!-- //banner1 -->
<!-- contact -->
	<div class="services">
		<div class="container">
			<div class="w3layouts_header">
				<h2>Mail <span>us</span>  </h2>
				<p><span><i class="fa fa-envelope-o" aria-hidden="true"></i></span></p>
			</div>
			<div class="w3layouts_skills_grids agileinfo_mail_grids">
				<form action="#" method="post">
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Name" type="text" id="input-13" placeholder=" " required="" />
						<label class="input__label input__label--chisato" for="input-13">
							<span class="input__label-content input__label-content--chisato" data-content="Name">Name</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Email" type="email" id="input-14" placeholder=" " required="" />
						<label class="input__label input__label--chisato" for="input-14">
							<span class="input__label-content input__label-content--chisato" data-content="Email">Email</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="Subject" type="text" id="input-15" placeholder=" " required="" />
						<label class="input__label input__label--chisato" for="input-15">
							<span class="input__label-content input__label-content--chisato" data-content="Subject">Subject</span>
						</label>
					</span>
					<textarea name="Message" placeholder="Your comment here..." required=""></textarea>
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</div>
<?php include 'utils/footer.php';?>
<?php include 'utils/script.php';?>
</body>
</html>