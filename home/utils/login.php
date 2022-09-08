<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
require_once('../../connect/utility.php');

$op = new DB;
$ot = new Utilities;
$db= 'clients';
$u = array();
$err = array();
($ot->prove($_POST['phone'], 3)[0] == 1)? $u['phone'] = $ot->prove($_POST['phone'], 2)[1]: $err['phone'] = $ot->prove($_POST['phone'], 2)[1];
($ot->prove($_POST['pass'], 4)[0] == 1)? $u['password'] = $ot->prove($_POST['pass'], 2)[1]: $err['password'] = $ot->prove($_POST['pass'], 2)[1];


if(count($err) == 0){
    $p = $op->selectOne($db, NULL, array('phone' =>$u['phone']));
    if(!(isset($p) && $p->id > 0 )){
        $p = $op->selectOne($db, NULL, array('email' =>$u['phone'])); 
    }
    
    if((isset($p) && $p->id > 0 ))
        {
            (isset($p->password)) ? $pr = $p->password: $pr = $q->password ; 
            if($pr == md5($u['password'])){
                session_start();
                $_SESSION['x'] = array();
                $_SESSION['x']['id'] = $p->id;
                $_SESSION['x']['name'] = ucwords(strtolower($p->surname." ".$p->othername));
                $_SESSION['x']['phone'] = $p->phone;
                header('location:../index.php');
            }
            else
            {
                header('location:../login.php?e=1');
            }
        }
    else
        {
            header('location:../login.php?e=1');
        }
}
else
{
    header('location:../login.php?e=2&g='.serialize($err).'');
}

?>