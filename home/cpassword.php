<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Change Password';
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
<title>Liberation Mandate | Change Password</title>
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
				<h2>Change <span>Password</span>  </h2>
				<p><span><i class="fa fa-coffee" aria-hidden="true"></i></span></p>
			</div>
			<div class="w3layouts_skills_grids agileinfo_mail_grids">
				<form action="utils/cpassword.php" method="post">
				<input name='mainID' type='hidden' value='<?php echo $_SESSION["x"]["id"];?>'>
					<span class="input input--chisato">
						<input value='<?php if(isset($m_array->phone)){echo $m_array->phone;}?>' class="input__field input__field--chisato" name="phone" type="hidden" id="input-13a" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13a">
							<span class="input__label-content input__label-content--chisato" data-content="Phone Number: <?php if(isset($m_array->phone)){echo $m_array->phone;}?>">Phone number : <?php if(isset($m_array->phone)){echo $m_array->phone;}?></span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="opass" type="text" id="input-13b" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13b">
							<span class="input__label-content input__label-content--chisato" data-content="Old Password">Old Password</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="npass" type="text" id="input-13c" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13c">
							<span class="input__label-content input__label-content--chisato" data-content="New Password">New Password</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="npass1" type="text" id="input-14" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-14">
							<span class="input__label-content input__label-content--chisato" data-content="Repeat New Password">Repeat New Password</span>
						</label>
					</span>
					
						<input style='margin-top:25px; margin-bottom: 10px ' id="input-14x" type="submit" value="Change">
						
						
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