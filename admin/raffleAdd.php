<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$title_name ='Raffles (Add | Edit)';

$id = $_GET['id'];
$edit = $_GET['edit'];
$raffle_start = new DATETIME(date('Y-m-d H:i:s', strtotime('now') ), new DATETIMEZONE('Africa/Lagos'));echo $raffle_start->format('c');
$raffle_end = new DATETIME(date('Y-m-d H:i:s', strtotime('now')), new DATETIMEZONE('Africa/Lagos'));
$gifts = serialize(array());
$centers = serialize(array());
$selectedCenters = array();
$active = 0;


if(isset($_POST['add']) || isset($_POST['edit']))
{

require_once('../connect/utility.php');
$ot = new Utilities;
$u = array();
($ot->prove($_POST['id'], 1)[0] == 1)? $uid = $ot->prove($_POST['id'], 1)[1]: NULL;
($ot->prove($_POST['mandateID'], 1)[0] == 1)? $u['mandateID'] = $ot->prove($_POST['mandateID'], 1)[1]: $err['mandateID'] = $ot->prove($_POST['mandateID'], 1)[1];
($ot->prove($_POST['raffle_start'],3)[0] == 1)? $u['raffle_start'] = $ot->prove($_POST['raffle_start'], 1)[1]: NULL;
($ot->prove($_POST['raffle_end'], 3)[0] == 1)? $u['raffle_end'] = $ot->prove($_POST['raffle_end'], 3)[1]: NULL;
($ot->prove($_POST['gifts'], 3)[0] == 1)? $u['gifts'] = serialize($ot->prove($_POST['gifts'], 3)[1]): NULL;
($ot->prove($_POST['active'], 2)[0] == 1 && $ot->prove($_POST['active'], 2)[1] == 0)? $u['active'] = 0: $u['active'] = 1;

$u['centers'] = serialize($_POST['centers']);

  if(count($err) == 0)
  {
    
    if(isset($uid) && $uid > 0)
    {
       $in = $op->update('raffles', $u, array('id' => $uid));
       
       $in = $uid;
    }
     else
     {
      
        $in = $op->insert('raffles', $u);
        $in = $uid;
     }

   if(isset($in) && $in > 0)
    {
       header('location:raffleAdd.php?id='.$u['mandateID'].'&edit='.$in);
    }
  }
}

if(isset($_GET['id']) && strlen($_GET['id']) > 0)
{
  $id = $_GET['id'];

  $f = $op->selectOne('mandates', NULL, array('id'=>$id)); // print_r($f);
  if(isset($f) && count($f) > 0)
  {
    //print_r($data);
    $man_name = $f->fullname;;
    $man_address = $f->address;;
    
    $gifts = $f->gifts;

    $active = 0;

  }
  
}

if(isset($_GET['edit']) && strlen($_GET['edit']) > 0)
{
  $edit = $_GET['edit'];

  $e = $op->selectOne('raffles', NULL, array('id'=>$edit)); 
  if(isset($e) && count($e->id) > 0)
  {
    
    $raffle_start = new DATETIME($e->raffle_start, new DATETIMEZONE('Africa/Lagos'));
    $raffle_end = new DATETIME($e->raffle_end, new DATETIMEZONE('Africa/Lagos'));
    $rgifts = unserialize($e->gifts);
    $selectedCenters = unserialize($e->centers);
    $id = $e->mandateID;
    $man = $op->selectOne('mandates', NULL, array('id'=>$id)); 
    $name = $man->fullname;
  }
  
}

if(($selectedCenters > 0))
{}
else
  {$selectedCenters  = array(); }


$cen = $op->selectCenters();
$cec = array();
foreach($cen as $ce)
{
  $cec[$ce->sid][$ce->sil][$ce->id] = array($ce->name);
  $qstate[$ce->sid] = $ce->sname;
  $qlga[$ce->sil] = $ce->lname;
}
$active_menu = 6;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title_name;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <?php require_once 'utils/css.php';?>
    <style>
    .flot{
      z-index:101;
      float:left;
      display:none;
      position: relative;
      color:none;
      font-weight: bold;
      font-size:14px; 
      background-color: none;
      width: auto;
      padding-left: 5px;
      padding-right: 5px;
      padding-bottom: 2px;
      margin:0px;
      top: -1px; 
      -webkit-transition:margin-left .5s ease-in-out;
    z-index:1;
    }

    </style>
  </head>
  <body>
    <?php require_once 'utils/nav.php';?>
    <div class="page home-page">
      <!-- navbar-->
      <header class="header">
        <?php require_once 'utils/header.php';?>
      </header>
       <div class="breadcrumb-holder">   
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title_name;?></li>
          </ul>
        </div>
      </div>
     <section class="charts">
        <div class="container-fluid">
          <header class='row'> 
            <h1>
                Sponsore: <?php echo $man_name;?>
            </h1>
             
          </header>
          <div class="row" >
            <div class="col-lg-12">
              <div class="card">
                
                 <div class="card-body">
                  <form class="form-horizontal" method='post'>
                    <input name='mandateID'  type='hidden' value='<?php echo $id;?>' type='hidden'>
                    <input name='id'  type='hidden' value='<?php echo $edit;?>' type='hidden'>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Start date</label>
                      <div class="col-sm-10">
                        
                        <input type="<?php  if(isset($edit)){echo 'datetime';}else{ 'datetime-local';}?>" name='raffle_start' value='<?php  if(isset($raffle_start)){echo $raffle_start->format('c');}?>'  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">End date</label>
                      <div class="col-sm-10">
                        <input type="<?php  if(isset($edit)){echo 'datetime';}else{ 'datetime-local';}?>" name='raffle_end' value='<?php if(isset($raffle_end)){echo $raffle_end->format('c');}?>'   class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <?php
                    $raf = $op->select('gifts', null, array('active'=>0));
                    $rag = unserialize($gifts);
                    foreach($raf as $h)
                    {
                    ?>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label"><?php echo $h->name;?></label>
                      <div class="col-sm-10">
                        <input type="number" name='gifts[<?php echo $h->id;?>]' value='<?php if(isset($rgifts[$h->id])){echo $rgifts[$h->id];}?>'   class="form-control input-sm">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <?php
                      }
                    ?>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Settings</label>
                      <div class="col-sm-10">
                        <div class="i-checks">
                          <input id="checkboxCustom2" type="checkbox" <?php echo ($active != 1)? 'checked': null;?> value="0" name="active" class='form-control-custom checkbox-custom'>
                          <label for="checkboxCustom2"><h5>Active</h5></label>
                        </div>
                      </div>
                    </div>
                     
                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Redemption Centers</label>
                      <div class="col-sm-10">
                    <?php
                    foreach($cec as $c =>  $c1)
                    {
                    ?>
                    
                        
                        <div style=''>
                        <?php
                        foreach($c1 as $c2 => $c3)
                        {
                        ?>
                           
                            <div style=''>
                            <?php
                            foreach($c3 as $c4 => $c5)
                            {
                              if(strlen($qstate[$c]) > 1)
                              {
                            ?>
                                <div class="i-checks">
                                <input 
                                name='centers[]'
                                id="centerx<?php echo $c4;?>" 
                                data-id='lga<?php echo $c;?>' 
                                type="checkbox" 
                                class='form-control-custom checkbox-custom state<?php echo $c;?> lga<?php echo $c;?>' 
                                value='<?php echo $c4;?>' 
                                <?php echo (in_array($c4, $selectedCenters))? 'checked': '';?> 
                                >
                                  <label for="centerx<?php echo $c4;?>">
                                    <h5>
                                      <?php echo $qstate[$c];?> <?php echo $qlga[$c2];?> <?php echo $c5[0];?>
                                    </h5>
                                  </label>
                                </div>
                            <?php
                              }
                              }
                            ?>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    <?php
                      }
                    ?> 
                    </div>
                    </div>
                    
               
                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                       
                        <?php
                        if(isset($edit) && $edit > 0){
                          ?>

                            <button type="submit" class="btn btn-primary" name='edit'>Post</button>
                            
                            
                          <?php
                        }
                        else
                        {
                          ?>
                          <button type="submit" class="btn btn-primary" name='add'>Post </button>
                          <?php
                        }
                        ?>
                        <a class="btn btn-secondary" href='liberators.php'>Liberators</a>
                        <a class="btn btn-secondary" href='raffleHistory.php?id=<?php echo $id;?>'>HISTORY</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Small modal -->


      
      <!-- Updates Section -->
      <section class="updates section-padding">
       </section>
     <?php require_once 'utils/script.php';?>
    </div>
    
  </body>
  <script>
  $(document).on('click', '.qstate', function(event){ 

    var d = $(this).attr('data-id');
    $('.'+d).each(function(){
    $(this).iCheck('check');
  })
  })
  $(document).on('ifChecked', '.qstatex', function(event){ 
    alert(11);
  $('.checkz').each(function(){
    $(this).iCheck('check');
  })
    $('#selectAllz').iCheck('check'); 
    if($('#reAll').hasClass('disabled')){
        $('#reAll').removeClass('disabled');
    }
    if($('#deAll').hasClass('disabled')){
        $('#deAll').removeClass('disabled');
    }

  });

$(document).on('ifUnchecked', '#selectAllz', function(event){ 
  $('.checkz').each(function(){
    $(this).iCheck('uncheck');
  })
  $('#selectAllz').iCheck('uncheck'); 
      if(!$('#reAll').hasClass('disabled')){
        $('#reAll').addClass('disabled');
        }
        if(!$('#deAll').hasClass('disabled')){
        $('#deAll').addClass('disabled');
        }
  });
  $(function () {
    //$("#example1").DataTable();
    $('#mytable').bootstrapTable({
      paging: true,
      "searching": true,
      "ordering": true,
    });
  });

  $(document).on('change', '#m_state', function(){ 
      var r = $(this).val(); 
      $('#h_state').val(r);
    })

    $(document).on('change', '#m_lga', function(){ 
      var r = $(this).val(); 
      $('#h_lga').val(r);
    })
    $(document).on('change', '#m_banks', function(){ 
      var r = $(this).val(); 
      $('#h_bank').val(r);
    })
    $(document).on('change', '#m_items', function(){ 
      var r = $(this).val(); 
      $('#h_item').val(r);
    })


    $('#m_banks').select2({placeholder:'Pick Bank'});
    $('#m_items').select2({placeholder:'Pick Columns'});
    $('#m_lga').select2({placeholder:'Pick LGA'});
  
</script>

</html>