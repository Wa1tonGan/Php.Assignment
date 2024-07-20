<?php
//delete event from admin-event.php

include("admin-database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id']; // get the event id

    $checkSql = "SELECT *  
                 FROM event_participants 
                 WHERE event_id = $id";

    $checkResult = mysqli_query($conn, $checkSql);
    
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['event_id'] == true) 
    {
        header("Location: admin-event.php?error=Cannot delete event because there are existing bookings.");
        exit;
    }

    $sql = "DELETE FROM crud WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) 
    {
        header("Location: admin-event.php?success=Event deleted successfully.");
        
    
    } 
    else 
    {
        header("Location: admin-event.php?errors=Error deleting event.");
    }
}


// delete user from admin-member.php
if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];  // user_id

    $checkSql = "SELECT *  
                 FROM event_participants 
                 WHERE event_id = $id";

    $checkResult = mysqli_query($conn, $checkSql);
    
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['event_id'] > 0) 
    {
        header("Location: admin-member.php?error=Cannot delete member because there are existing bookings.");
        exit;
    }

    $sql = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) 
    {
        header("Location: admin-member.php?success=Member deleted successfully.");
        die();   
    } 
    else 
    {
        header("Location: admin-member.php?errors=member deletion failed.");
    }
}
?>