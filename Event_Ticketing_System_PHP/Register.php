<?php

require_once ("Sql.php");
require_once("sitecommon2.php");

// assign form values to variables

$userEmail = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
$firstName = (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$lastName = (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '';
$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$userType = $_POST["usertype"];
        if ($userType == "U"){
            $Uchecked = "checked";
        }
        else if ($userType == "H"){
            $Hchecked = "checked";
        }
// if the form was submitted

if (isset($_POST['register']))
{
    // check whether the useremail already exists

    $result = findDuplicateUser($userEmail);

    if (count($result) > 0)
    {
        $error = 'Please choose a different User Email';
    }
    else
    {
         //insert new record

        addUser( $firstName, $lastName,$phone, $userEmail, $userPassword, $userType);

        //redirect user to login page

        header('Refresh: 2; URL=Login.php');
        echo '<h2>Thank you for Registering.  You will now be redirected to the login page.<h2>';
        die();
    }
}

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("New Member Registration");
echo "<section>";
// if the user chose a duplicate useremail, display error

if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>
<!DOCTYPE html>

<form name ="addUserForm" id="addUserForm" action="Register.php" method="post">  
   <label for="firstname">First Name</label>
   <input type="text" name="firstname" id ="firstname" value="<?php echo $firstName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="First Name has invalid characters" /><br /><br />
   <label for="lastname"> Last Name </label>
   <input type="text" name="lastname" id ="lastname" value="<?php echo $lastName; ?>" maxlength="20" class="twenty" required="required" pattern="^[a-zA-Z-]+$" title="Last Name has invalid characters" /><br /><br />    
   <label for="email">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
   <input type="text" name="email" id ="email" value="<?php echo $eMail; ?>" maxlength="50" class="twenty" required="required" pattern="^[\w-\.]+@[\w]+\.[a-zA-Z]{2,4}$" title="Enter a valid email" placeholder="abc@example.com" /><br /><br />
    <label for="userpassword">Password&nbsp;&nbsp;</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" class="ten" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Valid characters are a-z 0-9 _ . @ -" /><br /><br />
   <label for="phone">Telephone&nbsp;</label>
   <input type="text" name="phone" id ="phone" value="<?php echo $phone; ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number" placeholder="(eg. 970-689-8409)" /><br /><br />
   <strong>User Type</strong>
   <input type="radio" name="usertype" value="U" checked<?php echo $Uchecked;?>/>User
    <input type="radio" name="usertype" value="H" <?php echo $Hchecked;?>/>Event Host</input><br/>

    <br/>
      <input type="submit" value="Register" name="register" /> <br />
    <br/><br/>

</form>
</section>

<?php
// call the displayPageFooter method in siteCommon2.php
displayPageFooter();

?>

