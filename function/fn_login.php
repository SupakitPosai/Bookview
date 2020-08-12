<?php 
include "db_config.php";
if (isset($_GET['id'])) {
  $sql = "SELECT * FROM user WHERE id_google='{$_GET['id']}' ";
  $result = $conn->query($sql);
   mysqli_close($conn);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    session_start();
      $_SESSION['user_id']=$row["id_user"];
      $_SESSION['name']=$row["first_name"].' '.$row["last_name"];
      $_SESSION['profile']=$row["profile"];
      $_SESSION['user_type']=$row["type"];
    header('Location:/bookview'); 
    }
  } else {
      $sqlinsert = "INSERT INTO user (email, first_name, last_name,profile, id_google,  type )
      VALUES ('{$_GET["e"]}', '{$_GET["f_name"]}', '{$_GET["l_name"]}', '{$_GET["img"]}', '{$_GET["id"]}', 'user')";
      
      $result2 = mysqli_query($conn, $sqlinsert) or die ("Error in query: $sqlinsert " . mysqli_error());
    
       
    // javascript แสดงการ upload file
    
    if($result2){
      $sql = "SELECT * FROM user WHERE id_google='{$_GET['id']}' ";
      $result = $conn->query($sql);
      mysqli_close($conn);
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        session_start();
          $_SESSION['user_id']=$row["id_user"];
          $_SESSION['name']=$row["first_name"].' '.$row["last_name"];
          $_SESSION['profile']=$row["profile"];
          $_SESSION['user_type']=$row["type"];
        header('Location:/bookview'); 
        }
      }
      
    }
    else{
    echo "<script type='text/javascript'>";
    echo "alert('Error back to upload again');";
    echo "</script>";
    }
  }
}
?>