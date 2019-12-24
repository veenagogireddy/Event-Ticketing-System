<?php

session_start();
require_once ("sitecommon2.php");
require_once ("Sql.php");
displayPageHeader('User Home Page');
// declare and initialize Add/Edit flag variable

$editmode = false;
$userDetails = getUserDetailsByID($_SESSION['userInfo']['userid']);

$editmode = (count($userDetails) == 1);

extract($userDetails[0]);
$formtitle = 'Update Profile';

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


// declare and initialize Add/Edit flag variable

//
//if ((isset($_GET['userid'])) && (is_numeric($_GET['userid'])))
//{
    
//$userDetails = getUserDetailsByID($_SESSION['userInfo']['userid']);
//        $userid = (int)$_GET['userid'];
        $eventList = getEventByID($_SESSION['userInfo']['userid']);
        
        $matchingRecords = count($eventList);   

if ($matchingRecords == 0)
{
   echo "<p>You have not purchased any events</p>";
}
else

{   
    
    echo "<p>Below are your purchased events</p>";
            
            
$output = <<<ABC

   <table>
  
   <tbody>
        <colgroup>
                <col class="firstcol" />
            </colgroup>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Venue</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                </tr>
            </thead>
ABC;

   $eventNum = 0;
   foreach ($eventList as $events)
    {
        extract($events);
        $output .= <<<ABC
                
        <tr>
            <td> $events[Event_Name] </td>    
            <td> $events[Event_Venue] </td>
                 <td> $events[Event_Date]</td>
                  <td> $events[Event_Start_Time]</td>
            
                
               
      
ABC;
    }
}
    
    $output .= "<tbody></table><br/><br/>";
//}
   

 echo $output;



displayPageFooter();

?>