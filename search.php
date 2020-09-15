<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    
  </head>
  <body>
   <?php include("component/header.php")?>
   <div class="container mt-5 pt-5 pb-4 min-vh-100">
      <div class="row">
        
        <?php 
        $search = $_GET['search'];
          include "function/db_config.php";
          $query = "SELECT *
          FROM book WHERE status='1' AND name_book LIKE '%{$search}%'" or die("Error:" . mysqli_error()); 
          $result2 = mysqli_query($conn, $query); 
          while($row = mysqli_fetch_array($result2)) { 
            echo "<div class=' col-6 col-md-4  col-lg-3 '><a href='/bookview/book_detail.php?book={$row['id_book']}' >
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
