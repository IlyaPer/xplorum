<?php
  require_once("init.php");
  require_once("function.php");

  $new_info = [$_POST['que-title'], $_POST['que-description'], 'default', $_POST['user_id'], $_POST['que-subject']];
  $sql = "INSERT INTO questions (date_creation, title, description, url, user_id, subject_id) VALUES (NOW(), ?, ?, ?, ?, ?);";
  $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
  $res = mysqli_stmt_execute($stmt);
  if($res){
    header("Location: user.php?id=" . $_POST['user_id']);
  }
  else{
    print(mysqli_error($connection));
  }
?>
