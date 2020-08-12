<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//เพิ่มไฟล์
include "function/db_config.php";
$name_cate = $_POST['name_cate'];
$date_booking = $_POST['date_booking'];

$upload=$_FILES['img_cate'];
if($upload <> '') {   //not select file
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
	
		$sql = "INSERT INTO catergory (name_cate, date_borrow, image)
    VALUES ('$name_cate', '$date_booking', '$newname')";
		
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
	
    mysqli_close($conn); 
	// javascript แสดงการ upload file
	
	if($result){
    
	echo "<script type='text/javascript'>";
  echo "alert('เพิ่มหมวดหมู่สำเร็จ');";
  echo "</script>";
  header('Location:/bookview/manage_catergory.php'); 
  
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
                <h4 class="m-0">หมวดหมู่ทั้งหมด</h4>
                <button type="button" class="btn btn-book" data-toggle="modal" data-target="#myModal">
                    เพิ่มหมวดหมู่
                </button>
               </div>
                 
                  <table class="table w-100 mt-4">
                    <tr>
                      <th>รูป</th>
                      <th>ชื่อหมวดหมู่</th>
                      <th class="text-center">จำนวนวันที่สามารถยืมได้</th>
                      <th></th>
                    </tr>
                    <?php 
                    include "function/db_config.php";
                    $query = "SELECT * FROM catergory" or die("Error:" . mysqli_error()); 
                    $result2 = mysqli_query($conn, $query); 
                    while($row = mysqli_fetch_array($result2)) { 
                      echo "<tr>";
                      echo "<td><img src='/bookview/upload/{$row['image']}' class='rounded img-cate' alt='Cinque Terre'  /> </td>";
                      echo "<td>{$row['name_cate']}</td>";
                      echo "<td class='text-center'>{$row['date_borrow']}</td>";
                      echo "<td class='text-right'><a class='text-book-y-b mr-3' href='/bookview/edit_catergory.php?cate={$row['id_cate']}'>แก้ไข</a></td>";
                      // echo"<a class='text-book-y-b' data-toggle='modal' data-target='#myModal{$row['id_cate']}' href='#'>ลบ</a>";
                      echo "</tr>";
                      // echo "<div class='modal fade' id='myModal{$row['id_cate']}'>
                      //     <div class='modal-dialog modal-dialog-centered modal-md'>
                      //     <div class='modal-content'>
                      //         <div class='modal-header'>
                      //         <h4 class='modal-title'>ยืนยันการลบข้อมูล</h4>
                      //         <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      //         </div>
                      //         <div class='modal-body pl-5 pr-5 text-center'>
                      //         <i class='fas fa-exclamation-circle text-book mb-3' style='font-size:50px;'></i>
                      //         <h3>ยืนยันการลบหมวดหมู่หรือไม่</h3>
                                  
                      //         </div>
                      //         <div class='modal-footer justify-content-center'>
                      //             <button type='button' class='btn btn-book-outline w-25' data-dismiss='modal'>ยกเลิก</button>
                      //             <a class='btn btn-book w-25' href='/bookview/function/fn_delete.php?table=cate&id={$row['id_cate']}' >ยืนยัน</a>
                      //         </div>
                              
                      //     </div>
                      //     </div>
                      // </div>";
                    }
                    mysqli_close($conn); 
                    ?>
                    <!-- <tr>
                      <td><img src="/bookview/images/uploading-file.png" class="rounded img-cate" alt="Cinque Terre"  /> </td>
                      <td>ทั่วไป</td>
                      <td class="text-center">5</td>
                      <td class="text-right"><a class="text-book-y-b mr-3" href="/bookview/edit_catergory.php?cate=">แก้ไข</a><a class="text-book-y-b" href="/bookview/function/fn_delete.php?table=&id=">ลบ</a></td>
                    </tr> -->
                  
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
                <h4 class="modal-title">เพิ่มหมวดหมู่</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
               <form action="/bookview/manage_catergory.php" method="post" enctype="multipart/form-data">
                <div class="modal-body pl-5 pr-5">
                
                  <label>ชื่อหมวดหมู่ <span class="text-danger">*</span></label>
                  <input type="text" name="name_cate" class="form-control" required />
                  <label>จำนวนวันที่สามารถยืมได้ <span class="text-danger">*</span></label>
                  <input type="text" name="date_booking" class="form-control" required />
                  <label>รูปหมวดหมู่ <span class="text-danger">*</span></label>
                  <input type="file" name="img_cate" id="img_cate" class="form-control" accept="image/*" required  />
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