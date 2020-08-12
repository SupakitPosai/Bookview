<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/bookview/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/bookview/css/bookview.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
      crossorigin="anonymous"
    />
  </head>
  <body>
   <?php include("component/header.php")?>
   <div class="container mt-5 pt-5 pb-4">
      <div class="row">
        
        <?php 
        $search = $_GET['search'];
          include "function/db_config.php";
          $query = "SELECT *
          FROM book WHERE status='1' AND name_book LIKE '%{$search}%'" or die("Error:" . mysqli_error()); 
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
