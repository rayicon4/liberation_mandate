<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
require_once('../../connect/utility.php');
require_once('../../connect/sendmail.php');

$op = new DB;
$ot = new Utilities;
$em = new SendEmail;
$db = 'client';
$u = array();
$err = array();

($ot->prove($_POST['phone'], 3)[0] == 1)? $phone = $ot->prove($_POST['phone'], 3)[1]: $err['phone'] = $ot->prove($_POST['phone'], 3)[1];


if(count($err) == 0){
    $p = $op->selectOne($db, NULL, array('phone' => $phone));
    if(isset($p) && $p->id > 0)
    {
        $q = $ot->generatePassword();
        $i = $op->update($db, array('password' => $q[1]), array('id'=>$p->id) );
        if($i == 1)
        {
            $em->sendEmailNewPassword($id, $q[0]);
           //$em->sendSmsNewPassword($id, $q[0]);
            header('location:../pstatus.php?e=2&g='.serialize($err).'');
        }
    }
}
else
{
    header('location:../fpassword.php?e=2&g='.serialize($err).'');
}

?>