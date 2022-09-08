<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;

$row = array();
 
$row = $op->selectTimeOne('raffles', NULL, array('active'=>0), array('raffle_end asc'));
	
echo  strtotime($row->raffle_end) - strtotime('now');


//$num = count($row);
//echo strtotime($row->raffle_end);;
?>