<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$title_name ='Liberators (Add | Edit)';

$id = '';
$name = '';
$position = '';
$facebook = '';
$twitter = '';
$email = '';
$sex = 'Male';
$phrase = '';
$manisfesto ='';
$aboutme ='';
$address ='';
$active = 0;
$raffle = 0;


if(isset($_POST['submit']))
{
require_once('../connect/utility.php');
$ot = new Utilities;
$u = array();
($ot->prove($_POST['id'], 1)[0] == 1)? $uid = $ot->prove($_POST['id'], 1)[1]: NULL;

  if(count($err) == 0)
  {
    if(isset($uid) && $uid > 0)
    {
      $f = $op->loadFile(1, $uid, 'file', '../photo', 1000 , 1, 'p_' );
      $in = $op->update('mandates', array('passport' => $f[1]), array('id' => $uid));
    }
  }
}

if(isset($_GET['id']) && strlen($_GET['id']) > 0)
{
  $id = $_GET['id'];

  $f = $op->selectOne('mandates', NULL, array('id'=>$id)); // print_r($f);
  if(isset($f) && count($f->id) > 0)
  {
    
    $photo = $f->passport;
    
    if(is_file($photo) && file_exists($photo))
    {

    }
    else
    {
      $photo = '../home/images/1.jpg';
    }

  }
  
}
$active_menu  = 4;

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
                Mandates
            </h1>
             
          </header>
          <div class="row" style='font-size: 12px'>
            <div class="col-lg-12">
              <div class="card">
                
                 <div class="card-body">
                  <form class="form-horizontal" method='post' enctype="multipart/form-data">
                    <input name='id' value='<?php echo $id;?>' type='hidden'>               
                    <div class="line"></div>
                    
                    <div class="form-group row">
                      <img src='<?php echo $photo;?>' height="200px" width="180px">
                      <label class="col-sm-2 form-control-label">Load Photo</label>
                      
                    </div>
                    <div class="form-group row">
                    <input class='form-controlx' name='file' type='file'>
                    </div>
                    <div class="form-group row">
                    <button name="submit" type='submit' class="btn btn-danger">Load Image</button>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6 offset-sm-2">
                       
                        <?php
                        if(isset($id) && $id > 0){
                          (string) $ids = $id;
                          ?>
                           
                            <a class="btn btn-primary" href='mandatesAdd.php?id=<?php echo $id;?>'><i class='fa fa-Edit'></i> Edit</a>
                            <a class="btn btn-secondary" href='liberators.php'><i class='fa fa-users'></i> Liberators</a>
                            <a class="btn btn-info" href='../profile/profile.php?q=<?php echo $ids ;?>'><i class='fa fa-user'></i> Profile</a>
                            
                            
                          <?php
                        }
                        
                        ?>
                        
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