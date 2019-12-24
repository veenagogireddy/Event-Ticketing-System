<?php


require_once ("Sql.php");

// if $_POST has a userid element, call the update method

if (isset($_POST['userid']))
{
     updateUser((int)$_POST['userid'], $_POST['firstname'], $_POST['lastname'], $_POST['phone']
            );
     $message = "Your details have been updated";
}

header('Refresh: 2; URL=UserHomePage.php');
echo "<h2>$message. You will now be redirected to your home page.<h2>";

exit;

?>

