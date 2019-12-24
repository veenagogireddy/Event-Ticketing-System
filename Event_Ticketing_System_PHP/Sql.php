<?php

require_once 'dbConnExec.php';

// inserts a new row in the Users table

function addUser($firstName, $lastName, $phoneNumber, $emailID, $password, $userType)
{
    $query = <<<STR

INSERT INTO users( firstname, lastname, mobilenumber, emailid, password,UserRoleFK ) 
VALUES( '$firstName','$lastName','$phoneNumber','$emailID','$password', 
( SELECT UserRolePK FROM UserRole WHERE UserRole.UserType = '$userType' ))            
                     
STR;

    executeQuery($query);
}

function addPurchasedEvents($userid,$eventid)
{
    $query = <<<STR

INSERT INTO purchased_events(userid,event_id) 
VALUES('$userid','$eventid');            
                     
STR;

    executeQuery($query);
}

function purchasedEvents($userid,$eventid)
{
    $query = <<<STR

select event_id from Purchased_Events
where UserId = '$userid' and Event_Id = '$eventid';            
                     
STR;
   
    return executeQuery($query);
    
}

function purchasedEvents1($eventid)
{
    $query = <<<STR

select event_id from purchased_events
where event_id = '$eventid';            
                     
STR;
    

   return  executeQuery($query);
}


function addEvent($eventName, $eventVenue,$eventCity, $eventDate, $eventDuration, $eventType,$eventZip,$eventDescription,$userid,$eveStartTime)
{
    $query = <<<STR

INSERT INTO events(event_name, event_venue, event_duration, event_date, event_type,event_city,event_zip,event_status,Event_Description,Event_Organizer_ID,Event_Start_Time) 
VALUES( '$eventName','$eventVenue',$eventDuration,'$eventDate','$eventType','$eventCity','$eventZip','W','$eventDescription','$userid','$eveStartTime')
                     
STR;

    executeQuery($query);
}

function getEventList()
{
    $query = <<<STR
Select event_id, event_name
From events
where event_status = 'W'
Order by event_name
STR;
    
    return executeQuery($query);
}

function getEventListByID($userid)
{
    $query = <<<STR
Select event_id, event_name,event_status
From events
where event_organizer_id = '$userid';

STR;
 
    return executeQuery($query);
}

// checks whether a user with the provided credentials exists

function getUser($userEmail, $userPassword)
{
    $query = <<<STR
Select userid,firstname,emailid,userrolefk
From users
Where emailid = '$userEmail'
and password = '$userPassword'
STR;

return executeQuery($query);

}
function getAdminUser($adminEmail, $adminPassword)
{
    $query = <<<STR
Select admin_id,password
From admin
Where admin_id = '$adminEmail'
and password = '$adminPassword'
STR;

return executeQuery($query);

}
// checks whether a useremail alreadys exists

function findDuplicateUser($userEmail)
{
    $query = <<<STR
Select emailid
From users
Where emailid = '$userEmail'
STR;

return executeQuery($query);
}

function findDuplicateEvent($eventName)
{
    $query = <<<STR
Select Event_Name
From events
Where Event_Name = '$eventName'
STR;

return executeQuery($query);
}


function getUserDetailsByID($userid)
{
   $query = <<<STR
Select userid,firstname,lastname,mobilenumber,emailid
From users
Where userid = $userid
STR;
    
    return executeQuery($query);
}


function getEventByMultipleCriteria($eventDate,$eventCity)
{
   $query = <<<STR
Select event_organizer_id,Event_Id,Event_Name,Event_Venue,Event_Duration,Event_Date,Event_Status,Event_Type,Event_City,Event_Zip,Event_Description,Event_Start_Time
From events
Where Event_Status='A' 
    and 0=0
STR;
    if ($eventDate != '')
    {
    $query .= <<<STR
 And Event_Date  ='$eventDate'
STR;
    }
    if ($eventCity != '')
    {
    $query .= <<<STR
 And Event_City = '$eventCity'
STR;
    }

    return executeQuery($query);
}


function getEventDetailsByID($eventid)
{
   $query = <<<STR
Select event_id,Event_Name,Event_Venue,Event_Duration,Event_Date,Event_Status,Event_Type,Event_City,Event_Zip,Event_Description,Event_Start_Time
From events
Where event_id = '$eventid'
STR;
    return executeQuery($query);
}

function getEventByID($userid)
{
   $query = <<<STR
Select e.Event_Name,e.Event_Venue,e.Event_Date,e.Event_Start_Time
From events e join
purchased_events p on p.event_id = e.event_id
Where p.userid = '$userid'
STR;

    return executeQuery($query);
}

function getCities()
{
   $query = <<<STR
Select City_name from cities
STR;

    return executeQuery($query);
}

function updateUser($userid, $firstName, $lastName, $phonenumber)
{
    $firstName = str_replace('\'', '\'\'', trim($firstName));
    $lastName = str_replace('\'', '\'\'', trim($lastName));
    $phonenumber = str_replace('\'', '\'\'', trim($phonenumber));
    
    
    $query = <<<STR
Update users
Set firstname = '$firstName', lastname = '$lastName', mobilenumber = '$phonenumber'
Where userid = $userid
STR;

    return executeQuery($query);
}
function updateEvent3($eventid, $eventName, $eventdesc, $eventvenue, $eventcity,$evedate,$eveduration,$evezip,$evetype,$eveStartTime)
{
  
    
    $query = <<<STR
Update events
Set Event_Name = '$eventName', Event_Venue = '$eventvenue', Event_Duration = $eveduration,Event_Date = '$evedate'
,Event_Type='$evetype'
            ,Event_City='$eventcity'
            ,Event_Zip=$evezip
            ,Event_Description='$eventdesc'
            ,Event_Start_Time = '$eveStartTime'
            ,Event_Status='W'
Where event_id = $eventid
STR;

    return executeQuery($query);
}

function updateEvent($eventid)
{
   
    
    $query = <<<STR
Update events
Set event_status = 'A'
Where event_id = $eventid
STR;
    return executeQuery($query);
}

function updateEvent1($eventid)
{
   
    
    $query = <<<STR
Update events
Set event_status = 'U'
Where event_id = $eventid
STR;
    return executeQuery($query);
}

function deleteEvent($eventid)
{
    $query = <<<STR
Delete
From events
Where event_id = $eventid
STR;

    executeQuery($query);
}
?>
