<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview | จัดการข้อความ</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
      <?php include 'component/slide_nav.php' ?>
      <div class="layout pt-0">
        <div class="container">
        <div class="row">
            <div class="col-4 pr-0">
                <div class="cart-list min-vh-100">
                <?php 
                 include "function/db_config.php";
                
                   $sql = "SELECT *
                   FROM `chat_room` 
                   JOIN user ON `chat_room`.id_user = user.id_user
                   ORDER BY update_at DESC
                    ";
                   $result = mysqli_query($conn, $sql); 
                   if (mysqli_num_rows($result) > 0) { 
                     while($row = mysqli_fetch_assoc($result)) {
                         echo "<a href='/bookview/manage_chat.php?room={$row["id_chat_room"]}'>
                            <div class='d-flex align-items-center click'>
                            <div class='image-cropper border-0 profile admin'>
                                <img src='{$row["profile"]}' class='rounded' />
                            </div>
                            <div class='d-flex justify-content-between w-100 align-items-center ml-2' >
                                <div  >
                                    <h5 class='m-0'>{$row["first_name"]} {$row["last_name"]}</h5>
                                    <span class='m-0'>{$row["update_at"]}</span>
                                </div>";
                                if(isset($_GET['room']) &&$_GET['room']== $row["id_chat_room"]) { 
                                    echo "<i class='fas fa-angle-right'></i>";
                                }
                          echo "</div>
                        </div>
                        <hr></hr></a>
                         ";
                     }
                    }
                
                ?>
                    


                </div>
            </div>
            <div class="col-8">
                <div class="card card-prirary cardutline direct-chat direct-chat-primary ">
                    <div class="card-header admin">
                        <h4 class="card-title m-0">Direct Chat</h4>
                    </div>
                    <div class="card-body">
                        <div class="direct-chat-messages admin" id="direct-chat-messages">
                            <?php
                                if(isset($_GET['room'])) { 
                                    $sql2 = "SELECT *
                                    FROM `messages` 
                                    LEFT  JOIN user ON `messages`.send_by = user.id_user
                                    WHERE id_chat_room={$_GET['room']} ORDER BY chat_create_at ASC ";
                                    $result2 = mysqli_query($conn, $sql2); 
                                    if (mysqli_num_rows($result2) > 0) { 
                                    while($row2 = mysqli_fetch_assoc($result2)) { 

                                        if ($row2["send_by"] == "admin" || $row2["send_by"] == "Bot" ) {
                                            $t1 ="right";
                                            $t2 ="float-right";
                                            $t3 ="float-left";
                                            $t4 ="Super Admin";
                                            $t5 ="/bookview/images/icon_user.png";
                                        } else {
                                            $t1 ="";
                                            $t2 ="float-left";
                                            $t3 ="float-right";
                                            $t4 =$row2["first_name"]." ".$row2["last_name"];
                                            $t5 =$row2['profile'];
                                           
                                        }
                                        
                                        echo"
                                        <div class='direct-chat-msg {$t1}'>
                                        <div class='direct-chat-infos clearfix'>
                                            <span class='direct-chat-name {$t2}'>{$t4}</span>
                                            <span class='direct-chat-timestamp {$t3}'>
                                            
                                            <script type='text/javascript'>   
                                            function tDays(days) {
                                                const copy = new Date(days);
                                            
                                                
                                                    var thday = new Array ('อาทิตย์','จันทร์',
                                                    'อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
                                                    var thmonth = new Array ('ม.ค.','ก.พ.','มี.ค.',
                                                    'เม.ย.','พ.ค.','มิ.ย.', 'ก.ค.','ส.ค.','ก.ย.',
                                                    'ต.ค.','พ.ย.','ธ.ค.');
                                    
                                                    document.write( copy.getDate()+ ' ' + thmonth[copy.getMonth()]+ ' '+copy.getHours()+ ':'+copy.getMinutes());
                                                return copy;
                                                } 
                                                tDays('{$row2["chat_create_at"]}')
                                            </script>
                                            </span>
                                        </div>
                                        <img class='direct-chat-img' src='{$t5}' alt='Message User Image'>
                                        <div class='direct-chat-text'>
                                        {$row2["message"]}
                                        </div>
                                        </div>
                                        ";
                                    }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="card-footer admin"> 
                        <div class="input-group">
                            <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-book" onClick="sendMessage()">Send</button>
                            </span>
                        </div>
                    </div>
            </div> 
            </div>
        </div>
</div>
      </div>
      <script>
          var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php"); 
          const msgDCM = document.getElementById("direct-chat-messages")
        websocket.onopen = function(event) { 
          console.log("Connection is established!");		
        }
        websocket.onmessage = function(event) {
          var Data = JSON.parse(event.data);
            var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log('this.responseText', this.responseText)
                    const tmp =this.responseText;
        
                    msgDCM.innerHTML=tmp
                    msgDCM.scrollTop = msgDCM.scrollHeight;
                    // console.log('object a')
                }
              };
              xmlhttp.open("GET", "/bookview/function/fn_message.php?get_admin=1&room="+<?=$_GET['room']?>, true);
              xmlhttp.send();
          
        };
        
        websocket.onerror = function(event){
          console.log("Problem due to some Error");
        };
        websocket.onclose = function(event){
          console.log("Connection Closed");
        }; 
        
     
        msgDCM.scrollTop = msgDCM.scrollHeight;
        
        function sendMessage() {
          const msgTxt = document.querySelector("#message").value;
          if (msgTxt) {
            let date1=tDays();
            msgDCM.innerHTML+="<div class='direct-chat-msg right'>"+
                  "<div class='direct-chat-infos clearfix'>"+
                   " <span class='direct-chat-name float-right'>Super Admin</span>"+
                   " <span class='direct-chat-timestamp float-left'>"+date1+"</span>"+
                 " </div>"+
                " <img class='direct-chat-img' src='/bookview/images/icon_user.png' alt='Message User Image'>"+
                 " <div class='direct-chat-text'>"+
                 msgTxt+
                 " </div>"+
               " </div>";
              
               msgDCM.scrollTop = msgDCM.scrollHeight;
               document.querySelector("#message").value = ""
           
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  console.log('this.responseText', this.responseText)
                  var messageJSON = {
                    chat_user: "ttt",
                    chat_message: "ttt"
                  };
                  websocket.send(JSON.stringify(messageJSON));
                // let tmp = JSON.parse(this.responseText);
                //   addDIV(tmp.data.message); 
                  
                  // document.getElementById("txtHint").innerHTML = this.responseText;
                }
              };
              xmlhttp.open("GET", "/bookview/function/fn_message.php?q="+msgTxt+"&room="+<?=$_GET['room']?>+"&admin=1", true);
              xmlhttp.send();
           
          }
        }
        
        function tDays() {
            const copy = new Date();
                var thday = new Array ('อาทิตย์','จันทร์',
                'อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
                var thmonth = new Array ('ม.ค.','ก.พ.','มี.ค.',
                'เม.ย.','พ.ค.','มิ.ย.', 'ก.ค.','ส.ค.','ก.ย.',
                'ต.ค.','พ.ย.','ธ.ค.');

                let aaldate = copy.getDate()+ ' ' + thmonth[copy.getMonth()]+ ' '+copy.getHours()+ ':'+copy.getMinutes()
            return aaldate;
        
        } 
    </script>

  </body>
</html>