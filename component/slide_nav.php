<?php session_start(); 
if(!isset($_SESSION['user_id'])){
    header('Location:/bookview/login.php'); 
}else if($_SESSION['user_type']=='user'){
    header('Location:/bookview/');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  </head>
  <body>
    <nav id="nav1">
        <div class="slide-nav">
        <div class="slide-nav-admin"><a href="/bookview/admin.php"><?php if(isset($_SESSION['user_id'])) echo $_SESSION['name']; ?></a> </div>
        <hr class="m-0"></hr>
        <a href="/bookview/"><div class="slide-nav-head"><i class="fas fa-desktop mr-2"></i>ดูหน้าเว็บ</div></a>   
        <a href="/bookview/manage_catergory.php"><div class="slide-nav-head" id="nav-cate"><i class="fas fa-th mr-2"></i>จัดการหมวดหมู่</div></a>
            <a href="/bookview/manage_book.php"><div class="slide-nav-head" id="nav-book"><i class="fas fa-book mr-2"></i>จัดการหนังสือ</div></a>
            <a href="/bookview/manage_review.php"><div class="slide-nav-head" id="nav-review"><i class="fas fa-book-reader mr-2"></i>จัดการข้อมูลรีวิวหนังสือ</div></a>
            <a href="/bookview/manage_booking.php"><div class="slide-nav-head" id="nav-booking"><i class="fas fa-calendar-alt mr-2"></i>จัดการข้อมูล ยืม/คืน</div></a>
            <a href="/bookview/function/fn_logout.php"><div class="slide-nav-head logout"><i class="fas fa-sign-out-alt mr-2"></i>ออกจากระบบ</div></a>
        </div>
    </nav>
    <script>
      
      var patname = window.location.pathname.split("/");
      if (patname[2]=="manage_catergory.php") {
        var elementnav = document.getElementById('nav-cate');
        elementnav.classList.add("active");
      }
      if (patname[2]=="manage_book.php") {
        var elementnav = document.getElementById('nav-book');
        elementnav.classList.add("active");
      }
      if (patname[2]=="manage_review.php") {
        var elementnav = document.getElementById('nav-review');
        elementnav.classList.add("active");
      }
      </script>
  </body>
</html>
