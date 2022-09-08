<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
require_once('../../connect/utility.php');
require_once('../../connect/sendmail.php');

$op = new DB;
$ot = new Utilities;
$em = new SendEmail;
$db = 'clients';
$u = array();
$err = array();

($ot->prove($_POST['opass'], 4)[0] == 1)? $opass = $ot->prove($_POST['opass'], 4)[1]: $err['opass'] = $ot->prove($_POST['opass'], 4)[1];
($ot->prove($_POST['npass'], 4)[0] == 1)? $npass = $ot->prove($_POST['npass'], 4)[1]: $err['npass'] = $ot->prove($_POST['npass'], 4)[1];
($ot->prove($_POST['npass1'], 4)[0] == 1)?$npass1 = $ot->prove($_POST['npass1'], 4)[1]: $err['npass1'] = $ot->prove($_POST['npass1'], 4)[1];



if((count($err) == 0) && ($npass == $npass1) && isset($_POST['mainID']) && is_numeric($_POST['mainID']))
{
    $p = $op->selectOne($db, NULL, array('id' => $_POST['mainID'])); 
    if($p->password != md5($opass)) 
    {
        $i = $op->update($db, array('password' => md5($npass)), array('id'=>$_POST['mainID']) );
        if($i == 1)
        {
             $em->sendEmailPasswordChange($_POST['mainID'], $_POST['npass']);
            header('location:../pstatus.php?e=2&g='.serialize($err).'');
        }else{
           header('location:../cpassword.php?e=2&g='.serialize($err).'');  
        }
    }
}
else
{
    header('location:../cpassword.php?e=2&g='.serialize($err).'');
}

?>