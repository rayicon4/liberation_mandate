<?php

session_start();

//kill session
session_destroy();
echo "You have been logged out <a href = 'index.php'>Click here</a> to return to Hompage";


header ("Location: ../login/index.html");

?>

