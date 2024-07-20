<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <title>Admin login</title>
</head>
<body>



<body>
    <div class="container">
        <div class="title-container">
            <h2 class="form-title">Admin Login <i>Thearte</h2>
        </div>

        <form action="admin.php" method="post">

        <?php



    if(isset($_POST["admin-login"]))
    {
        $adminEmail = $_POST["admin-email"];
        $adminPassword = $_POST["admin-password"];

        require_once("admin-database.php");

        $sql = "SELECT* FROM admin WHERE email = '$adminEmail'";
        $result = mysqli_query($conn,$sql);    
        $row = mysqli_fetch_array($result);
        
        if($row)
        {
            if($adminPassword == $row["password"])
            {
                header("location: admin-index.php");
                die();
            }
            else
            {
                echo"<div class='alert alert-danger'>Password wrong</div>";
            }

        }
        else
        {
            echo"<div class='alert alert-danger'>Email not existed</div>";
        }


        
    }

    ?>
            <div class="form-group">
                <input type="email" class="form-control" name="admin-email" placeholder="Email">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="admin-password" placeholder="Password">
            </div>
            
            <div class="form-btn">
                <input type="submit" value="Login" name="admin-login" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>