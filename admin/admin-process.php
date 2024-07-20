<?php


include("admin-database.php");

if(isset($_POST["submit"]))
{
    //sanitize the input
    $eventName = mysqli_real_escape_string($conn , $_POST["eventName"]);
    $date = date('Y-m-d', strtotime($_POST["date"]));
    $time = date('H:i:s', strtotime($_POST["time"])); 
    $pax =  $_POST["pax"];
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) 
    {
        //extension
        $ext = strtolower(pathinfo($_FILES["fileToUpload"]['name'], PATHINFO_EXTENSION)); 
        $allowedExts = array("jpg", "jpeg", "png", "gif");

        //check file size and extension
        if (in_array($ext, $allowedExts) && $_FILES["fileToUpload"]['size'] <= 1048576) 
        { 
            $newFilename = uniqid() . '.' . $ext; //create a unique ID 
            $imagePath = "upload/".$newFilename; //save your image 


            if (move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $imagePath)) 
            {
                $filename = mysqli_real_escape_string($conn, $newFilename);
                $filepath = mysqli_real_escape_string($conn, $imagePath);
                
                $sql = "INSERT INTO crud (eventName, date, time, pax, location, description, imagePath) VALUES ('$eventName', '$date', '$time', $pax, '$location', '$description', '$imagePath')";
    

                if(mysqli_query($conn, $sql) == true)
                {
                    echo "<script>
                    if(confirm('Record inserted. Click OK to go back to the homepage.'))
                    {
                        window.location.href = 'admin-event.php'; 
                    }
                    </script>";

                }
                else
                {
                    echo "<script>
                    if(confirm('Something went wrong . Try again?'))
                    {
                        window.location.href = 'admin-add.php'; 
                    }
                     </script>";
            
            
                }
            }
            else
            {
                echo "Failed to upload image.";
                exit;
            }
            
        } 
        else
        {
            echo "Invalid file type or size.";
            exit;
        }
    }


}



if(isset($_POST["edit"]))
{
    //sanitize the input
    $id = mysqli_real_escape_string($conn , $_POST["id"]);
    $eventName = mysqli_real_escape_string($conn , $_POST["eventName"]);
    $date = date('Y-m-d', strtotime($_POST["date"]));
    $time = date('H:i:s', strtotime($_POST["time"])); 
    $pax =  $_POST["pax"];
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);


    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) 
    {
        //extension
        $ext = strtolower(pathinfo($_FILES["fileToUpload"]['name'], PATHINFO_EXTENSION)); 
        $allowedExts = array("jpg", "jpeg", "png", "gif");

        //check file size and extension
        if (in_array($ext, $allowedExts) && $_FILES["fileToUpload"]['size'] <= 1048576) 
        { 
            $newFilename = uniqid() . '.' . $ext; //create a unique ID 
            $imagePath = "upload/".$newFilename; //save your image 

            if (move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $imagePath)) 
            {
                $filename = mysqli_real_escape_string($conn, $newFilename);
                $filepath = mysqli_real_escape_string($conn, $imagePath);
                
                //if want to update image
                $sql = "UPDATE crud SET eventName = '$eventName', Date = '$date', time = '$time', pax = '$pax', location ='$location', description ='$description', imagePath = '$imagePath' WHERE id = '$id';";

                if(mysqli_query($conn, $sql) == true)
                {
                    echo "<script>
                    if(confirm('Record updated. Click OK to go back to the homepage.'))
                    {
                        window.location.href = 'admin-event.php'; 
                    }
                     </script>";

                }
                else
                {
                    echo "<script>
                    if(confirm('Something went wrong . Try again?'))
                    {
                        window.location.href = 'admin-edit.php'; 
                    }
                     </script>";

                }
            }
            else
            {
                echo "Failed to upload image.";
                exit;
            }
            
        } 
        else
        {
            echo "Invalid file type or size.";
            exit;
        }
    }
    else
    {
        //if no image uploaded
        $sql = "UPDATE crud SET eventName = '$eventName', Date = '$date', time = '$time', pax = '$pax', location ='$location', description ='$description' WHERE id = '$id';";

        if(mysqli_query($conn, $sql) == true)
        {
            echo "<script>
            if(confirm('Record updated. Click OK to go back to the homepage.'))
            {
                window.location.href = 'admin-event.php'; 
            }
             </script>";

        }
        else
        {
            echo "<script>
            if(confirm('Something went wrong . Try again?'))
            {
                window.location.href = 'admin-edit.php'; 
            }
             </script>";

        }
    }
}



?>
