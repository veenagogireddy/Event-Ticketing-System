<?php

require_once ("Sql.php");

if (isset($_GET['eventid']))
{

$purchasedEventList = purchasedEvents1((int)$_GET['eventid']);  
$result = $purchasedEventList[0];
 
if ($result == 0)
{
     deleteEvent((int)$_GET['eventid']);
      $message = "You have successfully deleted your event.<br /><br /> ";
}
 else 
    {
     
     $message = "Cannot delete event since you have users already purchased this event.<br /><br />";
     
    }   
}

header('Refresh: 2; URL=HostHomePage.php');
echo "<h2>$message You will now be redirected to your home page.<h2>";
exit;

?>
