<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
   
  </head>
  <body>
   <?php include("component/header.php")?>

   <div class="main-body ">
        <div class="container mt-5 pt-5">
            <div class="row p-5">
                <div class="col-12 p-5">
                    <div class="card-login">
                      <form action="/bookview/function/fn_register.php" method="post">
                          <h4 class="text-center">ลงทะเบียนสมาชิกใหม่</h4>
                          <label>ชื้อผู้ใช้<span class="text-danger">*</span></label>
                          <input type="text" class="form-control mb-2" required name="username"/>
                          <label>รหัสผ่าน<span class="text-danger">*</span></label>
                          <input type="password" class="form-control mb-2" required name="password"/>
                          <div class="row">
                              <div class="col-6">
                                  <label>ชื่อ<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control mb-2" required name="first_name"/>
                              </div>
                              <div class="col-6">
                                  <label>สกุล<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control mb-2" required name="last_name"/>
                              </div>
                          </div>
                          <label>อีเมล<span class="text-danger">*</span></label>
                          <input type="text" class="form-control mb-2" required name="email"/>
                          <label>เบอร์โทร<span class="text-danger">*</span></label>
                          <input type="text" class="form-control mb-4" required name="phone"/>
                          <button type="submit" class="btn btn-book w-100 mb-2" >สมัครสมาชิก</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("component/footer.php")?>
  </body>
</html>
