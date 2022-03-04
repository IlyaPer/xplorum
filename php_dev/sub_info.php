<?php
// Сделать проверку на говно
require_once("init.php");
require_once("function.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $subject = intval($_POST['ids']);
  $safe_info = mysqli_real_escape_string($connection, $_POST[$subject]);
  $sql = "UPDATE `user_help_subjects` SET text = '$safe_info' WHERE `subject_id` = '$subject' AND `user_id` = '$user_id';";
  $result_safe_info = mysqli_query($connection, $sql);
  if (!$result_safe_info) {
    exit;
  }
  if ($result_safe_info){
    header("Location:index.php");
  }
}
?>
