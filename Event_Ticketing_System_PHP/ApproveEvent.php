<?php


require_once ("Sql.php");

// if $_GET has a eventid element, call the update method

if (isset($_GET['eventid']))
{
    updateEvent((int)$_GET['eventid']);
     $message = "You have successfully approved event";
}

header('Refresh: 2; URL=AdminHomePage.php');
echo "<h2>$message. You will now be redirected to your home page.<h2>";
exit;

?>

