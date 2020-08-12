
<?php 
include "function/db_config.php";
session_start();
if (isset($_SESSION['user_id'])){
  header('Location:/bookview');
}
$username='';
  $password='';
  $loginError = '' ;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username=$_POST['username'];
  $password=$_POST['password'];
  $sql = "SELECT * FROM user WHERE username='{$username}' AND  password='{$password}'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      
      $_SESSION['user_id']=$row["id_user"];
      $_SESSION['name']=$row["first_name"].' '.$row["last_name"];
      $_SESSION['profile']=$row["profile"];
      $_SESSION['user_type']=$row["type"];
     if ($row["type"] == 'user') header('Location:/bookview'); 
     else if ($row["type"] == 'admin') header('Location:/bookview/admin.php'); 
    }
  } else {
    $loginError = "0 results";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--  กำหนดขอบเขตท้อมูลการร้องขอ มี profile กับ email-->
    <meta name="google-signin-scope" content="profile email">
<!--    กำหนด client ID ที่เราได้สร้างไว้-->
    <meta name="google-signin-client_id" content="590470975835-p3hr6qvp0ee27lbp4fdoruoe5aofkmnc.apps.googleusercontent.com">
<!--    ต้องมีการเรียกใช้งาน Google Platform Library ในหน้าที่มีการใช้งาน Google Sign In-->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
<!-- <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script> -->

  </head>
  <body>
   <?php include("component/header.php")?>

   <div class="main-body ">
        <div class="container mt-5 pt-5">
            
            <div class="row p-5">
                <div class="col-12 p-5">
                    <div class="card-login">
                    <form  method="post" action="/bookview/login.php">
                        <h4 class="text-center">เข้าสู่ระบบ</h4>
                        <label>ชื้อผู้ใช้</label>
                        <input type="text" name="username" class="form-control mb-2" value="<?php echo $username?>" />
                        <label>รหัสผ่าน</label>
                        <input type="password" name="password" class="form-control mb-4" value="<?php echo $password?>"/>
                      <?php if ($loginError) echo '<label class="text-danger">*ชื้อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</label>'; else echo '';?>  
                        <button type="submit" class="btn btn-book w-100 mb-2" >เข้าสู่ระบบ</button>
                        <!--  วางปุ่มล็อกอินด้วย Google ในตำแหน่งที่ต้องการ-->
                      <div class="g-signin2 my-3" data-onsuccess="onSignIn" data-theme="light"></div>

                      </form>
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
    <?php
    if(isset($_GET['register'])&&$_GET['register']=='success'){
    echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
          swal("สมัครสมาชิกเรียบร้อย","", "success");
        });
        
        </script>
        ';
    }
    
    include("component/footer.php")?>

<script>
   console.log('object')
/*      สังเกตจากปุ่มล็อกอินด้านบน จะเห็นว่ามีการกำหนด data-onsuccess="onSignIn"
        ซึ่งก็คือเมื่อมีการล็อกอินผ่าน Google แล้วให้เรียกใช้งานฟังก์ชั่น ที่ชื่อ onSignIn*/
      function onSignIn(googleUser) {
          
        // ขอมูลของผู้ใช้งานที่ล็อกอิน ที่เราสามารถนำไปใช้งานได้ 
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // google แนะนำว่าไม่ควรส่งคานี้ไปเก็บไว้บน server 
        // ค่า ID นี้เราสามรรถประยุกต์เพิ่มเติมตามต้องการ เช่นอาจจะเข้ารหัสก่อนบันทึกหรืออะไรก็ได้
        // แต่ในที่นี้จะใช้วิธีอยางง่่ายเพื่อเป็นแนวทาง
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());
 
        // google แนะนำให้ใช้ ID token สำหรับใช้ในการตรวจสอบการล็อกอิน
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        window.location.replace(`/bookview/function/fn_login.php?id=${profile.getId()}&f_name=${profile.getGivenName()}&l_name=${profile.getFamilyName()}&e=${profile.getEmail()}&img=${profile.getImageUrl()}`);

      };
    </script>
  </body>
</html>
