<?php

session_start();
require_once ("sitecommon2.php");
require_once ("Sql.php");

// declare and initialize Add/Edit flag variable

$editmode = false;

// if a numeric eventid was passed through the URL

if ((isset($_GET['eventid'])) && (is_numeric($_GET['eventid'])))
{
    // get the details for the event to be edited
    
    $eventDetails = getEventDetailsByID((int)$_GET['eventid']);
    
    // if event details are returned for the eventid, set $editmode to true
    
    $editmode = (count($eventDetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{
   extract($eventDetails[0]);

    $formtitle = 'Update Event';
 }


// call the displayPageHeader method in siteCommon2.php

displayPageHeader($formtitle);
?>

<script src="hoe5jsLibrary.js" type="text/javascript"></script>

<form name ="addEditForm" id="addEditForm" action="HostEdit1a.php" method="post" onsubmit="return checkForm(this)">

<?php
    if ($editmode)  //put the eventid in a hidden field
    {
        echo '<input type="hidden" name="eventid" value="' . $event_id . '" />';
        
    }
    
    
?>
    
    <label for="eventname">Event Name</label>
    <input name="eveName" id="name" type="text" value="<?php echo $Event_Name; ?>"  /> <br/> <br/>
              <label for="eventdescription">Event Description</label>
              <textarea name="eveDescription" id="eveDescription" wrap="soft"  onfocus="this.select()"><?php echo $Event_Description;?></textarea><br/> <br/>
             
              <label for="eventvenue">Event Venue</label>
              <input name="eveVenue" id="name" type="text" value="<?php echo $Event_Venue; ?>"  /> <br/> <br/>
              <label for="eventstarttime">Event Start Time(24 hours format)</label>
               <input name="eveStartTime" id="name" type="text" placeholder="xx:xx" maxlength="5" value="<?php echo $Event_Start_Time; ?>" required pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]"  /><br/><br/>
              <label for="eventcity">Event City </label>

              <select name="eveCity" id="eveCity">
               <option value="<?php echo $Event_City; ?>" selected=""><?php echo $Event_City; ?></option>
               <option value="denver">Denver</option>
               <option value="colosprings">Colorado Springs</option>
               <option value="fortCollins">FortCollins</option>
               <option value="lakewood">Lakewood</option>
               <option value="thorton">Thorton</option>
               <option value="westminster">Westminster</option>
               <option value="pueblo">Pueblo</option>
               <option value="Centennial">Centennial</option>
               <option value="boulder">Boulder</option>
               <option value="highlandsranch">Highlands Ranch</option>
               <option value="greeley">Greeley</option> 
               <option value="longmont">longmont</option>
               <option value="loveland">loveland</option>
               <option value="Broomfield">Broomfield</option>
               <option value="grand Junction">Grand Junction</option>
               <option value="castlerock">Castle Rock</option>
               <option value="commercecity">Commerce City</option>
               <option value="parker">Parker</option> 
              </select>
                  
              </br></br>
              
              <label for="eventdate">Event Date </label>
              <input name="eveDate" id="name" type="date" value="<?php echo $Event_Date; ?>"   /><br/><br/>
              <label for="eventduration">Event Duration(in hours) </label>
              <input name="eveDuration" id="name" type="number" value="<?php echo $Event_Duration; ?>" /><br/><br/>
              <label for="zip">Postal code </label>
              <input name="eveZip" id="name" type="text" value="<?php echo $Event_Zip; ?>"  /><br/><br/>
               <label for="eventtype">Event Type</label>
               <input name="eveType" id="name" type="text" value="<?php echo $Event_Type; ?>"   /><br/><br/>
               <input name="Update" id="Update" type="submit" value="Update" /> &nbsp;
               <a href="HostHomePage.php">Cancel</a>
               <br/><br/>
               
</form>
              
<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>