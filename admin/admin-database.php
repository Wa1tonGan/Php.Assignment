<?php
 $hostName ="localhost"; 
 $dbUser = "root";
 $dbPassword = "";
 $dbName = "admin-crud";
 $conn = mysqli_connect($hostName ,$dbUser , $dbPassword , $dbName);
 if (!$conn)
 {
      die("Database cannot connect;");
 }


?>