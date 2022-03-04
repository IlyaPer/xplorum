/**
Перед запуском:
> npm install ws
Далее:
> node server_websocket.js
> откройте http://localhost:8080 в вашем браузере
*/

const http = require('http');
const fs = require('fs');
const ws = new require('ws');

const wss = new ws.Server({noServer: true});

const clients = new Set();
const socket = new WebSocket('ws://localhost:8080');

// Соединение открыто
socket.addEventListener('open', function (event) {
  socket.send('Hello Server!');
});

// Наблюдает за сообщениями
socket.addEventListener('message', function (event) {
  console.log('Message from server ', event.data);
});


function onSocketConnect(ws) {
  clients.add(ws);
  log(`новое подключение`);

  ws.on('сообщение', function(message) {
    log(`получено сообщение: ${message}`);

    message = message.slice(0, 50); // максимальная длина сообщения 50

    for(let client of clients) {
      client.send(message);
    }
  });

  ws.on('закрыть', function() {
    log(`подключение закрыто`);
    clients.delete(ws);
  });
}

let log;
if (!module.parent) {
  log = console.log;
  http.createServer(accept).listen(8080);
} else {
  // для размещения на javascript.info
  log = function() {};
  // log = console.log;
  exports.accept = accept;
}
