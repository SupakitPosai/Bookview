<?php  session_start();?>
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
    <script src="/bookview/function/function.js"></script>
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
    <nav id="nav1" class="navbar navbar-expand-md book-nav fixed-top ">
      <div class="container">
        <div class="row w-100">
          <div class="col-2 align-items-center d-flex">
            <a class="navbar-brand" href="/bookview">Bookview Logo</a>
          </div>
          <div class="col-6 d-flex align-items-center px-0">
            <ul class="navbar-nav">
              <li id="navhome" class="nav-item w-100">
                <a class="nav-link" href="/bookview"><i class="fas fa-home mr-2"></i>หน้าหลัก</a>
              </li>
            </ul>
           <form action="search.php" method="get"> 
             <div class="input-group  ml-4">
              <input
                type="text"
                name="search"
                class="form-control"
                placeholder="ค้นหาหนังสือ...."
                value="<?php if(isset($_GET['search'])) echo $_GET['search']?>"
              />
               <div class="input-group-append">
                <button class="btn btn-book" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </form>
            </div>
          </div>
          <div class="col-4 d-flex align-items-center px-0 justify-content-end">
            
            <ul class="navbar-nav">
              <li id="navlogin" class="nav-item">
              <?php
                   
                    if(!isset($_SESSION['user_id'])) {
                      echo'<a class="nav-link" href="/bookview/login.php"><i class="fas fa-user mr-2"></i>เข้าสู่ระบบ</a>';
                    }else {
                        if(isset($_SESSION['profile'])){
                          $pro="
                          <div class='image-cropper border-0 profile mr-2'>
                              <img src='{$_SESSION['profile']}' class='rounded' />
                          </div>";
                        }else {
                          $pro="<div class='image-cropper border-0 profile mr-2'>
                              <img src='/bookview/images/icon_user.png' class='rounded' />
                          </div>";
                        }
                      echo"<div class='dropdown'>
                        <button type='button' class='btn  dropdown-toggle d-flex align-items-center' data-toggle='dropdown'>".$pro."
                      {$_SESSION['name']}
                      </button>
                      <div class='dropdown-menu'>

                        <a class='dropdown-item' href='/bookview/profile.php'>จัดการข้อมูลส่วนตัว</a>
                        <a class='dropdown-item' href='/bookview/order.php'>รายการยืม/คืน</a>
                        <a class='dropdown-item' href='/bookview/function/fn_logout.php'>ออกจากระบบ</a>
                      </div>
                    </div>";
                    }
              ?>
                
              </li>
            </ul>
            <a class="ml-3" href="/bookview/cart.php">
                <i class="fas fa-shopping-cart"></i>
                (<?php 
                    if(isset($_SESSION['cart'])){
                        $numall = 0;
                        for ($x = 0; $x < count($_SESSION['cart']); $x++) {

                            $numall += $_SESSION['cart'][$x]['num'];
                                
                        }
                            echo   $numall;
                    }else{
                        echo "0";
                    }
                ?>)
            </a>
          </div>
        </div>
        
      </div>
    </nav>
    <script>
      $(window).scroll(function(){
        var doc = document.documentElement;
        var element = document.getElementById('nav1');
        if (doc.scrollTop == 0) {
          element.classList.remove("box-shadow");
        }else{
           element.classList.add("box-shadow");
        }
       
         
      });
      var patname = window.location.pathname.split("/");
      if (patname[2]=="") {
        var elementnav = document.getElementById('navhome');
        elementnav.classList.add("active");
      }
      if (patname[2]=="login.php") {
        var elementnav = document.getElementById('navlogin');
        elementnav.classList.add("active");
      }
   
      </script>
  </body>
</html>
