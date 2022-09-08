<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
require_once('../../connect/utility.php');
require_once('../../connect/sendmail.php');

$op = new DB;
$ot = new Utilities;
$em = new SendEmail;

$f = array();
$err = array();

($ot->prove($_POST['id'], 2)[0] == 1)? $f1 = $ot->prove($_POST['id'], 2)[1]: $err['id'] = $ot->prove($_POST['id'], 2)[1];
($ot->prove($_POST['rid'], 2)[0] == 1)? $f['raffleID'] = $ot->prove($_POST['rid'], 2)[1]: $err['rid'] = $ot->prove($_POST['rid'], 2)[1];
($ot->prove($_POST['user'], 2)[0] == 1)? $f['clientID'] = $ot->prove($_POST['user'], 2)[1]: $err['user'] = $ot->prove($_POST['user'], 2)[1];
($ot->prove($_POST['centerID'], 2)[0] == 1)?$f['centerID'] = $ot->prove($_POST['centerID'], 2)[1]: $err['centerID'] = $ot->prove($_POST['centerID'], 2)[1];
($ot->prove($_POST['giftID'], 2)[0] == 1)?$f['giftID'] = $ot->prove($_POST['giftID'], 2)[1]: $err['giftID'] = $ot->prove($_POST['giftID'], 2)[1];

if(count($err) == 0 ){
    $db1 = 'raffle_log'.$f1;
    $p = $op->selectOne($db1, NULL, array('raffleID' => $f['raffleID'], 'clientID' =>$f['clientID']));
    if($p->id == 0)
    {
        $i = $op->insert($db1, $f);
        if($i > 1)
        {
           $em->sendSmsLog($f['clientID'], $i, $f1);
           $op->update($db1, array('logSms'=>1), array('id'=> $i));
           header('location:../../profile/index.php?q='.$f1.'&r='.$f['raffleID']);
        }
        else
        {
           header('location:../raffle.php');
        }
    }
    else
    {
        header('location:../raffle.php');
    }
}
else
{
    header('location:../raffle.php');
}

?>