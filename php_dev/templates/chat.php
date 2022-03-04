<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="../node_modules/socket.io.js"></script>-->

<!--<script>-->
<!--  // creating io instance-->
<!--  var io = io("http://localhost:3000");-->
<!---->
<!--  var receiver = "";-->
<!--  var sender = "";-->
<!---->
<!--</script>-->
<div class="window-wrapper">
  <div class="chat__window">
    <div class="chat__conversation-list">
      <h2 class="chat__conversation-title">Сообщения</h2>
      <ul class="chat__people-list">
        <?php foreach($all_messages as $info): ?>
        <li class="chat__conversation-area"><a class="chat__conversation-text" href="#" id="<?= $info['id']; ?>"><?= $info['name']; ?></li>
        <?php endforeach; ?>
        <li class="chat__conversation-area"><a class="chat__conversation-text" href="#">Техподдержка</a></li>
      </ul>
    </div>
  </div>
  <div class="chat__area" id="chat-area">
    <div class="chat__conversation-title"><b>Диалог:</b><i class="fa fa-search"></i></div>
    <div class="chat-list">
      <ul class="chat__main-dialog" id="chat">
        <script>
          var full_fetchurl = '';
          var update_fetchurl = '';
          var userid = 1;
          var chat_id = 0;

          $('.chat__conversation-text').on("click", function(){
            if (chat_id === 0) {
              chat_id = $(this).attr('id'); //let && const
              urluserid = window.location.search.split('&');
              userid = parseInt(urluserid[0].match(/\d+/));
              const chat_urls = new URLSearchParams({
                userid: userid,
                recieverid: chat_id
              });
              var url = "chat.php?" + chat_urls;

              urls = url.split('&');
              var userid = parseInt(urls[0].match(/\d+/));
              var recieverid = parseInt(urls[1].match(/\d+/));
              alert(recieverid);

              const fetchurl = new URLSearchParams({
                userid: userid,
                recieverid: recieverid
              });

                // let class_chat = document.getElementsByClassName('chat');
                //
                // while(class_chat[0]) {
                //   class_chat[0].parentNode.removeChild(class_chat[0]);
                // }
              let li = document.querySelectorAll('#message');
              for (let i = 0, len = li.length; i < len; i++) {
                li[i].onclick = function() {
                  console.log('parentNode', this.parentNode);
                  console.log('element => this', this);
                  this.parentNode.removeChild(this);
                }
              }

                full_fetchurl = "set/get_chat.php?" + fetchurl;
                update_fetchurl = "set/update_chat.php?" + fetchurl;

                let i = 0;

                fetch(full_fetchurl);
                fetch('set/results.json')
                  .then((arr) => {
                    return arr.json();
                  })
                  .then((data) => {
                    const $chat = document.querySelector('#chat');
                    while (i < data.length) {
                      const li = document.createElement('li');
                      li.className = "chat__mini-container chat__mini-container--user";
                      li.innerHTML = "<div class=\"chat__message\" id=\"message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
                      $chat.prepend(li);
                      i++;
                    }
                    c = i;
                  });
              }
            else {

            }
          });

          // INCORRECT
          // var url = window.location.href.toString();
          // urls = window.location.search.split('&');
          // var userid = parseInt(urls[0].match(/\d+/));
          // var recieverid = parseInt(urls[1].match(/\d+/));
          //
          // const fetchurl = new URLSearchParams({
          //            userid: userid,
          //            recieverid: recieverid
          // });
          //
          // var full_fetchurl = "set/get_chat.php?" + fetchurl;
          // var update_fetchurl = "set/update_chat.php?" + fetchurl;
          //
          data = 0;
          function chat() {
            $.ajax({
              url: update_fetchurl,
              type: "POST",
              cashe: false,
              data:{ content:$('#content').val() }, // Отправка
              success:
                function (data) {
                  $('#one').html(data);
                },
              error: function () {
                alert("Error");
              }
            });
          }
          var c = 0;

          setInterval(function() {
            if (full_fetchurl !== '') {
            fetch(full_fetchurl);
            fetch('set/results.json')
              .then((arr) => {
                return arr.json();
              })
              .then((data) => {
                const $chat = document.querySelector('#chat');
                if (c < data.length) {
                  let li = document.createElement('li');
                  li.className = "chat__mini-container chat__mini-container--user";
                  li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[0].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
                  c++;
                  $chat.prepend(li);
                }
              })
          }
          }, 5000);

          $('#' + userid).bind('click', function(event) {

            setInterval(function() {
              fetch(full_fetchurl);
              fetch('set/results.json')
                .then((arr) => {
                  return arr.json();
                })
                .then((data) => {
                  const $chat = document.querySelector('#chat');
                  if (c < data.length) {
                    let li = document.createElement('li');
                    li.className = "chat__mini-container chat__mini-container--user";
                    li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[0].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
                    c++;
                    $chat.prepend(li);
                  }
                })
            }, 5000);
          });

          // function chat() {
          //   $.ajax({
          //     url: update_fetchurl,
          //     type: "POST",
          //     cashe: false,
          //     data:{ content:$('#content').val() }, // Отправка
          //     success:
          //       function (data) {
          //         $('#one').html(data);
          //       },
          //     error: function () {
          //       alert("Error");
          //     }
          //   });
          // }
          //
          // var c = 0;
          //
          // setInterval(function() {
          //   fetch(full_fetchurl);
          //   fetch('set/results.json')
          //     .then((arr) => {
          //       return arr.json();
          //     })
          //     .then((data) => {
          //       const $chat = document.querySelector('#chat');
          //       if (c < data.length) {
          //         let li = document.createElement('li');
          //         li.className = "chat__mini-container chat__mini-container--user";
          //         li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[0].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
          //         c++;
          //         $chat.prepend(li);
          //       }
          //     })
          // }, 2000);

          // setInterval(function() {
          //   fetch(full_fetchurl);
          //   fetch('set/results.json')
          //     .then((arr) => {
          //       return arr.json();
          //     })
          //     .then((data) => {
          //       const $chat = document.querySelector('#chat');
          //       if (i <= data.length) {
          //         let li = document.createElement('li');
          //         li.className = "chat__mini-container chat__mini-container--user";
          //         li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
          //         $chat.prepend(li);
          //         i++;
          //       }
          //     })
          // }, 2000);

          // data = 0;
          // var i = 0;
          //
          // fetch(full_fetchurl);
          // fetch('set/results.json')
          //   .then((arr) => {
          //     return arr.json();
          //   })
          //   .then((data) => {
          //     const $chat = document.querySelector('#chat');
          //     while (i < data.length) {
          //       const li = document.createElement('li');
          //       li.className = "chat__mini-container chat__mini-container--user";
          //       li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
          //       $chat.prepend(li);
          //       i++;
          //     }
          //   })
          //
          // var i = 0;
          // setInterval(function() {
          //   fetch(full_fetchurl);
          //   fetch('set/results.json')
          //     .then((arr) => {
          //       return arr.json();
          //     })
          //     .then((data) => {
          //       const $chat = document.querySelector('#chat');
          //       if (i < data.length) {
          //         let li = document.createElement('li');
          //         li.className = "chat__mini-container chat__mini-container--user";
          //         li.innerHTML = "<div class=\"chat__message\"><p class=\"chat__message-text\">" + data[i].content + "</p><span class=\"msg-time\"></span></div><img class=\"chat__photo\" src=\"img/elenasportmachen.jpg\">";
          //         $chat.prepend(li);
          //         i++;
          //       }
          //     })
          // }, 5000);
        </script>
      </ul>
      <div class="chat__form"  id="form" style="position: absolute;">
        <input class="chat__input" type="text" placeholder="Введите сообщение" name="content" id="content">
        <button class="chat__submit" id="submit" onclick="chat()">Отправить</button>
      </div>
      <div id="one" style="position: absolute; background-color: #4DE55D;">
        Hello
      </div>
    </div>
  </div>
