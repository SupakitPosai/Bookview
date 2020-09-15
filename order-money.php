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
           <div class="col-12 col-md-4 pb-3">
                    <?php include("component/menu.php")?>
                </div>
                <div class="col-12 col-md-8">
                    <div class="cart-list">
                        <h5>รายการที่มีค่าปรับ</h5>
                        <hr></hr>
                        <?php 
                            include "function/db_config.php";
                            $sql = "SELECT *
                            FROM `order` 
                            WHERE id_user={$_SESSION['user_id']} AND fines_order > 0 ORDER BY create_order DESC
                            ";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {

                                echo "<div class='order-list mb-3'>
                                <div class='order-list-head'>
                                    <div class='row'>
                                        <div class='col-12 col-md-6'>
                                           <a href='/bookview/order-detail.php?id_order={$row['no_order']}'> <p class='m-0'>รหัสการยืม #{$row['no_order']}</p></a>
                                            <p class='m-0'>ยืมหนังสือวันที่ 
                                            <script type='text/javascript'>   
                                                function tDays(days) {
                                                    const copy = new Date(days);
                                                
                                                    
                                                        var thday = new Array ('อาทิตย์','จันทร์',
                                                        'อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
                                                        var thmonth = new Array ('มกราคม','กุมภาพันธ์','มีนาคม',
                                                        'เมษายน','พฤษภาคม','มิถุนายน', 'กรกฎาคม','สิงหาคม','กันยายน',
                                                        'ตุลาคม','พฤศจิกายน','ธันวาคม');
                                        
                                                        document.write( copy.getDate()+ ' ' + thmonth[copy.getMonth()]+ ' ' + (0+copy.getFullYear()+543));
                                                    return copy;
                                                
                                                } 
                                                tDays('{$row['create_order']}')
                                            </script>
                                            </p>
                                        </div>
                                        <div class='col-12 col-md-6 d-flex justify-content-end align-items-center '>
                                            สถานะ : ".chSt($row['status_order'])."
                                        </div>
                                    </div>
                                </div>
                                <div class='m-2'>";
                                $sql2 = "SELECT *
                                FROM order_detail JOIN book ON order_detail.id_book = book.id_book
                                WHERE id_order={$row['id_order']}
                                ";
                                $result2 = mysqli_query($conn, $sql2);
    
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo "
                                        <div class='row cart-item d-flex align-items-center justify-content-between '>
                                            <div class='col-12 col-lg-7 d-flex align-items-center ' >    
                                                <div class='book-detail-img'>
                                                    <img src='/bookview/upload/{$row2['image_book']}'/>
                                                </div> 
                                                <div class='ml-3'> 
                                                    <h5 class='mb-1'>{$row2['name_book']}</h5>
                                                    <h6 class='mb-1'>{$row2['name_author']}</h6>
                                                    <p class='mb-1'>วันที่คืน: 
                                                    <script type='text/javascript'>   
                                                        function tDays(days) {
                                                            const copy = new Date(days);
                                                        
                                                            
                                                                var thday = new Array ('อาทิตย์','จันทร์',
                                                                'อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
                                                                var thmonth = new Array ('มกราคม','กุมภาพันธ์','มีนาคม',
                                                                'เมษายน','พฤษภาคม','มิถุนายน', 'กรกฎาคม','สิงหาคม','กันยายน',
                                                                'ตุลาคม','พฤศจิกายน','ธันวาคม');
                                                
                                                                document.write( copy.getDate()+ ' ' + thmonth[copy.getMonth()]+ ' ' + (0+copy.getFullYear()+543));
                                                            return copy;
                                                        
                                                        } 
                                                        tDays('{$row2['date_borrow']}')
                                                    </script>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class='col-8 col-lg-3 mt-2 mt-lg-0 cart-q'>
                                                จำนวน {$row2['amount_order']}
                                            </div>
                                            
                                        </div>
                                        ";
                                    }
                                }

                              echo "</div>
                            </div>";

                            }
                            } else {
                            echo "";
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
                        <!-- <div class="order-list">
                            <div class="order-list-head">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="m-0">รหัสการยืม #3333442</p>
                                        <p class="m-0">ยืมหนังสือวันที่ 22 พค 2562</p>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-items-center ">
                                        สถานะ : รอการอนุมัติ
                                    </div>
                                </div>
                            </div>
                            <div class="m-2">
                                <div class="cart-item d-flex align-items-center justify-content-between ">
                                    <div class="d-flex align-items-center " >    
                                        <div class='book-detail-img'>
                                            <img src='/bookview/upload/1597227376-ปกหนังสือ.jpg'/>
                                        </div> 
                                        <div class="ml-3"> 
                                            <h5 class="mb-1">ชื่อหนังสือเทส</h5>
                                            <p class="mb-1">จำนวนที่มี : 5</p>
                                            <p class="mb-1">จำนวนที่ยืมได้: 5 วัน</p>
                                        </div>
                                    </div>
                                    <div class="cart-q">
                                        จำนวน 10
                                    </div>
                                    <div class="mr-5" >
                                        
                                    </div>
                                </div>
                                <div class="cart-item d-flex align-items-center justify-content-between ">
                                    <div class="d-flex align-items-center " >    
                                        <div class='book-detail-img'>
                                            <img src='/bookview/upload/1597227376-ปกหนังสือ.jpg'/>
                                        </div> 
                                        <div class="ml-3"> 
                                            <h5 class="mb-1">ชื่อหนังสือเทส</h5>
                                            <p class="mb-1">จำนวนที่มี : 5</p>
                                            <p class="mb-1">จำนวนที่ยืมได้: 5 วัน</p>
                                        </div>
                                    </div>
                                    <div class="cart-q">
                                        จำนวน 10
                                    </div>
                                    <div class="mr-5" >
                                        
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    
                    </div>
                </div>
           </div>
        </div>
    </div>
   
    <?php include("component/footer.php")?>
    </body>
</html>
