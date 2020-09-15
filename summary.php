<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
  </head>
  <body class="main-body ">
    <?php include("component/header.php")?>
    <div class="min-vh-100 " >
        <div class="container mt-5 pt-5 pb-4">
            <div class="row px-lg-5 my-3">
                <div class="col-12 px-lg-5">
                    <ul class="progressbar pl-lg-5 pr-lg-5">
                        <?php 
                        
                            if (isset($_GET["success"])) {
                               echo "
                                    <li class='active'></li>
                                    <li class='active'></li>
                               ";
                            }else{
                                echo "
                                    <li></li>
                                    <li></li>
                               ";
                            }
                        ?>
                        
                    </ul>
                </div>
            </div>
            <div class="row pl-lg-5 pr-lg-5">
                <div class="col-12 pl-lg-5 pr-lg-5">
                    <div class="cart-list">
                        <?php 
                            if(isset($_GET["order"]) && $_GET["order"]=="yes"){
                                echo "
                                <script type='text/javascript'>
                                    
                                    $(document).ready(function(){
                                    
                                    swal('คุณมีหนังสือที่ยังไม่คืน','', 'warning');
                                    });
                                    
                                    </script>";
                            }
                            include "function/db_config.php";
                            $new_id = array();
                            if(isset($_SESSION['cart']) && count($_SESSION['cart'])){
                                for ($x2 = 0; $x2 < count($_SESSION['cart']); $x2++) {
                                    // echo $_SESSION['cart'][$x2]['id_book'];
                                    //  array_push($new_id,$_SESSION['cart'][$x2]['id_book']);
                                
                                    $id_b = implode(',',$new_id);
                                    $sql = "SELECT *
                                    FROM book JOIN catergory ON book.id_cate = catergory.id_cate
                                    WHERE id_book = {$_SESSION['cart'][$x2]['id_book']}";
                                    $result = mysqli_query($conn, $sql);
                                    $product_cart = array();
                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while($row = mysqli_fetch_assoc($result)) {
                                        // $p_c = array("id_book"=>$row["id_book"],"image_book"=>$row["image_book"],"name_book"=>$row["name_book"],"name_author"=>$row["name_author"]
                                        //     ,"amount"=>$row["amount"],"date_borrow"=>$row["date_borrow"]);
                                        //     array_push($product_cart, $p_c);  
                                            echo "
                                            <div class='row cart-item d-flex align-items-center justify-content-between '>
                                                <div class='col-12 col-lg-7 d-flex align-items-center ' >    
                                                    <div class='book-detail-img'>
                                                        <img src='/bookview/upload/{$row['image_book']}'/>
                                                    </div> 
                                                    <div class='ml-3'> 
                                                        <h5 class='mb-1'>{$row['name_book']}</h5>
                                                        <h6 class='mb-1'>{$row['name_author']}</h6>
                                                        <p class='mb-1'>จำนวนที่มี : {$row['amount']}</p>
                                                        <p class='mb-1'>จำนวนที่ยืมได้: {$row['date_borrow']} วัน</p>
                                                    </div>
                                                </div>
                                                <div class='col-8 col-lg-3 mt-2 mt-lg-0 cart-q'>
                                            
                                                    วันที่คืน : 
                                                    
        
                                                <script type='text/javascript'>
                                                    function addDays(days) {
                                                        const copy = new Date();
                                                        copy.setDate(copy.getDate() + days);
                                                        
                                                            var thday = new Array ('อาทิตย์','จันทร์',
                                                            'อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
                                                            var thmonth = new Array ('มกราคม','กุมภาพันธ์','มีนาคม',
                                                            'เมษายน','พฤษภาคม','มิถุนายน', 'กรกฎาคม','สิงหาคม','กันยายน',
                                                            'ตุลาคม','พฤศจิกายน','ธันวาคม');
        
                                                            document.write( copy.getDate()+ ' ' + thmonth[copy.getMonth()]+ ' ' + (0+copy.getFullYear()+543));
                                                        return copy;
                                                    
                                                    }
                                                    
                                                addDays({$row['date_borrow']});
                                                </script>
                                                
                                                </div>
                                                <div class='col-4 col-lg-2 mt-2 mt-lg-0' >
                                                    จำนวน {$_SESSION['cart'][$x2]['num']}
                                                </div>
                                            </div>
                                            ";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                }
                                mysqli_close($conn);
                            
                                // for ($x = 0; $x < count($_SESSION['cart']); $x++) {
                                   
                                    
                                // }
                            }else{

                                
                                if (isset($_GET["success"])) {
                                    echo "
                                        <div class='text-center'><img class='w-50' src='/bookview/images/4060173.jpg'></img></div>
                                    ";
                                }else{
                                    echo "<div class='text-center'>ไม่มีรายการหนังสือ</div>";
                                }
                            }
                            
                            
                        ?>
                        
                        <div class="d-flex justify-content-center">
                            <?php 
                                if (isset($_GET["success"])) {
                                    echo "
                                    <a href='/bookview' class='btn btn-book-outline w-25 mr-2'>ดูหนังสืออื่นๆ</a>
                                    <a class='btn btn-book w-25 ml-2' href='/bookview/order-detail.php?id_order={$_GET["success"]}'>ดูรายการยืม</a>
                                    ";
                                }else{
                                    echo "<a href='/bookview/cart.php' class='btn btn-book-outline w-25 mr-2'>ยกเลิก</a>
                                    <a class='btn btn-book w-25 ml-2' href='/bookview/function/fn_order.php?insert_order=1'>ยืนยัน</a>";
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
         </div>   
    </div>
   
    <?php include("component/footer.php")?>
    </body>
</html>
