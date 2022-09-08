<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;


$id = $_POST['id'];

$row = array();
 
$row = $op->selectOne('raffle', NULL, array('active'=>0), array('raffle_end DESC'));
	
$num = count($row);
echo json_encode($row);
?>