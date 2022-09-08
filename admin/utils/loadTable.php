<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
session_start();
$op = new DB;
$db = 'centers';
$db_trash = 'trash_centers';
$f = array();
$err = array();
$itemz = array(1=>'statename', 2=>'lganame', 3=>'bankname', 4=>'account');
//print_r($_POST);

(isset($_POST['s']) && strlen($_POST['s']) > 0)? $state = $_POST['s']: $err[] = 1;
(isset($_POST['l']) && strlen($_POST['l']) > 0)? $lga = explode(',', $_POST['l']) : $err[] = 1;
(isset($_POST['b']) && strlen($_POST['b']) > 0)? $bank = explode(',', $_POST['b']): $err[] = 1;
(isset($_POST['i']) && strlen($_POST['i']) > 0)? $item = explode(',', $_POST['i']): $err[] = 1;

if(isset($state) && count($state) > 0)
{
	$states = $op->array_or_array('state', $state);
}
if(isset($lga) && count($lga) > 0)
{
	$lgas = $op->array_or_array('lga', $lga);
}

if(isset($bank) && count($bank) > 0)
{
	$banks = $op->array_or_array('bank', $bank);
}

if(isset($item) && count($item) > 0)
{ 
	$items = array('id', 'name');
	$itemd = array('id'=>'#', 'name'=>'Business Name');
	foreach($item as $t => $t1)
	{
		if(isset($itemz[$t1]))
		{
			$items[] = $itemz[$t1];
			$itemd[$itemz[$t1]] = $itemz[$t1];
		}
	}
	
}



$row = $op->selectRawMain($items, $states, $lgas, $banks);
$data = array();
foreach($row as $q)
{
	$d = array();
	$d['id'] = $q->id;
	$d['name'] = $q->name;
}
   $w = array();
   foreach($itemd as $k => $v)
   {
   	$rw = array(); 
   	$rw['field']=$k;
   	$rw['title']=$v;
   	$w[] = $rw;
   }
echo json_encode($row).'::::::::'.json_encode($w);

?>