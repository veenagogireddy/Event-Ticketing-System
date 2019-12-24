<?php

session_start();
require_once ("sitecommon2.php");
require_once ("Sql.php");

// declare and initialize Add/Edit flag variable

$editmode = false;

// if a numeric eventid was passed through the URL

if ((isset($_GET['eventid'])) && (is_numeric($_GET['eventid'])))
{
    // get the details for the actor to be edited
    
    $eventDetails = getEventDetailsByID((int)$_GET['eventid']);
    
    // if event details are returned for the eventid, set $editmode to true
    
    $editmode = (count($eventDetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{
   extract($eventDetails[0]);

    $formtitle = 'View Event';
 }


// call the displayPageHeader method in siteCommon2.php

displayPageHeader($formtitle);
?>

<script src="hoe5jsLibrary.js" type="text/javascript"></script>

<form name ="addEditForm" id="addEditForm" action="AdminHomePage.php" method="post" onsubmit="return checkForm(this)">

<?php
    if ($editmode)  //put the userid in a hidden field
    {
        echo '<input type="hidden" name="userid" value="' . $userid . '" />';
        
    }
    
    
?>
    
    <label for="eventname">Event Name</label>
    <input name="eveName" id="name" type="text" value="<?php echo $Event_Name; ?>" disabled /> <br/><br/>
              <label for="eventdescription">Event Description</label>
              <textarea name="eveDescription" id="eveDescription" wrap="soft" disabled onfocus="this.select()"><?php echo $Event_Description;?></textarea><br/>
              <br/>
              <label for="eventvenue">Event Venue</label>
              <input name="eveVenue" id="name" type="text" value="<?php echo $Event_Venue; ?>" disabled /> <br/><br/>
              <label for="eventcity">Event City </label>
              <input name="eveCity" id="name" type="text" value="<?php echo $Event_City; ?>" disabled  /><br/><br/>
              <label for="eventstarttime">Event Start Time(24 hours format)</label>
              <input name="eveStartTime" id="name" type="text" value="<?php echo $Event_Start_Time; ?>" disabled /><br/><br/>
              <label for="eventdate">Event Date </label>
              <input name="eveDate" id="name" type="date" value="<?php echo $Event_Date; ?>" disabled  /><br/><br/>
              <label for="eventduration">Event Duration(in hours) </label>
              <input name="eveDuration" id="name" type="number" value="<?php echo $Event_Duration; ?>" disabled/><br/><br/>
              <label for="zip">Postal code </label>
              <input name="eveZip" id="name" type="text" value="<?php echo $Event_Zip; ?>" disabled /><br/><br/>
               <label for="eventtype">Event Type</label>
               <input name="eveType" id="name" type="text" value="<?php echo $Event_Type; ?>" disabled  /><br/><br/>
              <input name="Return" id="Return" type="submit" value="Return" />
              <br/><br/>
</form>
              


<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();