<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;
$db = 'centers';

$id = $_POST['id'];
$mid = $_POST['mid'];
$main = $op->selectOne('raffles',NULL, array('id' =>$id));
$lid = $main->mandateID;
$row = array();
 
if(isset($mid) && is_numeric($mid) && $mid > 0)
{

   $mf = unserialize($main->gifts);
   
  if(isset($mf[$mid]) && $mf[$mid] > 0)
  {

      $dbs = 'raffle_log'.$main->mandateID;
      //select all thoses that applied for gift
      $allwins = $op->update($dbs, array('winID' => NULL), array('giftID' =>$mid, 'raffleID' =>$id, 'winID' => 1 ));
  } 
}



?>