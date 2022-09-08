<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;
$db = 'Blog';

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

 
$pg = $_GET['pg'];
if(isset($pg) && $pg > 0)
{

}
else
{
  $pg = 0;
}
$datanum = $op->select('blogs', NULL, array('active'=>0));
$datanum = count($datanum)/30;
$data = $op->selectBlogs($pg, 30);



//print_r($data);
$title_name = 'Liberators';


$active_menu = 7;

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
            <h1 class='col-md-6 float-right'>
                Blog
            </h1>
            <span class='col-md-6 float-left'>
              <a  class='btn btn-info' href='blog.php'> Add New</a>
            </span>
             
          </header>
          <div class="row" style='font-size: 12px'>
          
            <div class="col-lg-12">
              <div class="card">
                
                 <div class="card-body">
                  <div class="col-md-12">
        <ul class="list-group w3-agile">
        <?php
        foreach ($data as $d) 
        {
        ?>
           
            <li class="list-group-item">
              <a    href='../home/blogpost.php?id=<?php echo $d->id;?>' target='_blank'><i class='fa fa-eye text-info'></i></a>
              <a    href='blog.php?id=<?php echo $d->id;?>' ><i class='fa fa-edit text-primary'></i></a>
              <?php

              if($d->active == 0)
              {
              ?>
              <a    href='blogpost.php?id=<?php echo $d->id;?>' ><i class='fa fa-thumbs-up text-success'></i></a>
              <?php
              }else
              {
              ?>
              <a    href='blogpost.php?id=<?php echo $d->id;?>' ><i class='fa fa-thumbs-down text-danger'></i></a>
              <?php
                }
              ?>
               <?php echo $d->title;?><small><b style="color:black"> by <?php echo $d->author;?> </b></small>
              <span class="badge badge-primary pull-right"><?php echo $d->views  ;?></span> <i class="ti ti-eye"></i> <i style='color:black '><?php echo date('d D m Y h i a',strtotime($d->date_created));?></i> </a>
            </li>
           
        <?php
        }
        ?>
        </ul>
        </div>
        <div class="clearfix"> </div>
        <div class="col-md-12">
          <nav>
            <ul class="pagination pagination-sm">
               <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
              <?php 

              for($ft = 0; $ft < $datanum; ++$ft)
              {
                 $pg1 = $ft + 1;

                 if($ft == $pg)
                 {
                  echo '<li class="active"><a href="'.$_SERVER['PHP_SELF'].'?pg='.$ft.'">'.$pg1.'</a></li>';
                 }
                 else
                 {
                  echo '<li><a href="'.$_SERVER['PHP_SELF'].'?pg='.$ft.'">'.$pg1.'</a></li>';
                 }

                 
              }
              ?>
              
              
            </ul>
          </nav>

        </div>
      </div>
    </div>
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

</html>