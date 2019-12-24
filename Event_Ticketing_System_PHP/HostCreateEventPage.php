<!DOCTYPE html>

       <?php
session_start();
require_once ("Sql.php");
require_once ("LoginCheck.php");

// assign form values to variables

$eventName = (isset($_POST['eveName'])) ? trim($_POST['eveName']) : '';
$eventDescription = (isset($_POST['eveDescription'])) ? trim($_POST['eveDescription']) : '';
$eventVenue = (isset($_POST['eveVenue'])) ? trim($_POST['eveVenue']) : '';
$eventCity = (isset($_POST['eveCity'])) ? trim($_POST['eveCity']) :''; 
$eventDate = (isset($_POST['eveDate'])) ? trim($_POST['eveDate']) : '';
$eventDuration = (isset($_POST['eveDuration'])) ? trim($_POST['eveDuration']) : '';
$eventType = (isset($_POST['eveType'])) ? trim($_POST['eveType']) : '';
$eventZip = (isset($_POST['eveZip'])) ? trim($_POST['eveZip']) : '';
$eveStartTime = (isset($_POST['eveStartTime'])) ? trim($_POST['eveStartTime']) : '';

$userid = $_SESSION['userInfo']['userid'];


// if the form was submitted

if (isset($_POST['CreateEvent']))
{
    // check whether the eventname already exists

    $result = findDuplicateEvent($eventName);

    if (count($result) > 0)
    {
        $error = 'Please choose a different Event Name';
    }
    else
    {
         //insert new event

        addEvent($eventName, $eventVenue,$eventCity, $eventDate, $eventDuration, $eventType,$eventZip,$eventDescription,$userid,$eveStartTime);

        echo '<h2>Thank you for Adding Event.  You will now be redirected to the home page.<h2>';
        header('Refresh: 2; URL=HostHomePage.php');
        die();
    }
}
require_once ("siteCommon2.php");

displayPageHeader('Create Events');

echo "<section>";
// if the user chose a duplicate eventname, display error

if (!empty($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>
       
        <link rel="stylesheet" href="stylecommon.css" type="text/css" />   
        <form id="Event" name="event" action="HostCreateEventPage.php" method="post">
           <div class="container">
          <fieldset id="custInfo">
              <legend>Event Information</legend>

              <label for="eventname">Event Name</label>
              <input name="eveName" id="name" type="text" placeholder="Event Name" maxlength="25" required /> <br/><br/>
              <label for="eventdescription">Event Description</label> 
              <textarea name ="eveDescription" cols="20" rows="5" placeholder="Event Description" maxlength="1000"></textarea><br/><br/>
              <label for="eventvenue">Event Venue</label>
              <input name="eveVenue" id="name" type="text" placeholder="Event Venue" maxlength="25" required /> <br/><br/>
               <label for="eventstarttime">Event Start Time(24 hours format)</label>
               <input name="eveStartTime" id="name" type="text" placeholder="xx:xx" maxlength="5" required pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]"  /><br/><br/>
              <label for="eventcity">Event City </label>

            <select name = "eveCity" id = "eveCity">
                  
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
              
              <label for="eventdate">Event Date</label>
              <input name="eveDate" id="name" type="date" required /><br/><br/>
              <label for="eventduration">Event Duration (in hours) </label>
              <input name="eveDuration" id="name" type="number" min ="1" max="100" required /><br/><br/>
              <label for="zip">Postal code </label>
              <input name="eveZip" id="name" type="text" placeholder="xxxxx" maxlength="5" required pattern="(\d{5}([\-]\d{4})?)"  /><br/><br/>
               <label for="eventtype">Event Type</label>
               <input name="eveType" id="name" type="text" placeholder="Event Type" maxlength="25" required /><br/><br/>
              <input name="CreateEvent" id="createevent" type="submit" value="Create Event" />
              
          </fieldset>
          </form>      
</div>
           
<?php

displayPageFooter();

?>
