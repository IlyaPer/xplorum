<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div class="window-wrapper">
  <div class="chat__window" id="dialogs">
    <div class="chat__conversation-list">
      <h2 class="chat__conversation-title">Сообщения</h2>
      <ul class="chat__people-list">
        <?php foreach($all_messages as $info): ?>
        <li class="chat__conversation-area"><a class="chat__conversation-text" href="#" id="<?= $info['id']; ?>"><?= htmlspecialchars($info['name']); ?></li>
        <?php endforeach; ?>
        <li class="chat__conversation-area"><a class="chat__conversation-text" href="#">Техподдержка</a></li>
      </ul>
    </div>
  </div>
  <div class="chat__area" id="chat-area">
    <a class="chat__conversation-href" href="chat.php?userid=<?= $user_id ?>">Назад</a>
    <div class="chat__conversation-title"><b>Диалог:</b><i class="fa fa-search"></i></div>
    <div class="chat-list">
      <ul class="chat__main-dialog" id="chat">
        <script>
          let screenWidth = document.documentElement.clientWidth;
          var userid;
          var receiver_id;
          var update_fetchurl;
          var myNode = document.getElementById("chat");
          let active = 0;
          var count;
          let user_img = $(".main-header__photo").attr("src");

          $('.chat__conversation-text').on("click", function() {
            document.getElementById('messForm').style.display = "flex";
            if (screenWidth <= 450) {
              document.getElementById('dialogs').style.display = "none";
              document.getElementById('chat-area').style.display = "block";
            }
            receiver_id = $(this).attr('id');
            if (active === 1) {
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
            }
            active = 1;
            const fetchurl = new URLSearchParams({
              receiverid: receiver_id
            });
            update_fetchurl = "set/update_chat.php?" + fetchurl;

              fetch('set/session.php')
                .then((arr) => {
                  return arr.text();
                })
                .then((data) => {
                  userid = data;
                  //alert("user id: " + userid);

                  fetch('set/get_chat.php?' + fetchurl)
                    .then((arr) => {
                      return arr.json();
                    })
                    .then((data) => {
                      for (let i = 0; i < data.length; i++) {
                        if (data[i].reciever_id !== userid) {
                          let li = document.createElement('li');
                          li.className = "chat__mini-container chat__mini-container--user";
                          li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"" + user_img + "\">";
                          $chat.prepend(li);
                          continue;
                        }
                        else if (data[i].reciever_id === userid) {
                          let li = document.createElement('li');
                          li.className = "chat__mini-container";
                          li.innerHTML = "<div class=\"chat__message chat__message--sender\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"" + data[i].url + "\">";
                          $chat.prepend(li);
                          continue;
                        }
                        else if (data[i].user_id !== userid) {
                          let li = document.createElement('li');
                          li.className = "chat__mini-container";
                          li.innerHTML = "<div class=\"chat__message chat__message--sender\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"" + data[i].url + "\">";
                          $chat.prepend(li);
                          continue;
                        }
                        else if (data[i].user_id === userid) {
                          let li = document.createElement('li');
                          li.className = "chat__mini-container chat__mini-container--user";
                          li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"" + user_img + "\">";
                          $chat.prepend(li);
                        }
                        count = i;
                      }
                    })
                })

              setInterval(function() {
                let count = $('#chat').children('li').length;
                let i = 0;
                let url = new URLSearchParams({
                  receiverid: receiver_id,
                  offset: count
                });
                let get_fetch = "set/get_chat.php?" + url;
                if (active === 1) {
                  fetch(get_fetch)
                    .then((arr) => {
                       return arr.json();
                    })
                    .then((data) => {
                      if (data["status"] !== 200 && data !== 200) {
                        const $chat = document.querySelector('#chat');
                        let li = document.createElement('li');
                        while (i < data.length) {
                          if (data[i].user_id === userid) {
                              li.className = "chat__mini-container";
                          } else {
                            li.className = "chat__mini-container";
                          }
                          li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
                          $chat.append(li);
                          i++
                        }
                      }
                    })
                }
              }, 15000);
          });
          const $chat = document.querySelector('#chat');
          function sendmes() {
            $.ajax({
              url: update_fetchurl,
              type: "POST",
              cashe: false,
              data:{ content:$('#content').val() }, // Отправка
              success:
                function (data) {
                  let li = document.createElement('li');
                  li.className = "chat__mini-container chat__mini-container--user";
                  li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"" + user_img + "\">";
                  $chat.append(li);
                },
              error: function () {
                alert("Error 403. Fatal.");
              }
            });
            $("#content").val("");
          }
        </script>
      </ul>
      <div class="chat__form hide" id="messForm" style="display: none;">
        <input class="chat__input" type="text" placeholder="Введите сообщение" name="content" id="content">
        <button class="chat__form-img" id="submit" onclick="sendmes()">Send</button>
      </div>
    </div>
  </div>
