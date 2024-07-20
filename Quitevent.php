<?php
session_start();

?>

<?php
include("database.php");
if(isset($_SESSION['user_id']) && isset($_GET['event_id']))
{
    $user_id = $_SESSION['user_id'];
    $event_id = $_GET['event_id'];

    // Find booking details of user 
    $getBooking = "SELECT sum(seats_booked) AS seats_booked 
                   FROM event_participants  
                   WHERE user_id = $user_id 
                   AND event_id = $event_id";

    $bookingResult = mysqli_query($conn, $getBooking);
    if ($booking = mysqli_fetch_assoc($bookingResult)) 
    {
        // Update the event to add back the booked seats
        $updateEvent = "UPDATE crud 
                        SET pax = pax + " . $booking['seats_booked'] . "  
                        WHERE id = $event_id";
                        
        if (mysqli_query($conn, $updateEvent)) 
        {

            // Delete the booking cuz user quit and user would not see it 
            $deleteBooking = "DELETE 
                              FROM event_participants 
                              WHERE user_id = $user_id 
                              AND event_id = $event_id";
                            
            if (mysqli_query($conn, $deleteBooking))
            {
                header("Location: history.php?success=Quit successfully and bookings restored.");
            }
            else
            {
                echo "Error deleting booking: " . mysqli_error($conn);
                header("Location: history.php?error=Failed to delete booking.");

            }       
        }
        else
        {
            echo "Error updating event: " . mysqli_error($conn);
            header("Location: history.php?error=Failed to update event seats.");
        }
    } 
    else 
    {
        echo "Booking details not found or query error: " . mysqli_error($conn);
        header("Location: history.php?error=Booking details not found.");
    }
} 
else 
{
    header("Location: history.php?error=Invalid request.");
}
?>