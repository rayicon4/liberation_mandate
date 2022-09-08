<?php
session_start();

if(isset($_SESSION['x']) && count($_SESSION['x']) > 0)
{
    $m_id = $_SESSION['x']['id'];
    $m_phone = $_SESSION['x']['phone'];
    $m_name = $_SESSION['x']['name'];

    //require_once('../connect/connect.php');

	$op = new DB;
    $m_array = $op->selectOne('clients', NULL, array('id' => $m_id));
    if(isset($m_array->passport) && file_exists($m_array->passport)){
        $m_pics = $m_array->passport;
    }
    
}
else
{
        $m_name = 'Guest';
}

?>