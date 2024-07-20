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
    <meta http-erquiv="X-UA-Compatible" context="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Home</title>

</head>
<header class = "header" id = "header">
    <div class = "logo">
        <h1>Theatre Society</h1>
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
	<marquee onmouseover="stop()" onmouseout="start()" scrollamount=8 behavior="alternate" direction="left">
    <img src = "Pic/pic1.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic2.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic3.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic4.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic5.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic6.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic7.jpg" alt="" width="500" height="350">
    <img src = "Pic/pic8.jpg" alt="" width="500" height="350">
    </marquee>

    <div class = "title">
        <h2>Our Performances Events</h2>
    </div>



    <div class = "row">
    <?php
    //show event details from database
        include("database.php");

        $sql = "SELECT * FROM crud";  
        $result = mysqli_query($conn, $sql);

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $row) {
            ?>
            <div class = "img">
            <a href = "event.php?id=<?php echo $row['id']; ?>"> 
            <img src = "admin/<?php echo htmlspecialchars($row['imagePath']); ?>" alt =""></a>

            <div class="name">
                <ul>
                    <li><?php echo htmlspecialchars($row["eventName"]); ?></li>
                </ul>
            </div>
        </div>
           <?php 


        }
?>

    




        
    <div class = "comingsoon">
        <h3> COMINGSOON THEATRE EVENTS</h3>
    </div>

    <section class = "image">
        <div class = "slider-wrapper">
            <div class = "slider">
                <img id = "slide-1" src = "Pic/comingsoon1.gif" alt = "The Phantom of the Opera"/>
                <img id = "slide-2" src = "Pic/comingsoon2.jpg" alt = "Two strangers"/>
                <img id = "slide-3" src = "Pic/comingsoon3.jpg" alt = "The Inheritance"/>
                <img id = "slide-4" src = "Pic/comingsoon4.jpg" alt = "Matilda"/>
                <img id = "slide-5" src = "Pic/comingsoon5.jpg" alt = "Come From Away" />
            </div>
            <div class = "slider-nav">
                <a href = "#slide-1"></a>
                <a href = "#slide-2"></a>
                <a href = "#slide-3"></a>
                <a href = "#slide-4"></a>
                <a href = "#slide-5"></a>
            </div>

        </div>

    </section>
   
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