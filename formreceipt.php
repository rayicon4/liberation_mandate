<?php

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



require("fpdf/fpdf.php");
$pdf= new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(10,10, "Welcome {$fname}, registration complete.download this form and keep safe",0,1);

$pdf->Cell(50,10,"Program :",1,0);
$pdf->Cell(70,10,"$program",1,1);

$pdf->Cell(50,10,"Level of Program : ",1,0);
$pdf->Cell(70,10,"$levelofprog",1,1);

$pdf->Cell(50,10,"Nature of Program :",1,0);
$pdf->Cell(70,10,"$natureofprog",1,1);

$pdf->Cell(50,10,"Name :",1,0);
$pdf->Cell(70,10,"$fname",1,1);

$pdf->Cell(50,10,"Surname :",1,0);
$pdf->Cell(70,10,"$surname",1,1);

$pdf->Cell(50,10,"State :",1,0);
$pdf->Cell(70,10,"$state",1,1);

$pdf->Cell(50,10,"LGA :",1,0);
$pdf->Cell(70,10,"$lga",1,1);

$pdf->Cell(50,10,"Nationality :",1,0);
$pdf->Cell(70,10,"$nationality",1,1);

$pdf->Cell(50,10,"Date of Birth :",1,0);
$pdf->Cell(70,10,"$date_of_birth",1,1);

$pdf->Cell(50,10,"Username :",1,0);
$pdf->Cell(70,10,"$username",1,1);

$pdf->Cell(50,10,"Gender :",1,0);
$pdf->Cell(70,10,"$gender",1,1);

$pdf->Cell(50,10,"Email :",1,0);
$pdf->Cell(70,10,"$email",1,1);

$pdf->Cell(50,10,"Phone :",1,0);
$pdf->Cell(70,10,"$phone",1,1);

$pdf->Cell(50,10,"Password :",1,0);
$pdf->Cell(70,10,"$password",1,1);

$pdf->output();

}

 ?>
