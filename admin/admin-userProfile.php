<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Event Details</title>

    <style>
        .event-details {
            background-color: #f5f5f5;
            padding: 50px;
        }
        .event-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Profile</h1>
            <div>
                <a href="admin-member.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <div class="event-details">
            <?php
            //show user profile
            include("admin-database.php");
            $id = $_GET["user_id"];
            if ($id) 
            {
                $sql = "SELECT * FROM users WHERE id = $id";


                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) 
                {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Full name:</h3>
                            <p><?php echo $row["full_name"]; ?></p>
                            <h3>Email:</h3>
                            <p><?php echo $row["email"]; ?></p>
                            <h3>Password:</h3>
                            <p><?php echo $row["password"]; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } 
            else 
            {
                echo "<script>
                if(confirm('No user found'))
                {
                    window.location.href = 'admin-member.php'; 
                }
                </script>";
                
                
            }

            
            ?>
            
            <a href="admin-editprofile.php?user_id=<?php echo $id?>" class="btn btn-primary"  name="editProfile">Edit</a>

        </div>
    </div>
</body>
</html>
