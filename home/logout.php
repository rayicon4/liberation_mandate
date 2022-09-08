<?php
ob_start();
session_start();
session_destroy();
ob_start();
header ("Location: index.php");
echo "You have been logged out <a href = 'index.php'>Click here</a> to return to Hompage";




?>

