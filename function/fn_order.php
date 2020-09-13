<?php 
session_start();
include "db_config.php";
if(isset($_GET["insert_order"])){
    $numall = 0;
    $id_user = $_SESSION['user_id'];
    $status_order = "01";
    
    for ($x1 = 0; $x1 < count($_SESSION['cart']); $x1++) {

        $numall += $_SESSION['cart'][$x1]['num'];
            
    }
   
    $id = 0;
    $sqlCh = "SELECT *  FROM `order` WHERE id_user = {$id_user} AND status_order != 11";
    $resultCh = $conn->query($sqlCh);
   
    if ($resultCh->num_rows > 0) {
        header('Location:/bookview/summary.php?order=yes');
    }else{
        $sql = 'SELECT MAX(`no_order`) AS`no_order`  FROM `order`';
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (isset($row['no_order'])) {
                $id = $row['no_order']+1;
            }else{
                $id = 1;
            }
        
        }
        }
        // echo sprintf("%010d",$id);
        $new_id = array();
        // for ($x2 = 0; $x2 < count($_SESSION['cart']); $x2++) {
        //     // echo $_SESSION['cart'][$x2]['id_book'];
        //     // array_push($new_id,$_SESSION['cart'][$x2]['id_book']);
        // }
        // $id_b = implode(',',$new_id);
        
        $no = sprintf('%010d',$id);
        $create_order = date('Y-m-d h:i:s');
        $sqlinsert = "INSERT INTO `order` (`no_order`, `id_user`, `total_amount`, `status_order`,`create_order`) 
        VALUES ('{$no}',{$id_user},{$numall}, '01','{$create_order}');";
        if ($conn->query($sqlinsert) === TRUE) {
            $last_id = $conn->insert_id;
            echo "New record created successfully ".$last_id;
            for ($x2 = 0; $x2 < count($_SESSION['cart']); $x2++) {
                $id_book = $_SESSION['cart'][$x2]["id_book"];
                $sql = "SELECT *
                FROM book JOIN catergory ON book.id_cate = catergory.id_cate
                WHERE id_book = {$id_book}";
                $result3 = mysqli_query($conn, $sql);
            
                if (mysqli_num_rows($result3) > 0) {
                    // output data of each row
                    while($row4 = mysqli_fetch_assoc($result3)) {
                    $dayes = pustDate($row4['date_borrow']);
                      echo $dayes;
                        $amount = $_SESSION['cart'][$x2]["num"];
                        $sqlinsertDetail = "INSERT INTO `order_detail`(`id_order`, `id_book`, `date_borrow`, `amount_order`, `status_order_detail`) 
                        VALUES ({$last_id},{$id_book},'{$dayes}',{$amount},'01');";
                        $inSert_true = $conn->query($sqlinsertDetail);
                        echo "insert ".$inSert_true;
                    }
                } else {
                    echo "0 results";
                }
               
            }
            $_SESSION['cart'] = array();
            header('Location:/bookview/summary.php?success='.$no);
        
        } else {
            echo "Error: " . $sqlinsert . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    
}

function pustDate($var)
{
    $date = "04-15-2013";
    $date1 = date("m/d/Y");
    $tomorrow = date('Y-m-d',strtotime($date1 . "+$var days"));
    return $tomorrow;
}
if(isset($_POST["edit_status_order"])){
    $sqlupdate = "UPDATE `order`
    SET status_order = '{$_POST['status_order']}'
    WHERE id_order = {$_POST['id_order']};";
    $sqlupdate2 = "UPDATE `order_detail`
    SET status_order_detail = '{$_POST['status_order']}'
    WHERE id_order = {$_POST['id_order']};";
    if ($conn->query($sqlupdate) === TRUE) {
       if ($conn->query($sqlupdate2) === TRUE) {
        header('Location:/bookview/manage_booking.php');
       }
    } else {
        echo "Error: " . $sqlupdate . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}

if(isset($_GET["check"])){
    $total = 0;
    $sql = "SELECT *
    FROM order_detail 
    WHERE id_detail IN ({$_GET["check"]})";
    $result3 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result3) > 0) {
        // output data of each row
        while($row4 = mysqli_fetch_assoc($result3)) {
            if (date($row4['date_borrow']) < date("Y-m-d")) {
                $date1=date_create(date("Y-m-d"));
                $date2=date_create($row4['date_borrow']);
                $diff=date_diff($date1,$date2);
                $dif= $diff->format("%d");
                echo $dif;
                $total += $dif;
                
            }
            $id_o = $row4['id_order'];
            $sql2 = "UPDATE order_detail 
            SET status_order_detail = '10'
            WHERE id_detail = {$row4['id_detail']}";
            $result4 = mysqli_query($conn, $sql2);
        }
        $total*=5;
       
        if($total == 0){
            $sql3 = "UPDATE `order` 
            SET status_order = '10'
            WHERE id_order = {$id_o}";
            $result5 = mysqli_query($conn, $sql3);
        }
        if($total > 0){
            $sql3 = "UPDATE `order` 
            SET status_order = '12'
            WHERE id_order = {$id_o}";
            $result5 = mysqli_query($conn, $sql3);
        }


        header("Location:/bookview/order-detail.php?id_order={$_GET["id_order"]}&total={$total}");
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
}
if(isset($_GET["status_re"])){
    $sql3 = "UPDATE order_detail 
    SET status_order_detail = '11'
    WHERE id_order = {$_GET["id_order"]} AND status_order_detail = '10'";
    $result5 = mysqli_query($conn, $sql3);
   
    $sql = "SELECT *
    FROM order_detail 
    WHERE id_order = {$_GET["id_order"]} AND status_order_detail != '11'";
    $result3 = mysqli_query($conn, $sql);
    $product_cart = array();
    if (mysqli_num_rows($result3) > 0) {
        // output data of each row
        $sql4 = "UPDATE `order` 
        SET status_order = '13'
        WHERE id_order = {$_GET["id_order"]} ";
        $result5 = mysqli_query($conn, $sql4);
        header('Location:/bookview/manage_booking.php');
    } else {
        $sql4 = "UPDATE `order` 
        SET status_order = '11'
        WHERE id_order = {$_GET["id_order"]} ";
        $result5 = mysqli_query($conn, $sql4);
        header('Location:/bookview/manage_booking.php');
    }
}

?>