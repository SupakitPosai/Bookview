<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview | จัดการรีวิว</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
      <?php include 'component/slide_nav.php' ?>
      <div class="layout">
        <div class="container pl-5 pr-5 pb-3">
           <div class="row pb-4">
             <div class="col-12">
               <h3>จัดการข้อมูลรีวิว</h3>
             </div>
           </div>
           <div class="row">
             <div class="col-12">
               <div class="box-manage">
               <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-0">หนังสือที่ถูกรีวิว</h4>
            
               </div>
                 
                  <table class="table w-100 mt-4">
                    <tr>
                        <th>รูป</th>
                        <th>ชื่อหนังสือ</th>
                        <th>ชื่อผู้รีวิว</th>
                        <th>เวลา</th>
                        <th>สถานะ</th>
                        <th></th>
                    </tr>
                    <?php 
      
          include "function/db_config.php";
                   
                    $sql = "SELECT *
                    FROM reviews
                    INNER JOIN user
                    ON reviews.id_user=user.id_user
                    INNER JOIN book
                    ON reviews.id_book=book.id_book 
                  ";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                       
                     echo "<tr>
                     <td><img src='/bookview/upload/{$row["image_book"]}' class='rounded img-cate' alt='Cinque Terre'  /> </td>
                     <td>{$row["name_book"]}</td>
                     <td >{$row["first_name"]} {$row["last_name"]}</td>
                     <td >{$row["date_review"]}</td>
                     <td >";
                     if($row['status_review'] == "1"){
                        echo '<span class="text-success">แสดง</span>';
                      }else{
                        echo '<span class="text-danger">ซ่อน</span>';
                      }
                    echo "</td>
                     <td class='text-right'><a class='text-book-y-b mr-3' href='#'  data-toggle='modal' data-target='#myModal{$row['id_review']}'>ดูรีวิว</a><a class='text-book-y-b' href='#' data-toggle='modal' data-target='#myModalHor{$row['id_review']}'>";
                     if($row['status_review'] == "0"){
                        echo 'แสดง';
                      }else{
                        echo 'ซ่อน';
                      }
                     echo "</a></td>
                   </tr>";
                   echo "<div class='modal fade' id='myModal{$row['id_review']}'>
                          <div class='modal-dialog modal-dialog-centered modal-md'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                              <h4 class='modal-title'>รีวิว</h4>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              </div>
                              <div class='modal-body pl-5 pr-5 text-center'>
                              <p>{$row["review"]}</p>
                              </div>
                          </div>
                          </div>
                      </div>";
                   echo "<div class='modal fade' id='myModalHor{$row['id_review']}'>
                          <div class='modal-dialog modal-dialog-centered modal-md'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                              <h4 class='modal-title'>ยืนยันการซ่อน/แสดงรีวิว</h4>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              </div>
                              <div class='modal-body pl-5 pr-5 text-center'>
                              <i class='fas fa-exclamation-circle text-book mb-3' style='font-size:50px;'></i>
                              <h3>ยืนยันการซ่อน/แสดงรีวิวหรือไม่</h3>
                                  
                              </div>
                              <div class='modal-footer justify-content-center'>
                                  <button type='button' class='btn btn-book-outline w-25' data-dismiss='modal'>ยกเลิก</button>
                                  <a class='btn btn-book w-25' href='/bookview/function/fn_delete.php?table=review&id={$row['id_review']}&status={$row['status_review']}' >ยืนยัน</a>
                              </div>
                              
                          </div>
                          </div>
                      </div>";
                    }
                    } else {
                    echo "0 results";
                    }

                    mysqli_close($conn);
        ?>
                    
                  
                  </table>
               </div>
             </div>
           </div>

        </div>
      </div>
       

  </body>
</html>