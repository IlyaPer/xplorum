<?php
  require_once("../init.php");
  require_once("../function.php");

  $id = intval($_POST['appId']);

  if ($id >= 0 && $id < 1000000000) {
    $sql = "DELETE FROM applications WHERE id = '$id' AND user_id = " . $_SESSION['user_id'] . ';';
    $result = mysqli_query($connection, $sql);
    if (!$result) {
      print("error");
      exit;
    } else {
      die(mysqli_query($connection, $sql));
      header("Location: ../user.php?id=" . $user_id);
    }
  }
  else {
    die("ich bin nicht berwigen zum fich!!!");
    header("Location: ../user.php?id=" . $user_id);
    exit;
  }
?>
