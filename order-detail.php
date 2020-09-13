<?php 
 include "function/db_config.php";
if (isset($_GET["total"])&&$_GET["total"]>0) {


    

    $sql4 = "SELECT *
    FROM `order` 
    WHERE no_order={$_GET['id_order']}
    ";
    $result4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        while($row4 = mysqli_fetch_assoc($result4)) {
            if (isset($row4['fines_order'])) {
                $ttotal = $row4['fines_order'] + $_GET["total"];
                $sql3 = "UPDATE `order` 
                SET fines_order = {$ttotal}
                WHERE no_order = {$_GET['id_order']}";
                $result5 = mysqli_query($conn, $sql3);
            }else{
                $sql3 = "UPDATE `order` 
                SET fines_order = {$_GET["total"]}
                WHERE no_order = {$_GET['id_order']}";
                $result5 = mysqli_query($conn, $sql3);
            }
            
        }
    }
}
?>
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
        <div class="container mt-5 pt-5 pb-4">
           <div class="row">
                <div class="col-4">
                    <?php include("component/menu.php")?>
                </div>
                <div class="col-8">
                    <div class="cart-list">
                        <h5>รายละเอียดการยืมหนังสือ</h5>
                        <hr></hr>
                        <?php 
                           $st = 0;
                            $sql = "SELECT *
                            FROM `order` 
                            WHERE no_order={$_GET['id_order']}
                            ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {

                                echo "
                                <div class='row'>
                                    <div class='col-6'>
                                        <p class='m-0'>รหัสการยืม #{$row['no_order']}</p>
                                        <p class='m-0'>ยืมหนังสือวันที่ <script type='text/javascript'>   
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
                                    <div class='col-6 text-right '>
                                       <p class='m-0'> สถานะ : ".chSt($row['status_order'])."</p>";
                                    if (isset($row['fines_order'])&&$row['fines_order']>0) {
                                        echo " 
                                          <p class='m-0'>  ค่าปรับ : {$row['fines_order']}  บาท</p>
                                        
                                        " ;
                                    }
                                   echo" </div>
                                </div>
                                <hr></hr>";
                                // if ($row['status_order'] == '00') {
                                //     echo"<div class='mr-3 d-flex align-items-center'>
                                //         <div class='custom-control custom-checkbox w-0'>
                                //             <input type='checkbox' class='custom-control-input' id='ch-all3' value='1'>
                                //             <label class='custom-control-label' for='ch-all3'></label>
                                //         </div>
                                //         <span class='mt-2'>ทั้งหมด</span>
                                //     </div>";
                                // }
                                echo "<div class='row mt-3'>
                                    <div class='col-12'>";
                                $sql2 = "SELECT *
                                FROM order_detail JOIN book ON order_detail.id_book = book.id_book
                                WHERE id_order={$row['id_order']}
                                ";
                                $result2 = mysqli_query($conn, $sql2);
    
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo "
                                        <div class='cart-item d-flex align-items-center justify-content-between '>
                                            <div class='d-flex align-items-center ' >  ";
                                                if ($row2['status_order_detail'] == '00') {
                                                    echo "<div class='mr-3'>
                                                        <div class='custom-control custom-checkbox w-0'>
                                                            <input type='checkbox' class='custom-control-input' id='ch-{$row2['id_detail']}' onClick='checkProduct({$row2['id_detail']})' value='1'>
                                                            <label class='custom-control-label' for='ch-{$row2['id_detail']}'></label>
                                                        </div>
                                                    </div>   ";
                                                }else{
                                                     echo "";
                                                }
                                                

                                                echo"<div class='book-detail-img'>
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
                                            <div class='cart-q'>
                                                จำนวน {$row2['amount_order']}
                                            </div>
                                            <div class='mr-5' >
                                                สถานะ : ".chSt($row2['status_order_detail'])."
                                            </div>
                                        </div>
                                        
                                        ";
                                        if ($row2['status_order_detail'] == '00') {
                                            $st += 1;
                                        }
                                    }
                                }

                              echo "</div>
                              </div>";
                              if ($st > 0) {
                                echo" <div class='d-flex justify-content-center mt-4'>
                                   
                                    <button type='button' class='btn btn-book w-25' onClick='clickRe1()' >คืนหนังสือ</button>
                                    
                                </div>";
                                }

                                
                            }
                            } else {
                            echo "0 results";
                            }

                            mysqli_close($conn);
                            if (isset($_GET["total"])&&$_GET["total"]>0) {
                            echo "
                            <script type='text/javascript'>
                                
                                $(document).ready(function(){
                                
                                swal('กรุณชำระค่าปรับ {$_GET["total"]} บาท','', 'warning');
                                });
                                
                                </script>";
                            }
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
    <div class='modal fade' id='myModal'>
        <div class='modal-dialog modal-dialog-centered modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title'>ชำระค่าปรับ</h4>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                </div>
                <div class='modal-body pl-5 pr-5 cart-list'>
                    <div class="cart-item d-flex align-items-center justify-content-between ">
                        <div class="d-flex align-items-center " >   
                            <!-- <div class="mr-3">
                                <div class="custom-control custom-checkbox w-0">
                                    <input type="checkbox" class="custom-control-input" id="ch-all" value="1" checked="">
                                    <label class="custom-control-label" for="ch-all"></label>
                                </div>
                            </div>  -->
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
                            <!-- <p class="del-cart "><i class="fas fa-trash"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class='modal-footer justify-content-center'>
                    <button type='button' class='btn btn-book-outline w-25' data-dismiss='modal'>ยกเลิก</button>
                    <a class='btn btn-book w-25' href='/bookview/function/fn_delete.php?table=book&id' >ยืนยัน</a>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript'> 
    
    let check = []
    let id_order = "<?=$_GET['id_order']?>"
    function checkProduct(val) {
        check.push(val)
        console.log('check', check)
    }
    function clickRe1() {
        window.location.replace(`/bookview/function/fn_order.php?id_order=${id_order}&check=${check}`);
    }

    </script>
    <?php include("component/footer.php")?>
    </body>
</html>
