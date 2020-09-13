<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $type = 'user'; 
    $sqlinsert = "INSERT INTO user (username,password,first_name, last_name, email,phone,type)
    VALUES ('{$username}','{$password}','{$first_name}', '{$last_name}', '{$email}','{$phone}','{$type}')";
    echo "dasds".$sqlinsert;
    if ($conn->query($sqlinsert) === TRUE) {
        echo "New record created successfully";
        
        header('Location:/bookview/login.php?register=success');
    
    } else {
        echo "Error: " . $sqlinsert . "<br>" . mysqli_error($conn);
    }
}


$conn->close();
?>