<?php
 $id_user = $_GET["edit"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//เพิ่มไฟล์
include "db_config.php";
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];

// print_r( $_FILES['profile']);
$upload=$_FILES['profile'];

if($_FILES['profile']['name']) {   //not select file
    //โฟลเดอร์ที่จะ upload file เข้าไป 
    $path="../upload/";  
    //เอาชื่อไฟล์ที่มีอักขระแปลกๆออก
	$remove_these = array(' ','`','"','\'','\\','/','_');
	$newname = str_replace($remove_these, '', $_FILES['profile']['name']);
	//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
	$newname = time().'-'.$newname;
  $path_copy=$path.$newname;
  //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
  move_uploaded_file($_FILES['profile']['tmp_name'],$path_copy);  	
	// เพิ่มไฟล์เข้าไปในตาราง uploadfile
	
    $sqlup = "UPDATE user SET first_name='$first_name' , last_name='$last_name' , phone='$phone'  ,profile='http://localhost/bookview/upload/{$newname}' WHERE id_user=$id_user";
  }else{
    $sqlup = "UPDATE user SET first_name='$first_name' , last_name='$last_name' , phone='$phone'  WHERE id_user=$id_user";
  }
    $result1 = mysqli_query($conn, $sqlup) or die ("Error in query: $sqlup " . mysqli_error());
    mysqli_close($conn); 
    // javascript แสดงการ upload file
    if($result1){
      session_start();
      $_SESSION['name'] = $first_name.' '.$last_name;
      if($_FILES['profile']['name']) { 
        $_SESSION['profile'] = "http://localhost/bookview/upload/{$newname}";
      }
    header("Location:/bookview/profile.php?success=1"); 
    }
    else{
        echo '';
    }
}

?>