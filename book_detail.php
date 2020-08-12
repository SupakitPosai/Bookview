<?php 

$id_book = $_GET["book"];
$date_review =  date("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//เพิ่มไฟล์
include "function/db_config.php";
$review = $_POST['review'];

session_start();
  $sql = "INSERT INTO reviews (id_book, id_user, review,date_review ,status_review)
  VALUES ('$id_book', '{$_SESSION['user_id']}', '$review', '$date_review' , '1')";
    $result1 = mysqli_query($conn, $sql) or die ("Error in query: $sqlup " . mysqli_error());
    mysqli_close($conn); 
    // javascript แสดงการ upload file
    if($result1){
  
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มหมวดหมู่สำเร็จ');";
    echo "</script>";
    header("Location:/bookview/book_detail.php?book=$id_book"); 
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
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
  </head>
  <body>
  <?php include("component/header.php")?>

   
    <div class="container mt-5 pt-5 pb-4">
      <div class="row">
        <?php 
          $id_book = $_GET['book'];
          include "function/db_config.php";
                   
                    $sql = "SELECT *
                    FROM book
                    WHERE id_book='$id_book'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-7'>
                                  <div class='book-detail-img'>
                                      <img src='/bookview/upload/{$row["image_book"]}'/>
                                  </div>
                              </div>
                              <div class='col-5 '>
                                  <div class='book-detail-txt p-4'>
                                      <h4 class='mb-3'>รายละเอียด</h4>
                                      <p>ชื่อหนังสือ : {$row["name_book"]}</p>
                                      <p>ชื่อผู้แต่ง : {$row["name_author"]}</p>
                                      <hr/>
                                      <h4 class='mb-3'>เรื่องย่อ</h4>
                                      <p class='dication'>{$row["resume"]}</p>
                                  </div>
                              </div>";
                    }
                    } else {
                    echo "0 results";
                    }

                    mysqli_close($conn);
        ?>
        
      </div>
      <hr/>
      <div class="row pl-5 pr-5 py-2">
          <div class="col-12 pl-5 pr-5">
            <div class="book-review">
                <div class="book-comment">
                   <h5>เขียนรีวิว</h5> 
                </div>
                <form action="/bookview/book_detail.php?book=<?php echo $id_book ?>" method="post" enctype="multipart/form-data">
                  <textarea placeholder="เขียนสิ่งที่ต้องการรีวิว..." rows="6" name="review" ></textarea>
                  <div class="float-right">
                  <button type="submit" class="btn btn-book text-dark">เขียนรีวิว</button></div>
                </form>
            </div>
          </div>
      </div>
      <?php 
          $id_book = $_GET['book'];
          include "function/db_config.php";
                   
                    $sql = "SELECT *
                    FROM reviews
                    INNER JOIN user
                    ON reviews.id_user=user.id_user
                    WHERE id_book='$id_book' AND status_review='1'
                    ORDER BY date_review DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='row mt-4 pl-5 pr-5'>
                        <div class='col-12 pl-5 pr-5 '>
                            
                            <div class='review-item d-flex'>";
                            if(isset($row['profile'])){
                              $pro="
                              <div class='image-cropper border-0 profile mr-2'>
                                  <img src='{$row['profile']}' class='rounded' />
                              </div>";
                            }else {
                              $pro="<div class='image-cropper border-0 profile mr-2'>
                                  <img src='/bookview/images/icon_user.png' class='rounded' />
                              </div>";
                            }
                              echo  $pro."
                                <div class='ml-4 '>
                                    <p>ชื่อ - สกุล : {$row["first_name"]} {$row["last_name"]}</p>
                                    <hr class='w-100'/>
                                    <p>{$row["review"]}</p>
                                </div>
                                
                            </div>
                
                        </div>
                      </div>";
                    }
                    } else {
                    echo "";
                    }

                    mysqli_close($conn);
        ?>

<!--       
      <div class="row mt-4 pl-5 pr-5">
        <div class="col-12 pl-5 pr-5 ">
            
            <div class="review-item d-flex">
                <div class="image-cropper">
                    <img src="/images/banner2.jpg" class="rounded" />
                </div>
                <div class="ml-4 ">
                    <p>ชื่อ - สกุล : test</p>
                    <hr class="w-100"/>
                    <p>dffdfsdfdsf fsd fdsfds fds fd</p>
                </div>
                
            </div>

        </div>
      </div> -->

    </div>
<?php include("component/footer.php")?>
     </body>
</html>
