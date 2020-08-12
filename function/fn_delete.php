<?php
include "db_config.php";
switch ($_GET["table"]) {
    case "cate":
        
      echo "Your favorite color is red!";

      break;
    case "book":
        if($_GET["status"] == '1') $setStatus = '0';
       else  $setStatus = '1';

        $sqlup = "UPDATE book SET status='$setStatus'  WHERE id_book={$_GET['id']}";
  
        $result1 = mysqli_query($conn, $sqlup) or die ("Error in query: $sqlup " . mysqli_error());
        mysqli_close($conn); 
        // javascript แสดงการ upload file
        if($result1){
        header("Location:/bookview/manage_book.php"); 
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to upload again');";
            echo "</script>";
        }
        echo "Your favorite color is red!";

      break;
    case "review":
      if($_GET["status"] == '1') $setStatus = '0';
      else  $setStatus = '1';
      $sqlup = "UPDATE reviews SET status_review='$setStatus'  WHERE id_review={$_GET['id']}";
  
        $result1 = mysqli_query($conn, $sqlup) or die ("Error in query: $sqlup " . mysqli_error());
        mysqli_close($conn); 
        // javascript แสดงการ upload file
        if($result1){
        header("Location:/bookview/manage_review.php"); 
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to upload again');";
            echo "</script>";
        }

      break;
    // case "blue":
    //   echo "Your favorite color is blue!";
    //   break;
    default:
      echo "Your favorite color is neither red, blue, nor green!";
  }
?>
 
