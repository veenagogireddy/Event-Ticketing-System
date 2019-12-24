<?php

session_start();

require_once ("sitecommon2.php");
require_once ("Sql.php");
displayPageHeader('My Purchased Events');

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
<section> 
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
            
         </tr>       
               
      
ABC;
    }
}
    
    $output .= "</tbody></table></section><br/><br/><br/><br/><br/><br/>";   

 echo $output;

displayPageFooter();

?>