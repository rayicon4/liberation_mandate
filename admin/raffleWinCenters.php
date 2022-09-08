<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$id = $_GET['id'];
$mid = $_GET['mid'];
$pid = $_GET['pid'];
$ba = $op->selectOne('centers', NULL, array('id' =>$pid));
$barname = $bar->name;
$addr = $bar->address;
$bank = $bar->bank;
$account = $bar->account;
if(isset($id) && is_numeric($id) && $id > 0)
{ 
  $dat = $op->selectOne('raffles', NULL, array('id' =>$id));
  $center = $op->selectOne('mandates',NULL, array('id' =>$dat->mandateID)); 
  if(isset($mid))
  {
     $data = $op->selectLogs($center->id, $id, 1, $mid, $pid); 
  }else
  {
     $data = $op->selectLogs($center->id, $id, 1, NULL, $pid); 
  }
  
}



//print_r($data);
$title_name = $center->fullname;;
$title_address = $center->address;;

$items = array(1=>'state', 2=>'lga', 3=>'banks', 4=>'account');
$gifts = $op->select('gifts', NULL, array('active'=>0));

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
            <li class="breadcrumb-item"><a href="mandates.php">Mandates</a></li>
            <li class="breadcrumb-item"><a href="raffleHistory.php?id="><?php echo $title_name;?></a></li>
            <li class="breadcrumb-item active">Log</li>
          </ul>
        </div>
      </div>
     <section class="charts">
        <div class="container-fluid">
         
          <div class="row" style='font-size: 14px'>
            <div class="col-lg-12">
              <div class="card">
              <div class="card-header" >
              <span class='col-md-6 pull-left'>
              <h1>
                 <i class='fa fa-instituition'></i>Liberators Mandate <small><?php echo $title_name.'   ('.$id.')';?> Raffle</small> 
              </h1>
              <p><?php echo $barname;?></p>
              <p><?php echo $addr;?></p>
              <p><?php echo $bank.'  '.$account;?></p>
              <p><?php echo $phone;?></p>
              </span>
              <span class='col-md-6 '>
              <div class="float-right btn-group"> 
                  <a  class='btn btn-success' href="raffleWinCenters.php?id=<?php echo $id;?>&pid=<?php echo $pid;?>" style='color:white' > All Gifts </a>
              </div>
              </span>
              
      </div> 
                
                
                <div class="card-body">
                 <form action='centers_gift.php?id=<?php echo $id;?>' method='post' >
                 <table id='mytables' width='100%' style='cellpadding:0px !important' class="" data-pagination="true" data-search="true" data-toggle="tablex">
                  <input type='hidden' name='center' value='<?php echo $id;?>'>
                    <thead>
                      <tr>
                        <th width='10px' style='width:10px'>#</th>
                         <th >MAN. ID</th>
                        <th >Name</th>
                        <th >Phone</th>
                        <th >Gift</th>
                        
                        <th >Price</th>
                        <th >Date</th>                 
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i =0;
                    if(isset($data) && is_array($data))
                    {
                    
                    foreach($data as $d )
                    {
                      ?>

                      <tr id='roz<?php echo $d->id;?>'>          
                        <td width='10px' class='text-center'><?php echo ++$i;?></td>
                        <td class='a_row text-left' >  
                            <?php
                              echo $op->enrcode(str_pad($d->lganame.$center->id, 2, '0', STR_PAD_LEFT).str_pad($d->id, 6, '0', STR_PAD_LEFT));
                            ?>                  
                        </td>
                        <td class='a_row text-left' data-id='<?php echo $p->id;?>'>  
                          <b class='nlot' id='namez<?php echo $p->id;?>'>
                            <?php

                              echo ($d->winID == 1)? '<i class="fa fa-check text-success"></i>': '<i class="fa fa-times text-danger"></i>'; 
                              
                              echo ucwords(strtolower($d->name));

                              echo '<span class="pull-right">';

                              echo ($d->winSms == 1)? '<i class="fa fa-envelope text-success"></i>': '<i class="fa fa-envelope text-danger"></i>';
                              echo ($d->winSms == 1)? '<i class="fa fa-envelope text-success"></i>': '<i class="fa fa-envelope text-danger"></i>'; 

                              echo '</span>';
                            ?> 
                          </b>                       
                        </td>
                        <td class='a_row text-left' >  
                            <?php
                              echo $d->phone;
                            ?>                  
                        </td> 
                        <td class='a_row text-left' >  
                            <?php
                              echo $d->giftname;
                            ?>                  
                        </td> 
                        
                        <td class='text-right' >  
                             <?php
                             $sum[] = $d->price;
                              echo $d->price;
                            ?>             
                        </td>
                        <td class='text-right' >  
                             <?php
                              echo date('d M Y h i s', strtotime($d->dt));
                            ?>             
                        </td>
                                          
                      </tr>
                    <?php
                      
                    }
                  }
                    ?>   
                                  
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class='text-center' width='10px' style='width:10px'>#</th>
                        <th ></th>
                        <th class='text-center'><?php

                            if(count($tum) > 0)
                            {
                              echo $num = array_sum($tum);
                             

                            }

                            ?></th>
                        <th ></th>
                     
                        <th class='text-right'>
                            <?php

                            if(count($sum) > 0)
                            {
                              $num = array_sum($sum);
                              echo number_format($num, 2,'.',',');

                            }

                            ?>

                        </th>                 
                      </tr>

                    </tfoot>

                  </table>
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
    <?php require_once 'utils/header.php';?>
  </body>
  <script>
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
<script>
  $(function () {
    $('.checkz').iCheck({
      checkboxClass: 'icheckbox_square-green',
      //radioClass: 'iradio_square-blue',
      increaseArea: '0%' // optional
    });
  });
</script>
  <script>

  $(document).on('mouseover', '.a_row', function(){ 
    var id = $(this).attr('data-id'); 
    var nm = '#flotz'+id; 
    $(nm).show();
  });
  $(document).on('mouseleave', '.a_row', function(){ 
    var id = $(this).attr('data-id'); 
    var nm = '#flotz'+id; 
    $(nm).hide();
  });

  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
  })

  $(document).on('change', '#bus_state', function(){ 
    var d = $(this).val(); 

    $.post('utils/loadLga.php', {id:d},  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#bus_lga').html('');
                $('#bus_lga').html(r);
            }
    }) ;      
  })
  $(document).on('change', '#ebus_state', function(){ 
    var d = $(this).val(); 

    $.post('utils/loadLga.php', {id:d},  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#ebus_lga').html('');
                $('#ebus_lga').html(r);
            }
    }) ;      
  })
  $(document).on('change', '#m_state', function(){ 
    var d = $(this).val(); 

    $.post('utils/loadLga.php', {id:d},  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#m_lga').html('');
                $('#m_lga').html(r);
            }
    }) ;      
  })

  function lga(d){ 
    $.post('utils/loadLga.php', {id:d},  function(dat, status){  
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                var r = '';

                for(var i =0; i < obj.length; ++i)
                {
                  r += '<option value="'+obj[i].id+'">'+obj[i].name+'</option>';
                }
                $('#ebus_lga').html('');
                $('#ebus_lga').html(r);
            }
    }) ;      
  }
  

$(document).on('click', '#subAdd', function(){ 
    var  name = $('#bus_name').val(); 
    var  addr = $('#bus_add').val();
    var  phone1 = $('#bus_num1').val();
    var  phone2 = $('#bus_num2').val();
    var  bank = $('#bus_bank').val();
    var  acc = $('#bus_acc').val();
    var  state = $('#bus_state').val();
    var  lga = $('#bus_lga').val();alert(name);
    var  id = '';
    var  b = 
    {
        id:id,
        name:name,
        addr:addr,
        phone1:phone1,
        phone2:phone2,
        bank:bank,
        acc:acc,
        state:state,
        lga:lga,
        status:1
    }    
    centers_db(b);       
  })

$(document).on('click', '#subItem', function(){ 
    loadTable();

    $('#filterItem').modal('hide');     
  })

$(document).on('click', '.cedit', function(){  
  var id = $(this).attr('data-id');
  var b = {id:id, status:4};
  
  $.post('utils/loadCenters.php', b,  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); alert(obj);
                $('#editItem').modal('show');
                $('#ebus_id').val(obj.id); 
                $('#ebus_name').val(obj.name); 
                $('#ebus_add').val(obj.address);
                $('#ebus_num1').val(obj.phone1);
                $('#ebus_num2').val(obj.phone1);
                $('#ebus_bank').val(obj.bank);
                $('#ebus_acc').val(obj.account);
                $('#ebus_state').val(obj.state);
                lga(obj.state);
                $('#ebus_lga').val(obj.lga);
         

            }
    }) ;  
})

$(document).on('click', '#subEdit', function(){ 
    var  name = $('#ebus_name').val(); 
    var  addr = $('#ebus_add').val();
    var  phone1 = $('#ebus_num1').val();
    var  phone2 = $('#ebus_num2').val();
    var  bank = $('#ebus_bank').val();
    var  acc = $('#ebus_acc').val();
    var  state = $('#ebus_state').val();
    var  lga = $('#ebus_lga').val();
    var  id = $('#ebus_id').val();
    var  b = 
    {
        id:id,
        name:name,
        addr:addr,
        phone1:phone1,
        phone2:phone2,
        bank:bank,
        acc:acc,
        state:state,
        lga:lga,
        status:2
    }
    
    var data = centers_db(b);
    clearRes2();   
    $('#editItem').modal('hide');

  })


$(document).on('click', '#mclear', function(){ 
    var r = confirm('Are you sure you want to clear all selected winners . You will not be able to recover the data');
    if(r == true)
    {
        var id = $(this).attr('data-id'); 
        var mid = $(this).attr('data-mid');
        var b = {id:id, mid:mid , status:5};
        $.post('utils/loadClearWin.php', b,  function(dat, status){  
            if(status == 'success')
            {
                //alert(dat);
                //var dt = dat;
                //if(dt == 1)
                //{
                    alert('All winning have been cleared please reload');
                //}
            }
        }) ;
     }   
      });

 


</script>
</html>s