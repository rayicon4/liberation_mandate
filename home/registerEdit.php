<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
require_once("../connect/connect.php"); 

$op = new DB;
require_once 'utils/connect.php';
$states = $op->select('states');
$lgas = $op->select('local_governments', NULL, array('state_id' =>1));
$data = $op->select('centers', NULL);
$cat = array(0=>'General Parliament', 1=>"Women's Parliament", 2=>"Student's Parliament");
$absolute_url = $op->full_url( $_SERVER );
$title  ='Edit Profile';

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
<title>Liberation Mandate | Edit Profile</title>
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
				<h2>Edit<span>Profile</span>  </h2>
				<p><span><i class="fa fa-coffee" aria-hidden="true"></i></span></p>
			</div>
			<div class="w3layouts_skills_grids agileinfo_mail_grids">
				<form action="utils/registerEdit.php" method="post">
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="surname" value='<?php if(isset($m_array->surname)){echo $m_array->surname;}?>' type="text" id="input-13a" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13a">
							<span class="input__label-content input__label-content--chisato" data-content="Surname">Surname</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input value='<?php if(isset($m_array->othername)){echo $m_array->othername;}?>' class="input__field input__field--chisato" name="othername" type="text" id="input-13b" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13b">
							<span class="input__label-content input__label-content--chisato" data-content="Other names">Other Names</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input value='<?php if(isset($m_array->phone)){echo $m_array->phone;}?>' class="input__field input__field--chisato" name="phone" type="hidden" id="input-13c" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-13c">
							<span class="input__label-content input__label-content--chisato" data-content="Phone Number: <?php if(isset($m_array->phone)){echo $m_array->phone;}?>">Phone number : <?php if(isset($m_array->phone)){echo $m_array->phone;}?></span>
						</label>
					</span>
					<span class="input input--chisato">
						<input value='<?php if(isset($m_array->email)){echo $m_array->email;}?>' class="input__field input__field--chisato" name="email" type="email" id="input-14a" placeholder=" " required="required" />
						<label class="input__label input__label--chisato" for="input-14a">
							<span class="input__label-content input__label-content--chisato" data-content="Email">Email</span>
						</label>
					</span>
					<span class="input input--chisato">
						<select class="input__field input__field--chisato" name="cat" type="text" id="input-15" placeholder=" " required="required" >


								<?php
                            foreach($cat as $k =>$v)
                            {
                            ?>
                              <option value='<?php echo $k;?>'><?php echo $v;?></option>
                            <?php
                             }
                            ?>
						</select>
						<label class="input__label input__label--chisato" for="input-14b">
							<span class="input__label-content input__label-content--chisato" data-content="Parliament">Parliament</span>
						</label>
					</span>
					<span class="input input--chisato">
						<select class="input__field input__field--chisato" name="lga" type="text" id="input-14b" placeholder=" " required="required" >
						<?php
						if(isset($m_array->lga))
							{
								$lg = $op->selectOne('local_governments', NULL, array('id'=>$m_array->lga) );
								$st = $op->selectOne('states', NULL, array('id'=>$lg->state_id) );
								echo '<option value="'.$st->id.'">';
								echo $st->name;
								echo '</option>';
							}
						?>	
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
						<select class="input__field input__field--chisato" name="state" type="text" id="input-14c" placeholder=" " required="required" >
						
							<?php
							if(isset($m_array->lga))
							{
								echo '<option value="'.$m_array->lga.'">';
								echo $lg->name;
								echo '</option>';
							}
							
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
						<input class="input__field input__field--chisato" name="ward" type="text" id="input-14da" value='<?php if(isset($m_array->ward)){echo $m_array->ward;}?>' required="required" >
						
						<label class="input__label input__label--chisato" for="input-14da">
							<span class="input__label-content input__label-content--chisato" data-content="Ward">Ward/Polling Unit</span>
						</label>
					</span>
					<span class="input input--chisato">
						<input class="input__field input__field--chisato" name="pvc" type="text" id="input-14d" value='<?php if(isset($m_array->pvcnum)){echo $m_array->pvcnum;}?>' required="required" >
						
						<label class="input__label input__label--chisato" for="input-14d">
							<span class="input__label-content input__label-content--chisato" data-content="PVC NUMBER">PVC NUMBER</span>
						</label>
					</span>
					
						<input style='margin-top:25px; margin-bottom: 10px ' id="input-14x" type="submit" value="Change">
						
						
					</span>
					
					<div class="grid_3 grid_5 w3ls">
						
				
						<div class="alert alert-info" role="alert">
							<strong>Note !</strong> You will be required to confirm your PVC Number before claiming any prize.
						</div>
					</div>

						</form>
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