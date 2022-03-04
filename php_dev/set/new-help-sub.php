<?php
  require_once("../init.php");
  require_once("../function.php");

  $new_info = [$user_id, $_POST['new-subject'], $_POST['sub-description']];
  $sql = "INSERT INTO `user_help_subjects`(`user_id`, `subject_id`, `text`) VALUES (?, ?, ?);";
  $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
  $res = mysqli_stmt_execute($stmt);
  if($res){
    header("Location: ../user.php?id=" . $user_id);
  }
  else{
    print(mysqli_error($connection));
  }
?>
