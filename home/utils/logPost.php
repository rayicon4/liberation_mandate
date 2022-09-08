<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;

$row = array();
 
$row = $op->selectOne('blogs', array('views'), array('id'=>$_POST['id']));
$val = $row->views + 1;
$row = $op->update('blogs', array('views' =>$val ), array('id'=>$_POST['id']));
	

?>