


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>login</title>
</head>
<body>



    <div class="container">
    <h2 class="login-title">Theatre Club Login</h2>



        <form  action="login.php" method="post">

        <?php
    if(isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once("database.php");

        $sql="SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_array($result , MYSQLI_ASSOC);  

        if ($user) {
            if ($user['password'] == $password) {
                session_start();
                $_SESSION["user_id"] = $user['id']; //for the event use.
                $_SESSION["user"] = true; 
                header("Location: homepage.php");
                die();
            } 
            else 
            {
                echo "<div class='alert alert-danger'>Password does not match.</div>";
            }
        } 
        else 
        {
            echo "<div class='alert alert-danger'>Email does not match.</div>";
        }
        



        }
        ?>


       
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Passsword">
            </div>
            
            <div class="form-btn">
                <input type="submit" value="login" name="login" class="btn btn-primary">
            </div>

            <div class="form-group">
                <h7>Not yet registered ? <a href="registration.php">Register</a></h7>
            </div>



        </form>
    </div>

    
</body>
</html>
