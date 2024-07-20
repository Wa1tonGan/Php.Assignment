<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-erquiv="X-UA-Compatible" context="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="events1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Tartuffe: The Imposter</title>
    <style>
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



body{
    background-color: black;
}

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Josefin Sans', sans-serif;
    color: white; 
    
}

.about{
    width: 100%;
    padding: 78px 0px;
  
}

.about img{
    height: 440px;
    width: 450px;
}

.about-text{
    width: 550px;

}

.main{
    width: 1130px;
    max-width: 95%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-around;

}

.about-text h2{
    color: white;
    font-size: 50px;
    text-transform: capitalize;
    margin-bottom: 20px;
}

.about-text h6{
    color: white;
    font-size: 25px;
    text-transform: capitalize;
    margin-bottom: 25px;
    letter-spacing: 2px;
}

.about-text p{
    color: #fff;
    letter-spacing: 1px;
    line-height: 30px;
    font-size: 15px;
    margin-bottom: 45px;

}


button{
    background: black;
    color:  white;
    text-decoration: none;
    border: 2px solid transparent;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 30px;   
    transition: .4s;

}

button:hover{
    background-color: #5D55A6; 
    color: #FFFFFF; 
    border: 2px solid #000000;
    cursor: pointer;
  
}

button a:link{
    text-decoration: none;
}


footer{
    padding-top: 30px;
    border-top: solid;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-radius: 8px;
    border-color: grey;
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


@media (max-width: 480px) {
    header .logo, header .btns {
        padding: 0 20px; 
    }

    header .btns .links {
        flex-direction: column; 
    }

    header .btns .links li {
        margin-bottom: 10px; 
    }
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
    <section class = "about">


        <div class = "main">
            <?php

            include("database.php");
            $id = $_GET['id'];  //event_id pass from the homepage 

            $sql = "SELECT * FROM crud WHERE id='$id'";
            $result=mysqli_query($conn ,$sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($row)
            {
                ?>
                <img src="admin/<?php echo ($row['imagePath']); ?>">
                <h2><?php echo htmlspecialchars($row["eventName"]); ?></h2>
                <p>Description: <?php echo($row["description"]); ?></p>
                <?php
            } 
            else 
            {
                echo "<p>Event not found.</p>";
            }
            ?>
            

            

                <button type = "button"><a href = "seat.php?id=<?php echo $row['id']; ?>"> Book now</button>
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