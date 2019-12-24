<!DOCTYPE html>
       
        <?php
        
        session_start();
        require_once ("Sql.php");
        require_once("sitecommon2.php");
       displayPageHeader('Home');

$userid = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userid'] : "";   
        ?>



<script src="hoe5jsLibrary.js" type="text/javascript"></script>

<form name ="SearchByEventDate" id="SearchByEventDate" action="HomePage.php" method="post" onsubmit="return checkForm(this)">

       
        <h2>Search Events By City</h2>
            <select class = "citySelect" name = "eventcity" id = "eventcity">
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
     <h2> Select a Date to View Events </h2>  

     <input type="date" name="eventdate" id="eventdate" maxlength="10" /> 
    
      <br/> <br/>

         <input type="submit" value="Search" name="search" />
      <br/> <br/>
   </form>





<?php

       
    require_once ("Sql.php");
       
   
if(isset($_POST['eventdate']) || isset($_POST['eventcity']))
{
     $eventDate = $_POST['eventdate'];
        $eventCity = $_POST['eventcity'];
        $eventList = getEventByMultipleCriteria($eventDate,$eventCity);
        $matchingRecords = count($eventList); 
        
if ($matchingRecords == 0)
{
   echo "<p>No events found for search criteria(s)</p>";
}
else
{   
// prepare the output using heredoc syntax

$output = <<<ABC
<table>
  <caption>$matchingRecords event(s) found</caption>
   <tbody>
        <colgroup>
                <col class="firstcol" />
            </colgroup>
            <thead>
                <tr>
                    <th>Event&nbsp;Name</th>
                    <th>Event Description</th>
                    <th>Event&nbsp;Venue</th>
                    <th>Event&nbsp;City</th>
                    <th>Event&nbsp;Time</th>
                    <th>Event&nbsp;Date</th>
                    <th>Event Duration</th>
                    <th>Postal&nbsp;code</th>
                    <th>Event&nbsp;Type</th>
ABC;
if( isset($_SESSION['adminInfo']))
 {
 }
 else
 {
     $output.= <<<ABC
             <th>Interested?</th>
ABC;
            
    }
            $output.= <<<ABC
                    
                </tr>
            </thead>
                    
ABC;

   //$eventNum = 0;
   foreach ($eventList as $events)
    {
        extract($events);
        
    $eventid = $events[Event_Id];
     
        $output .= <<<ABC
        <tr>
            <td> $events[Event_Name] </td>
                <td> $events[Event_Description] </td>
            <td> $events[Event_Venue] </td>
                <td> $events[Event_City]</td>
                 <td> $events[Event_Start_Time]</td>
                 <td> $events[Event_Date]</td>
            <td> $events[Event_Duration] </td>
            <td> $events[Event_Zip]</td>
                <td> $events[Event_Type]</td>
               
ABC;
                
 if( isset($_SESSION['adminInfo']))
 {
 }
 else
 {
     $output.= <<<ABC
             <td>
              <a href="PurchaseConfirmation.php?userid=$userid&eventid=$eventid">[Purchase]</a>
                </td>
ABC;
            
    }
    
 }
                
    $output .= "<tbody></table><br/><br/>";
}
   
}
 echo $output;


?>

<?php

displayPageFooter();

   
?>
