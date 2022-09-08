<?php
session_start();
if(isset($_SESSION['a']) && is_array($_SESSION['a']))
{
  $my_id = $_SESSION['a']['id'];
  $my_name = $_SESSION['a']['fullname'];
  $my_rank = $_SESSION['a']['rank'];
  $my_level = $_SESSION['a']['level'];
  $my_username = $_SESSION['a']['username'];
}
else
{
  header('location:index.html');
}

?>