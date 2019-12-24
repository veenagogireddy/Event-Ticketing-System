<?php


require_once ("Sql.php");

// if $_POST has a eventid element, call the update method

if (isset($_POST['eventid']))
{
    updateEvent3((int)$_POST['eventid'], $_POST['eveName'], $_POST['eveDescription'], $_POST['eveVenue'],
            $_POST['eveCity'], $_POST['eveDate'], (int)$_POST['eveDuration'], (int)$_POST['eveZip'],$_POST['eveType'],$_POST['eveStartTime']);
     $message = "You have successfully updatated your event details";
}

header('Refresh: 2; URL=HostHomePage.php');
echo "<h2>$message. You will now be redirected to your home page.<h2>";
exit;

?>


