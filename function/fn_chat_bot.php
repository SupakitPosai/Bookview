<?php
include "db_config.php"; 
if (isset($_GET["add_bot"])) {
    $upAt2 = date('Y-m-d h:i:s');
    $sqlinsertCh = "INSERT INTO chat_bot ( `key`, `message_auto`, `create_chat_bot`) 
    VALUES ('{$_POST["key"]}','{$_POST["message_auto"]}','{$upAt2}');";
    $resultInCh = mysqli_query($conn, $sqlinsertCh);
    header("Location:/bookview/manage_chat_bot.php"); 
}
if (isset($_GET["edit_bot"])) {
    if ($_GET["edit_bot"]==1) {
        $updateChatRoom = "UPDATE chat_bot
    SET `message_auto` = '{$_POST["message_auto"]}'
    WHERE id_chat_bot = {$_GET["edit_bot"]}  ";
    } else {
        $updateChatRoom = "UPDATE chat_bot
    SET `key` = '{$_POST["key"]}' , `message_auto` = '{$_POST["message_auto"]}'
    WHERE id_chat_bot = {$_GET["edit_bot"]}  ";
    }
    $resultUp = mysqli_query($conn, $updateChatRoom);
    header("Location:/bookview/manage_chat_bot.php"); 
}
if (isset($_GET["del_bot"])) {
        $sqlinsertCh = "DELETE FROM chat_bot WHERE id_chat_bot='{$_GET["del_bot"]}';";
        $resultInCh = mysqli_query($conn, $sqlinsertCh);
        header("Location:/bookview/manage_chat_bot.php"); 
}
?>