<?php
  require_once("../init.php");
  require_once("../function.php");

  if(!empty($_POST['message'])) {
    $new_info = [$_SESSION["user_id"], intval($_POST['receiver']), $_POST['message']];
    $sql = "INSERT INTO messages (date_creation, user_id, reciever_id, content) VALUES (NOW(), ?, ?, ?);";
    $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
      $url = array(
        'userid' => $_POST['visitor'],
        'reciever' => $_POST['user_id']
      );
      $chat_href = "../chat.php?" . http_build_query($url, '', '&');
      header("Location:" . $chat_href);
    } else {
      print(mysqli_error($connection));
    }
  }
  ?>
