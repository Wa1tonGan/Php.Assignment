



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="register.css">
    <title>Registration</title>
</head>
<body>
    <div class="container">
       
    <h2 class="form-title">REGISTRATION THEATRE CLUB</h2>

        <form action="registration.php" method="post">
            
            
            
            
            <?php
        if(isset($_POST["submit"]))
        {
            $fullname =$_POST["fullname"];
            $email =$_POST["email"];
            $password =$_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $errors =  array();

            if(empty($fullname) || empty($email) || empty($password) || empty($passwordRepeat))
            {
                array_push($errors ,"All field are required");
            }
            if(!filter_var($email ,FILTER_VALIDATE_EMAIL))
            {
                array_push($errors ,"Email not valid");
            }
            if(strlen($password) < 6)
            {
                array_push($errors ,"Password must be atleast 6 character");
            }
            if($password !=$passwordRepeat)
            {
                array_push($errors ,"Password are not match");
            }

            require_once("database.php");
            $sql =  "SELECT*  from users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                array_push($errors ,"Email existed");
            }

            if(count($errors) > 0)  
            {
                foreach($errors as $value)
                {
                    echo"<div class = 'alert alert-danger'>".$value."</div>";
                }
            }
            else
            {
                require_once("database.php");
                $sql  = "INSERT INTO users (full_name , email , password) VALUE (?,?,?)";
                $stmt =  mysqli_stmt_init($conn); //something similar with query but more safer , use it when external input (especisalyy when using INSERT SQL)
                $prepareStmt=mysqli_stmt_prepare($stmt, $sql);

                if($prepareStmt)
                {
                    mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$password);   //triple s = $fullname , $email , $password and S = string;
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registered sucessfully </div>";
                    header("Location: login.php");
                }
                else
                {
                    die("Something went wrong");

                }

            }

        }

        ?>
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>

            <div class="form-group">
                <input type="password"  class="form-control" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <input type="password"  class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>

            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit" value="Register">
            </div>


            <div class="form-group">
                <h7>Registered ? <a href="login.php">Login</a></h7>
            </div>







        </form>
    </div>
    
</body>
</html>