<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 

$op = new DB;

function pnum()
{
  $arr = array('0801', '0803','0805', '0807', '0813' );
  $arr_num = array(0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9);
  $rand_n = rand(0, 4);
  shuffle($arr_num);
  $slice = array_slice($arr_num, 0, 7);
  $slice1 = implode('' , $slice);
  return $arr[$rand_n].$slice1;
}

function ptext()
{
  $arr = array('@yahoo.com', '@gmail.com' );
  $arr_num = array('a','a','a','b','c','d','e','e','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','b','c','d','f','g','h','j','k','l','m','n','o','o','p','q','r','s','t','u','u','v', 'w');
  $rand_n = rand(3, 8);
  shuffle($arr_num);
  $slice = array_slice($arr_num, 0, $rand_n);
  $slice1 = implode('' , $slice);
  return $arr[$rand_n].$slice1;
}
function pemail()
{
  $arr = array('@yahoo.com', '@gmail.com' );
  $rand_n = rand(0, 1);
  return $arr[$rand_n];
}
for($i = 0; $i < 500; ++$i)
{
  $rt['surname'] = ptext();
  $rt['othername'] = ptext();
  $rt['phone'] = pnum();
  $rt['password'] = md5($rt['phone']);
  $rt['active'] = 0;
  $rt['category'] = 0;
  $rt['lga'] = rand(0, 774);
  $rt['email'] =$rt['surname'].'.'.$rt['othername'].pemail();
  
  
  $op->insert('clients', $rt);
 
}
?>

