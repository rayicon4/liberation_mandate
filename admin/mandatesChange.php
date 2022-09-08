<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;
$db = 'clients';

if(isset($_GET['act']) && is_numeric($_GET['act']) && $_GET['act'] > 0)
{
  $op->update($db, array('active' =>0), array('id'=>$_GET['act']));
}
if(isset($_GET['dct']) && is_numeric($_GET['dct']) && $_GET['dct'] > 0)
{
  $op->update($db, array('active'=>1), array('id'=>$_GET['dct']));
}
if(isset($_GET['del']) && is_numeric($_GET['del']) && $_GET['del'] > 0)
{
  $op->del($db, array('id'=>$_GET['act']));
}


$data = $op->select('clients', NULL, array('centers' => 2));




$title_name = 'Mandates Forgotten Password';


$active_menu = 5;

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
          
          <div class="row" style='font-size: 14px'>
            <div class="col-lg-12">
              <div class="card">
              <div class="card-header" >
              <span class='col-md-6 pull-left'>
              <h1>
                 <i class='fa fa-instituition'></i> <?php echo $title_name;?> 
              </h1>
              </span>
              <span class='col-md-6 '>
              <div class="float-right">
              <form class='form' action='' method='get'>
                  <div class="form-group">
                        <div class="form-group">
                          <div class="input-group"> <label class="input-group-addon">Active </label>
                           <span class="input-group-addon">

                              <input name='slid' type="checkbox" checked value ='1'>
                              </span>
                            <select class="form-control" name='sls'>
                            <option value='all'>All</option>
                            <?php
                            $states = $op->select('states');
                            foreach($states as $st)
                            {
                              $lgs = $op->select('local_governments', NULL, array('state_id'=>$st->id));
                              echo '<option value="'.$st->id.',xx">'.$st->name.'</option>';
                              foreach($lgs as $lg1)
                              {
                                echo '<option value="'.$st->id.','.$lg1->id.'">'.$st->name.':'.$lg1->name.'</option>';
                              }
                            }
                            ?>
                              <option>Hold</option>
                            </select>
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-primary">Go!</button></span>
                          </div>
                        </div>
                      </div>
              </form>
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
                        <th >Lga</th>
                        <th >Name</th>
                        <th >Phone</th>
                        <th >Email</th>
                        <th width='20px !important' style='width:20px !important'>Action</th>                  
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    $i =0;
                    if(isset($data) && is_array($data) && sizeof($data) > 0)
                    {
                    foreach($data as $d)
                    {
                     
                      ?>

                      <tr id='roz<?php echo $d->id;?>'>          
                        <td width='10px' class='text-center'><?php echo ++$i;?></td>
                         
                        <td class='a_row' data-id='<?php echo $d->id;?>'>  
                          <b class='nlot' id='namez<?php echo $d->id;?>'>
                            <?php echo ($d->active == 0)? '<i class="fa fa-check text-success"></i>': '<i class="fa fa-times text-danger"></i>'; ?>
                            <?php
 echo ucwords(strtolower($d->surname." ".$d->firstname." ".$d->othername));
                            ?> 
                          </b>                       
                        </td>
                        <td class='a_row' >  
                          
                            <?php
                            echo $d->phone;
                            ?> 
                                              
                        </td>
                        <td class='e_row' >  
                          
                            <?php
                            echo $d->email;
                            ?> 
                                              
                        </td>  
                        <td>
                        <div class="btn-group btn-xs col-md-12 float-left" style='padding:0px !important;margin:0px !important; font-size:13px; ' >
                          <button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu">
                        
                        
                         <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $d->id;?>&act=<?php echo $d->id;?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $d->id;?>&act=<?php echo $d->id;?>">Activate</a>
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $d->id;?>&dct=<?php echo $d->id;?>">Deactivate</a>
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $d->id;?>&del=<?php echo $d->id;?>">Delete</a>   
                          </div>
                        </div>
                        </td>                  
                      </tr>
                    <?php
                    }
                  }
                    ?>   
                                  
                    </tbody>

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
</html>