<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$title_name ='Liberators';

if(isset($_GET['del']) && is_numeric($_GET['del']) && $_GET['del'] > 0)
{
  $op->delete('gallery', array('id'=>$_GET['del']));
}

if(isset($_POST['submit']))
{
require_once('../connect/utility.php');
$ot = new Utilities;
$u = array(); 
      $in = $op->insert('gallery', array('title' => $_POST['title'], ), array('id' => $uid));
      $f = $op->loadFile(1, $in, 'file', '../photo', 100000 , 1, 'z_z' );
      $op->update('gallery', array('passport' => $f[1]), array('id' => $in));
   
}



  $f = $op->select('gallery'); // print_r($f);

$active_menu  = 10;

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
                Gallery
            </h1>
             
          </header>
          <div class="row" style='font-size: 12px'>
            <div class="col-lg-12">
              <div class="card">
                
                 <div class="card-body">
                 <div class='row'>
                 <?php
                    if(is_array($f))
                    {
                    foreach($f as $f1)
                    {
                      $add = explode('.', $f1->passport);
                        $lt = end($add);
                        $im_a =  array('jpg', 'png', 'gif', 'jpeg', 'bmp' );
                        $vid_a =  array('mp4', 'wma', '3gpp', 'flv' );
                      if(in_array($lt, $im_a))
                      {
                    ?>
                    <div class="col-md-6">
                      <div>
                      <img src='<?php echo $f1->passport;?>' height="200px" >
                      </div>
                      <hr>
                      <div class='alert alert-info'><?php echo $f1->title;?></div>
                      <div>
                      <a class="btn btn-info" href='gallery.php?del=<?php echo $f1->id;?>'>Delete Image</a>
                      </div> 
                    </div>
                    <?php
                    }
                    }
                  }
                    ?>
                    </div>
                    <div class='row'>
                 <?php
                    if(is_array($f))
                    {
                    foreach($f as $f1)
                    {
                      $add = explode('.', $f1->passport);
                        $lt = end($add);
                        $im_a =  array('jpg', 'png', 'gif', 'jpeg', 'bmp' );
                        $vid_a =  array('mp4', 'wma', '3gpp', 'flv' );
                      if(in_array($lt, $vid_a))
                      {
                    ?>
                    <div class="col-md-6">
                      <div>
                      <video width='380px' height='250px'   controls>
                      <source src="<?php echo $f1->passport ;?>" type="video/<?php echo $lt;?>"><  
                      </video>
                      </div>
                      <hr>
                      <div class='alert alert-info'><?php echo $f1->title;?></div>
                      <div>
                      <a class="btn btn-info" href='gallery.php?del=<?php echo $f1->id;?>'>Delete Video</a>
                      </div> 
                    </div>
                    <?php
                    }
                    }
                  }
                    ?>
                    </div>
                  <form class="form-horizontal" method='post' enctype="multipart/form-data">
                    <input name='id' value='<?php echo $id;?>' type='hidden'>               
                    <div class="line"></div>
                    <div class="form-group row">
                    <label>Title</label>
                    <input class='form-control' name='title' type='text'>
                    </div>
                    <div class="form-group row">
                    <input class='form-controlx' name='file' type='file'>
                    </div>
                    <div class="form-group row">
                    <button name="submit" type='submit' class="btn btn-danger">Load Image</button>
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