<?php
  require_once("../init.php");
  require_once("../function.php");
  $id = intval($_POST['appId']);
  $receiverId = intval($_POST['receiverId']);
  var_dump($_POST);
  $bool = $_POST['delete'];
  if ($bool === "false") {
    $new_info = [$_SESSION['user_id'], $_POST['appId']];
    $sql = "INSERT INTO feeds (userId, appId) VALUES (?, ?);";
    $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
    $res = mysqli_stmt_execute($stmt);
    if (!$res) {
      print("error");
      exit;
    }
    $new_info = [$_SESSION['user_id'], $receiverId, "Привет! Нашел твою заявку!"];
    $sql = "INSERT INTO messages (`date_creation`, `user_id`, `reciever_id`, `content`) VALUES (NOW(), ?, ?, ?);";
    $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
    $res = mysqli_stmt_execute($stmt);
    if (!$res) {  //TODO LOGGING
      print("error");
      exit;
    }
    print("Ok! " . $res);
  }
  else {
    print("f");
    $sql = "DELETE FROM feeds WHERE userId = " . $_SESSION['user_id'] . " AND appId = " . $id . ';';
    $result = mysqli_query($connection, $sql); // DELETE MESSAGE!!!!!!!
    if (!$result) {
      print("error"); //TODO LOGGING
      exit;
    }
  }
?>
