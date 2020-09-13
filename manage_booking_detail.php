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
                    <h3>จัดการรายการยืม : <?= $_GET['id_order'] ?></h3>
                </div>
           </div>
           <div class="row">
                <div class="col-12">
                    <div class="box-manage">
                        <div class="cart-list">
                                <?php 
                                $st = 0;
                                include "function/db_config.php";
                                $query = "SELECT * FROM `order_detail` INNER JOIN book ON `order_detail`.id_book=book.id_book
                                JOIN `order` ON `order_detail`.id_order=`order`.id_order
                                WHERE `order`.no_order = {$_GET['id_order']}" or die("Error:" . mysqli_error()); 
                                $result2 = mysqli_query($conn, $query); 
                                while($row = mysqli_fetch_array($result2)) { 
                                
                                echo "<div class='cart-item d-flex align-items-center justify-content-between '>
                                <div class='d-flex align-items-center ' >    
                                    <div class='book-detail-img'>
                                        <img src='/bookview/upload/{$row['image_book']}'/>
                                    </div> 
                                    <div class='ml-3'> 
                                        <h5 class='mb-1'>{$row['name_book']}</h5>
                                        <h6 class='mb-1'>{$row['name_author']}</h6>
                                    </div>
                                </div>
                                <div class='cart-q'>
                                    วันที่คืน : {$row['date_borrow']}
                                </div>
                                <div class='mr-5' >
                                    จำนวน {$row['amount_order']}
                                </div>
                                <div class='mr-5' >
                                สถานะ : ".chSt($row['status_order_detail'])."
                            </div>
                                    </div>";
                            
                                    if ($row['status_order_detail'] == '10') {
                                        $st += 1;
                                    }
                            
                                }
                                
                                $query2 = "SELECT * FROM `order` 
                                WHERE `order`.no_order = {$_GET['id_order']}" or die("Error:" . mysqli_error()); 
                                $result3 = mysqli_query($conn, $query2); 
                                while($row2 = mysqli_fetch_array($result3)) { 
                                
                                    if ($row2['status_order'] == '01') {
                                        echo "
                                        <form action='/bookview/function/fn_order.php' method='post'>
                                        <div class='d-flex align-items-center my-3'>
                                            <div class='w-50' >
                                                สถานะการยืม : 
                                            </div>  
                                            <input type='hidden' name='edit_status_order' value='1'>
                                            <input type='hidden' name='id_order' value='{$row2['id_order']}'>
                                            <div class='w-50 d-flex' > 
                                                <div class='form-check'>
                                                    <label class='form-check-label' for='status_order1'>
                                                        <input type='radio' class='form-check-input' id='status_order1' name='status_order' value='02' checked>ยกเลิก
                                                    </label>
                                                </div>
                                                <div class='form-check ml-4'>
                                                    <label class='form-check-label' for='status_order2'>
                                                        <input type='radio' class='form-check-input' id='status_order2' name='status_order' value='00'>ยืนยัน
                                                    </label>
                                                </div> 
                                            </div> 
                                        </div>
                                        <hr></hr>
                                        <div class='d-flex justify-content-center' > 
                                            <button type='submit' class='btn btn-book w-25' >ยืนยัน</button> 
                                        </div>
                                        </form>";
                                        }
                                        if (isset($row2['fines_order'])&&$row2['fines_order']>0) {
                                            echo " 
                                            <div class='w-50 my-3' >
                                                ค่าปรับ : {$row2['fines_order']}  บาท
                                            </div> 
                                            " ;
                                        }

                                        if($st > 0){
                                            echo" <div class='d-flex justify-content-center mt-4'>
                                                
                                                    <a  class='btn btn-book w-25' href='/bookview/function/fn_order.php?status_re=1&id_order={$row2['id_order']}'  >ยืมยันการคืนสินค้า</a>
                                                    
                                             </div>";
                                        }
                                       
                                        // if ($row2['fines_order']) {
                                        //     echo" <div class='d-flex justify-content-center mt-4'>
                                                
                                        //         <button type='button' class='btn btn-book w-25' onClick='clickRe1()' >คืนหนังสือ</button>
                                                
                                        //     </div>";
                                        // }
                                        
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
                        </div>
                    </div>
                </div>
           </div>
        </div>
      </div>
      

  </body>
</html>