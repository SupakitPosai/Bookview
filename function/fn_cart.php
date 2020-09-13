<?php

session_start();
// session_unset();
if(isset($_GET["add"])){
    $carts = array("id_book"=>$_GET["id_book"],"num"=>1);
    $y=0;
    if(isset($_SESSION['cart'])){
        for ($x = 0; $x < count($_SESSION['cart']); $x++) {
           
            if(array_search($_GET["id_book"],$_SESSION['cart'][$x]) == 'id_book'){
                $_SESSION['cart'][$x]["num"] += 1;
                $y += 1;
            }
        }
        if($y == 0){
            array_push($_SESSION['cart'],$carts);
        
        }
    }else{
        $_SESSION['cart'] = array ($carts); 
    }
}
if(isset($_GET["delete"])){
    for ($x2 = 0; $x2 < count($_SESSION['cart']); $x2++) {
        
        if(array_search($_GET["id_book"],$_SESSION['cart'][$x2]) == 'id_book'){
            
           
            array_splice($_SESSION['cart'],$x2,1);
        }
    }
    ;
}
if(isset($_GET["edit"])){
    for ($x3 = 0; $x3 < count($_SESSION['cart']); $x3++) {
        
        if(array_search($_GET["id_book"],$_SESSION['cart'][$x3]) == 'id_book'){
            
            $_SESSION['cart'][$x3]['num'] += $_GET["val"];
        }
    }
}
// echo  array_search($_GET["id_book"],$_SESSION['cart']);
header("Location:/bookview/cart.php"); 

// print_r($_SESSION['cart']);

?>