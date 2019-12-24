<?php

session_start();
require_once ("sitecommon2.php");
require_once ("Sql.php");
require_once ("LoginCheck.php");
// declare and initialize Add/Edit flag variable

$editmode = false;
$userDetails = getUserDetailsByID($_SESSION['userInfo']['userid']);
    
$editmode = (count($userDetails) == 1);

// if mode is $editmode is true

if ($editmode)
{
   extract($userDetails[0]);
   $formtitle = 'Update Profile';
 }
else  

// call the displayPageHeader method in siteCommon2.php
require_once ("sitecommon2.php");
displayPageHeader($formtitle);
?>

<script src="hoe5jsLibrary.js" type="text/javascript"></script>

<form name ="userEditForm" id="userEditForm" action="UserEdit.php" method="post" onsubmit="return checkForm(this)">

<?php
    if ($editmode)  //put the userid in a hidden field
    {
        echo '<input type="hidden" name="userid" value="' . $userid . '" />';
        
    }
        
?>

    <label for="firstname">First Name</label>   
    <input type="text" name="firstname" id="firstname" maxlength="100" value="<?php echo $firstname; ?>" autofocus required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="User first name has invalid characters" />
    <label for="lastname">Last Name</label>   
    <input type="text" name="lastname" id="lastname" maxlength="100" value="<?php echo $lastname; ?>" autofocus required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="User last name has invalid characters" /><br /><br />
    <label for="phone">Telephone</label>
   <input type="text" name="phone" id ="phone" value="<?php echo $mobilenumber; ?>" maxlength="12" class="ten" required="required" pattern="^(\d{3}-)?\d{3}-\d{4}$" title="Enter a valid phone number" /><br /><br />
      <input type="submit" value="Update" />
    </p> 
</form>

<?php

require_once ("Sql.php");
require_once ("sitecommon2.php");

$eventList = getEventListByID($userid);  //gets the list of events

if (count($eventList) > 0) {

$output = <<<HTML
      
<section><table id="Events List">
HTML;

// display each event with links to update or delete it
$output = <<<ABC
<table>
   
   <tbody>
        <colgroup>
                <col class="firstcol" />
            </colgroup>
            <thead>
                <tr>
                    <th>Event Name</th>                    
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Event Status</th>
                </tr>
            </thead>
ABC;
foreach ($eventList as $events)
{
    extract($events);
    $output .= <<<HTML
    <tr>
            
            <td>
            $events[event_name]
            </td>
        <td>
            <a href="HostEditEvent.php?eventid=$event_id">Update</a>
            
        </td>
         
        <td>
             <a href="HostDeleteEvent.php?eventid=$event_id">Delete</a>
             
           
        </td>
        
        <td>
            $events[event_status]
        </td>    
    </tr>
HTML;
}

$output .= '</table></section><br/>';

echo $output;

}

// call the displayPageFooter method in siteCommon2.php

displayPageFooter();

?>

