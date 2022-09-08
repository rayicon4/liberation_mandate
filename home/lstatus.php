<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Liberators : login Status';
$states = $op->select('states');
$lgas = $op->select('local_governments', NULL, array('state_id' =>1));
$data = $op->select('centers', NULL);
$cat = array(0=>'General Parliament', 1=>"Women's Parliament", 2=>"Student's Parliament");


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
				<h2>Registration<span>Status</span>  </h2>
				<p><span><i class="fa fa-coffee" aria-hidden="true"></i></span></p>
			</div>
			<div class="w3layouts_skills_grids agileinfo_mail_grids">
				<form action="utils/register.php" method="post">
					
				
					
					<div class="grid_3 grid_5 w3ls">
						
						<div class="alert alert-success text-center" role="alert">
							<strong>Congratulations! !</strong> Your Registration was successful ! You will get a Confirmation SMS shortly 
							<p>
							<a href='raffle.php' class='btn btn-success'> <i class='fa fa-gift'></i> Raffle Draws</a>
							<a href='index.php' class='btn btn-info'> <i class='fa fa-home'></i> Home</a>
							</p>
						</div>
					</div>

						</form>
					</div>
			
		</div>
		
	</div>
<?php include 'utils/footer.php';?>
<?php include 'utils/script.php';?>

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