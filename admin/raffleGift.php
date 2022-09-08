<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$id = $_GET['id'];
$mid = $_GET['mid'];
$main = $op->selectOne('raffles',NULL, array('id' =>$id));
$lid = $main->mandateID;





if(isset($id) && is_numeric($id) && $id > 0)
{ 
  $data = $op->selectOne('raffles',NULL, array('id' =>$id));
  $center = $op->selectOne('mandates',NULL, array('id' =>$data->mandateID)); 

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
            <li class="breadcrumb-item active">Cost</li>
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
                 <i class='fa fa-instituition'></i> <?php echo $title_name;?> Raffle Cost
              </h1>
              
              </span>
              <span class='col-md-6 '>
              <div class="float-right"> 
                    <a  class='btn btn-success' href='raffleWinSummary.php?id=<?php echo $id;?>'>Gift  Distribution </a>
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
                        <th >Gift</th>
                        <th >Quantity</th>
                        <th >Unit Price</th>
                        <th >Cost</th> 
                        <th >Loggers</th> 
                        <th >Winners</th>                
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i =0;
                    $sum = array();
                    $tum = array();
                    if(isset($data))
                    {

                    $datar = unserialize($data->gifts);
                    foreach($datar as $d  => $dp)
                    {
                      $p = $op->selectOne('gifts', NULL, array('id' => $d));
                     if($dp > 0)
                     {
                      ?>

                      <tr id='roz<?php echo $p->id;?>'>          
                        <td width='10px' class='text-center'><?php echo ++$i;?></td>
                        <td class='a_row text-left' data-id='<?php echo $p->id;?>'>  
                          <b class='nlot' id='namez<?php echo $p->id;?>'>
                            <?php
                              echo $p->name;
                            ?> 
                          </b>                       
                        </td>
                        <td class='a_row text-center' >  
                            <?php
                              echo $dp;
                              $tum[] = $dp;
                            ?>                  
                        </td> 
                        <td class='text-right' >  
                             <?php
                              echo number_format($p->price, '2', '.', ',');
                             ?>             
                        </td> 
                        <td class='text-right' >  
                             <?php
                             $amt = $p->price * $dp;
                             $sum[] = $amt;
                              echo number_format($amt, '2', '.', ',');
                            ?>             
                        </td>
                        <td class='text-center' >
                             <?php
                             $lg = $op->select('raffle_log'.$lid, array('id'), array('raffleID'=>$id, 'giftID'=>$p->id));
                             (isset($lg))? $lgnum = count($lg) : $lgnum = 0;
                             $lum[] = $lgnum;
                          
                             echo '<a class="btn btn-xs btn-info"><i style="color:white">'.number_format($lgnum, '0', '.', ',').'</i></a>';

                            ?>             
                        </td>
                        <td class='text-center' id='winhold<?php echo $p->id;?>' >  
                             <?php
                             $mg = $op->select('raffle_log'.$lid, array('id'), array('raffleID' => $id, 'giftID' => $p->id, 'winID' => 1));
                             (isset($mg))? $mgnum = count($mg) : $mgnum = 0;
                             if(strtotime('now') > strtotime($main->raffle_end))
                             {

                             if($mgnum > 0 && count($mg) == $dp)
                             {
                              $pum[] = $mgnum;
echo '<a data-mid = "'.$p->id.'" data-id ="'.$id.'" class="pull-left cwin"><i style="">'.number_format($mgnum, '0', '.', ',').'</i></a>';
                             }
                             elseif($mgnum > 0 && $mgnum == $dp)
                             {
echo '<a data-mid = "'.$p->id.'" data-id = "'.$id.'" class="pull-left btn btn-xs btn-danger cwin"><i style="color:black">GET Winners</i></a>';
                             }
                             elseif($mgnum > 0 && $mgnum < $dp)
                             {
echo '<a data-mid = "'.$p->id.'" data-id = "'.$id.'" class="pull-left btn btn-xs btn-danger cwin"><i style="color:black">'.number_format($mgnum, '0', '.', ',').' GET Winners</i></a>';
                             }
                             elseif($mgnum > 0 && $mgnum > $dp)
                             {
echo '<a data-mid = "'.$p->id.'" data-id = "'.$id.'" class="pull-left btn btn-xs btn-danger cwin"><i style="color:red">'.number_format($mgnum, '0', '.', ',').' Error</i></a>';
                             }
                              else
                             {
echo '<a data-mid = "'.$p->id.'" data-id = "'.$id.'" class="pull-left btn btn-xs btn-danger cwin"><i style="color:white">GET WINNERS</i></a>';
                             }
echo '<a href = "raffleWin.php?mid='.$p->id.'&id='.$id.'"  target="_blank" class="pull-right"><i class="fa fa-print"></i></a>';
                           }
                           else
                           {
                            echo 'STILL ACTIVE ! NOT YET TIME';
                           }
                             
                            ?>             
                           
                        </td>
                                          
                      </tr>
                    <?php
                      }
                    }
                  }
                    ?>   
                                  
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class='text-center' width='10px' style='width:10px'>#</th>
                        <th ></th>
                        <th class='text-center'>
                        <?php

                            if(count($tum) > 0)
                            {
                              echo $num = array_sum($tum);
                             

                            }

                            ?></th>
                            <th></th>
                            <th class='text-right'>
                            <?php

                            if(count($sum) > 0)
                            {
                              $num = array_sum($sum);
                              echo number_format($num, 2,'.',',');

                            }

                            ?>

                        </th> </th>
                        <th class='text-center'>
                            <?php

                            if(count($lum) > 0)
                            {
                              $num = array_sum($lum);
                              
                               echo '<a href="'.$_SERVER['PHP_SELF'].'?id='.$id.'&mid='.$p->id.'" class="btn btn-xs btn-info"><i>'.number_format($num, 0,'.',',').'</i></a>';
                            }

                            ?>

                        </th>   
                        <th class='text-center'>
                            <?php

                            if(count($pum) > 0)
                            {
                              $num = array_sum($pum);
                              
                              echo '<a href="'.$_SERVER['PHP_SELF'].'?id='.$id.'&mid='.$p->id.'" class="btn btn-xs btn-success"><i>'.number_format($num, 0,'.',',').'</i></a>';
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



function clearRes()
{
  $('#bus_name').val(''); 
  $('#bus_add').val(''); 
  $('#bus_num').val(''); 
  $('#bus_num1').val(''); 
  $('#bus_acc').val(''); 
}
function clearRes2()
{
  $('#bus_id').val(''); 
  $('#bus_name').val(''); 
  $('#bus_add').val(''); 
  $('#bus_num').val(''); 
  $('#bus_num1').val(''); 
  $('#bus_acc').val(''); 
}

function loadTable(){
  var s = $('#h_state').val(); 
  var l = $('#h_lga').val();
  var b = $('#h_bank').val();
  var i = $('#h_item').val();
  $.post('utils/loadTable.php', {s:s, l:l, b:b, i:i},  function(dat, status){  
            if(status == 'success')
            {
                var dt = dat.split('::::::::'); 
                obj = JSON.parse(dt[0]); 
                obj1 = JSON.parse(dt[1]); 
                $('#mytable').bootstrapTable('destroy'); 
                $('#mytable').bootstrapTable({
                      cache: false,
                      data: obj,
                      columns:obj1
                }) ;           
                
            }
    }) ;

}

function centers_db(a)
{
  $.post('utils/loadCenters.php', a,  function(dat, status){
            if(status == 'success')
            {
                return obj = JSON.parse(dat);
            }
    }) ; 
}

function getChecked(){
        var array = '';
        $(".chk:checked").each(function(){
          array += $(this).val();
          array += ',';
        });   
    return n = array;
}

$(document).on('click', '.cwin', function(){ 
        var pr = confirm('Are you sure !!!');
          
        if(pr == true)
        {

        var id = $(this).attr('data-id'); 
        var mid = $(this).attr('data-mid');
        var pos = '#winhold'+mid;
        $(pos).html('Please Wait...');
        var b = {id:id, mid:mid, status:5};
      
        $.post('utils/loadWins.php', b,  function(dat, status){
            if(status == 'success')
            {
                
                $(pos).html('Done !');
            }
        }) ; 
        $('#namez'+id).unwrap("<del>");
      }
      });


$(document).on('click', '.cact', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:5};
        centers_db(b);
        $('#namez'+id).unwrap("<del>");
      });

 
$(document).on('click', '.cdct', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:6};
        centers_db(b); 
        alert($('#namez'+id).html());
        $('#namez'+id).wrap("<del>");
        alert($('#namez'+id).html());
      });

$(document).on('click', '.cdel', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:7};
        centers_db(b);
        $('#namez'+id).wrap("<del>");
        $('#rowz'+id).fadeOut("slow");
      });

  $(document).on('click', '#cact', function(){ 
        var id = getChecked();
        var b = {id:id, status:8};
        centers_db(b);
        reload_table();
      });

  $(document).on('click', '#cdct', function(){ 
        var id = getChecked();
        var b = {id:id, status:9};
        centers_db(b);
        reload_table();
      });


</script>
</html>s