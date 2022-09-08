<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once('../../connect/connect.php');
require_once('../../connect/utility.php');
require_once('../../connect/sendmail.php');

$os = new DB;
$ot = new Utilities;
$em = new SendEmail;
$db = 'clients'; 
$u = array();
$err = array();
($ot->prove($_POST['surname'], 1)[0] == 1)? $u['surname'] = $ot->prove($_POST['surname'], 1)[1]: $err['surname'] = $ot->prove($_POST['surname'], 1)[1];
($ot->prove($_POST['othername'], 1)[0] == 1)? $u['othername'] = $ot->prove($_POST['othername'], 1)[1]: $err['othername'] = $ot->prove($_POST['othername'], 1)[1];
($ot->prove($_POST['phone'], 3)[0] == 1)? $u['phone'] = $ot->prove($_POST['phone'], 3)[1]: $err['phone'] = $ot->prove($_POST['phone'], 3)[1];
($ot->prove($_POST['email'], 5)[0] == 1)? $u['email'] = $ot->prove($_POST['email'], 5)[1]: $err['email'] = $ot->prove($_POST['email'], 5)[1];

($ot->prove($_POST['lga'], 2)[0] == 1)? $u['lga'] = $ot->prove($_POST['lga'], 2)[1]: $err['lga'] = $ot->prove($_POST['lga'], 2)[1];
($ot->prove($_POST['cat'], 2)[0] == 1)? $u['category'] = $ot->prove($_POST['cat'], 2)[1]: $err['cat'] = $ot->prove($_POST['cat'], 2)[1];
($ot->prove($_POST['pvc'], 2)[0] == 1)? $u['pvcnum'] = $ot->prove($_POST['pvc'], 2)[1]: $u['pvc'] = '';
($ot->prove($_POST['ward'], 1)[0] == 1)? $u['ward'] = $ot->prove($_POST['ward'], 1)[1]: $err['ward'] = $ot->prove($_POST['ward'], 1)[1];

//print_r($err);
if(count($err) == 0)
{
    $p = $os->selectOne($db, NULL, array('phone' => $u['phone']));
    
    if(isset($p) && $p->id > 0)
    {       
        
        $id  = $os->update($db, $u, array('id' => $p->id));
        
        if($id > 0)
        {
            $em->sendEmailNewRegistration($id, $q[0]);
            $em->sendSmsNewRegistration($id, $q[0]);
            header('location:../regeditstatus.php');
        }
    }
    else
    {
        header('location:../registerEdit.php?e=3&g='.serialize($err).'');
    }
}
else
{
    header('location:../registerEdit.php?e=2&g='.serialize($err).'');
}

?>