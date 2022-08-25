<?php
    require_once("../init.php");
    require_once("../function.php");

    $feedback = $_POST;
    $errors = [];
    $rules = [
      'content' => function(){
        if(!validateFilled('content')){
          return "error";
        }
      }
    ];
    if (isset($_POST)) {
      foreach ($feedback as $key => $value) {
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
      $new_info = [$_SESSION["user_id"], $feedback['feed_content'], $_SESSION['toWrite']];
      $sql = "INSERT INTO feedbacks (`date_creation`, `author_id`, `content`, `user_id`) VALUES (NOW(), ?, ?, ?);";
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
