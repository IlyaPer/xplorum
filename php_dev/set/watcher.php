<?php
  require_once("../init.php");
  require_once("../function.php");

  $date =
  $id = intval($_SESSION['user_id']);

  $sql = "SELECT * FROM messages WHERE reciever_id = '$id' AND date_creation > NOW() ORDER BY date_creation DESC;";
  $result_subjects = mysqli_query($connection, $sql);
  if (!$result_subjects) {
    exit;
  }
  $new = mysqli_fetch_all($result_subjects, MYSQLI_ASSOC);
  var_dump(json_encode($new));
?>
