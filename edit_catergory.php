<?php
 $id_cate = $_GET["cate"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//เพิ่มไฟล์
include "function/db_config.php";
$name_cate = $_POST['name_cate'];
$date_booking = $_POST['date_booking'];
$upload=$_FILES['img_cate'];
if($_FILES['img_cate']['name']) {   //not select file
    //โฟลเดอร์ที่จะ upload file เข้าไป 
    $path="upload/";  
    //เอาชื่อไฟล์ที่มีอักขระแปลกๆออก
	$remove_these = array(' ','`','"','\'','\\','/','_');
	$newname = str_replace($remove_these, '', $_FILES['img_cate']['name']);
	//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
	$newname = time().'-'.$newname;
  $path_copy=$path.$newname;
  //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
  move_uploaded_file($_FILES['img_cate']['tmp_name'],$path_copy);  	
	// เพิ่มไฟล์เข้าไปในตาราง uploadfile
	
    $sqlup = "UPDATE catergory SET name_cate='$name_cate' , date_borrow='$date_booking' ,image='$newname' WHERE id_cate=$id_cate";
  }else{
    $sqlup = "UPDATE catergory SET name_cate='$name_cate' , date_borrow='$date_booking'  WHERE id_cate=$id_cate";
  }
    $result1 = mysqli_query($conn, $sqlup) or die ("Error in query: $sqlup " . mysqli_error());
    mysqli_close($conn); 
    // javascript แสดงการ upload file
    if($result1){
  
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มหมวดหมู่สำเร็จ');";
    echo "</script>";
    header("Location:/bookview/edit_catergory.php?cate=$id_cate"); 
    }
    else{
        echo "<script type='text/javascript'>";
        echo "alert('Error back to upload again');";
        echo "</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview | จัดการหมวดหมู่</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
      <?php include 'component/slide_nav.php' ?>
      <div class="layout">
        <div class="container pl-5 pr-5 pb-3">
           <div class="row pb-4">
             <div class="col-12">
               <h3>จัดการหมวดหมู่</h3>
             </div>
           </div>
           <div class="row">
             <div class="col-12">
               <div class="box-manage">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="m-0">แก้ไขหมวดหมู่</h4>
                </div>
                <form action="/bookview/edit_catergory.php?cate=<?php echo $id_cate ?>" method="post" enctype="multipart/form-data">
                <?php 
                    include "function/db_config.php";
                   
                    $sql = "SELECT * FROM catergory WHERE id_cate='$id_cate'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<label>ชื่อหมวดหมู่</label>";
                        echo "<input type='text' name='name_cate' class='form-control' value='{$row["name_cate"]}'  />";
                        echo "<label>จำนวนวันที่สามารถยืมได้</label>";
                        echo "<input type='text' name='date_booking' class='form-control' value='{$row["date_borrow"]}' />";
                        echo "<label>รูปหมวดหมู่</label>";
                        echo "<input type='file' name='img_cate' id='img_cate' class='form-control' accept='image/*'   />";
                        echo "<img src='/bookview/upload/{$row["image"]}' class='rounded img-uploaad' alt='Cinque Terre' id='img-upload'  />";
                    }
                    } else {
                    echo "0 results";
                    }

                    mysqli_close($conn);
                    ?>
                   
                    
                    
                    <div class="d-flex justify-content-center align-items-center w-100 mt-5">
                        
                        <button class="btn btn-book w-25" type="submit">บันทึก</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
          window.addEventListener("load", function() { 
            document.getElementById("img_cate").onchange = function(event) { 
              var reader = new FileReader(); 
              reader.readAsDataURL(event.srcElement.files[0]); 
              var me = this; 
              reader.onload = function () { 
                var fileContent = reader.result; 
              // console.log(fileContent); 
              document.getElementById("img-upload").src = fileContent;
              } 
          }}); 
        </script>
    </body>
</html>