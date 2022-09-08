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
$phone ='';
$active = 0;
$raffle = 0;


if(isset($_POST['add']) || isset($_POST['edit']))
{
require_once('../connect/utility.php');
$ot = new Utilities;
$u = array();
($ot->prove($_POST['id'], 1)[0] == 1)? $uid = $ot->prove($_POST['id'], 1)[1]: NULL;
($ot->prove($_POST['name'], 1)[0] == 1)? $u['fullname'] = $ot->prove($_POST['name'], 1)[1]: $err['name'] = $ot->prove($_POST['name'], 1)[1];
($ot->prove($_POST['position'],1)[0] == 1)? $u['position'] = $ot->prove($_POST['position'], 1)[1]: NULL;
($ot->prove($_POST['facebook'], 3)[0] == 1)? $u['facebook'] = $ot->prove($_POST['facebook'], 3)[1]: NULL;
($ot->prove($_POST['twitter'], 5)[0] == 1)? $u['twitter'] = $ot->prove($_POST['twitter'], 5)[1]: NULL;
($ot->prove($_POST['email'], 2)[0] == 1)? $u['email'] = $ot->prove($_POST['email'], 2)[1]: NULL;
($ot->prove($_POST['sex'], 2)[0] == 1)? $u['sex'] = $ot->prove($_POST['sex'], 2)[1]: NULL;
($ot->prove($_POST['phone'], 2)[0] == 1)? $u['phone'] = $ot->prove($_POST['phone'], 2)[1]: NULL;
($ot->prove($_POST['address'], 2)[0] == 1)? $u['address'] = $ot->prove($_POST['address'], 2)[1]: NULL;
($ot->prove($_POST['phrase'], 2)[0] == 1)? $u['phrase'] = $ot->prove($_POST['phrase'], 2)[1]: NULL;
($ot->prove($_POST['manisfesto'], 2)[0] == 1)? $u['manifesto'] = $ot->prove($_POST['manisfesto'], 2)[1]: NULL;
($ot->prove($_POST['aboutme'], 2)[0] == 1)? $u['aboutme'] = $ot->prove($_POST['aboutme'], 2)[1]: NULL;
($ot->prove($_POST['active'], 2)[0] == 1 && $ot->prove($_POST['active'], 2)[1] == 0)? $u['active'] = 0: $u['active'] = 1;
($ot->prove($_POST['raffle'], 2)[0] == 1 && $ot->prove($_POST['raffle'], 2)[1] == 0)? $u['raffle'] = 0: $u['raffle'] = 1;

//print_r($u);
  if(count($err) == 0)
  {
    if(isset($uid) && $uid > 0)
    {
    $in = $op->update('mandates', $u, array('id' => $uid));
    $op->createLog($uid);
    $in = $uid;
   }
   else
   {
      $in = $op->insert('mandates', $u);
      echo $op->createLog($in);
      
      $in = $uid;
   }

   if(isset($in) && $in > 0)
    {
      header('location:mandatesAdd.php?id='.$in);
    }
  }
}

if(isset($_GET['id']) && strlen($_GET['id']) > 0)
{
  $id = $_GET['id'];

  $f = $op->selectOne('mandates', NULL, array('id'=>$id)); // print_r($f);
  if(isset($f) && count($f) > 0)
  {
    $name = $f->fullname;
    $sex = $f->sex;
    $position = $f->position;
    $facebook = $f->facebook;
    $twitter = $f->twitter;
    $email = $f->email;
    $phrase = $f->phrase;
    $manisfesto = $f->manifesto;
    $aboutme = $f->aboutme;
    $address = $f->address;
    $phone = $f->phone;
    $active = $f->active;
    $raffle = $f->raffle;

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
                Liberators
            </h1>
             
          </header>
          <div class="row" style='font-size: 12px'>
            <div class="col-lg-12">
              <div class="card">
                
                 <div class="card-body">
                  <form class="form-horizontal" method='post'>
                    <input name='id' value='<?php echo $id;?>' type='hidden'>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Fullname</label>
                      <div class="col-sm-10">
                        <input type="text" name='name' value='<?php echo $name;?>' placeholder="Barrister Geurge Mento"  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Position</label>
                      <div class="col-sm-10">
                        <input type="text" name='position' value='<?php echo $position;?>' placeholder="Senator"  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Phone</label>
                      <div class="col-sm-10">
                        <input type="text" name='phone' value='<?php echo $phone;?>' placeholder=""  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">facebook Handle</label>
                      <div class="col-sm-10">
                        <input type="url" name='facebook' value='<?php echo $facebook;?>' placeholder=""  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Twitter Handle</label>
                      <div class="col-sm-10">
                        <input type="url" name='twitter' value='<?php echo $twitter;?>' placeholder=""  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name='email' value='<?php echo $email;?>' placeholder="info@mail.com"  class="form-control">
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Sex </label>
                      <div class="col-sm-10">
                        <div class="i-checks">
                          <input id="optionsRadios1" type="radio" <?php echo ($sex == 'Male')? 'checked': null;?> value="Male" name="sex" class='form-control-custom radio-custom'>
                          <label for="optionsRadios1">Male</label>
                        </div>
                        <div class="i-checks">
                          <input id="optionsRadios2" type="radio"  <?php echo ($sex == 'Female')? 'checked': null;?> value="Female" name="sex" class='form-control-custom radio-custom'>
                          <label for="optionsRadios2">Female</label>
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Catch Phrase <br><small class="text-primary">Few words that explain pupose or define you</small></label>
                      <div class="col-sm-10">
                        <textarea name='phrase' placeholder=""  class="form-control"><?php echo $phrase;?></textarea>
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">About me</label>
                      <div class="col-sm-10">
                        <textarea name='aboutme' placeholder=""  class="form-control"><?php echo $aboutme;?></textarea>
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Manifesto</label>
                      <div class="col-sm-10">
                        <textarea name='manisfesto' placeholder=""  class="form-control"><?php echo $manisfesto;?></textarea>
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Address</label>
                      <div class="col-sm-10">
                        <textarea name='address' placeholder=""  class="form-control"><?php echo $address;?></textarea>
                        <span class="help-block-none"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Settings</label>
                      <div class="col-sm-10">
                        <div class="i-checks">
                          <input id="checkboxCustom1" type="checkbox"  <?php echo ($raffle != 1)? 'checked': null;?> value="0" name="raffle" class='form-control-custom checkbox-custom'>
                          <label for="checkboxCustom1">Raffle</label>
                        </div>
                        <div class="i-checks">
                          <input id="checkboxCustom2" type="checkbox" <?php echo ($active != 1)? 'checked': null;?> value="0" name="active" class='form-control-custom checkbox-custom'>
                          <label for="checkboxCustom2">Active</label>
                        </div>
                      </div>
                    </div>
               
                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-md-6 offset-sm-2">
                       
                        <?php
                        if(isset($id) && $id > 0){
                          ?>

                            <button type="submit" class="btn btn-primary" name='edit'><i class='fa fa-save'></i> Save changes</button>
                            <a class="btn btn-secondary" href='mandates.php'><i class='fa fa-users'></i> Liberators</a>
                            <a class="btn btn-info" href='../profile/profile.php?q=<?php echo $id;?>'><i class='fa fa-user'></i> Profile</a>
                            <a class="btn btn-warning" href='mandateProfile.php?id=<?php echo $id;?>'><i class='fa fa-image'></i> Photo</a>
                            
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