<?php

session_start();

require_once ("Sql.php");

// Set local variables to $_POST array elements (userlogin and userpassword) or empty strings

$userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';

$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'HomePage.php';

// if the form was submitted

if (isset($_POST['login']))
{
    //Call getUser method to check credentials

    $userList = getUser($userLogin, $userPassword);
    

    if (count($userList)==1) //If credentials check out
    {
        extract($userList[0]);
        
        // assign user info to an array

        $userInfo = array('userid'=>$userid,'emailid'=>$userLogin, 'firstname'=>$firstname,'usertype'=>$userrolefk);
      
        // assign the array to a session array element

        $_SESSION['userInfo'] = $userInfo;

        session_write_close(); 

        header('location:' . $redirect. "?userid=$userid" );
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

<form action="Login.php" name="loginForm" id="loginForm" method="post">

    <!-- Store the redirect file name in a hidden field  -->

   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <label for="userlogin">User Email &nbsp;</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="40" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters" /><br /><br />
   <label for="userpassword">Password &nbsp;&nbsp;&nbsp;</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Password has invalid characters" />
   <input type="hidden" name="userrole" value="<?php echo $userrolefk; ?>" />
   <br/><br/>
         
   <input type="submit" value="Login" name="login" /><br/><br/>
         New User?  <a href="Register.php">Register Here</a></br></br>
         <a href="AdminLogin.php">Are you an Admin?</a>
         <br/><br/>
</form>
</section>

<?php
    displayPageFooter();

?>
 