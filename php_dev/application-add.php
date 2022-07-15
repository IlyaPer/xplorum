<?php
  require_once("init.php");
  require_once("function.php");
    if (strlen($_POST['app-title']) > 5 & strlen($_POST['app-title']) < 500 & strlen($_POST['app-description']) > 5 & strlen($_POST['app-description']) < 500) {
      $new_info = [$_POST['app-title'], $_POST['app-description'], $url, $user_id, $_POST['app-subject']];
      $sql = "INSERT INTO applications (date_creation, title, content, url, user_id, subject_id) VALUES (NOW(), ?, ?, ?, ?, ?);";
      $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
      $res = mysqli_stmt_execute($stmt);
      if ($res) {
        header("Location: user-apps.php?id=" . $user_id);
      } else {
        print(mysqli_error($connection));
      }
    }
    else {
      die("error");
    }
?>
