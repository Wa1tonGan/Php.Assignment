<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theater Club Booking Status</title>
    <link rel="stylesheet" href="style.css">

<style>

.status-icon {
    font-size: 48px;
    margin: 20px auto; 
    width: 80px;
    height: 80px; 
    line-height: 80px; 
    background-color: #DAA520; 
    color: #4B0082; 
    border-radius: 50%; 
    text-align: center;
    box-shadow: 0 0 10px rgba(0,0,0,0.5); 
}

body {
    font-family: 'Georgia', serif;
    background-color: black; 
    color:white;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 90%;
    max-width: 700px; 
    background: #1E1A30; 
    border-radius: 10px;
    padding: 30px; 
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.3); 
}

.header, .footer {
    text-align: center;
    margin: 10px 0;
}

.main-content {
    border-top: 2px solid #FFD700; 
    border-bottom: 2px solid #FFD700; 
    padding: 20px 0;
}

.booking-status, .booking-details {
    text-align: center; 
}

.booking-details ul {
    list-style-type: none;
    padding: 0;
}

.booking-details ul li {
    background-color: #342E4B; 
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
    border-left: 4px solid #FFD700; 
} 

h1, h2, h3, p {
    margin: 15px 0;
}

.footer {
    font-style: italic;
    color:white; 
}

button{
    background-color: #FFD700; 
    color:  #4B0082; 
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    margin-top: 20px; 
    display: block; 
    width: 100%; 
    max-width: 200px; 
    margin-left: auto; 
    margin-right: auto;
    transition: background-color 0.3s , color 0.3s ;
}

button:hover {
    background-color: #5D55A6; 
    color: #FFFFFF; 
}


    </style>
</head>














<body>
    <div class="container">
        <header class="header">
            <h1>Theater Club Booking Confirmation</h1>
        </header>
        <div class="main-content">
            <section class="booking-status">
                <h2>Booking Successful!</h2>
                <div class="status-icon">&#10003; </div>
                <p>Your seats have been confirmed. Prepare for an evening of unforgettable theater!</p>
            </section>
            <section class="booking-details">
                <h3>Your Booking Details:</h3>

                <?php
                include("database.php");
            if (isset($_GET['id'])) 
            {

                $event_id = $_GET['id'];
                $sql = "SELECT * FROM crud WHERE id = '$event_id'";
                $result = mysqli_query($conn , $sql);
                $row = mysqli_fetch_array($result , MYSQLI_ASSOC);

                if($row)
                {
                    ?>
                    <ul>
                    <li>Date: <b><?php echo $row['date']; ?></b> </li>
                    <li>Time: <b><?php echo $row['time']; ?>  </b></li>
                    <li>Play Title:<b> <?php echo $row['eventName']; ?></b></li>
                </ul>
                <?php
                }
            }
            else{
                echo 'not event found';
            }
?>



            


            </section>
            <a href ="homepage.php"><button type="button">Back to Homepage</button></a>
        </div>
        <footer class="footer">
            <p>Thank you for supporting our Theater Club. See you at the show!</p>
        </footer>
    </div>
</body>
</html>
