<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
session_start();
$op = new DB;
$db = 'centers';
$db_trash = 'trash_centers';
$f = array();
$err = array();
//print_r($_POST);

$status = $_POST['status'];
if(isset($_POST['id']) && strlen($_POST['id']) > 0)
	{
		$q = explode(',', $_POST['id']);

		if(count($q) == 1 && $q[0] != NULL && $q[0] != '' && $q[0] > 0)
		{
			$id = $_POST['id'];	
			$f['id'] = $id;
		}
		elseif(count($q) > 1)
		{
			$id = $q;
		}
		
	}
else{
		$id = NULL; 
		$f['id'] = $id;
	}
(isset($_POST['name']) && strlen($_POST['name']) > 0)? $f['name'] = $_POST['name']: $err[] = 1;
(isset($_POST['phone1']) && strlen($_POST['phone1']) > 10)? $f['phone1'] = $_POST['phone1']: $err[] = 1;
(isset($_POST['phone2']) && strlen($_POST['phone2']) > 0)? $f['phone2'] = $_POST['phone2']: $er[] = 1;
(isset($_POST['addr']) && strlen($_POST['addr']) > 0)? $f['address'] = $_POST['addr']: $err[] = 1;
(isset($_POST['state']) && strlen($_POST['state']) > 0)? $f['state'] = $_POST['state']: $err[] = 1;
(isset($_POST['lga']) && strlen($_POST['lga']) > 0)? $f['lga'] = $_POST['lga']: $err[] = 1;
(isset($_POST['bank']) && strlen($_POST['bank']) > 0)? $f['bank'] = $_POST['bank']: $err[] = 1;
(isset($_POST['acc']) && strlen($_POST['acc']) > 0)? $f['account'] = $_POST['acc']: $err[] = 1;

//
//PRINT_R($err);
//add
if($status == 1)
{
	if(count($err) == 0)
	{
		unset($f['id']);
		$in = $op->insert($db, $f);
		if($in > 0)
		{
			$row = $op->selectOne($db, NULL, array('id'=>$in));
			echo json_encode($row);
		}
	}

}
//update/edit
elseif($status == 2)
{
	if($f['id'] > 0)
	{

		unset($f['id']);
		$in = $op->update($db, $f, array('id'=>$id));
		if($in > 0)
		{
			$row = $op->selectOne($db, NULL, array('id'=>$id));
			echo json_encode($row);
		}
	}
	
}
//delete/remove by id
elseif($status == 3)
{
	if($f['id'] > 0)
	{
		echo $in = $op->delete($db, array('id' => $id));
	}
	
}
//select
elseif($status == 4)
{
	if($f['id'] > 0)
	{
		
		$row = $op->selectOne($db, NULL, array('id'=>$id));
		echo json_encode($row);
		
	}
	
}

elseif($status == 5)
{
	if($f['id'] > 0)
	{

		echo $in = $op->update($db, array('active' => 0), array('id'=>$id));
	}
	
}
elseif($status == 6)
{
	if($f['id'] > 0)
	{

		echo $in = $op->update($db, array('active' => 1), array('id'=>$id));
	}
	
}
elseif($status == 7)
{
if($f['id'] > 0)
	{
		$in = $op->selectOne($db, NULL, array('id'=>$id));
		$in = $op->insert($db, $in);
		$in = $op->delete($db_trash, NULL, array('id'=>$id));
		echo $in = $op->delete($db, array('id' => $id));
	}
}
elseif($status == 8)
{
	if(is_array($id) & count($id) > 0)
	{
		foreach($id as $ids)
		{
			echo $in = $op->update($db, array('active' => 0), array('id'=>$ids));
		}
		
	}
	
}

elseif($status == 9)
{
	if(is_array($id) & count($id) > 0)
	{
		foreach($id as $ids)
		{
			echo $in = $op->update($db, array('active' => 1), array('id'=>$ids));
		}
		
	}
	
}

elseif($status == 10)
{
	if(is_array($id) & count($id) > 0)
	{
		foreach($id as $ids)
		{
			$in = $op->selectOne($db, NULL, array('id'=>$ids));
			$in = $op->insert($db, $in);
			$in = $op->delete($db_trash, NULL, array('id'=>$ids));
		}
		
	}
	
}

?>