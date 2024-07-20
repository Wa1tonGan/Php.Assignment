<?php
include("admin-database.php");

if (isset($_GET['user_id']) || isset($_GET['event_id'])) {
    $user_id = $_GET['user_id'];
    $event_id = $_GET['event_id'];

    //unblacklist the user for a specific event
    $updateParticipant = "UPDATE event_participants 
                          SET blacklisted = 0 
                          WHERE user_id = $user_id 
                          AND event_id = $event_id";

    $updateParticipantResult = mysqli_query($conn, $updateParticipant);

    if (!$updateParticipantResult) {
        header("Location: attendees1.php?error=Failed to unblacklist user for the event.");
        exit;
    }

    // Find booking details of user 
    $getBooking = "SELECT sum(seats_booked) AS seats_booked 
                   FROM event_participants  
                   WHERE user_id = $user_id 
                   AND event_id = $event_id";

    $bookingResult = mysqli_query($conn, $getBooking);
    $booking = mysqli_fetch_array($bookingResult);

    if ($booking) {
        // Update the event to minus back the booked seats
        $updateEvent = "UPDATE crud 
                        SET pax = pax - " . $booking['seats_booked'] . " 
                        WHERE id = $event_id";
                        
        $updateEventResult = mysqli_query($conn, $updateEvent);

        //remember to change the header location
        if ($updateEventResult) 
        {
            header("Location: attendees1.php?event_id=$event_id&success=Unblacklisted successfully and bookings restored.");
        }
        else
        {
            header("Location: attendees1.php?event_id=$event_id&error=Failed to update event seats.");
        }
    } 
    else 
    {
        header("Location: attendees1.php?event_id=$event_id&error=Booking details not found.");
    }
} 
else 
{
    header("Location: attendees1.php?event_id=$event_id&error=Invalid request.");
}
?>
