<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Liberators Login';
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
<title>Liberation Mandate | Login</title>
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
				<h2>Log<span>in</span>  </h2>
				<p><span><i class="fa fa-coffee" aria-hidden="true"></i></span></p>
			</div>
			<div class="w3layouts_skills_grids agileinfo_mail_grids">
				<form action="utils/login.php" method="post">
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="phone" type="text" id="input-13" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13">
							<span class="input__label-content input__label-content--chisato" data-content="Phone Number">Phone Number</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="pass" type="password" id="input-14" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-14">
							<span class="input__label-content input__label-content--chisato" data-content="Password">Password</span>
						</label>
					</span>
					
						<input style='margin-top:25px; margin-bottom: 10px ' id="input-14x" type="submit" value="Submit">
						
						
					</span>
					
				</form>
			</div>
			
		</div>
		<div class="container">
			<a class='btn btn-danger btn-lg' href='fpassword.php'> Forgot Password </a>
			<a class='btn btn-default btn-lg' href='register.php'> Register </a>
		</div>
	</div>
<?php include 'utils/footer.php';?>
<?php include 'utils/script.php';?>
</body>
</html>