<?php
session_start();
require_once ("sitecommon2.php");
require_once ("Sql.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("Approve or Deny Events");

$eventList = getEventList();  //gets the list of events

if(count($eventList) == 0 )
{
    echo "No events to approve <br /><br />";
}
 else 
 {
    echo "Click on the event name to view the event details<br /><br />";
 }

$output = <<<HTML
<section> <table id="Events List">

HTML;

// display each event with links to approve or deny it

foreach ($eventList as $events)
{
    extract($events);
    $output .= <<<HTML
    <tr>
        <td>
            <a href="AdminEventView.php?eventid=$event_id">$event_name</a>
            
        </td>
         
        <td>
  <button type="submit" name="approve" value="A" onclick="window.location.href='ApproveEvent.php?eventid=$event_id'">Approve</button>   

        </td>
        <td>
            <button type="submit" name="deny"value="U"onclick="window.location.href='DenyEvent.php?eventid=$event_id'">Deny</button>  
            

        </td>
    </tr>
HTML;
}

$output .= '</table></section> <br/>';

echo $output;

// call the displayPageFooter method in siteCommon2.php

displayPageFooter();

?>
