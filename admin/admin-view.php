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
            <h1>Event Details</h1>
            <div>
                <a href="admin-event.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <div class="event-details">
            <?php
            //show event details
            include("admin-database.php");
            $id = $_GET["id"];
            if ($id) {
                $sql = "SELECT * FROM crud WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Image:</h3>
                            <img src="<?php echo $row["imagePath"]; ?>" alt="Event Image" class="event-image">
                        </div>
                        <div class="col-md-6">
                            <h3>Event:</h3>
                            <p><?php echo $row["eventName"]; ?></p>
                            <h3>Date:</h3>
                            <p><?php echo $row["date"]; ?></p>
                            <h3>Time:</h3>
                            <p><?php echo $row["time"]; ?></p>
                            <h3>Location:</h3>
                            <p><?php echo $row["location"]; ?></p>
                            <h3>Description:</h3>
                            <p><?php echo $row["description"]; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<script>
                if(confirm('No event found'))
                {
                    window.location.href = 'admin-event.php'; 
                }
                </script>";
            }
            ?>
        </div>
    </div>
</body>
</html>
