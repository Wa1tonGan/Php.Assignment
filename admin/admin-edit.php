<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GA sXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit event</title>

    <style>
        body {
            background-color: white; 
            padding: 0; 
            display: flex;
            justify-content: center;
            align-items:     flex-start;
        }
        .container {
            width: 100%;
            max-width: 600px; 
            padding: 20px;
            background-color: #f8f9fa; 
            border: 1px solid #dee2e6; 
            border-radius: 5px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-element {
            margin-bottom: 20px;
        }
        .form-control {
            border: 1px solid #007bff;
        }
        .btn-sucess {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-sucess:hover {
            background-color: lightcyan;
        }
        h2 {
            text-align: center;
            font-size: 30px; 
            margin-bottom: 20px;
            color: #007bff;
            transition: color 0.3s ease, font-size 0.3s ease; 
        }
        h2:hover {
            color: #0056b3; 
            font-size: 36px; 
            transform: scale(1.1); 
        }
        select {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        option {
            color: #007bff;
        }
    </style>








</head>
<body>

    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #64739b; position: fixed;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-theater-masks"></i></div>
                    <div class="sidebar-brand-text mx-3"><span style="font-size: 14px;">theatre society</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                <?php
                    include("admin-database.php");

                    $sql = "SELECT * FROM crud";

                    $result =mysqli_query($conn , $sql);
                    $row = mysqli_fetch_array($result);
                    if($row)
                    {
                    ?>
                        <li class="nav-item"><a class="nav-link active" href="admin-index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a><a class="nav-link" href="admin-event.php"><i class="far fa-calendar-alt"></i><span>Events</span></a><a class="nav-link" href="attendees1.php?event_id=<?php echo $row['id']; ?>"><i class="fas fa-users"></i><span>Attendees</span></a><a class="nav-link" href="admin-member.php"><i class="fas fa-user-friends"></i><span>Members</span></a></li>
                    <?php
                }
                    ?>                    
                    <li class="nav-item"></li>  
                </ul>
                <div class="text-center d-none d-md-inline"></div>
            </div>
        </nav>
    </div>

    <div class="container">

    <h2>Edit Event</h2> 

    <?php
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        include("admin-database.php");
        $sql =  "SELECT* FROM crud WHERE id = $id";
        $result = mysqli_query($conn ,$sql);
        $row = mysqli_fetch_array($result);

        ?>

        <form action="admin-process.php" method="post" enctype="multipart/form-data">
            <div class="form-element">
            <label>Event Name</label>            
                <input type="text" class="form-control" name="eventName" value="<?php echo $row["eventName"]?>" placeholder="Event Name">
            </div>

            <div class="form-element">
            <label>Event date</label>            
                <input type="date" class="form-control" name="date" value="<?php echo $row["date"]?>" placeholder="Date">
            </div>

            <div class="form-element">
            <label>Event Time</label>            
                <input type="time" class="form-control" name="time" placeholder="time"  value="<?php echo $row["time"]?>">
            </div>

            <div class="form-element">
            <label>Pax</label>            
                <input type="number" class="form-control" name="pax" placeholder="PAX"  value="<?php echo $row["pax"]?>">
            </div>

            <div class="form-element">
                <label>Event Venue</label>            
                <select name="location"  class="form-control">
                    <option value="Hall A" <?php if($row['location']=="Hall A"){echo"Selected";} ?>>Hall A</option>
                    <option value="Hall B"<?php if($row['location']=="Hall B"){echo"Selected ";} ?>>Hall B</option>
                    <option value="Hall C"<?php if($row['location']=="Hall C"){echo"Selected ";} ?>>Hall C</option>
                </select>
            </div>

            

            <div class="form-element">
            <label>Event description</label>            
                <input type="text" class="form-control" name="description" value="<?php echo $row['description']?>">
            </div>


            <div class="col-md-6">
                    <div class="form-element">
                        <label>Current Image</label>            
                        <img src="<?php echo $row['imagePath'];?>" alt="Current Image" style="max-width: 100%;">
                    </div>

            <div class="form-element">
                <label>Upload New Image</label>
                <input type="file" class="form-control" name="fileToUpload" accept="image/*">
            </div>

            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
            <div class="form-element">
                <input type="submit" class="btn btn-sucess" name="edit" value="Edit Event">
            </div>
        </form>
        <?php




    }

    ?>







       
    </div>


</body>
</html>