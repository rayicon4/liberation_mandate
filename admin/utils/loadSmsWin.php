<?php
require_once('../../connect/connect.php');
require_once('../../connect/sendmail.php');
session_start();
$op = new DB;
$em = new SendEmail;


$id = $_POST['id'];
$mid = $_POST['mid'];

$main = $op->selectOne('raffles',NULL, array('id' =>$id));
$lid = $main->mandateID;

$center = $op->selectOne('mandates', NULL, array('id' =>$lid)); 
$data = $op->selectLogs($lid, $id, 1, $mid);

if(isset($data) && is_array($data))
{ 
	foreach($data as $d)
	{
		try{
		$em->sendSmsWinning($d->clientID, $d->id, $lid);
		$op->update('raffle_log'.$lid, array('winSms'=> 1), array('id' => $d->id));
		} 
		catch (Exception $e) {
			
		}
		
	   
	}
}



?>