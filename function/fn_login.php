<?php 
include "db_config.php";
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo  $row["username"]. "<br>";
  }
} else {
  echo "0 results";
}

?>