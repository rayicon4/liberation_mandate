<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;
$db = 'raffles';

$id = $_POST['id'];
$mid = $_POST['mid'];
$row = array();
 
$raffle = $op->selectOne($db, NULL, array('id'=>$mid));

$gifts = unserialize($raffle->gifts);
$giftz = array_keys($gifts);
$rowz = array();

$center_gift = $op->select('centers_gifts', NULL, array('centers_id'=>$id));

foreach($center_gift as $r)
{
	if(in_array($r->gifts_id, $giftz) && $gifts[$r->gifts_id] > 0)
	{
	 $gf = $op->selectOne('gifts', array('name'), array('id'=>$r->gifts_id));
	 $d = array();
	 $d['id'] = $r->gifts_id;
	 $d['name'] = $gf->name;
	 $rowz[] = $d;
	}

}	
ob_start();
echo json_encode($rowz);


?>