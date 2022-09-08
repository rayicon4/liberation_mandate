<?php
    session_start();

    //connect to database
    $db = mysqli_connect("localhost","root","","authentication");

    if(isset($_POST['register_btn'])){
	  $program = ($_POST['program']);
	  $levelofprog = ($_POST['levelofprog']);
	  $natureofprog = ($_POST['natureofprog']);
	  $fname = ($_POST['fname']);
      $surname = ($_POST['surname']);
      $state = ($_POST['state']);
      $lga = ($_POST['lga']);
	  $nationality = ($_POST['nationality']);
	  $date_of_birth = ($_POST['date_of_birth']);
      $username = ($_POST['username']);
      $gender = ($_POST['gender']);
      $email = ($_POST['email']);
	  $phone = ($_POST['phone']);
      $password = ($_POST['password']);
      $password2 = ($_POST['password2']);





      if ($password == $password2){
          //create user
          $password = md5($password); //hash password before storing for security purposes
          $sql = "INSERT INTO users(program, levelofprog, natureofprog, fname, surname, state, lga, nationality, date_of_birth, username, gender, email, phone, password) VALUES('$program','$levelofprog','$natureofprog','$fname','$surname','$state','$lga','$nationality','$date_of_birth','$username','$gender','$email','$phone','$password')";
          mysqli_query($db, $sql);
          $_SESSION['message'] = "You have been logged in";
		  $_SESSION['program'] = $program;
		  $_SESSION['levelofprog'] = $levelofprog;
		  $_SESSION['natureofprog'] = $natureofprog;
          $_SESSION['fname'] = $fname;
          $_SESSION['surname'] = $surname;
          $_SESSION['state'] = $state;
          $_SESSION['lga'] = $lga;
		  $_SESSION['nationality'] = $nationality;
		  $_SESSION['date_of_birth'] = $date;
          $_SESSION['username'] = $username;
          $_SESSION['gender'] = $gender;
          $_SESSION['email'] = $email;
		  $_SESSION['phone'] = $phone;

          header("location: regpagecomplete.php"); //redirect to home page
          
      }else{
        //failed
          $_SESSION['message'] = "The passwords do not match";
      }
    }	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Student Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://webthemez.com" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>


<style>
.formdecoration{
	width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	color: black;
	font-size: 16px;
}

.submit{
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
input:focus{
	background-color: lightblue;
}

.submit:hover {
    background-color: orange;
}
</style>
<style>
*{
	margin:0;
	padding:0;

}
nav{
	width:100%
	height:60px;
	background-color:white;
  float:right;

}
nav ul{
	float: right;
  padding-left:442px;
}
nav ul li{
	float: left;
	list-style: none;
	position: relative;
}
nav ul li a{
	display: block ;
	font-family: arial;
	color: #336;
	font-size:16px;
  font-weight: bold;
	padding: 15px 10px;
	text-decoration: none;
}
nav ul li ul{
	display: none;
	position: absolute;
	background-color: #F90;
	color: #FFF;
	padding: 7px;
	border-radius:0px 0px 4px 4px;
}

nav ul li:hover ul{
	display: block;
}

nav ul li ul li{
	width: 180px;
	border-radius:4px;
}

nav ul li ul li a{
	padding:5px 10px;
}

nav ul li ul li a:hover{
	background-color: #F60;
	color: #FFF;
}

.fff {	color: #FFFFFF;
}
</style>

</head>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="index.html"><img src="img/logo4.png" alt="logo"/></a></div>
                <nav>
                  <ul>
                      <li><a href='index.html'>Home</a></li>
                        <li><a href='about.html'>About us</a></li>
                        <li><a href='#'>Admission</a>
                          <ul>
                            <li><a href='admissioninfo.html'>Admission Info</a></li>
                            <li><a href='studentregistration.php'>Apply</a></li>
                            </li>
                            </ul>
                        <li><a href='programs.html'>Programmes</a>
                          <li><a href='#'>Online Assessment</a>
                            <ul>
                              <li><a href='linkpage.html'>Online Exams</a></li>
                              <li><a href='trainerapp/index.html'>Online CBT Training</a></li>
                              </li>
                              </ul>
                        <li><a href='contact.html'>Contact</a></li>
                        <li><a href='adminloginform.html'>Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
	</header><!-- end header -->
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Student Registration</h2>
			</div>
		</div>
	</div>
	</section>
	<section id="content">

	<div class="container">
	<div class="row">
    <div class="col-md-6">
		  <div class="headers">
    <h3>Use the form below to apply</h3><br>
    <h4 style="color: #8C0000">Every field is required</h4>
    <h4>Online Registration</h4>
  </div>
  <div class="formdecoration">
<form method="post" action="studentregistration.php">
  <table>
    <tr>
    </td>Programme of Choice: <select input type="text" name="program" class="formdecoration"></td>
    <option value="select">select..</option>
    <option value="Pharmarcy_Tech">Professional Certificate in Pharmacy Technician</option>
    <option value="Medical_Lab">Professional Certificate in Medical Laboratory</option>
    <option value="Public_Health">National Diploma in Public Health</option>
    <option value="Health_Tech">National Diploma in Environmental Health Tech.</option>
    <option value="Medical_Record">National Diploma in Medical Record</option>
    <option value="Health_Record">National Diploma in Electrical Health Record</option>
    <option value="Tele-Medicine">National Diploma in Tele-Medicine</option>
  </select>
    </tr><br><br>
    <tr>
    </td>Level of Programme: <select input type="text" name="levelofprog" class="formdecoration"></td>
    <option value="select">select..</option>
     <option value="HND">HND</option>
    <option value="OND">OND</option>
  </select>
    </tr><br><br>
    <tr>
    </td>Nature of Programme: <select input type="text" name="natureofprog" class="formdecoration"></td>
    <option value="select">select..</option>
    <option value="Full-time">Full Time</option>
    <option value="Part-time">Part Time</option>
  </select>
    </tr><br><br>
    <tr>
    </td>First Name: <input type="text" name="fname" class="formdecoration"></td><br>
    </tr><br>
    <tr>
    </td>Surname: <input type="text" name="surname" class="formdecoration"></td><br>
    </tr><br>
    <tr>
    </td>State of Origin: <input type="text" name="state" class="formdecoration"></td><br>
    </tr><br>
    <tr>
    </td>L.G.A: <input type="text" name="lga" class="formdecoration"></td><br>
    </tr><br>
    <tr>
    </td>Nationality: <select input type="text" name="nationality" class="formdecoration"></td>
    <option value="Nigerian">Nigerian</option>
    </select>
    </tr><br><br>
     <tr>
    </td>Date of Birth: <input type="date" name="date_of_birth" class="formdecoration"></td><br>
    </tr><br>

    <tr>
    </td>Username: <input type="text" name="username" class="formdecoration" required="username"></td><br>
    </tr><br>
    <tr>
    </td>Gender: <select input type="text" name="gender" class="formdecoration"></td>
    <option value="select">select..</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
    </tr><br><br>
    <tr>
    </td>Email: <input type="email" name="email" class="formdecoration"></td><br>
  </tr><br>
  <tr>
    </td>Phone Number: <input type="text" name="phone" class="formdecoration" required="phone"></td><br>
  </tr><br>
    <tr>
    </td>Password: <input type="password" name="password" class="formdecoration" required="password"></td><br>
    </tr><br>
    <tr>
    </td>Password again: <input type="password" name="password2" class="formdecoration"></td><br>
    </tr><br>
    <tr>
      <td></td>
    </td><input type="submit" name="register_btn" value="Register" class="submit"></td>
    </tr>
  </table>
</form>
</div>









    <p>&nbsp;</p>
    <p>&nbsp;</p>
	</div>
	</div>

	</section>







	<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="widget">
					<h5 class="widgetheading">Our Contact</h5>
					<address>
					<strong><span class="fff">Eastern School of Health Technology, Aba</span></strong><br>
#321 Aba Owerri Road<br>
Osisioma Aba.
                    </address>
                    <p> <i class="icon-phone"></i> 08055929054, 08035058330, 08106891609<br>
                      <i class="icon-envelope-alt"></i> info@escotech.com </p>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="widget">
					<h5 class="widgetheading">Quick Links</h5>
					<ul class="link-list">
						<li><a href="about.html">About Us</a></li>
                        <li><a href="studentregistration.php">Apply</a></li>
                        <li><a href="programs.html">Our Programmes</a></li>
                        <li><a href="admissioninfo.html">Admission Information</a></li>
                        <li><a href="contact.html">Contact us</a></li>
                        <li></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="widget">
				  <ul class="link-list">
				  <li>
				    <h5 class="widgetheading">Other information</h5>
                      <ul class="link-list">
                        <li><a href="#">Academic Calendar</a></li>
                        <li>Lecturers</li>
                        <li>Our Fees</li>
                        <li>Campus police number</li>
                        <li>Campus address</li>
                      </ul>
					</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3">
					<div class="widget">
					<h5 class="widgetheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Escotech Aba</h5>
					<ul class="link-list">
						<li>
						  <table width="205" border="1">
						    <tr>
						      <td width="155"><img src="img/biglogo.png" alt="" width="191%" height="201"></td>
					        </tr>
					      </table>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p>
							<span>&copy; Eastern School of Health Technology 2019. All right reserved. By </span><a href="http://webthemez.com" target="_blank">Techlod</a>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script src="js/validate.js"></script>
</body>
</html>
