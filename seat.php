<?php
ob_start();
session_start();
if (!isset($_SESSION['user_id'])) 
{
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concert Seat Booking - The Grand Stage Theater</title>
    <link rel="stylesheet" href="theater-booking.css">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <style>
body {
    font-family: 'Playfair Display', serif;
    background-color:black;
    color: whitesmoke;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
}

.header1 {
    text-align: center;
    padding: 2rem 0;
}

.title {
    
    font-size: 2.5rem;
}

.subtitle {
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.main-content {
    background-color: rgba(0, 0, 0, 0.7);
    padding: 2rem;
    border-radius: 0.5rem;
    margin-bottom: 2rem;
    width: 90%;
    max-width: 800px;
    
}


.stage-area {
    background-color: #444;
    color: #fff;
    padding: 1rem 1rem;
    margin-bottom: 2rem;
    border-radius: 0.5rem;
    text-align: center; 
    
}

.seating-sections {
    display: flex;
    justify-content: space-evenly;
    margin-bottom: 2rem;
}

.section {
    background: #333;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    transition: transform 0.3s ease; 
}

.section:hover {
    transform: translateY(-5px); 
}

.seats-available {
    font-weight: bold;
}

.form-group {
    margin-bottom: 1rem;
}




input[type="text"], input[type="number"], select {
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.25rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    background-color: #1C1C1C;
    color: whitesmoke; 
}

input[type="text"]:hover, input[type="number"]:hover, select:hover {
    border-color: #F9E79F;
}

input[type="submit"] {
    width: 100%;
    color: #120F2C;
    padding: 0.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-style: bold;
}

input[type="submit"]:hover, input[type="submit"]:focus {
    background-color: #F9E79F; 

}

/*footer*/

footer{
    padding-top: 30px;
    border-style: solid;
    border-radius: 8px;
    border-color: grey;
    box-sizing: border-box;
    text-decoration: none;
    list-style-type: none;
}

.container{
    width: 1640px;
    margin: auto;
    display: flex;
    justify-content: center;

}

.footer-content{
    width: 33.33%;
}

h4{
    font-size: 25px;
    margin-bottom: 10px;
    text-align: center;
    padding-top: 10px;
    font-family: "Rubik Scribble", sans-serif ;
}

.footer-content p{
    width:  300px;
    margin: auto;
    padding: 5px;
    text-align: center;
    
}

.footer-content ul{
    text-align: center;
}

.footer-content img{
    padding-top: 5px;
    width: 300px;
}

.social-icons{
    text-align: center;
    padding: 0;
}

.social-icons li{
    display: flex;
    align-items: center;
    padding: 5px;
    flex-direction: column;
}

.social-icons i{
    color: white;
    font-size: 15px;
}

a{
    text-decoration: none;
}

.social-icons i:hover{
    color: #B76E79;
}

/*Navigation*/

header{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style-type: none;
    color: white;
    font-family: sans-serif;
    justify-content: space-between;
    width: 100%;
}

header {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    height: 100px;
    
}

header .logo {
    font-size: .5rem;
    padding-left: 4em;
}

header h1{
    font-family: "Rubik Scribble", sans-serif ;
    font-size: 20px;
}


header .btns {
    display: flex;
    flex-direction: row;
    align-items: center;
    
}

header .btns .links{
    display: flex;
    flex-direction: row;
    align-items: center;

}

header .btns .links li{
    margin-right: 20px;
    justify-content: space-between;
    cursor: pointer; 
    
}

header .btns .links li a:link{
    text-decoration: none;
}

header .btns .links li a:hover{
    color: #B76E79;
    transition: .3s;
}

    </style>
</head>

<header class = "header" id = "header">
    <div class = "logo">
        <a href="homepage.html"><h1>Theatre Society</h1></a>
        
    </div>
    
        <div class="btns">
            <ul class="links">
                <li><a href ="contactus.html">Contact us</a></li>
                <li><a href ="about us.html">About Us</a></li>
                <li><a href ="faq.html">FAQ</a></li>
                <li><a href ="history.php">Events History</a></li>
                <li><a href ="logout.php"> <i class="bi bi-box-arrow-right"></i></a></li>
            </ul>
        </div>
</header>

<?php
include("database.php");

if (isset($_POST['ticket_quantity'], $_POST['id']) && isset($_SESSION['user_id'])) 
{
    $id = $_POST['id'];  //event id
    $ticket_quantity = $_POST['ticket_quantity']; //past from the form 
    $user_id = $_SESSION['user_id']; //user id

    $sql = "SELECT pax FROM crud WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_array($result);

        if ($row && $row['pax'] >= $ticket_quantity)   //if the seat are enough 
        {
            $new_pax = $row['pax'] - $ticket_quantity; //update the seat
            $update_query = "UPDATE crud SET pax = '$new_pax' WHERE id = '$id'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) 
            {
                $insert_query = "INSERT INTO event_participants (user_id, event_id, seats_booked) VALUES ('$user_id', '$id', '$ticket_quantity')"; //insert the data into composite table 
                $insert_result = mysqli_query($conn, $insert_query);

                if ($insert_result) 
                {
                    header("Location: status.php?id=$id");
                    exit;
                }
                else 
                {
                    echo "Failed to book seats.";
                }
            } 
            else 
            {
                echo "Failed to update seats.";
            }
        } 

        else
        {
            echo "Not enough seats available or event not found.";
        }
    } 

} 
?>

<body>

    <div class="header1">
        <h1 class="title">The Grand Stage Theater</h1>
        <p class="subtitle">Concert Seat Booking</p>
    </div>
    
    <main class="main-content">
        <div class="stage-area">
            <div class="stage-label">Stage</div>
        </div>
        
        <section class="seating-sections">
            <div class="section" id="section-A">
                <h2>Section A</h2>

                <?php
                include("database.php");
                $id = $_GET['id'];
                $sql = "SELECT pax FROM crud WHERE id = '$id'"; 
                $result=mysqli_query($conn ,$sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if($row)
                {
                    ?>
                <p>Seats Available: <span><?php echo htmlspecialchars($row['pax']); ?></span></p>
<?php
                }
                

            
                ?>
            </div>
        </section>
        
        <form action="seat.php" method="post" id="booking-form">

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="form-group">
                <label for="ticket-quantity">Enter the ticket quantity:</label>
                <input type="number" id="ticket-quantity" name="ticket_quantity" min="1" required>
            </div>
            

        <div class="form-group">

            <?php
            include("database.php");
            $id = $_GET['id'];
            $sql = "SELECT * FROM crud WHERE id = '$id'"; 
            $result=mysqli_query($conn ,$sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($row)
            {
                ?>
                
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="form-group">
                <label for="event_date">Event Date:</label>
                <input type="text" id="event_date" name="event_date" value="<?php echo htmlspecialchars($row['date']); ?>" class="form-control"readonly >
            </div>

            <div class="form-group">
                <label for="event_time">Event Time:</label>
                <input type="text" id="event_time" name="event_time" value="<?php echo htmlspecialchars($row['time']); ?>" class="form-control" readonly >
            </div>

            <div class="form-group">
                <label for="event_venue">Event Venue:</label>
                <input type="text" id="event_venue" name="event_venue" value="<?php echo htmlspecialchars($row['location']); ?>" class="form-control" readonly >
            </div>

                <?php
            } 
            else 
            {
                 echo "<p>Event not found.</p>";
            }



                ?>
                
                
                <input type="submit" name="submit" value="Book Ticket" class="book-btn">
        </div>

        </form>
    </main>
    
</body>






<footer>


    <div class = "container">
        <div class="footer-content">
            <h4>Location</h4>
            <p>Six Ceylon, 6, Jalan Bukit Ceylon, Bukit Bintang, Kuala Lumpur, Malaysia<br/><img src = "Pic/exp_address.png" alt = ""></p>
            
        </div>

        <div class="footer-content">
            <h4>Contact Us</h4>
        <p>Phone : +6013698742 & +6019495287</p>
        <p>Open Hours : 10:00 - 22:00 , Tue - Sun </p>

        </div>


        
        <div class="footer-content">
            <h4>Follow Us</h4>
            <ul class="social-icons">
                <li><i class="bi bi-facebook"> Theatre Society</i></li>
                <li><i class="bi bi-twitter-x"> Theatre_society</i></li>
                <li><i class="bi bi-instagram"> Theatre_society</i></li>
            </ul>
        </div>   

    </div>


</footer>



</html>
