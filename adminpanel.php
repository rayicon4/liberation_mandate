<?php
	session_start();

?>

<html>
<head>
<title> Admin Panel</title>
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

<style>
body{
	margin:0px;
	border:0px;
}
#header{
	width: 100%;
	height: 130px;
	background: #D96D00;
	color: white;
	font-weight: bold;
}
#sidebar{
	width: 300px;
	height: 400px;
	background: #00B285;
	float: left;
	font-size: 16px;
	font-weight:bold;
}
#data{
	height: 700px;
	background: #FFFFFF;
	color: black;
}
#adminlogo{
	background:	white;
	border-radius: 50px;
	width: 80px;
	height: 70px;
}
ul li{
	padding: 20px;
	border-bottom: 2px solid grey;
}
ul li:hover{
	background: #FFFFFF;
	color: blue;
	font-weight:bold;
}
#regpagecomplete {
	font-size: 16px;
	font-weight: bold;
	color: #FFF;
	text-align: right;
	font-style: normal;
}

</style>
</head>

<body>
	<STYLE>A {text-decoration: none;}</STYLE>

	<div id="header">
	<center><img src="img/adminicon.ico" alt="adminlogo"  id="adminlogo"><br><br>Admin Panel</center>
        <div id="regpagecomplete"><a href="index.html">Home</a> | <a href="about.html">About Us</a> | <a href="courses.html">        Courses</a> | <a href="contact.html">Contact</a></div>
	</div>




	<div id="sidebar">
		<ul>
			<li><a href="studentregdownload.php">Student Registration</a></li>
			<li>Delete Data</li>
			<li>Update Data</li>
			<li>Techlod</li>
            <li><a href="adminloginform.html">Logout</a></li>
		</ul>


	</div>
	<div id="data"><br>
	<center>
		<h2>Welcome!!</h2>
		<h2>This is the admin section. What would you like us to do?</h2>

	</center>


	</div>
</body>
</html>
