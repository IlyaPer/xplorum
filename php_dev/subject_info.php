<?php
  // Сделать проверку на говно
  require_once("init.php");
  require_once("function.php");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_info = [$user_id, $_POST['ids'], $_POST[$_POST['ids']]];
    $subject = intval($_POST['ids']);
    $safe_info = mysqli_real_escape_string($connection, $_POST[$subject]);
    $sql = "UPDATE `user_subjects` SET text = '$safe_info' WHERE `user_id` = '$user_id' AND `subject_id` = '$subject';";
    $result_safe_info = mysqli_query($connection, $sql);
    if (!$result_safe_info) {
      exit;
    }
    if ($result_safe_info){
        header("Location:index.php");
    }
  }
  ?>
