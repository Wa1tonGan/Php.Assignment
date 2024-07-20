<?php
session_start();
if (!isset($_SESSION['user_id'])) 
{
    header("Location: login.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Booking History - The Grand Stage Theater</title>
    <link rel="stylesheet" href="booking-history.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style-type: none;
    color: white;
    font-family: sans-serif;
}


html {
    font-size: 16px;
}

body{
    background-color: black;
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
    list-style: none;
    
}

header .btns .links li a:link{
    text-decoration: none;
}

header .btns .links li a:hover{
    color: #B76E79;
    transition: .3s;
}





.history-container {
    max-width: 800px;
    margin: auto;
    margin-bottom: 360px;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
}

.history-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.history-table thead th {
    background-color: #333;
    color: #fff;
    padding: 10px;
    border: 1px solid #444;
}

.history-table tbody td {
    background-color: #1c1c1c;
    color: #fff;
    padding: 8px;
    border: 1px solid #444;
}


.history-table a {
    color: #E6B800; 
    text-decoration: none; 
    transition: color 0.3s ease;
}

.history-table a:hover {
    color: #F9E79F; 
    text-decoration: underline; 
}

@media screen and (max-width: 600px) {
    .history-table, .history-table thead, .history-table tbody, .history-table th, .history-table td, .history-table tr {
        display: block;
    }
}


footer{
    padding-top: 30px;
    border-style: solid;
    border-radius: 8px;
    border-color: grey;
    border-left: none;
    border-right: none;
    border-bottom: none;
}

.container{
    width: 1140px;
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



    </style>
</head>


<header class = "header" id = "header">
    <div class = "logo">
        <a href="homepage.php"><h1>Theatre Society</h1></a>
    </div>
    
        <div class="btns">
            <ul class="links">
                <li><a href ="contactus.html">Contact Us</a></li>
                <li><a href ="about us.html">About Us</a></li>
                <li><a href ="faq.html">FAQ</a></li>
                <li><a href ="history.php">Events History</a></li>
                <li><a href ="logout.php"> <i class="bi bi-box-arrow-right"></i></a></li>

            </ul>
        </div>
</header>



<body>
    <div class="history-container">
        <h1>Your Booking History</h1>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Ticket booked</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php

                include("database.php");

                if (isset($_SESSION['user_id']))  //if user is logged in
                {
                    $user_id = $_SESSION['user_id'];

                    $sql = "SELECT ep.event_id, SUM(ep.seats_booked) AS total_seats_booked, c.eventName, c.date
                            FROM event_participants ep
                            JOIN crud c 
                            ON ep.event_id = c.id
                            WHERE ep.user_id = '$user_id'  
                            GROUP BY ep.event_id
                            ORDER BY c.date DESC"; //check specific user booking history for specific event
                    
                    $result = mysqli_query($conn, $sql);

                    if($result)
                    {
                        $row = mysqli_fetch_all($result , MYSQLI_ASSOC);
                    }

                    foreach ($result as $row) 
                    {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['eventName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_seats_booked']) . "</td>";
                        echo "<td><a href='#' class='btn btn-danger' onclick='return confirmation(" . $row["event_id"] . ");'>Quit</a></td>"; //same as other confirmaion function
                        echo "</tr>";
                    }

                }
                ?>

                <?php
                //pass from Quitevent.php
                if (isset($_GET['success']))
                {
                    echo "<script>
                    alert('Quit successfully and bookings restored.');
                    window.location.href = 'history.php';
                    </script>";
                }
                if (isset($_GET['error']))
                {
                    echo "<script>
                    alert('Failed to update event seats.');
                    window.location.href = 'history.php';
                    </script>";
                }
                if (isset($_GET['errors']))
                {
                    echo "<script>
                    alert('Booking details not found.');
                    window.location.href = 'history.php';
                    </script>";
                }
?>
            </tbody>
            <script>
                function confirmation(eventId) {
                    if (confirm("Are you sure you want to quit this event?")) 
                    {
                        window.location.href = 'Quitevent.php?event_id=' + eventId;
                    }
                        return false; 
                    }
            </script>
        </table>
    </div>
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
