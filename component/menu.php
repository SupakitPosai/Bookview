<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    
    <div class="cart-list">
        <div class="d-flex align-items-center">
        <?php
                   
            if(!isset($_SESSION['user_id'])) {
                echo'';
            }else {
                if(isset($_SESSION['profile'])){
                    echo"
                    <div class='image-cropper border-0 profile mr-2'>
                        <img src='{$_SESSION['profile']}' class='rounded' />
                    </div>";
                }else {
                    echo"<div class='image-cropper border-0 profile mr-2'>
                        <img src='/bookview/images/icon_user.png' class='rounded' />
                    </div>";
                }
                echo" <div class='ml-2' ><h5 class='m-0'>{$_SESSION['name']}
                </h5>
                <a href='/bookview/profile.php' class=' text-secondary m-0'>แก้ไขข้อมูลส่วนตัว</a>
            </div>";
            }
        ?>
        
        </div>
        <hr></hr>
        <div class="d-flex">
            <div ><i class="fas fa-book font-1 text-book ml-2"></i></div>
            <div >
                <div class="ml-4">
                    <h5 class="mb-2 ">รายการยืมหนังสือ</h5>
                </div>
                <div class="ml-4">
                    <a href="/bookview/order.php" ><p class="mb-1 link-menu">รายการที่เคยยืมหนังสือ</p></a>
                    <a href="/bookview/order-money.php" ><p class="mb-1 link-menu">รายการที่มีค่าปรับ</p></a>
                    <a href="/bookview/order-success.php" ><p class="mb-1 link-menu">รายการคืนสำเร็จ</p></a>
                </div>    
            </div>
        </div>
        
    </div>
  </body>
</html>
