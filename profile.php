
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
  </head>
  <body>
    <?php include("component/header.php")?>
    <div class="main-body min-vh-100">
        <div class="container mt-5 pt-5 ">
           <div class="row">
                <div class="col-4">
                    <?php include("component/menu.php")?>
                </div>
                <div class="col-8">
                    <?php 
                        if(isset($_GET["success"])){
                            echo "
                            <script type='text/javascript'>
                                
                                $(document).ready(function(){
                                
                                swal('แก้ไขข้อมูลเรียบร้อย','', 'success');
                                });
                                
                                </script>";
                        }
                         include "function/db_config.php";
                         $sql = "SELECT *
                         FROM user 
                         WHERE id_user = {$_SESSION['user_id']} 
                         ";
                         $result = mysqli_query($conn, $sql);

                         if (mysqli_num_rows($result) > 0) { 
                            while($row = mysqli_fetch_assoc($result)) {
                                $first_name = $row["first_name"];
                                $last_name  =$row["last_name"];
                                $email =$row["email"];
                                $phone =$row["phone"];
                                if(isset($row["profile"])){
                                    $profile = $row["profile"];
                                }else{
                                    $profile = "/bookview/images/icon_user.png";
                                }
                                
                            }
                         }
                    ?>
                    <form action="/bookview/function/fn_user.php?edit=<?=$_SESSION['user_id']?>" method="post" enctype="multipart/form-data">
                        <div class="cart-list">
                            <h5>จัดการข้อมูลส่วนตัว</h5>
                            <hr></hr>
                            <div class="row">
                                <div class="col-4">
                                <div class='image-cropper border-0 profile mr-2'>
                                    <img src='<?=$profile?>' class='rounded' id="img-profile" />
                                    </div>
                                    <input type='file' name='profile' id='profile' class='form-control mt-3' accept='image/*'   />
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>ชื่อ</label>
                                            <input type="text" class="form-control mb-2" value='<?=$first_name?>' name="first_name"/>
                                        </div>
                                        <div class="col-6">
                                            <label>สกุล</label>
                                            <input type="text" class="form-control mb-2" value='<?=$last_name?>' name="last_name"/>
                                        </div>
                                    </div>
                                    <label>อีเมล</label>
                                    <input type="text" class="form-control mb-2" value='<?=$email?>'  name="email" disabled=""/>
                                    <label>เบอร์โทร</label>
                                    <input type="text" class="form-control mb-4" value='<?=$phone?>' name="phone"/>
                                    <button type="submit" class="btn btn-book w-100 mb-2" >บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("component/footer.php")?>
    <script>
          window.addEventListener("load", function() { 
            document.getElementById("profile").onchange = function(event) { 
              var reader = new FileReader(); 
              reader.readAsDataURL(event.srcElement.files[0]); 
              var me = this; 
              reader.onload = function () { 
                var fileContent = reader.result; 
              // console.log(fileContent); 
              document.getElementById("img-profile").src = fileContent;
              } 
          }}); 
        </script>
    </body>
</html>