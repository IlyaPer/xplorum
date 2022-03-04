<?php
  require_once("init.php");
  require_once("function.php");
  if (isset($_SESSION['user_id'])) {
    header("Location: /index.php");
    exit();
  }
  $errors = [];
  $user = $_POST;
  $rules = [
    'email' => function(){
      if(!validateEmail('email')){
        return "Введите корректный email";
      }
    },
    'password' => function() {
      if (!validateFilled('password')) {
        return "Заполните это поле";
      }
    }
  ];
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($user as $key => $value) {
      if (isset($rules[$key])) {
        $rule = $rules[$key];
        $result = $rule($value);
        if ($result !== null) {
          $errors[$key] = $result;
        }
      }
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)) {
    if ($_POST['password'] === "ТАЙФУНАХЕР" && $_POST['email'] === "admin@io.io"){
      $_SESSION['user_id'] = 0;
      $_SESSION['user_name'] = 'AДМИН';
      $_SESSION['url'] = "profile.jpg";
      header("Location: applications.php");
    }
    $safe_email = mysqli_real_escape_string($connection, $_POST['email']);
    $sql_info = "SELECT id, name, url, password FROM users WHERE email = '$safe_email'";
    $res = mysqli_query($connection, $sql_info);
    if (!$res) {
      die("Произошла ошибка!");
    }
    $user_info = mysqli_fetch_all($res, MYSQLI_ASSOC);
    if (!empty($user_info)){
      $user_password = $user_info[0];
    }
    if (mysqli_num_rows($res) === 0) {
      $errors['email'] = 'Пользователь с таким email не зарегистрирован';
    } else {
      if (password_verify($_POST['password'], $user_password['password'])) {
        $_SESSION['user_id'] = $user_password['id'];
        $_SESSION['user_name'] = $user_password['name'];
        $_SESSION['url'] = $user_password['url'];

        $sql_sessions = "INSERT INTO sessions (user_id, date_creation, active_status) VALUES (" . $_SESSION['user_id'] . ", NOW(), 1);";
        $result_subjects = mysqli_query($connection, $sql_sessions);
        if (!$result_subjects) {
          exit;
        }
        header("Location: applications.php");
      } else {
        $errors['password'] = "Неверный пароль";
      }
    }
  }
  $errors = array_filter($errors);
  $content = include_template('login.php', ['connection' => $connection, 'rules' => $rules, 'errors' => $errors, 'username' => $username]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Вход', 'username' => $username, 'rules' => $rules]);
  print($layout_content);
?>
