<?php
  require_once("../init.php");
  require_once("../function.php");

  $id = intval($_GET['id']);

  if ($id > 0 && $id < 1000000000) {
    $sql = "DELETE FROM applications WHERE id = '$id' AND user_id =" . $_SESSION['user_id'];
    $result = mysqli_query($connection, $sql);
    print ("hello");
    if (!$result) {
      print(mysqli_error($result));
      exit;
    } else {
      header("Location: ../user.php?id=" . $user_id);
    }
  }
  else {
    header("Location: ../user.php?id=" . $user_id);
    exit;
  }
?>
