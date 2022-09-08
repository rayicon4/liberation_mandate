<?php
ob_start();
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("../connect/raffle.php");
$op = new DB;
$fa = new Raffle;


$mandates = $fa->selectRaffle();
//print_r($mandates);

require_once 'utils/connect.php';
if(isset($_SESSION['x']['id']))
{
   

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

<style>
    .div-2 {
    	background-color: #ABBAEA;
    }
</style>
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
                <h2>Sponsored <span> Draws</span>  </h2>
                <p><span><i class="fa fa-gift" aria-hidden="true"></i></span></p>
            </div>
            <div class="w3layouts_skills_grids">
            <?php
            $boxes = 0;
                if(isset($mandates) && count($mandates) > 0){
                foreach($mandates as $m)
                {
                    //print_r($m);
            ?>
               
  <?php

$r = $op->selectOne('raffle_log'.$m->id, null, array('raffleID'=>$m->rid, 'clientID' => $m_id));
if(isset($r) && ($r->id > 0) && ($r->winID == 1) && strtotime($m->raffle_start) < strtotime('now') && strtotime($m->raffle_end) < strtotime('now') )
    {
    $boxes = $boxes + 1;                                    //logged and won
 ?> 
 <hr/>
                <div class="div-2">
                    <div class="col-md-4 wthree_stats_grid">
                    <div class="w3_agileits_stats_grid">
                        <img  class='img img-circle' src='<?php echo $m->passport;?>' height='200px' width='200px'>
                        <h3><?php echo $m->name;?></h3>
                                     <a 
                                        href='../profile/index.php?q=<?php echo $m->id;?>&r=<?php echo $m->rid;?>' 
                                        class='btn btn-sm btn-block btn-success'>
                                     <span class="badge"></span> 
                                     Congratulations  You won!!!
                                     
                                     <div class='alert alert-success'>
                                     <h3>
                                        <?php
                                                $gift_details = $op->selectOne('gifts', NULL, array('id' => $r->giftID));
                                                echo $ry1.' '.$gift_details->name;
                                        ?>
                                    </h3>
                                    </div>
                                    <?php
                                        if(strtotime($m->raffle_end) > strtotime('now'))
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i> Ending <?php echo date('d D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i>Ended <?php echo date('D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                         }
                                        ?>
                                    </a>
                         <p class="counter w3_agile_counter2"><?php echo  $bag = array_sum(unserialize($m->gifts));?> Prizes</p>
                        </div>
                    </div>
                    </div>
                    <br/>
<?php
    }
?>

<?php
if(isset($r) && ($r->id > 0) && ($r->winID != 1) && strtotime($m->raffle_start) < strtotime('now') && strtotime($m->raffle_end) < strtotime('now') && $m->active == 0 )
    {      
    $boxes = $boxes + 1;                                //logged and won
 ?>
                    <div class="col-md-4 wthree_stats_grid">
                    <div class="w3_agileits_stats_grid">
                        <img  class='img img-circle' src='<?php echo $m->passport;?>' height='50px' width='50px'>
                        <h3><?php echo $m->name;?></h3>
                                     <a 
                                        href='../profile/index.php?q=<?php echo $m->id;?>&r=<?php echo $m->rid;?>' 
                                        class='btn btn-sm btn-block btn-info'>
                                     <span class="badge"></span> 
                                     Raffle Close: No Win, Maybe Next time
                                     <div class='alert alert-info'>
                                     <h3>
                                        <?php
                                                $gift_details = $op->selectOne('gifts', NULL, array('id' => $r->giftID));
                                                echo $ry1.' '.$gift_details->name;
                                        ?>
                                    </h3>
                                    </div>
                                    <?php
                                        if(strtotime($m->raffle_end) > strtotime('now'))
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i> Ending <?php echo date('d D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i>Ended <?php echo date('D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                         }
                                        ?>
                                    </a>
                         <p class="counter w3_agile_counter2"><?php echo  $bag = array_sum(unserialize($m->gifts));?> Prizes</p>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
    <?php
    }
    ?>

<?php
if(isset($r) && ($r->id > 0) && ($r->winID != 1) && strtotime($m->raffle_start) < strtotime('now') && strtotime($m->raffle_end) < strtotime('now') && $m->active == 1 )
    {   
    $boxes = $boxes + 1;                                   //logged and won
 ?>
                    <div class="col-md-4 wthree_stats_grid">
                    <div class="w3_agileits_stats_grid">
                        <img  class='img img-circle' src='<?php echo $m->passport;?>' height='50px' width='50px'>
                        <h3><?php echo $m->name;?></h3>
                                     <a 
                                        href='../profile/index.php?q=<?php echo $m->id;?>&r=<?php echo $m->rid;?>' 
                                        class='btn btn-sm btn-block btn-warning'>
                                     <span class="badge"></span> 
                                     Raffle Processing Winners, You would be notified if you win?
                                     
                                     <div class='alert alert-warning'>
                                     <h3>
                                        <?php
                                                $gift_details = $op->selectOne('gifts', NULL, array('id' => $r->giftID));
                                                echo $ry1.' '.$gift_details->name;
                                        ?>
                                    </h3>
                                    </div>
                                    <?php
                                        if(strtotime($m->raffle_end) > strtotime('now'))
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i> Ending <?php echo date('d D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i>Ended <?php echo date('D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                         }
                                        ?>
                                    </a>
                         <p class="counter w3_agile_counter2"><?php echo  $bag = array_sum(unserialize($m->gifts));?> Prizes</p>
                        </div>
                    </div>
                    <br/>
    <?php
    }
    ?>

<?php

if(isset($r) && ($r->id > 0) && ($r->winID != 1) && strtotime($m->raffle_start) < strtotime('now')  && strtotime($m->raffle_end) > strtotime('now'))
    {    
    $boxes = $boxes + 1;                                  //just registered time not up
 ?>
                    <div class="col-md-4 wthree_stats_grid">
                    <div class="w3_agileits_stats_grid">
                        <img  class='img img-circle' src='<?php echo $m->passport;?>' height='50px' width='50px'>
                        <h3><?php echo $m->name;?></h3>
                                     <a 
                                        href='../profile/index.php?q=<?php echo $m->id;?>&r=<?php echo $m->rid;?>' 
                                        class='btn btn-sm btn-block btn-primary'>
                                     <span class="badge"></span> 
                                     Best of Luck !!!
                                     </a>
                                     
                                     <div class='alert alert-primary'>
                                     <h3>
                                        <?php
                                                $gift_details = $op->selectOne('gifts', NULL, array('id' => $r->giftID));
                                                echo $ry1.' '.$gift_details->name;
                                        ?>
                                    </h3>
                                    </div>
                                    <?php
                                        if(strtotime($m->raffle_end) > strtotime('now'))
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i> Ending <?php echo date('d D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i>Ended <?php echo date('D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                         }
                                        ?>
                                
                         <p class="counter w3_agile_counter2"><?php echo  $bag = array_sum(unserialize($m->gifts));?> Prizes</p>
                        </div>
                    </div>
                    <br/>
    <?php
    }
    ?>


    <?php

if(!isset($r) && strtotime($m->raffle_start) < strtotime('now')  && strtotime($m->raffle_end) > strtotime('now') && $m->active == 0)
    { 
    $boxes = $boxes + 1;              //raffle active note regirsetred time available
 ?>
                    <div class="col-md-4 wthree_stats_grid">
                    <div class="w3_agileits_stats_grid">
                        <img  class='img img-circle' src='<?php echo $m->passport;?>' height='50px' width='50px'>
                        <h3><?php echo $m->name;?></h3>
                                     <a 
                                        href='../profile/index.php?q=<?php echo $m->id;?>&r=<?php echo $m->rid;?>' 
                                        class='btn btn-sm btn-block btn-danger'>
                                     <span class="badge"></span> 
                                     Raffle Open !!!
                                     </a>
                                     
                                     <div class='alert alert-danger'>
                                     <h3>
                                        <?php

                                            $all_gifts = unserialize($m->gifts);
                                            if(count($all_gifts) > 0)
                                            {
                                                foreach($all_gifts as $ry => $ry1){
                                                    if($ry1 > 0)
                                                    {
                                                         $gift_details = $op->selectOne('gifts', NULL, array('id' => $ry));
                                                            echo ' : '.$ry1.' '.$gift_details->name.' : ';
                                                    }
                                                   
                                                }
                                                
                                            }
                                        ?>
                                    </h3>
                                    </div>
                                    <?php
                                        if(strtotime($m->raffle_end) > strtotime('now'))
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i> Ending <?php echo date('d D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <b style='font-size: 12px'><i>Ended <?php echo date('D M Y h:i:s', strtotime($m->raffle_end));?></i></b>
                                        <?php
                                         }
                                        ?>
                                
                         <p class="counter w3_agile_counter2"><?php echo  $bag = array_sum(unserialize($m->gifts));?> Prizes</p>
                        </div>
                    </div>
                    <br>
                    
    <?php
    }
    
    ?>


    <?php

    if(($boxes / 3) == 0)
                {
                    echo '<div class="clearfix"> </div>';
                }

                }


            }
    ?>
                
                
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