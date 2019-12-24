<?php

session_start();

require_once ("LoginCheck.php");
require_once ("Sql.php");

$purchasedEventList = purchasedEvents((int)$_GET['userid'], (int)$_GET['eventid']);  

$result = $purchasedEventList[0];

if ($result == 0)
{
      addPurchasedEvents((int)$_GET['userid'], (int)$_GET['eventid']);
     $message = "You have successfully purchased event";
}
else
{    

   $message = "You have already purchased this event";
    
}

header('Refresh: 2; URL=HomePage.php');
echo "<h2>$message. You will now be redirected to your home page.<h2>";

exit;



?>


