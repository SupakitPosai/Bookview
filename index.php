<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
   <?php include("component/header.php")?>

   <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-12">
          <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img
                  src="/bookview/images/banner1.jpg"
                  alt="Los Angeles"
                  width="1100"
                  height="500"
                />
              </div>
              <div class="carousel-item">
                <img
                  src="/bookview/images/banner2.jpg"
                  alt="Chicago"
                  width="1100"
                  height="500"
                />
              </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fuild position-relative mt-5 mb-2">
      <div class="position-absolute box-bg"></div>
      <div class="container">
        <div class="row pt-5 mb-2">
          <div class="col-4"></div>
          <div class="col-4">
            <div class="text-center"><h2 class="text-white">หนังสือแนะนำ</h2></div>
          </div>
          <div class="col-4">
          </div>
        </div>
      </div>
    </div>
    <div class="container my-5">
      <div class="row">
        
        <?php 
          include "function/db_config.php";
          $query = "SELECT *
          FROM book WHERE status='1' LIMIT 4" or die("Error:" . mysqli_error()); 
          $result2 = mysqli_query($conn, $query); 
          while($row = mysqli_fetch_array($result2)) { 
            echo "<div class='col-3'><a href='/bookview/book_detail.php?book={$row['id_book']}' >
            <div class='book-card'>
              <div class='book-card__cover'>
                <div class='book-card__book'>
                  <div class='book-card__book-front'>
                    <img class='book-card__img'   src='/bookview/upload/{$row['image_book']}' />
                  </div>
                  <div class='book-card__book-back'></div>
                  <div class='book-card__book-side'></div>
                </div>
              </div>
              <div>
                <div class='book-card__title'>
                {$row['name_book']}
                </div>
                <div class='book-card__author'>
               ผู้แต่ง : {$row['name_author']}
                </div>
                <div class='book-more'>อ่านเพิ่มเติม</div>
              </div>
            </div>
          </a></div>";
          }
        
          mysqli_close($conn); 
          ?>
          
        
      </div>
    </div>
    <?php include("component/footer.php")?>
  </body>
</html>
