<?php 
    include "db_config.php"; 
    if (isset($_GET["user"])) {
        $id_user = $_GET["id"];
        $message =  $_GET["q"];
        
        
       $room = createChatRoom($conn);

        $upAt2 = date('Y-m-d h:i:s');
        $sqlinsertCh = "INSERT INTO messages ( `id_chat_room`, `send_to`, `send_by`, `message`, `chat_create_at`) 
        VALUES ({$room},'admin','{$id_user}','{$message}','{$upAt2}');";
        $resultInCh = mysqli_query($conn, $sqlinsertCh);

        $sqlCheck = "SELECT * FROM `messages` WHERE `id_chat_room`= '{$room}' AND `send_by` = 'admin'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        if (mysqli_num_rows($resultCheck) == 0) {
            $sql = "SELECT *
            FROM chat_bot ";
            $result3 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result3) > 0) {
            
                while($row = $result3->fetch_assoc()) {
                    $tmp = strstr( $message, $row["key"] );
                    // echo " ". $tmp." - - ".$row["key"]." -";
                    if ($tmp != "") {

                        $upAt3 = date('Y-m-d h:i:s');
                        $sqlinsertCh2 = "INSERT INTO messages ( `id_chat_room`, `send_to`, `send_by`, `message`, `chat_create_at`) 
                        VALUES ({$room},'{$id_user}','Bot','{$row["message_auto"] }','{$upAt3}');";
                        $resultInCh2 = mysqli_query($conn, $sqlinsertCh2);
                        

                        $arr_variable = array("id_user"=>$id_user,"message"=>$row["message_auto"] );
                        $data['data'] = $arr_variable;
                        // return print_r( $data);
                        echo json_encode($data);
                        exit;
                    }
                    
                }

                $sql2 = "SELECT *
                FROM chat_bot 
                WHERE `Key` = 'default'";
                $result4 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result4) > 0) {
                    while($row2 = $result4->fetch_assoc()) {

                        $upAt4 = date('Y-m-d h:i:s');
                        $sqlinsertCh4 = "INSERT INTO messages ( `id_chat_room`, `send_to`, `send_by`, `message`, `chat_create_at`) 
                        VALUES ({$room},'{$id_user}','Bot','{$row2["message_auto"] }','{$upAt4}');";
                        $resultInCh4 = mysqli_query($conn, $sqlinsertCh4);

                        $arr_variable = array("id_user"=>$id_user,"message"=>$row2["message_auto"]);
                        $data['data'] = $arr_variable;
                        // return print_r ($data);
                        echo  json_encode($data);
                        exit;
                    }
                    
                }
                
            } 
        }    
    }   
    
    if (isset($_GET["admin"])) {
        $room = $_GET["room"];
        $message =  $_GET["q"];
        $upAt2 = date('Y-m-d h:i:s');
        $sqlinsertCh = "INSERT INTO messages ( `id_chat_room`, `send_to`, `send_by`, `message`, `chat_create_at`) 
        VALUES ({$room},'user','admin','{$message}','{$upAt2}');";
        $resultInCh = mysqli_query($conn, $sqlinsertCh);

        $updateChatRoom = "UPDATE chat_room
             SET update_at = '{$upAt2}'
             WHERE id_chat_room = {$room}  ";
            $resultUp = mysqli_query($conn, $updateChatRoom);

    }


    function createChatRoom($conn)
    {
        $id_user = $_GET["id"];
        $sqlChatRoom = "SELECT * FROM chat_room WHERE id_user = {$id_user}  ";
        $resultCh = mysqli_query($conn, $sqlChatRoom);
        $upAt = date('Y-m-d h:i:s');
        if (mysqli_num_rows($resultCh) > 0) {
            
            $updateChatRoom = "UPDATE chat_room
             SET update_at = '{$upAt}'
             WHERE id_user = {$id_user}  ";
            $resultUp = mysqli_query($conn, $updateChatRoom);

            while($row2 = $resultCh->fetch_assoc()) {
                return $row2["id_chat_room"];
            }
        }else{

            $sqlinsert = "INSERT INTO chat_room ( `id_user`, `update_at`, `create_at`) 
            VALUES ({$id_user},'{$upAt}','{$upAt}');";
            $resultIn = mysqli_query($conn, $sqlinsert);
             return  $conn->insert_id;
        }
    }
    if (isset($_GET["get_user"])) {
        session_start();
          if(isset($_SESSION['user_id'])) { 
            $divvv = "";
            $sql = "SELECT *
            FROM `chat_room` 
            WHERE id_user={$_SESSION['user_id']} ";
            $result = mysqli_query($conn, $sql); 
            if (mysqli_num_rows($result) > 0) { 
              while($row = mysqli_fetch_assoc($result)) {
                  $sql2 = "SELECT *
                  FROM `messages` 
                  WHERE id_chat_room={$row["id_chat_room"]} ORDER BY chat_create_at ASC ";
                  $result2 = mysqli_query($conn, $sql2); 
                  if (mysqli_num_rows($result2) > 0) { 
                    while($row2 = mysqli_fetch_assoc($result2)) { 
                      if ($row2["send_by"] == "admin" || $row2["send_by"] == "Bot" ) {
                        $t1 ="";
                        $t2 ="float-left";
                        $t3 ="float-right";
                        $t4 ="Super Admin";
                        $t5 ="/bookview/images/icon_user.png";
                      } else {
                        $t1 ="right";
                        $t2 ="float-right";
                        $t3 ="float-left";
                        $t4 =$_SESSION['name'];
                        $t5 =$_SESSION['profile'];
                      }
                      
                      $divvv .="<div class='direct-chat-msg ".$t1."'>".
                      "<div class='direct-chat-infos clearfix'>".
                        " <span class='direct-chat-name ".$t2."'>".$t4."</span>".
                          "<span class='direct-chat-timestamp ".$t3."'>".
                          $row2["chat_create_at"].
                          "</span>".
                          "</div>".
                        "<img class='direct-chat-img' src='".$t5."' alt='Message User Image'>".
                        "<div class='direct-chat-text'>".
                         $row2["message"].
                         " </div>".
                     " </div>"
                      ;
                    }
                  }
              }
              echo $divvv;
            }
          }
        
    }
    
    if (isset($_GET["get_admin"])) { 
        if(isset($_GET['room'])) { 
            $divvv = "";
            $sqlyy = "SELECT *
            FROM `messages` 
            LEFT  JOIN user ON `messages`.send_by = user.id_user
            WHERE id_chat_room={$_GET['room']} ORDER BY chat_create_at ASC ";
            $resultyy = mysqli_query($conn, $sqlyy); 
            if (mysqli_num_rows($resultyy) > 0) { 
            while($rowyy = mysqli_fetch_assoc($resultyy)) { 

                if ($rowyy["send_by"] == "admin" || $rowyy["send_by"] == "Bot" ) {
                    $tyy1 ="right";
                    $tyy2 ="float-right";
                    $tyy3 ="float-left";
                    $tyy4 ="Super Admin";
                    $tyy5 ="/bookview/images/icon_user.png";
                } else {
                    $tyy1 ="";
                    $tyy2 ="float-left";
                    $tyy3 ="float-right";
                    $tyy4 =$rowyy["first_name"]." ".$rowyy["last_name"];
                    $tyy5 =$_SESSION['profile'] ? $_SESSION['profile'] :' /bookview/images/icon_user.png';
                    
                }
                
                $divvv .="<div class='direct-chat-msg ".$tyy1."'>".
                "<div class='direct-chat-infos clearfix'>".
                "<span class='direct-chat-name ".$tyy2."'>".$tyy4."</span>".
                    "<span class='direct-chat-timestamp ".$tyy3."'>".
                            $rowyy['chat_create_at'].
                            " </span>".
                            "</div>".
                            " <img class='direct-chat-img' src='".$tyy5."' alt='Message User Image'>".
                            " <div class='direct-chat-text'>".
                            $rowyy["message"].
                            "</div>".
                            " </div>";
            }
            echo $divvv;
            }
        }

       
    }
?>