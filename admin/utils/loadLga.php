<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;


$id = $_POST['id'];

$row = array();
 
$row = $op->select('local_governments', NULL, array('state_id'=>$id));
	
$num = count($row);
echo json_encode($row);
?>