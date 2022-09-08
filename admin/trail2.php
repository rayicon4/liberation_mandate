<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 

$op = new DB;

$se = $op->select('clients');

foreach($se as $s)
{
  echo $rt['raffleID'] = 3;
  $rt['giftID'] = rand(1, 3);
  $rt['centerID'] = rand(1, 3);
  $rt['clientID'] = $s->id;
  
  $op->insert('raffle_log1', $rt);
}
?>

