<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 

$op = new DB;
$absolute_url = $op->full_url( $_SERVER );
$title  ='Register';

$states = $op->select('states');
$lgas = $op->select('local_governments', NULL, array('state_id' =>1));
$data = $op->select('centers', NULL);
$cat = array(0=>'General Parliament', 1=>"Women's Parliament", 2=>"Student's Parliament");


if(isset($_GET['e']) && $_GET['e']==3)
{
	echo "<script>alert('Phone number is already in use')</script>";
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
<title>Liberation Mandate | Members Registration</title>
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

	<style>
@media (max-width: 475px){
	.w3layouts_header h5,h2,h3 {
    margin: 0 0 0.5em;
    color: #ef543b;
    font-size: 1.1em;
    text-transform: uppercase;
    letter-spacing: 3px;
	}
}


	</style>
<!-- //banner1 -->
<!-- contact -->
	<div class="services">
		<div class="container">
			<div class="w3layouts_header">
				<h2>Membership<span>Registration</span>  </h2>
				<p><span><i class="fa fa-coffee" aria-hidden="true"></i></span></p>
				<div class='alert alert-info'>
				All information provided will be kept confidential. we will not disclose your personal information to a third party without your consent. unless we are required or authorized to do so by law or other regulations.
				</div>
			</div>
			<h4 style='color:red'>All items are required</h4>
			<div class="w3layouts_skills_grids agileinfo_mail_grids">
				<form action="utils/register.php" method="post">
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="surname" type="text" id="input-13a" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13a">
							<span class="input__label-content input__label-content--chisato" data-content="Surname">Surname</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="othername" type="text" id="input-13b" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13b">
							<span class="input__label-content input__label-content--chisato" data-content="Other names">Other Names</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="phone" type="text" id="input-13c" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13c">
							<span class="input__label-content input__label-content--chisato" data-content="Phone Number">Phone number</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="email" type="email" id="input-14a" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-14a">
							<span class="input__label-content input__label-content--chisato" data-content="Email">Email</span>
						</label>
					</span>
					
					<span class="input input--chisato">
						<select class="input__field input__field--chisato" name="state" type="text" id="input-14b" placeholder=" " required="required" >
								<option value></option>
							<?php
                            foreach($states as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
						</select>
						<label class="input__label input__label--chisato" for="input-14b">
							<span class="input__label-content input__label-content--chisato" data-content="State of Residence">State</span>
						</label>
					</span>
					<span class="input input--chisato">
						<select class="input__field input__field--chisato" name="lga" type="text" id="input-14c" placeholder=" " required="required" >
						<option value></option>
							<?php
                            foreach($lgas as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
						</select>
						<label class="input__label input__label--chisato" for="input-14c">
							<span class="input__label-content input__label-content--chisato" data-content="Local Government Area">Local Government Area</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="pvc" type="text" id="input-19a" placeholder="" required="required" />
						<label class="input__label input__label--chisato" for="input-19a">
							<span class="input__label-content input__label-content--chisato" data-content="PVC Number">PVC Number</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="ward" type="text" id="input-19aa" placeholder="" required="required" />
						<label class="input__label input__label--chisato" for="input-19aa">
							<span class="input__label-content input__label-content--chisato" data-content="Ward">Ward/Polling Unit</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="epass" type="password" id="input-17a" placeholder="" required="required"  minlength="4" />
						<label class="input__label input__label--chisato" for="input-17a">
							<span class="input__label-content input__label-content--chisato" data-content="Password">Password</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="opass" type="password" id="input-17b" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-17b">
							<span class="input__label-content input__label-content--chisato" data-content="Repeat Password">Repeat Password</span>
						</label>
					</span>
					

					<span class="input input--chisato">
						<input style='margin-top:0px; margin-bottom: 10px ' id="input-14x" type="submit" value="Submit">
					</span>
						
						
					</span>
					
					

						</form>
					</div>
			<div class='alert alert-danger'>
				You would be required to confirm your PVC number before claiming any prize.
				</div>
		</div>
		<div class="container">
			<a class='btn btn-default btn-lg' href='login.php'> Login </a>
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
                var r = '<option value></option>';

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