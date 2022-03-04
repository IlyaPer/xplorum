<?php
  require_once("init.php");
  require_once("function.php");

  $new_info = [$_GET['title'], $_GET['content'], $_GET['url'], $user_id, $_GET['subject']];
  $sql = "INSERT INTO answers (`date_creation`, `content`, `user_id`, `question_id`) VALUES (NOW(), ?, ?, ?);";
  $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
  $res = mysqli_stmt_execute($stmt);
  if ($res) {
    $que_id = mysqli_insert_id($connection);
    header("Location: question.php?id=" . $que_id);
  } else {
    print(mysqli_error($connection));
  }

  ?>
