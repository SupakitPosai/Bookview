<?php
 $id_book = $_GET["book"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//เพิ่มไฟล์
include "function/db_config.php";
$name_book = $_POST['name_book'];
$name_author = $_POST['name_author'];
$resume = $_POST['resume'];
$amount = $_POST['amount'];
$status = $_POST['status'];

$upload=$_FILES['img_book'];
if($_FILES['img_book']['name']) {   //not select file
    //โฟลเดอร์ที่จะ upload file เข้าไป 
    $path="upload/";  
    //เอาชื่อไฟล์ที่มีอักขระแปลกๆออก
	$remove_these = array(' ','`','"','\'','\\','/','_');
	$newname = str_replace($remove_these, '', $_FILES['img_book']['name']);
	//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
	$newname = time().'-'.$newname;
  $path_copy=$path.$newname;
  //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
  move_uploaded_file($_FILES['img_book']['tmp_name'],$path_copy);  	
	// เพิ่มไฟล์เข้าไปในตาราง uploadfile
	
    $sqlup = "UPDATE book SET name_book='$name_book' , status='$status' , name_author='$name_author' , resume='$resume' , amount='$amount' ,image_book='$newname' WHERE id_book=$id_book";
  }else{
    $sqlup = "UPDATE book SET name_book='$name_book' , status='$status' , name_author='$name_author' , resume='$resume' , amount='$amount' WHERE id_book=$id_book";
  }
    $result1 = mysqli_query($conn, $sqlup) or die ("Error in query: $sqlup " . mysqli_error());
    mysqli_close($conn); 
    // javascript แสดงการ upload file
    if($result1){
  
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มหมวดหมู่สำเร็จ');";
    echo "</script>";
    header("Location:/bookview/edit_book.php?book=$id_book"); 
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
    <title>Bookview | จัดการหนังสือ</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
      <?php include 'component/slide_nav.php' ?>
      <div class="layout">
        <div class="container pl-5 pr-5 pb-3">
           <div class="row pb-4">
             <div class="col-12">
               <h3>จัดการหนังสือ</h3>
             </div>
           </div>
           <div class="row">
             <div class="col-12">
               <div class="box-manage">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="m-0">แก้ไขหนังสือ</h4>
                </div>
                <form action="/bookview/edit_book.php?book=<?php echo $id_book ?>" method="post" enctype="multipart/form-data">
                <?php 
                    include "function/db_config.php";
                   
                    $sql = "SELECT *
                    FROM book
                    INNER JOIN catergory
                    ON book.id_cate=catergory.id_cate
                    WHERE id_book='$id_book'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<label>หมวดหมู่</label>";
                        echo "<input type='text' name='name_cate' class='form-control' value='{$row["name_cate"]}' disabled  />";
                        echo "<label>ชื่อหนังสือ</label>";
                        echo "<input type='text' name='name_book' class='form-control' value='{$row["name_book"]}'  />";
                        echo "<label>ชื่อผู้แต่ง</label>";
                        echo "<input type='text' name='name_author' class='form-control'  value='{$row["name_author"]}' />";
                        echo "<label>เรื่องย่อ</label>";
                        echo "<textarea name='resume' class='form-control' rows='4' cols='50' >{$row["resume"]}</textarea>";
                        echo "<label>จำนวน</label>";
                        echo "<input type='text' name='amount' class='form-control' value='{$row["amount"]}' />";
                        echo "<label>สถานะ</label>";
                        echo "<select class='form-control' name='status' >";
                            if($row["status"]=='1'){
                                echo "<option value='1' selected>แสดง</option>";
                                echo "<option value='0'>ซ่อน</option>
                                    </select>";
                            }else{
                                echo "<option value='1' >แสดง</option>";
                                echo "<option value='0' selected>ซ่อน</option>
                                    </select>";
                            }
                        
                        echo "<label>รูปหนังสือ</label>";
                        echo "<input type='file' name='img_book' id='img_book' class='form-control' accept='image/*'   />";
                        echo "<img src='/bookview/upload/{$row["image_book"]}' class='rounded img-uploaad' alt='Cinque Terre' id='img-upload'  />";
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
            document.getElementById("img_book").onchange = function(event) { 
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