<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$title_name ='Gift Packs';
$data = $op->select('gifts', NULL);
$active_menu = 3;

if(isset($_POST['submit']))
{
require_once('../connect/utility.php');
$ot = new Utilities;
$u = array();
($ot->prove($_POST['agift_id'], 1)[0] == 1)? $uid = $ot->prove($_POST['agift_id'], 1)[1]: NULL;

  
    if(isset($uid) && $uid > 0)
    {
      
      $f = $op->loadFile(1, $uid, 'file', '../photo', 1000 , 1, '__p_pp' );
      
      $in = $op->update('gifts', array('photo' => $f[1]), array('id' => $uid));
    }
  
}
//exit();
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
      padding-right: 5px;
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
        <div class="container">

          <div class="col-lg-12" style='font-size: 12px'>
            <div >
              <div class="card col-lg-12">
              <div class="card-header" >
              <span class='col-md-6 pull-left'>
              <h1>
                 <i class='fa fa-gift'></i> Gift Packs
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
          <a class="dropdown-item" href="<?php $_['PHP_SELF'];?>?mid=2">>Deactivated</a>
          <a class="dropdown-item disabled" href="#" id='reAll'>Reactivate All</a>
          <a class="dropdown-item disabled " href="#" id='deAll'>Deactivate All</a>
        </div>
      </div>
      </span>
      </div>
                <div class="card-body">
                 
      <table id='mytables' width='100%' style='cellpadding:0px !important' class="" data-search="true" >
                    <thead>
                      <tr>
                        <th width='2%'>
                            <input type='checkbox' id='selectAllz' class="checkz" value='<?php echo $d->id;?>'>
                        </th>
                        <th width='4%'>GIFT CODE</th>
                        <th width='70%'>GIFT NAME</th>
                        <th width='10%'>UNIT PRICE</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i =0;
                    if(isset($data) && sizeof($data) > 0)
                    {
                    foreach($data as $d)
                    {
                      if(isset($_GET['mid']) && $d->active == ($_GET['mid'] - 1) || !isset($_GET['mid']))
                      {
                    ?>
                      <tr id='roz<?php echo $d->id;?>'>
                        <td scope="row">
                          
                          <input type='checkbox' id='chk<?php echo $d->id;?>' class="checkz" value='<?php echo $d->id;?>'>
                          
                        </td>
                        <td>
                        <?php echo str_pad($d->id, 4, "0", STR_PAD_LEFT);?>
                        </td>
                        <td class='a_row' data-id='<?php echo $d->id;?>'>
                          <b class='nlot' id='namez<?php echo $d->id;?>'>
                            <?php echo ($d->active == 0)? $nx = $d->name: $nx = '<del>'.$d->name.'</del>'; ?> 
                          </b>    
                          <span class='flot' id='flotz<?php echo $d->id;?>'>
                            <i class='fa fa-eye cfull' data-id='<?php echo $d->id;?>'></i>
                            <i class='fa fa-image cphoto' data-id='<?php echo $d->id;?>'></i>
                            <i class='fa fa-check cact' data-id='<?php echo $d->id;?>'></i>
                            <i class='fa fa-remove cdct' data-id='<?php echo $d->id;?>'></i>
                            <i class='fa fa-edit cedit' data-id='<?php echo $d->id;?>'></i>
                            
                          </span>                      
                        </td>
                        <td class='text-right'>
                            <?php echo number_format($d->price, 2, '.', ',');?>
                        </td>                     
                      </tr>
                    <?php
                      }
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
        <h3 class="modal-title">Add Gift</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                
                     <form style='font-size:12px '>
                        <div class="form-group">
                          <label>Gift Name</label>
                          <input type="text" id='gift_name' placeholder=" Recharge Cards: 100" class="form-control form-control-sm">
                        </div>
                        <div class="form-group ">
                        
                          <label>Unit Price</label>
                          <input type="number" id='gift_amt' placeholder="000000" class="form-control form-control-sm">
                                               
                        </div>
                        <div class="form-group ">
                          <label>Description</label>
                           <textarea id='gift_des' name='editor1'  class="form-control form-control-sm ckeditor ">
                           </textarea>                    
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

<!-- Add Center -->
<div class="modal fade" id='addPhoto' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-primary">
        <h3 class="modal-title">Add Photo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">                
                     <form  style='font-size:12px' action="" method="post" enctype="multipart/form-data">
                     <input type="hidden" id='agift_id' name='agift_id'>
                     <input type="hidden" id='agift_name' name='agift_name'>
                        <div>
                            <img id='agift_photo'  src="" height="220px" width="380px">
                        </div>
                        
                        <div class="form-group ">
                          <label>Load Promo Photo</label>
                          <input type="file" name='file' id='agift_amtt'  class="form-control form-control-sm">                   
                        </div>
                        
      </div>
      <div class="modal-footer">
        <input type="submit" id='subAdd' name="submit" value="Submit" class="btn btn-primary">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Center -->
<div class="modal fade" id='editItem' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-primary">
        <h3 class="modal-title">Edit Gift</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                
                     <form style='font-size:14px '>
                        <div class="form-group">
                          <label>Gift Name</label>
                          <input type="hidden" id='egift_id' placeholder="" value=''>
                          <input type="text" id='egift_name' placeholder="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                        
                          <label>Unit Price</label>
                          <input type="number" id='egift_amt' placeholder="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group ">
                          <label>Description</label>
                           <textarea id='egift_des' name='editor1'  class="form-control form-control-sm ckeditor ">
                           </textarea>                    
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


$(document).on('click', '#subAdd', function(){ 
    var  name = $('#gift_name').val(); 
    var  amt = $('#gift_amt').val();
    var  des = $('#gift_des').val();
    var  id = '';
    var  b = 
    {
        id:id,
        name:name,
        amt:amt,
        des:des,
        status:1
    }    
    if(centers_db(b) != 0)
    {
      pageReloader();
    }
          
  })

$(document).on('click', '.cedit', function(){  
  var id = $(this).attr('data-id');
  var b = {id:id, status:4};
  
  $.post('utils/loadGifts.php', b,  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat); 
                $('#editItem').modal('show');
                $('#egift_id').val(obj.id); 
                $('#egift_name').val(obj.name); 
                $('#egift_amt').val(obj.price);
                $('#egift_des').val(obj.description);
            }
    }) ;  
})

$(document).on('click', '.cphoto', function(){  
  var id = $(this).attr('data-id');
  var b = {id:id, status:4};
  
  $.post('utils/loadGifts.php', b,  function(dat, status){
            if(status == 'success')
            {
                var obj = JSON.parse(dat);
                
                $('#addPhoto').modal('show');
                $('#agift_id').val(obj.id); 
                $('#agift_name').val(obj.name); 
                $('#agift_photo').attr('src', obj.photo);
            }
    }) ;  
})

$(document).on('click', '#subEdit', function(){ 
    var  name = $('#egift_name').val(); 
    var  amt = $('#egift_amt').val();
    var  id = $('#egift_id').val();
    var  des = $('#egift_des').html();
    var  b = 
    {
        id:id,
        name:name,
        amt:amt,
        des:des,
        status:2
    }
    
    var data = centers_db(b);
    clearRes2();   
    $('#editItem').modal('hide');

  })



function clearRes()
{
  $('#gift_name').val(''); 
  $('#gift_amt').val(''); 
  $('#gift_des').html('');
}
function clearRes2()
{
  $('#egift_id').val(''); 
  $('#egift_name').val(''); 
  $('#egift_amt').val(''); 
  $('#egift_des').html('');
}

function centers_db(a)
{
  $.post('utils/loadGifts.php', a,  function(dat, status){ 
            if(status == 'success')
            {
                return obj = JSON.parse(dat);
            }
            else
            {
              return 0;
            }
    }) ; 
}

function getChecked(){
        var array = '';

        $(".checkz:checked").each(function(){ 
          array += $(this).val();
          array += ',';
        });    
    return n = array;
}

function pageReloader(){
       window.reload(); 
}
$(document).on('click', '.cact', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:5};
        centers_db(b);
        $('#namez'+id).unwrap("<del></del>");
      });

 
$(document).on('click', '.cdct', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:6};
        centers_db(b); 
        $('#namez'+id).wrap("<del></del>");
        
      });

$(document).on('click', '.cdel', function(){ 
        var id = $(this).attr('data-id'); 
        var b = {id:id, status:7};
        centers_db(b);
        $('#namez'+id).wrap("<del>");
        $('#rowz'+id).fadeOut("slow");
      });

  $(document).on('click', '#reAll', function(){ 
        var id = getChecked(); 
        var b = {id:id, status:8};
        centers_db(b);
        pageReloader();
      });

  $(document).on('click', '#deAll', function(){ 
        var id = getChecked(); 
        var b = {id:id, status:9};
        centers_db(b);
        pageReloader();
      });


</script>
</html>