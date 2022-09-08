<?php
error_reporting (E_ALL ^ E_NOTICE);
require_once("../connect/connect.php"); 

$op = new DB;

$op->getData($_POST['LoginUsername'], $_POST['LoginPassword']);
?>