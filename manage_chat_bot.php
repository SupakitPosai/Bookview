<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview | จัดการข้อความอัตโนมัติ</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
      <?php include 'component/slide_nav.php' ?>
      <div class="layout">
        <div class="container pl-5 pr-5 pb-3">
            <div class="row pb-4">
                <div class="col-12">
                    <h3>จัดการข้อความอัตโนมัติ</h3>
                </div>
           </div>
           <div class="row">
                <div class="col-12">
                    <div class="box-manage">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- <h4 class="m-0">รายการยืมทั้งหมด</h4> -->
                            <button typr="button" class="btn btn-book" data-toggle="modal" data-target="#myModal" >เพิ่มข้อความอัตโนมัต</button>
                        </div>
                        <table class="table w-100 mt-4">
                            <tr>
                            <th>Key</th>
                            <th>ตอบกลับ</th>
                            <th></th>
                            </tr>
                            <?php 
                            include "function/db_config.php";
                            $query = "SELECT * FROM `chat_bot` " or die("Error:" . mysqli_error()); 
                            $result2 = mysqli_query($conn, $query); 
                            while($row = mysqli_fetch_array($result2)) { 
                            echo "<tr>";
                            echo "<td>{$row['key']}</td>";
                            echo "<td>{$row['message_auto']}</td>";
                            echo "<td class='text-right'>
                            <a class='text-book-y-b' href='#' data-toggle='modal' data-target='#myModal{$row['id_chat_bot']}'>แก้ไข</a>
                            ";
                            if ($row['id_chat_bot'] != 1) {
                                echo"<a class='text-book-y-b ml-2' href='/bookview/function/fn_chat_bot.php?del_bot={$row['id_chat_bot']}'>ลบ</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                            echo "<div class='modal fade' id='myModal{$row['id_chat_bot']}'>
                                <div class='modal-dialog modal-dialog-centered modal-md'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                    <h4 class='modal-title'>แก้ไขข้อความอัตโนมัต</h4>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    </div>
                                    <form action='/bookview/function/fn_chat_bot.php?edit_bot={$row['id_chat_bot']}' method='post' enctype='multipart/form-data'>
                                        <div class='modal-body pl-5 pr-5'>
                                        <label>key</label>";
                                    if ($row['id_chat_bot'] == 1) {
                                       echo "<input type='text' name='key' class='form-control' value='{$row['key']}' disabled='' />";
                                    }else{
                                        echo "<input type='text' name='key' class='form-control' value='{$row['key']}' />";
                                    }

                                       echo" <label>ตอบกลับ</label>
                                        <input type='text' name='message_auto' class='form-control' value='{$row['message_auto']}' />
                                        </div>
                                        <div class='modal-footer justify-content-center'>
                                        <button type='button' class='btn btn-book-outline w-25' data-dismiss='modal'>ยกเลิก</button>
                                        <button class='btn btn-book w-25' type='submit'>บันทึก</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>";
                            }
                            mysqli_close($conn); 
                            ?>
                        </table>
                    </div>
                </div>
           </div>
        </div>
      </div>
      
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">เพิ่มข้อความอัตโนมัต</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
               <form action="/bookview/function/fn_chat_bot.php?add_bot=1" method="post" enctype="multipart/form-data">
                <div class="modal-body pl-5 pr-5">
                  <label>key <span class="text-danger">*</span></label>
                  <input type="text" name="key" class="form-control" required />
                  <label>ตอบกลับ <span class="text-danger">*</span></label>
                  <input type="text" name="message_auto" class="form-control" required />
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-book-outline w-25" data-dismiss="modal">ยกเลิก</button>
                  <button class="btn btn-book w-25" type="submit">บันทึก</button>
                </div>
              </form>
            </div>
          </div>
        </div>

  </body>
</html>