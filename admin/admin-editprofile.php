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

    <div class="container">

    <h2>Edit Profile</h2> 

    <?php
    include("admin-database.php");
    if(isset($_GET['user_id']))
    {
        $id = $_GET['user_id'];

    $sql = "SELECT* FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if($row){
        ?>
        <form action="admin-editprofile.php" method="post">

            <div class="form-element">
            <label>Name</label>            
                <input type="text" class="form-control" name="userName" value="<?php echo $row['full_name']?>" placeholder="User Name">
            </div>

            <div class="form-element">
            <label>Email</label>            
                <input type="text" class="form-control" name="email" value="<?php echo $row["email"]?>" placeholder="Email">
            </div>

            <div class="form-element">
            <label>Password</label>            
                <input type="text" class="form-control" name="password" placeholder="password" value="<?php echo $row["password"]?>">
            </div>


            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-element">
                <input type="submit" class="btn btn-sucess" name="editUser" value="Edit User"> 
            </div>
            
        </form>
        <?php
    }
    }
    else
    {
        echo "something wrong from the last page ";
    }
    ?>
    </div>


    <?php

//edit code
if(isset($_POST["editUser"]))
{
    //sanitize the input
    $id = mysqli_real_escape_string($conn , $_POST["id"]);
    $fullname = mysqli_real_escape_string($conn , $_POST["userName"]);
    $email = mysqli_real_escape_string($conn , $_POST["email"]);
    $password = mysqli_real_escape_string($conn , $_POST["password"]);

    $sql = "UPDATE users SET full_name = '$fullname', email = '$email', password = '$password' WHERE id = '$id'";

    if(mysqli_query($conn, $sql) == true)
    {
        
            echo "<script>
            if(confirm('Record updated. Click OK to go back to the member page.'))
            {
                 window.location.href = 'admin-member.php'; 
            }
            </script>";
        

    }
    else
    {
        echo "<script>
        if(confirm('Something went wrong . Try again?'))
        {
            window.location.href = 'admin-userprofile.php?user_id=$id'; 
        }
         </script>";

    }
}
    

    ?>













</body>
</html>