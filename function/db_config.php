<?php    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_bookview";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    date_default_timezone_set("Asia/Bangkok"); 
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>