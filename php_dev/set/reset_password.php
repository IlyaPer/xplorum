<?php
  require_once("../init.php");
  require_once("../function.php");
  $id = $_SESSION['user_id'];

  if(!empty($_POST['password'] && $_POST['new-password']) && strlen($_POST['new-password']) > 6) {
    $sql_info = "SELECT id, password FROM users WHERE id = '$id'";
    $res = mysqli_query($connection, $sql_info);
    if (!$res) {
      die("Произошла ошибка!");
    }
    $user_info = mysqli_fetch_assoc($res);

    if (password_verify($_POST['password'], $user_info['password'])) {
      $passwordHash = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
      $sql = "UPDATE users SET password = '$passwordHash' WHERE users.id =" . $_SESSION['user_id'];
      $result = mysqli_query($connection, $sql);
      if (!$result) {
        exit;
      } else {
        print(mysqli_error($connection));
      }
    }
    else {
      print ("Неверный текущий пароль");
    }
  }
  else {
    print($_POST['password']);
    print ("Неверный текущий пароль");
    exit;
  }
  ?>
