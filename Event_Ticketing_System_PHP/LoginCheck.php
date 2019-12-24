<?php

session_start();

if (!isset($_SESSION['userInfo']))
{
    $redirect = 'HomePage.php';
       
    if (isset($_GET['userid']) && is_numeric($_GET['userid']))
    {
        $userid = (int) $_GET['userid'];
        $redirect .= '?userid=' . $userid;
    }
     
    header('location: Login.php?redirect=' . $redirect);
    die();
}

?>

