<?php
  require_once("init.php");
  require_once("function.php");
  if(isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
  }
  $errors = [];
  $user = $_POST;
  $rules = [
    'email' => function(){
      if(!validateEmail('email')){
        return "Введите корректный email";
      }
    },
    'password' => function(){
      if(!validatePassword('password')){
        return "Заполните это поле";
      }
    },
    'name' => function(){
      if(!validateFilled('name')){
        return "Заполните это поле";
      }
    },
    'role' => function(){
      if(!validateRole('role')){
        return "Выберите существующую роль";
      }
    },
    'description' => function(){
      if(!validateFilled('description')){
        return "Заполните это поле";
      }
    },
    'date' => function(){
      $date = $_POST['date'];
      if(!is_date_valid($date)){
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
      $new_order = [$safe_name, $safe_email, $role, $safe_message, $passwordHash];
      $sql = 'INSERT INTO `users`(`register_date`, `name`, `email`, `role`, `info`, `password`) VALUES (NOW(), ?, ?, ?, ?, ?)';
      $stmt = db_get_prepare_stmt($connection, $sql, $new_order);
      $res = mysqli_stmt_execute($stmt);

      if ($res && empty($errors)) {
        header("Location: login.php");
        exit;
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
      <h2 class="main-header__username">ИЛЬЯ</h2>
      <img class="main-header__photo" src="img/profile.jpg" alt="фото">
    </div>
  </header>
  <form class="order-form" method="post" action="register.php">
    <div class="order-form__container">
      <label for="name">
      Ваше имя
      </label>
      <input type="text" name="name" id="name">
      <?= isset($errors['name']) ? "Введи имя по-братски" : ""; ?>
      <label for="name">
        Ваш email
      </label>
      <input type="email" name="email" id="email">
      <?= isset($errors['email']) ? "Введи email" : ""; ?>
    </div>
    <div class="order-form__container">
      <input type="radio" id="role"
             name="role" value="boss">
      <label for="role">ИСПОЛНИТЕЛЬ</label>

      <input type="radio" id="worker"
             name="role" value="lead">
      <label for="worker">ЗАКАЗЧИК</label>
      <?= isset($errors['role']) ? "Может, роль хоть выберешь?" : ""; ?>
    </div>
    <div class="order-form__container order-form__container--description">
      <label for="description">
        Расскажите о себе
        </label>
      <textarea class="order-form__textarea" name="description" id="description" placeholder="Чем подробнее будет ТЗ, тем больше людей оно привлечет"></textarea>
      <?= isset($errors['description']) ? "Это поле здесь не просто так" : ""; ?>
    </div>
    <div class="order-form__container">
      <label for="date">
        Дата рождения
      </label>
      <input type="date" name="date" id="date">
      <?= isset($errors['date']) ? "Дата твоего рождения))))" : ""; ?>
    </div>
    <?php
      if (!empty($errors)){
        print("<h1>There are some shit over there.</h1>");
      }
      ?>
    <label for="password">
      Ваш password
    </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Зарегистрироваться">
  </form>
</body>
</html>
