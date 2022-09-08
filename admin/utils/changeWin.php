<?php
require_once('../../connect/connect.php');
session_start();
$op = new DB;


$id = $_POST['id']; 
$mid = $_POST['mid']; 
//exit();
$main = $op->selectOne('raffles',NULL, array('id' =>$id));//get raffle
$dbs = 'raffle_log'.$main->mandateID; 
$giftz = unserialize($main->gifts);



$persons = $op->selectOne($dbs,NULL, array('id' =>$mid));//get raffle
$person = $op->selectOne('clients',NULL, array('id' =>$persons->clientID));//get raffle

//confirm if allready won
if($persons->winID == 1)
{
	echo $person->surname.' is already a winner';
}
else
{
	//confime if space is available
	$all = $op->select($dbs, array('id'), array('raffleID' =>$id, 'giftID'=>$persons->giftID));

	if(isset($all) && is_array($all) && count(is_array($all)) > 0 && count($all) >= $giftz[$persons->giftID] )
	{
		$getOne = $op->selectone($dbs, NULL,  array('raffleID' =>$id, 'giftID'=>$persons->giftID), array('id desc'));
		$op->update($dbs, array('winID' => NULL), array('id'=>$getOne->id));
		$op->update($dbs, array('winID' => 1), array('id'=>$mid));
		echo 'Some One was replaced ';
		echo strtoupper($person->surname).' is now a winner refresh to view changes';
	}else
	{
		$op->update($dbs, array('winID' => 1), array('id'=>$mid));
		echo strtoupper($person->surname).' is now a winner refresh to view changes';
	}

}



?>