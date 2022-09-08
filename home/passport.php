<?php
ob_start();
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("../connect/raffle.php");
$op = new DB;
$fa = new Raffle;

$absolute_url = $op->full_url( $_SERVER );
$title  ='Passport';

if(isset($_POST['submit']))
{

$u = array();
(isset($_POST['id']))? $uid = $_POST['id']: NULL;
    if(isset($uid) && $uid > 0)
    {
        
      $f = $op->loadFile(1, $uid, 'file', '../photo', 1000 , 1, '_mm' );
      $in = $op->update('clients', array('passport' => $f[1]), array('id' => $uid));
    } 
}

$passport = 'images/add.png';
require_once 'utils/connect.php';
if(isset($_SESSION['x']['id']))
{
 
 $mandates = $op->selectOne('clients', NULL, array('id' => $_SESSION['x']['id']));  

 if(is_file($mandates->passport) && file_exists($mandates->passport))
 {
    $passport = $mandates->passport;
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
				<h2>Load <span> Passport</span>  </h2>
				<p><span><i class="fa fa-gift" aria-hidden="true"></i></span></p>
			</div>
			<div class="row"  style='margin: 0 auto ;'>
									
										
						
                <div class="col-md-4 col-md-offset-4" align="center"  style='' >
                   
                       
                        
                            <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value='<?php echo $_SESSION['x']['id'];?>'>
                                <div class='row'>
                                    <img src='<?php echo $passport;?>' height="210px" width="210px">
                                </div>
                                <br>
                                <div class='form-group w3_w3layouts'>
                                    <input  type='file' name="file" class="form-control"> 
                                </div>
                                <div class=' form-group w3_w3layouts'>
                                <button type='submit' name='submit' class='btn btn-block btn-success'>Submit</button>
                                <a href='printid.php' class='btn btn-block btn-info'>Print ID Card</a>
                                </div>
                            </form>
                            
                        
                                    
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