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
                <div class="col-12"><h3>ตะกร้าของฉัน</h3><hr></hr></div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="cart-list">
                        <?php 
                        // print_r($_SESSION['cart']);
                            include "function/db_config.php";
                            $new_id = array();
                            if(isset($_SESSION['cart']) && count($_SESSION['cart'])){
                                for ($x2 = 0; $x2 < count($_SESSION['cart']); $x2++) {
                                    // echo $_SESSION['cart'][$x2]['id_book'];
                                    //  array_push($new_id,$_SESSION['cart'][$x2]['id_book']);
                                
                                    // $id_b = implode(',',$new_id);
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
                                        <div class='cart-item d-flex align-items-center justify-content-between '>
                                            <div class='d-flex align-items-center ' >    
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
                                            <div class='cart-q'>
                                                <div class='input-group input-group-number'>
                                                   <a href='/bookview/function/fn_cart.php?id_book={$row['id_book']}&edit=1&val=-1'> <input type='button' class='button button-minus' data-id='108' data-field='quantity' 
                                                    ";
                                                    if($_SESSION['cart'][$x2]['num'] > 1){
                                                        echo "";
                                                    }else{
                                                        echo "disabled=''";
                                                    }
                                                    echo "
                                                    value='-'></input></a>
                                                    <input type='number' step='1' max='{$row['amount']}' min='1' pattern='[0-9]*' name='quantity' data-field='quantity' value='{$_SESSION['cart'][$x2]['num']}' data-id='108' class='input quantity-field' disabled='' >
                                                    <a href='/bookview/function/fn_cart.php?id_book={$row['id_book']}&edit=1&val=1'> <input type='button' class='button button-plus' data-id='108' data-field='quantity' value='+' 
                                                    onClick='editCart({$row['id_book']},1)' ";
                                                    if($_SESSION['cart'][$x2]['num'] == $row['amount']){
                                                        echo "disabled=''";
                                                    }else{
                                                        echo "";
                                                    }
                                                    echo "
                                                    ></input></a>
                                                </div>
                                            </div>
                                            <div class='mr-5' >
                                                <a href='/bookview/function/fn_cart.php?id_book={$row['id_book']}&delete=1'><p class='del-cart '><i class='fas fa-trash'></i></p></a>
                                            </div>
                                        </div>
                                        ";
                                        
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                }
                                mysqli_close($conn);
                                // print_r($_SESSION['cart']);
                               
                                // for ($x = 0; $x < count($_SESSION['cart']); $x++) {
                                   
                                // }
                            }else{
                                echo "<div class='text-center'>ไม่มีรายการหนังสือ</div>";
                            }
                            
                            
                        ?>
                        
                        
                    </div>
                </div>
                <div class="col-4">
                    <div class="cart-list">
                        <h4>รายละเอียด</h4>
                        <hr></hr>
                        <div class="d-flex justify-content-between">
                        <h5 class="m-0">จำนวนทั้งหมด</h5>
                        <p class="m-0">
                        <?php 
                            if(isset($_SESSION['cart'])){
                                $numall = 0;
                                for ($x = 0; $x < count($_SESSION['cart']); $x++) {

                                    $numall += $_SESSION['cart'][$x]['num'];
                                     
                                }
                                 echo   $numall;
                            }else{
                                echo "0";
                            }
                        ?>
                        </p>
                        </div>
                      <a href="/bookview/summary.php"> <button type="button" class='btn btn-book w-100 mt-5'>ยืมหนังสือ</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <?php include("component/footer.php")?>
    </body>
</html>
