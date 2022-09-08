<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$title_name ='Redemption Centers';
$states = $op->select('states');
$lgas = $op->select('local_governments', NULL, array('state_id' =>1));
$banks = $op->select('banks');
$data = $op->select('centers', NULL); 
$items = array(1=>'state', 2=>'lga', 3=>'banks', 4=>'account');
$active_menu = 2;
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
      float:right;
      display:none;
      position: relative;
      color:green;
      font-weight: bold;
      font-size:14px; 
      background-color: none;
      width: auto;
      padding-left: 5px;
      paddicng-right: 5px;
      padding-bottom: 2px;
      margin:0px;
      top: -1px; 
      -webkit-transition:margin-left .5s ease-in-out;
    z-index:1;
    }
    td{
      font-family:'tahoma'; 
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
          <div class="row" style='font-size: 12px'>
            <div class="col-lg-12">
              <div class="card">
<div class="card-header" >
              <span class='col-md-6 pull-left'>
              <h1>
                 <i class='fa fa-instituition'></i> Redemption Centers
              </h1>
              </span>
              <span class='col-md-6 '>
              <div class="btn-group float-right">
        <button class="btn btn-secondary btn-sm pull-right" type="button">
          <i class='fa fa-gear'></i>
        </button>
        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item"  data-toggle="modal" data-target="#addItem" href="#">Add New</a>
          <a class="dropdown-item" href="<?php $_['PHP_SELF'];?>?mid=1">Active</a>
          <a class="dropdown-item" href="<?php $_['PHP_SELF'];?>?mid=2">Deactivated</a>
          <a class="dropdown-item disabled" href="#" id='reAll'>Reactivate All</a>
          <a class="dropdown-item disabled " href="#" id='deAll'>Deactivate All</a>
          <a class="dropdown-item" href="#">Assign Gift Pack</a>
          <a class="dropdown-item" href="#">Remove Gift Pack</a>
        </div>
      </div>
      </span>
      </div>                                    
        <div class="card-body">
                 
        <table id='mytables' style='cellpadding:0px !important' class="" data-pagination="true" data-search="true" data-toggle="tables">   
                    <thead>
                      <tr>
                        <th width='2px'><input type='checkbox' id='selectAllz' class="checkz" value='<?php echo $d->id;?>'></th>
                        <th width='4%'>CENTER CODE</th>
                        <th width='40%'>BUSINESS NAME</th>
                        <th width='50%'>ADDRESS</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i =0;
                    if(isset($data) && sizeof($data) > 0)
                    {
                      
                    foreach($data as $d)
                    {
                     # if(isset($_GET['mid']) && $d->active == ($_GET['mid'] - 1))
                     # {
                    ?>
                      <tr id='roz<?php echo $d->id;?>'>
                        <td scope="row">
                          
                          <input type='checkbox' id='chk<?php echo $d->id;?>' class="checkz" value='<?php echo $d->id;?>'>
                          
                        </td>
                        <td><?php echo str_pad($d->lga, 3, "0", STR_PAD_LEFT).str_pad($d->id, 7, "0", STR_PAD_LEFT);?></td>
                        <td class='a_row' data-id='<?php echo $d->id;?>'>  
                          <span class='flot' id='flotz<?php echo $d->id;?>'>
                            <i class='fa fa-eye cfull' data-id='<?php echo $d->id;?>'></i>
                            <i class='fa fa-check cact' data-id='<?php echo $d->id;?>'></i>
                            <i class='fa fa-remove cdct' data-id='<?php echo $d->id;?>'></i>
    <a href='centers_gift.php?id=<?php echo $d->id;?>' target='_blank'><i class='fa fa-gift cgift ' data-id='<?php echo $d->id;?>'></i></a>
                            <i class='fa fa-edit cedit' data-id='<?php echo $d->id;?>'></i>
                            
                          </span>  
                          <b class='nlot' id='namez<?php echo $d->id;?>'>
                            <?php echo ($d->active == 0)? $nx = $d->name: $nx = '<del>'.$d->name.'</del>'; ?> 
                          </b>                       
                        </td>
                        <td>
                            <?php echo $d->address;?> <?php echo $d->lga;?></td>                     
                      </tr>
                    <?php
                       # }
                    }
                  }
                    ?>                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Small modal -->

<!-- Add Center -->
<div class="modal fade" id='addItem' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-primary">
        <h3 class="modal-title">Add Redemption Centers</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                
                     <form style='font-size:12px '>
                        <div class="form-group">
                          <label>Business Name</label>
                          <input type="text" id='bus_name' placeholder="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group row ">
                        <div class='col-md-6'>
                          <label>Phone Number</label>
                          <input type="text" id='bus_num1' placeholder="" class="form-control form-control-sm">
                        </div>
                        
                        <div class="col-md-6">
                          <label>Alt. Phone Number</label>
                          <input type="text" id='bus_num2' placeholder="" class="form-control form-control-sm">
                        </div>
                        </div>
                        <div class="form-group ">
                          <label>Address</label>
                          <textarea class="form-control" id='bus_add' placeholder="type here"></textarea>
                        </div>
                        <div class="form-group row">
                        <div class='col-md-6'>
                          <label>State</label>
                          <select name="state" id='bus_state' class="form-control form-control-sm">
                            <?php
                            foreach($states as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                        </div>
                        
                        <div class="col-md-6">
                          <label>Area</label>
                          <select name="lga" id='bus_lga' class="form-control form-control-sm">
                          
                          </select>
                        </div>
                        </div>
                        <div class="form-group row ">
                        <div class='col-md-6'>
                          <label>Bank</label>
                          <select name="bus_bank" id='bus_bank' class="form-control form-control-sm">
                            <?php
                            foreach($banks as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                          
                        </div>
                        
                        <div class="col-md-6">
                          <label>Account Number</label>
                          <input type="text" id='bus_acc' placeholder="" class="form-control form-control-sm">
                        </div>
                        </div>
      </div>
      <div class="modal-footer">
        <input type="button" id='subAdd' value="Save" class="btn btn-primary">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- show Center -->
<div class="modal fade" id='showItem' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-primary">
        <h3 class="modal-title" id='sbus_name'></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p id='sbus_add'></p>
      <p id='sbus_lga'></p>
      <p id='sbus_state'></p>
      <p><span id='sbus_num1'></span>  <span id='sbus_num2'></span></p>

                     
      </div>
      <div class="modal-footer">
        <input type="button" id='subAdd' value="Edit" class="btn btn-primary">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>
<!-- Edit Center -->
<div class="modal fade" id='editItem' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-primary">
        <h3 class="modal-title">Edit Redemption Centers</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                
                     <form style='font-size:12px '>
                        <div class="form-group">
                          <label>Business Name</label>
                          <input type="hidden" id='ebus_id' placeholder="" value=''>
                          <input type="text" id='ebus_name' placeholder="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group row ">
                        <div class='col-md-6'>
                          <label>Phone Number</label>
                          <input type="text" id='ebus_num1' placeholder="" class="form-control form-control-sm">
                        </div>
                        
                        <div class="col-md-6">
                          <label>Alt. Phone Number</label>
                          <input type="text" id='ebus_num2' placeholder="" class="form-control form-control-sm">
                        </div>
                        </div>
                        <div class="form-group ">
                          <label>Address</label>
                          <textarea class="form-control" id='ebus_add' placeholder="type here"></textarea>
                        </div>
                        <div class="form-group row">
                        <div class='col-md-6'>
                          <label>State</label>
                          <select name="state" id='ebus_state' class="form-control form-control-sm">
                            <?php
                            foreach($states as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                        </div>
                        
                        <div class="col-md-6">
                          <label>Area</label>
                          <select name="lga" id='ebus_lga' class="form-control form-control-sm">
                          
                          </select>
                        </div>
                        </div>
                        <div class="form-group row ">
                        <div class='col-md-6'>
                          <label>Bank</label>
                          <select name="ebus_bank" id='bus_bank' class="form-control form-control-sm">
                            <?php
                            foreach($banks as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                          
                        </div>
                        
                        <div class="col-md-6">
                          <label>Account Number</label>
                          <input type="text" id='ebus_acc' placeholder="" class="form-control form-control-sm">
                        </div>
                        </div>
      </div>
      <div class="modal-footer">
        <input type="button" id='subEdit' value="Change" class="btn btn-info">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Center -->
<div class="modal fade" id='filterItem' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-info">
        <h3 class="modal-title"><i class='fa fa-filter'></i> Filter Search</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                
                     <form style='font-size:20px '>
                        <div class="form-group">
                         
                         <select placeholder="Select State" name="mstate" id='m_state' class="form-control form-control-sm">
                            <?php
                            foreach($states as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                          
                          <select placeholder="Select Local Government" name="mlga" id='m_lga' multiple="multiple" style="width: 100% !important" class="form-control ">
                            <?php
                            foreach($lgas as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                          
                          <select placeholder="Select Bank" name="mbanks" id='m_banks' multiple="multiple" style="width: 100% !important" class="form-control ">
                            <?php
                            foreach($banks as $k)
                            {
                            ?>
                              <option value='<?php echo $k->id;?>'><?php echo $k->name;?></option>
                            <?php
                             }
                            ?>
                          </select>
                          
                          <select placeholder="Select Columns" name="mitems" id='m_items' multiple="multiple" style="width: 100% !important" class="form-control col-md-12">
                            <?php
                            foreach($items as $k => $v)
                            {
                            ?>
                              <option value='<?php echo $k;?>'><?php echo $v;?></option>
                            <?php
                             }
                            ?>
                          </select>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id='subItem' value="Search" class="btn btn-info"><i class='fa fa-filter'></i> Filter</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
      
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
  $(document).on('ifChecked', '#selectAllz', function(event){ 
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
    var  lga = $('#bus_lga').val();
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
                var obj = JSON.parse(dat); 
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

$(document).on('click', '.cfull', function(){  
  var id = $(this).attr('data-id');
  var b = {id:id, status:4};
  
  $.post('utils/loadCenters.php', b,  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                $('#showItem').modal('show');
                $('#sbus_id').html(obj.id); 
                $('#sbus_name').html(obj.name); 
                $('#sbus_add').html(obj.address);
                $('#sbus_num1').html(obj.phone1);
                $('#sbus_num2').html(obj.phone1);
                $('#sbus_bank').html(obj.bank);
                $('#sbus_acc').html(obj.account);
                $('#sbus_state').html(obj.state);
                lga(obj.state);
                $('#sbus_lga').html(obj.lga);
         

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
  $.post('utils/loadCenters.php', a,  function(dat, status){ alert(status)
            if(status == 'success')
            {
                return obj = JSON.parse(dat);
            }
    }) ; 
}

function getChecked(){
        var array = '';
        $(".checks:checked").each(function(){
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
        $('#namez'+id).wrap("<del></del>");
        
      });

$(document).on('click', '.cdelx', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:7};
        centers_db(b);
        $('#namez'+id).wrap("<del></del>");
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