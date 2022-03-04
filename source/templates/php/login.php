<?php
  require_once("init.php");
  require_once("function.php");
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
    $safe_email = mysqli_real_escape_string($connection, $_POST['email']);
    $sql_info = "SELECT id, name, password FROM users WHERE email = '$safe_email'";
    $res = mysqli_query($connection, $sql_info);
    if (!$res) {
      die("Произошла ошибка!");
    }
    $user_info = mysqli_fetch_all($res, MYSQLI_ASSOC);
    if (mysqli_num_rows($res) === 0) {
      $errors['email'] = 'Пользователь с таким email не зарегистрирован';
    } else {
      $user_password = $user_info[0];
      if (password_verify($_POST['password'], $user_password['password'])) {
        $_SESSION['user_id'] = $user_password['id'];
        $_SESSION['user_name'] = $user_password['name'];
        header("Location: index.php");
      } else {
        $errors['password'] = "Неверный пароль";
      }
    }
  }
  $errors = array_filter($errors);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="img/icon.svg" type="img/svg+xml">
    <link rel="apple-touch-icon" href="img/apple.webp">
    <title>Регистрация</title>
  </head>
  <body class="main-body">
  <header class="main-header">
    <h1 class="main-header__heading">youngblood</h1>
    <div class="main-header__profile">
      <h2 class="main-header__username">ВОЙТИ</h2>
      <img class="main-header__photo" src="img/profile.jpg" alt="фото">
    </div>
  </header>
  <form class="order-form" method="post" action="login.php">
    <div class="order-form__container">
      <label for="email">
        Ваш email
      </label>
      <input type="email" name="email" id="email">
      <?php if(isset($errors['email'])) {
        print($errors['email']);
      }?>
    </div>
      <label for="password">
        Пароль
      </label>
      <input type="password" name="password" id="password">
      <?php if(isset($errors['password'])) {
        print($errors['password']);
      }?>
    <input type="submit" value="Войти">
  </form>
  </body>
</html>
