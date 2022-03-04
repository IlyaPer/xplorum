<?php
  require_once("../init.php");
  require_once("../function.php");

  $id = intval($_SESSION['user_id']) ?? 0;
  $reciever_id = intval($_GET['receiverid']);

  $message = $_POST;
  print($_POST['content']);
  $errors = [];
  $rules = [
    'content' => function(){
      if(!validateFilled('content')){
        return "error";
      }
    }
  ];
  if (isset($_POST)) {
    foreach ($message as $key => $value) {
      if (isset($rules[$key])) {
        $rule = $rules[$key];
        $result = $rule($value);
        if ($result !== null) {
          $errors[$key] = $result;
        }
      }
    }
  }
 // if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && empty($errors)) {
    if (empty($errors)) {
      $new_info = [$id, $reciever_id, $_POST['content']];
      $sql = "INSERT INTO messages (`date_creation`, `user_id`, `reciever_id`, `content`) VALUES (NOW(), ?, ?, ?);";
      $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
      $res = mysqli_stmt_execute($stmt);
      if ($res) {
        //print("Запрос отправлен");
      }
      if (!$res) {
        die("Фатальная ошибка");
      }
    }
  ?>
