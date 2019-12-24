<?php

session_start();

$_SESSION = array(); 
session_destroy(); 
session_write_close(); 

header('Refresh: 2; URL=HomePage.php');

echo '<h2>You have been logged out of Colotix.  You will now be redirected to our home page.</h2>';

die();
?>