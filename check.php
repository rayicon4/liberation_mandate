<?php
$name=$_POST['name'];
$pass=$_POST['pass'];

if ($name==("admin") & $pass==("password")){

	$_SESSION['name'] = $name;
	$_SESSION['pass'] = $pass;
	header("location: adminpanel.php");
	
}else {
	echo 'Either the username or password is not correct. Are you sure you are the Admin?';
}
?>
