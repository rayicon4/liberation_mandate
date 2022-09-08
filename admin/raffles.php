
<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 
require_once("proof.php");
$op = new DB;
$db = 'raffles';

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

 
  
$data = $op->select($db);



//print_r($data);
$title_name = 'Raffles';


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
            <li class="breadcrumb-item active"><?php echo $title_name;?></li>
          </ul>
        </div>
      </div>
     <section class="charts">
        <div class="container-fluid">
          <header class='row'> 
            <h1>
                <?php echo $title_name;?> 
            </h1>
           
          </header>
          <div class="row" style='font-size: 14px'>
            <div class="col-lg-12">
              <div class="card">
                
                
                <div class="card-body">
                 <form action='raffles.php' method='post' >
                 <table id='mytables' width='100%' style='cellpadding:0px !important' class="" data-pagination="true" data-search="true" data-toggle="tablex">
                  <input type='hidden' name='center' value='<?php echo $id;?>'>
                    <thead>
                      <tr>
                        <th width='10px' style='width:10px'>#</th>
                        <th >Sponsor</th>
                        <th >Date End</th>
                        <th >Gift Size</th>
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
                            $h1 = $op->selectOne('mandates', null, array('id'=>$d->mandateID));
                            echo $h1->fullname;
                            ?> 
                          </b>                       
                        </td>
                        <td class='a_row' >  
                          
                            <?php
                            if(strtotime('now') > strtotime($d->raffle_end))
                            {
                            	$op->update('raffles', array('active' => 1), array('id' => $d->id));
								echo '<i class="text-danger">'.date('d m Y h:i:s',strtotime($d->raffle_end)).'</i>';
                            }else
                            {
                            	echo '<i class="text-success">'.date('d m Y h:i:s',strtotime($d->raffle_end)).'</i>';
                            }
                            
                            ?> 
                                              
                        </td> 
                        <td class='text-center' >  
                          
                            <?php
                            echo array_sum(unserialize($d->gifts));
                            
                            ?> 
                                              
                        </td> 
                        <td>
                        <div class="btn-group btn-xs col-md-12 float-right" style='padding:0px !important;margin:0px !important;' >
                          <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                          </button>
                          <div class="dropdown-menu">
                        
                        <a class="dropdown-item" href="raffleAdd.php?id=<?php echo $_GET['id'];?>">Raffle Add</a>
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>&edit=<?php echo $d->id;?>">Edit</a>
                        
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>&act=<?php echo $d->id;?>">Activate</a>
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>&dct=<?php echo $d->id;?>">Deactivate</a>
                        <a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>&del=<?php echo $d->id;?>">Delete</a>   
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
      "searching": true,
      "ordering": true,
    });
  });

  
</script>
</html>