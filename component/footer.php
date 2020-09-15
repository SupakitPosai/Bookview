<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookview</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
  </head>
  <body>
    
    <footer >
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="##"> Bookview.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <div class="chat-layout">
        <div class="message-box"> 
          <div class="card card-prirary cardutline direct-chat direct-chat-primary">
            <div class="card-header">
              <h4 class="card-title m-0">Direct Chat</h4>
            </div>
            <div class="card-body">
              <div class="direct-chat-messages" id="direct-chat-messages">

              <?php 
                include "function/db_config.php";
                if(isset($_SESSION['user_id'])) { 
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
                              $t5 =$_SESSION['profile'] ? $_SESSION['profile'] :' /bookview/images/icon_user.png';
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
                  }
                }
              ?>
                
              </div>
            </div>
            <div class="card-footer">
              <div class="input-group">
                <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                  <button type="button" class="btn btn-book" onClick="sendMessage()">Send</button>
                </span>
              </div>
            </div>
          </div> 
        </div>
        <div class="d-flex justify-content-end">
          <div class="message-cricle">
            <i class="far fa-comment"></i>
            <i class="far fa-times-circle"></i>
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
                 
                  if (this.responseText ) {
                    const tmp =this.responseText;
                    msgDCM.innerHTML = tmp
                    msgDCM.scrollTop = msgDCM.scrollHeight;
                    // console.log('object u')
                  }
                  
                }
              };
              xmlhttp.open("GET", "/bookview/function/fn_message.php?get_user=1", true);
              xmlhttp.send();
          
        };
        
        websocket.onerror = function(event){
          console.log("Problem due to some Error");
        };
        websocket.onclose = function(event){
          console.log("Connection Closed");
        }; 
        
      	
          
       
        const msgb = document.querySelector(".message-box");
        const msgc = document.querySelector(".message-cricle");
       
        msgc.addEventListener("click", clickMsg);
        
        function clickMsg() {
          if(msgc.classList.contains("active")){
            msgb.classList.remove('active');
            msgc.classList.remove('active');
          }else{
            msgb.classList.add('active');
            msgc.classList.add('active');
            msgDCM.scrollTop = msgDCM.scrollHeight;
          }
        }
        function sendMessage() {
          const msgTxt = document.querySelector("#message").value;
          if (msgTxt) {
            

            // var node = document.createElement("DIV");
            // var textnode = document.createTextNode(msgTxt);
            // node.appendChild(textnode);
            // node.className ="direct-chat-msg"
            let date1=tDays();
            msgDCM.innerHTML+="<div class='direct-chat-msg right'>"+
                  "<div class='direct-chat-infos clearfix'>"+
                   " <span class='direct-chat-name float-right'><?=$_SESSION['name']?></span>"+
                   " <span class='direct-chat-timestamp float-left'>"+date1+"</span>"+
                 " </div>"+
                " <img class='direct-chat-img' src='<?= $_SESSION['profile'] ? $_SESSION['profile'] :' /bookview/images/icon_user.png'?>' alt='Message User Image'>"+
                 " <div class='direct-chat-text'>"+
                 msgTxt+
                 " </div>"+
               " </div>";
              
               msgDCM.scrollTop = msgDCM.scrollHeight;
               document.querySelector("#message").value = ""
            setTimeout(function(){
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  console.log('this.responseText', this.responseText)
                  if (this.responseText) {
                    let tmp = JSON.parse(this.responseText);
                  addDIV(tmp.data.message); 
                  }
                  
                  var messageJSON = {
                    chat_user: "ttt",
                    chat_message: "ttt"
                  };
                  websocket.send(JSON.stringify(messageJSON));
                  // document.getElementById("txtHint").innerHTML = this.responseText;
                }
              };
              xmlhttp.open("GET", "/bookview/function/fn_message.php?q="+msgTxt+"&id="+<?=$_SESSION['user_id']?>+"&user=1", true);
              xmlhttp.send();
            }, 1000);
          }
        }
        function addDIV(txt) {
          let date1=tDays();
          const msgDCM = document.getElementById("direct-chat-messages")
            msgDCM.innerHTML+="<div class='direct-chat-msg'>"+
                  "<div class='direct-chat-infos clearfix'>"+
                   " <span class='direct-chat-name float-left'>Super Addmin</span>"+
                   " <span class='direct-chat-timestamp float-right'>"+date1+"</span>"+
                 " </div>"+
                " <img class='direct-chat-img' src='/bookview/images/icon_user.png' alt='Message User Image'>"+
                 " <div class='direct-chat-text'>"+
                 txt+
                 " </div>"+
               " </div>";
               msgDCM.scrollTop = msgDCM.scrollHeight;
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
