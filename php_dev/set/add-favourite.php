<?php
  require_once("../init.php");
  require_once("../function.php");
  $user_id = $_SESSION['user_id'];
  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = intval($_POST['id']);
    $sql_check = "SELECT * FROM favourite_apps WHERE user_id = '$user_id' AND app_id = '$id'";
    $res = mysqli_query($connection, $sql_check);
    $apps = mysqli_fetch_all($res, MYSQLI_ASSOC);
    var_dump($res);
    if (!empty($apps[0])) {
      $sql_delete = "DELETE FROM favourite_apps WHERE user_id = '$user_id' AND app_id = '$id'";
      $res = mysqli_query($connection, $sql_delete);
    } else {
      $info = [$id, $_SESSION['user_id']];
      $sql = "INSERT INTO favourite_apps (user_id, app_id) VALUES (?, ?);";
      $stmt = db_get_prepare_stmt($connection, $sql, $info);
      $res = mysqli_stmt_execute($stmt);
      if (!$res) {
        print(mysqli_error($connection));
      }
    }
  }
?>
