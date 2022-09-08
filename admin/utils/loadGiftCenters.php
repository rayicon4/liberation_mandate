<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;
$db = 'centers';

$id = $_POST['id'];

$row = array();
 
$row = $op->select($db, NULL, array('lga'=>$id, 'active'=>0));


$rowz = array();
foreach($row as $r)
{
	 $d = array();
	 $d['id'] = $r->id;
	 $d['name'] = strtoupper($r->name)." | ".strtoupper($r->address);
	 $rowz[] = $d;

}	
echo json_encode($rowz);


?>