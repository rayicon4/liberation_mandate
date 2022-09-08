<?php
    session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration complete</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

<style type="text/css">
body{
 padding:0px;
 margin: 0px;
}
  #regpagecomplete {
	font-size: 18px;
	font-weight: bold;
	text-align: right;
	font-style: normal;

}

.header{
  background-color: #D96D00;
  color: white;
  text-align: center;
  top: 100px;
  width: 700px center;
  padding: 5px;
}

</style>
</head>
<STYLE>A {text-decoration: none;}</STYLE>
<style>
a:hover {
color: #00661A;
}
</style>
<body>
   <div class="header">
    <h1>Your registration is complete.  </h1>
<div><h4>Thank you <?php echo $_SESSION['fname']; ?></h4></div>
  <div>
<div id="regpagecomplete"><a href="index.html" style="color: #FFFFFF">Home</a> | <a href="about.html" style="color: #FFFFFF">About Us</a> | <a href="programs.html" style="color: #FFFFFF">Programmes</a> | <a href="contact.html" style="color: #FFFFFF">Contact</a></div>
</body>
</html>
