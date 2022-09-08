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
	font-weight: bold;
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

	<div id="header">
	<center><img src="img/adminicon.ico" alt="adminlogo"  id="adminlogo"><br><br>Admin Panel</center>
        <div id="regpagecomplete"><a href="index.html">Home</a> | <a href="about.html">About Us</a> | <a href="programs.html">Programmes</a> | <a href="contact.html">Contact</a></div>
	</div>




	<div id="sidebar">
		<ul>
			<li class="active">Student Registration</li>
			<li>Delete Data</li>
			<li>Update Data</li>
			<li>Techlod</li>
            <li><a href="adminloginform.html">Logout</a></li>
		</ul>


	</div>
	<div id="data"><br>
	<center>
		<h2>Student Registration Panel</h2>
	  <h2>Here you can download registered information from the database.</h2>
		<h2>use the download button below</h2>
		<form action="excel.php" method="post">
        <input type="submit" name="export_excel" class="btn btn-success" value="Student Registration" />
      </form>


	</center>


	</div>
</body>
</html>
