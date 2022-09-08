<?php
ob_start();
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;

$title_name ='Blogs (Add | Edit)';

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

if(isset($_POST['add']) || isset($_POST['edit']))
{
require_once('../connect/utility.php');
$ot = new Utilities;
$u = array();
($ot->prove($_POST['id'], 1)[0] == 1)? $uid = $ot->prove($_POST['id'], 1)[1]: NULL;
($ot->prove($_POST['title'], 1)[0] == 1)? $u['title'] = $ot->prove($_POST['title'], 1)[1]: $err['title'] = $ot->prove($_POST['title'], 1)[1];
($ot->prove($_POST['editor1'],1)[0] == 1)? $u['content'] = $ot->prove($_POST['editor1'], 1)[1]: NULL;
($ot->prove($_POST['author'],1)[0] == 1)? $u['author'] = $ot->prove($_POST['author'], 1)[1]: NULL;
($ot->prove($_POST['liberator'],1)[0] == 1)? $u['liberatorID'] = $ot->prove($_POST['liberator'], 1)[1]: NULL;
($ot->prove($_POST['active'], 2)[0] == 1 && $ot->prove($_POST['active'], 2)[1] == 0)? $u['active'] = 0: $u['active'] = 1;



  if(count($err) == 0)
  {
    if(isset($uid) && $uid > 0)
    {
      $in = $op->update('blogs', $u, array('id' => $uid));
      $in = $uid;
    }
    else
    {
      $in = $op->insert('blogs', $u);
      
    }

    if(isset($in) && $in > 0)
    {
       header('location : blog.php?id='.$in);
    }
  }
}

if(isset($_GET['id']) && strlen($_GET['id']) > 0)
{
  $id = $_GET['id'];
  $f = $op->selectOne('blogs', NULL, array('id'=>$id)); // print_r($f);
  if(isset($f) && count($f) > 0)
  {
    $title = $f->title;
    $content = $f->content;
    $author = $f->author;
    $liberator = $f->liberatorID;
    $photo = $f->photo;
    $active = $f->active;
  
  }
  
}
$libr = $op->select('mandates');
$active_menu  = 8;

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
                Blog (Add/Edit)
            </h1>
            <span class='col-md-6 float-left'>
              <a  class='btn btn-info' href='blogs.php'> Veiw All</a>
            </span>
             
          </header>
          <div class="row" style='font-size: 12px'>
          
            <div class="col-lg-12">
              <div class="card">
                
                 <div class="card-body">
                  <form class="form-horizontal" method='post'>
                    <input name='id' value='<?php echo $id;?>' type='hidden'>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Title</label>
                      <div class="col-sm-10">
                        <input type="text" name='title' value='<?php echo $title;?>' placeholder="Politics in Nigeria"  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                     <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Content</label>
                      <div class="col-sm-10">
                        <textarea class="ckeditor" name="editor1" id="editor" name='content' height='700px'   class="form-control">
                        <?php echo $content;?>
                        </textarea>
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">liberators</label>
                      <div class="col-sm-10" >
                      <select name='liberator' class="form-control">
                      <option>
                      <?php
                      foreach($libr as $l)
                      {
                        echo '<option value="'.$l->id.'">'.$l->fullname.'</option>';
                      }
                      ?>
                      </select>
                       
                        <span class="help-block-none"></span>
                      </div>
                    </div>

                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Other Authors</label>
                      <div class="col-sm-10">
                        <input type="text" name='author' value='<?php echo $author;?>' placeholder=""  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>

                    <div class="line"></div>
                    
                    
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Settings</label>
                      <div class="col-sm-10">
                        <div class="i-checks">
                          <input id="checkboxCustom2" type="checkbox" <?php echo ($active != 1)? 'checked': null;?> value="0" name="active" class='form-control-custom checkbox-custom'>
                          <label for="checkboxCustom2">Active</label>
                        </div>
                      </div>
                    </div>
               
                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                       
                        <?php
                        if(isset($id) && $id > 0){
                          ?>

                            <button type="submit" class="btn btn-primary" name='edit'>Save changes</button>
                            <a class="btn btn-secondary" href='mandates.php'>Mandates</a>
                            <a class="btn btn-info" href='../profile/profile.php?q=<?php echo $id;?>'>Profile</a>
                            <a class="btn btn-warning" href='profilephoto.php?id=<?php echo $id;?>'>Photo</a>
                            
                          <?php
                        }
                        else
                        {
                          ?>

                          <button type="submit" class="btn btn-primary" name='add'>Save </button>
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