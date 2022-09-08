<?php
ob_start();
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("../connect/raffle.php");
$op = new DB;
$fa = new Raffle;

$absolute_url = $op->full_url( $_SERVER );
$title  ='Print ID Card';


$passport = 'images/add.png';
$pvc = '';
require_once 'utils/connect.php';
if(isset($_SESSION['x']['id']))
{
 
 $mandates = $op->selectOne('clients', NULL, array('id' => $_SESSION['x']['id'])); 
 $llg = $op->selectOne('local_governments', NULL, array('id' => $mandates->lga)); 
 $sst = $op->selectOne('states', NULL, array('id' => $llg->state_id)); 
 $id =  $mandates->id;
 $id2 =  $mandates->id2;
 $ward =  $mandates->ward;
 $pvc =  $mandates->pvcnum;
 $lga =  $llg->name;
 $state =  $sst->name;

 if(is_file($mandates->passport) && file_exists($mandates->passport))
 {
    $passport = $mandates->passport;
    $pvc = $mandates->pvcnum;
 }

}
else
{
    ob_start();
    header("Location:login.php");
}


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
<span class="hidden-print">
<!-- header -->
<?php include 'utils/head_bar.php';?>
<?php include 'utils/header.php';?>	
</span>
<!-- header -->
<!-- banner1 -->
	<div class="banner1 hidden-print">
	</div>
<!-- //banner1 -->
<!-- contact -->
	<div class="services">
		<div class="container">
			<div class="w3layouts_header hidden-print">
				<h2>ID <span> CARD</span>  </h2>
				<p><span><i class="fa fa-gift" aria-hidden="true"></i></span></p>
			</div>
			<div class="row"  style='margin: 0 auto ;'>
									
										
						
                <div class="col-md-4 col-md-offset-2" align="center"  style='' >     
                        
                <div style='width: 260px; height: 400px; border: solid 1px #ef543b ; background-color: #ef543b !important '>
                <div  style='background-color: white '> 
                <div style='padding-top: 7px;'>
                <img src='images/1.jpg' height="50px" width='50px'>
                </div>
                <div style='margin-top: 7px;'>
                    <h4 style='color:#ef543b !important; font-family: century; font-size: 20px;padding: 4px '><b>LIBERATORS MANDATE</b></h4>
                </div>
                <div style='margin-top: 7px;'>
                <img src='<?php echo $passport;?>' height="100px" width='90px'>
                </div>
                <div style='margin-top: 4px;'>
                <b>
                    <?php echo strtoupper($_SESSION['x']['name']);?>
                </b>
                </div>
                <div style='margin-top: 4px; padding-bottom: 15px'>
                    <p><span style='color:#ef543b !important; font-weight: 900px'><b>MEMBER ID</b></span>:<b> <?php echo $id2;?></b></p>
                    <p><span style='color:#ef543b !important; font-weight: 900px'><b>PVC NUMBER</b></span>:<b> <?php echo $pvc;?></b></p>
                    <p><span style='color:#ef543b !important; font-weight: 900px'><b>STATE/LGA</b></span>:<b><?php echo $state.'/'.$lga;?></b></p>
                    <p><span style='color:#ef543b !important; font-weight: 900px'><b>WARD</b></span>:<b><?php echo $ward;?></b></p>
                </div>
                </div>

                <div style='padding-top: 7px;'>
                <img 
                src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo str_pad($llg->id, 3, "0", STR_PAD_LEFT).str_pad($id, 7, "0", STR_PAD_LEFT).$pvc; ?>&choe=UTF-8"
                    title="<?php echo $name;?>"  
                    height="50px" 
                    width='50px'>
                </div>

                </div>
                            
                        
                                    
                </div>
                <div class="col-md-4" align="center"  style='' >     
                        
                <div style='width: 260px; height: 400px; border: solid 1px #ef543b ; background-color: #ef543b !important '>
                <div  style='background-color: white '> 
                <div style='padding-top: 7px;'>
                <p>
                If found kindly contact the undermentioned phone number
                </p>
                </div>
                <div style='padding-top: 7px;'>
                <p style='padding:3px; font-size:9px '>
                <i><b>Ownership of this card indicates you are ready to coly to the rules of the organisations as weel as the Constitution of the Federal Republic of Nigeria.</b></i>
                </p>
                </div>
               
                <img 
                src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo str_pad($llg->id, 3, "0", STR_PAD_LEFT).str_pad($id, 7, "0", STR_PAD_LEFT).$pvc; ?>&choe=UTF-8"
                    title="<?php echo $name;?>"  
                    height="150px" 
                    width='150px'>
                <div style='margin-top: 7px;'>
                <b>
                    <?php echo strtoupper($_SESSION['x']['name']);?>
                </b>
                </div>
                
                </div>

                 <div style='margin-top: 7px;'>
                    <h4 style='color:white !important; font-family: century; font-size: 30px '><b>LIBERATORS MANDATE </b></h4>
                    <small style='white'>08060630925</small>
                </div>

                </div>
                            
                        
                                    
                </div>


			</div>
            <div class="row hidden-print"  style='margin: 30px;'>
            <div class="col-md-4 col-md-offset-4" align="center"  style='' >
            <button class="btn btn-primary btn-block" onclick="window.print();"><i class='fa fa-print'></i> Print</button>
            </div>
<br>
            <div class="row hidden-print"  style='margin: 30px;'>
            <div class="col-md-4 col-md-offset-4" align="center"  style='' >
            <div class='alert alert-info'>Please ensure you have a recent passport photo attached before printing. laminate to preserve after printing </div>
            <a href="http://liberators.com.ng/home/passport.php"  class="btn btn-primary btn-block"><i class='fa fa-image'></i> Attach passport</a>
            </div>

            </div>
			
		</div>
		
	</div>
<span class='hidden-print'>
<?php include 'utils/footer.php';?>
<?php include 'utils/script.php';?>
</span>
<script>
$(document).on('change', '#input-14b', function(){ 
    var d = $(this).val(); 

    $.post('../admin/utils/loadLga.php', {id:d},  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#input-14c').html('');
                $('#input-14c').html(r);
                loadCenters();
            }
    }) ;      
  })
$(document).on('change', '#input-14c', function(){ 
    var d = $(this).val(); 
    $.post('../admin/utils/loadGiftcenters.php', {id:d},  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#input-14d').html('');
                $('#input-14d').html(r);
            }
    }) ;      
  })
function loadCenters()
{
	var d = $('#input-14c').val(); 
    $.post('../admin/utils/loadGiftcenters.php', {id:d},  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#input-14d').html('');
                $('#input-14d').html(r);
            }
    }) ;  

}
</script>
</body>
</html>