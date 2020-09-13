<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview | จัดการรายการยืม</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
      <?php include 'component/slide_nav.php' ?>
      <div class="layout">
        <div class="container pl-5 pr-5 pb-3">
            <div class="row pb-4">
                <div class="col-12">
                    <h3>จัดการรายการยืม</h3>
                </div>
           </div>
           <div class="row">
                <div class="col-12">
                    <div class="box-manage">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">รายการยืมทั้งหมด</h4>
                        </div>
                        <table class="table w-100 mt-4">
                            <tr>
                            <th>รหัสรายการยืม</th>
                            <th>ชื่อผู้ยืม</th>
                            <th>จำนวนทั้งหมด</th>
                            <th>วันที่ยืม</th>
                            <th>สถานะ</th>
                            </tr>
                            <?php 
                            include "function/db_config.php";
                            $query = "SELECT * FROM `order` INNER JOIN user ON `order`.id_user=user.id_user
                             ORDER BY `order`.`create_order` DESC" or die("Error:" . mysqli_error()); 
                            $result2 = mysqli_query($conn, $query); 
                            while($row = mysqli_fetch_array($result2)) { 
                            echo "<tr>";
                            echo "<td><a class='text-book' href='/bookview/manage_booking_detail.php?id_order={$row['no_order']}'>{$row['no_order']}</a></td>";
                            echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                            echo "<td>{$row['total_amount']}</td>";
                            echo "<td>{$row['create_order']}</td>";
                            echo "<td>".chSt($row['status_order'])."</td>";
                            echo "</tr>";
                            }
                            mysqli_close($conn); 
                            function chSt($stt)
                            {
                                if($stt == '01'){
                                    return "<span class='ml-2 text-book' > รออนุมัติการยืม</span>";
                                }
                                if($stt == '00'){
                                    return "<span class='ml-2 text-success' > ยืมหนนังสือสำเร็จ</span>";
                                }
                                if($stt == '10'){
                                    return "<span class='ml-2 text-book' > รออนุมัติการคืน</span>";
                                }
                                if($stt == '11'){
                                    return "<span class='ml-2 text-success' > คืนหนังสือสำเร็จ</span>";
                                }
                                if($stt == '12'){
                                    return "<span class='ml-2 text-danger' > รออนุมัติการคืนและค่าปรับ</span>";
                                }
                                if($stt == '13'){
                                    return "<span class='ml-2 text-book' > มีหนังสือยังไม่คืน</span>";
                                }
                            }
                            ?>                  
                        </table>
                    </div>
                </div>
           </div>
        </div>
      </div>
      

  </body>
</html>