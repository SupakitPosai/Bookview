<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//เพิ่มไฟล์
include "function/db_config.php";
$id_cate = $_POST['id_cate'];
$name_book = $_POST['name_book'];
$name_author = $_POST['name_author'];
$resume = $_POST['resume'];
$amount = $_POST['amount'];

$upload=$_FILES['img_book'];
if($upload <> '') {   //not select file
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
	
		$sql = "INSERT INTO book (id_cate, name_book, name_author,resume, amount,  image_book , status)
    VALUES ('$id_cate', '$name_book', '$name_author', '$resume', '$amount', '$newname','1')";
		
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
	
    mysqli_close($conn); 
	// javascript แสดงการ upload file
	
	if($result){
    
	echo "<script type='text/javascript'>";
  echo "alert('เพิ่มหมวดหมู่สำเร็จ');";
  echo "</script>";
  header('Location:/bookview/manage_book.php'); 
  
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to upload again');";
	echo "</script>";
  }
  
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
                <h4 class="m-0">หนังสือทั้งหมด</h4>
                <button type="button" class="btn btn-book" data-toggle="modal" data-target="#myModal">
                    เพิ่มหนังสือ
                </button>
               </div>
                 
                  <table class="table w-100 mt-4">
                    <tr>
                      <th>รูป</th>
                      <th>ชื่อหนังสือ</th>
                      <th class="text-center">หมวดหมู่</th>
                      <!-- <th class="text-center">ชื่อผู้แต่ง</th> -->
                      <!-- <th class="text-center">เรื่องย่อ</th> -->
                      <th class="text-center">จำนวน</th>
                      <th class="text-center">สถานะ</th>
                      <th></th>
                    </tr>
                    <?php 
                    include "function/db_config.php";
                    $query = "SELECT *
                    FROM book
                    INNER JOIN catergory
                    ON book.id_cate=catergory.id_cate" or die("Error:" . mysqli_error()); 
                    $result2 = mysqli_query($conn, $query); 
                    while($row = mysqli_fetch_array($result2)) { 
                      echo "<tr>";
                      echo "<td><img src='/bookview/upload/{$row['image_book']}' class='rounded img-cate' alt='Cinque Terre'  /> </td>";
                      echo "<td>{$row['name_book']}</td>";
                      echo "<td class='text-center'>{$row['name_cate']}</td>";
                      // echo "<td class='text-center'>{$row['name_author']}</td>";
                      // echo "<td class='text-center'>{$row['resume']}</td>";
                      echo "<td class='text-center'>{$row['amount']}</td>";
                      echo "<td class='text-center'>";
                      if($row['status'] == "1"){
                        echo '<span class="text-success">แสดง</span>';
                      }else{
                        echo '<span class="text-danger">ซ่อน</span>';
                      }
                      echo "</td>";
                      echo "<td class='text-right'><a class='text-book-y-b mr-3' href='/bookview/edit_book.php?book={$row['id_book']}'>แก้ไข</a>
                      <a class='text-book-y-b' href='#' data-toggle='modal' data-target='#myModal{$row['id_book']}'>";
                      // echo"<a class='text-book-y-b' data-toggle='modal' data-target='#myModal{$row['id_book']}' href='#'>ลบ</a>";
                     if($row['status'] == "0"){
                        echo 'แสดง';
                      }else{
                        echo 'ซ่อน';
                      }
                      echo "</a></td>";
                      
                      echo "</tr>";
                      echo "<div class='modal fade' id='myModal{$row['id_book']}'>
                          <div class='modal-dialog modal-dialog-centered modal-md'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                              <h4 class='modal-title'>ยืนยันการซ่อน/แสดงหนังสือ</h4>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              </div>
                              <div class='modal-body pl-5 pr-5 text-center'>
                              <i class='fas fa-exclamation-circle text-book mb-3' style='font-size:50px;'></i>
                              <h3>ยืนยันการซ่อน/แสดงหนังสือหรือไม่</h3>
                                  
                              </div>
                              <div class='modal-footer justify-content-center'>
                                  <button type='button' class='btn btn-book-outline w-25' data-dismiss='modal'>ยกเลิก</button>
                                  <a class='btn btn-book w-25' href='/bookview/function/fn_delete.php?table=book&id={$row['id_book']}&status={$row['status']}' >ยืนยัน</a>
                              </div>
                              
                          </div>
                          </div>
                      </div>";
                    
                    }
                  
                    mysqli_close($conn); 
                    ?>
                  </table>
               </div>
             </div>
           </div>

        </div>
      </div>
       <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">เพิ่มหนังสือ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
               <form action="/bookview/manage_book.php" method="post" enctype="multipart/form-data">
                <div class="modal-body pl-5 pr-5">
                
                  <label>เลือกหมวดหมู่ <span class="text-danger">*</span></label>
                  <select class="form-control" name="id_cate"  required>
                  <option value=''>เลือกหมวดหมู่</option>
                    <?php 
                    include "function/db_config.php";
                    $queryCate = "SELECT * FROM catergory" or die("Error:" . mysqli_error()); 
                    $resultCate = mysqli_query($conn, $queryCate); 
                    while($row = mysqli_fetch_array($resultCate)) { 
                      echo "<option value='{$row["id_cate"]}'>{$row["name_cate"]}</option>";
                      
                    }
                    mysqli_close($conn); 
                    ?>
                  </select>
                  <label>ชื่อหนังสือ <span class="text-danger">*</span></label>
                  <input type="text" name="name_book" class="form-control" required />
                  <label>ชื่อผู้แต่ง <span class="text-danger">*</span></label>
                  <input type="text" name="name_author" class="form-control" required />
                  <label>เรื่องย่อ <span class="text-danger">*</span></label>
                  <textarea name="resume" class="form-control" rows="4" cols="50" required ></textarea>
                  <label>จำนวน <span class="text-danger">*</span></label>
                  <input type="text" name="amount" class="form-control" required />
                  <label>รูปหนังสือ <span class="text-danger">*</span></label>
                  <input type="file" name="img_book" id="img_book" class="form-control" accept="image/*" required  />
                  <img src="/bookview/images/uploading-file.png" class="rounded img-uploaad" alt="Cinque Terre" id="img-upload"  /> 
                </div>
                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-book-outline w-25" data-dismiss="modal">ยกเลิก</button>
                  <button class="btn btn-book w-25" type="submit">บันทึก</button>
                </div>
              </form>
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