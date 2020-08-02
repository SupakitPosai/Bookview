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

   <div class="main-body ">
        <div class="container mt-5 pt-5">
            
            <div class="row p-5">
                <div class="col-12 p-5">
                    <div class="card-login">
                        <h4 class="text-center">เข้าสู่ระบบ</h4>
                        <label>ชื้อผู้ใช้</label>
                        <input type="text" class="form-control mb-2"/>
                        <label>รหัสผ่าน</label>
                        <input type="text" class="form-control mb-4"/>
                        <button type="button" class="btn btn-book w-100 mb-2" >เข้าสู่ระบบ</button>
                        <div class="float-left">
                            <label>สมาชิกใหม่?
                                <a class="text-success" href="/bookview/register.php"> ลงทะเบียน </a>ที่นี่
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("component/footer.php")?>
  </body>
</html>