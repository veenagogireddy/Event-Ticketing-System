<?php

session_start();

require_once ("Sql.php");

// Set local variables to $_POST array elements (adminlogin and adminpassword) or empty strings

$adminLogin = (isset($_POST['adminlogin'])) ? trim($_POST['adminlogin']) : '';
$adminPassword = (isset($_POST['adminpassword'])) ? trim($_POST['adminpassword']) : '';

   

$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'AdminHomePage.php';

// if the form was submitted

if (isset($_POST['login']))
{
    //Call getAdminUser method to check credentials

    $userList = getAdminUser($adminLogin, $adminPassword);
    

    if (count($userList)==1) //If credentials check out
    {
        extract($userList[0]);

        // assign admin info to an array

        $adminInfo = array('adminid'=>$admin_id);
      
        // assign the array to a session array element

        $_SESSION['adminInfo'] = $adminInfo;

        session_write_close(); 

        header('location:' . $redirect);
        die();
    }

    else // Otherwise, assign error message to $error
    {
        $error = 'Invalid login credentials<br />Please try again';
    }
}

// display form

require_once ("sitecommon2.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("Login Form");
echo "<section>";
// if error variable was set, display it

if (isset($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>

<form action="AdminLogin.php" name="loginForm" id="loginForm" method="post">

    <!-- Store the redirect file name in a hidden field  -->

   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <label for="userlogin">User Email &nbsp;</label>
   <input type="text" name="adminlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="40" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters" /><br /><br />
   <label for="userpassword">Password &nbsp; &nbsp;</label> 
   <input type="password" name="adminpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Password has invalid characters" />

   <br/><br/>
        <input type="submit" value="Login" name="login" />
   <br/><br/>
</form>
</section>

<?php
    displayPageFooter();
?>
 
