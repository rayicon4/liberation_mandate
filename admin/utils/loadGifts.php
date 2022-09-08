<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
session_start();
$op = new DB;
$db = 'gifts';
$db_trash = 'trash_gifts';
$f = array();
$err = array();


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
(isset($_POST['amt']) && strlen($_POST['amt']) > 0)? $f['price'] = $_POST['amt']: $err[] = 1;
$f['description'] = $_POST['des'];
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