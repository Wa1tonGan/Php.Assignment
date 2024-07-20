<?php
include("admin-database.php");

if (isset($_GET['user_id']) || isset($_GET['event_id']))  // Check if user_id and event_id are set from admin-member.php
{
    $user_id = $_GET['user_id'];
    $event_id = $_GET['event_id'];

    // Update the event_participants to mark the user as blacklisted for a specific event
    $updateParticipant = "UPDATE event_participants 
                          SET blacklisted = 1 
                          WHERE user_id = $user_id 
                          AND event_id = $event_id";

    $updateParticipantResult = mysqli_query($conn, $updateParticipant);

    if (!$updateParticipantResult) {
        header("Location: admin-member.php?error=Failed to blacklist user for the event.");
        exit;
    }

    // Get the booking details for the user for the specific event
    $getBooking = "SELECT sum(seats_booked) AS seats_booked 
                   FROM event_participants  
                   WHERE user_id = $user_id 
                   AND event_id = $event_id";

    $bookingResult = mysqli_query($conn, $getBooking);
    $booking = mysqli_fetch_array($bookingResult);

    if ($booking) {
        // Update the event to add back the booked seats
        $updateEvent = "UPDATE crud 
                        SET pax = pax + " . $booking['seats_booked'] . " 
                        WHERE id = $event_id";
                        
        $updateEventResult = mysqli_query($conn, $updateEvent);

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
