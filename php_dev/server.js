// const express = require('express')
// const app = express()
// const passport = require('passport')
// const session = require('express-session')
// const bcrypt = require('bcrypt')
const http = require('http');
const WebSocketServer = require("websocket").server;
let connection = null;

const httpserver = http.createServer((req, res) =>{

  console.log("recieved a request");
})


const websocket = new WebSocketServer({
  "httpServer": httpserver
})

websocket.on("request", request=> {

  connection = request.accept(null, request.origin);
  connection.on("open", () => console.log("connection is opened"));
  connection.on("close", () => console.log("connection is closed"));
  connection.on("message", message => {
    console.log(`Recieved a message from client: ${message.utf8}`)
  })
})

httpserver.listen(8080, () => console.log("my server is listening on port 8080"))

// const initializePassport = require('./passport-config');
// initializePassport(
//   passport,
//   email => users.find(user => users.email === email),
//   id => users.find(user => users.id === id)
// )

// app.use(session({
//   secret: process.env.SESSION_SECRET,
//   resave: false,
//   saveUninitialized: false
// }))
//
//
// const host = 'localhost';
// const port = 40;
//
// const requestListener = function (req, res) {
//   res.setHeader("Content-Type", "application/json");
//   res.writeHead(200);
//   res.end(`{"message": "This is a JSON response"}`);
// };
//



// const options = {
//   hostname: 'localhost',
//   port: '',
//   path: 'http://taifun/php_dev/set/session.php',
//   method: 'GET'
// }

// const req = http.request(options, res => {
//   console.log(`statusCode: ${res.statusCode}`)
//   console.log(options.path);
//
//   req.responseType = 'json';
//   res.on('data', d => {
//     process.stdout.write(d)
//   })
// })

// req.on('error', error => {
//   console.error(error)
//   console.error("Ошибка дебильная где-то.")
// })
//
// req.end();

// Работа с БД

// var mysql = require("mysql");
// var getUserJson = require('mysql-json');
//
// var getUserJson = mysql.createConnection({
//   "host": "localhost",
//   "user": "root",
//   "password": "",
//   "database": "taifun"
// });
//
// let user_email = "test1@test.ru"
// let password = "123";
// //const isValid = await bcrypt.compare(user.2, hashedPassword);
//
// getUserJson.connect(function(err) {
//   if (err) {
//     return console.error("Ошибка: " + err.message);
//   } else {
//     console.log("Подключение к серверу MySQL успешно установлено.");
//     getUserJson.query("SELECT * FROM users WHERE email = ?;", user_email, function(err, response) {
//       if(err) console.log(err);
//       console.log(response)
//       console.log(response.RowDataPacket.email)
//       if (response.email != null) {
//         bcrypt.compare(password, response.password, function(err, res) {
//             console.log("Password is correct")
//         });
//       }
//     });
//   }
// });


// Подключаем библиотеку для работы с WebSocket
// const WebSocket = require('ws');
// // Создаём подключение к WS
// let wsServer = new WebSocket.Server({
//   port: 8081
// });
// // Создаём массив для хранения всех подключенных пользователей
// let users = []
//
// // Проверяем подключение
// wsServer.on('connection', function (ws) {
//   console.log("Web-socket connection established");
//   let user = {
//     connection: ws
//   }
//   // Добавляем нового пользователя ко всем остальным
//   users.push(user)
//   // Получаем сообщение от клиента
//   ws.on('message', function (message) {
//     console.log(message);
//     // Перебираем всех подключенных клиентов
//     for (let u of users) {
//       // Отправляем им полученное сообщения
//       u.connection.send(message)
//     }
//   })
//   // Делаем действие при выходе пользователя из чата
//   ws.on('close', function () {
//     // Получаем ID этого пользователя
//     let id = users.indexOf(user)
//     // Убираем этого пользователя
//     users.splice(id, 1)
//     console.log("User disconnected");
//   })
// });
