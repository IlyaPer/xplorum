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
    'title' => function(){
      if(!validateFilled('title')){
        return "Это поле должно быть заполнено";
      }
    },
    'description' => function(){
      if(!validatePassword('description')){
        return "Заполните это поле";
      }
    },
    'deadline' => function(){
      $date = $_POST['deadline'];
      if(!is_date_valid($date)){
        return "Заполните это поле";
      }
    },
    'price' => function(){
      if(!validatePrice('price')){
        return "Введите положительный бюджет проекта";
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
    var_dump($_POST);
    $role = $_POST['role'];
    $safe_email = mysqli_real_escape_string($connection, $user['email']);
    $sql = "SELECT id FROM users WHERE email = '$safe_email'";
    $res = mysqli_query($connection, $sql);
    if (mysqli_num_rows($res) > 0) {
      $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
    }
    else{
      $safe_name = mysqli_real_escape_string($connection, $_POST['name']);
      $safe_message = mysqli_real_escape_string($connection, $_POST['description']);
      $passwordHash = password_hash($user['password'], PASSWORD_DEFAULT);
      $new_user = [$safe_name, $safe_email, $role, $safe_message, $passwordHash];
      $sql = 'INSERT INTO `orders`(`date_creation`, `title`, `description`, `skills_id`, `approximate_price`, `ddeadline_date`, `author`, `winner`, `category_id`) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)';
      $stmt = db_get_prepare_stmt($connection, $sql, $new_user);
      $res = mysqli_stmt_execute($stmt);

      if ($res && empty($errors)) {
        header("Location: login.php");
        exit;
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
      <h2 class="main-header__username">ИЛЬЯ</h2>
      <img class="main-header__photo" src="img/profile.jpg" alt="фото">
    </div>
  </header>
  <form class="order-form" method="post" action="project-add.php">
    <div class="order-form__container">
      <label for="title">
        Название задачи для фрилансера
      </label>
      <input type="text" name="title" id="title" value="<?= getPostVal("title"); ?>">
      <?= isset($errors['title']) ? "Введи название по-братски" : ""; ?>
    </div>
    <div class="order-form__container order-form__container--description">
      <label for="description">
        Подробно опишите ТЗ проекта
      </label>
      <textarea class="order-form__textarea" name="description" id="description" placeholder="Чем подробнее будет ТЗ, тем больше людей оно привлечет"></textarea>
      <?= isset($errors['description']) ? "Это поле здесь не просто так" : ""; ?>
    </div>
    <div class="order-form__container">
      <label for="deadline">
        Окончание работ по проекту
      </label>
      <input type="date" name="deadline" id="deadline">
      <?= isset($errors['deadline']) ? "Дедлайн проекта))))" : ""; ?>
    </div>
    <div class="order-form__container">
      <label for="price">
        Бюджет проекта (в рублях)
      </label>
      <input type="number" name="price" id="price">
      <?= isset($errors['price']) ? "Введи нормальный бюджет" : ""; ?>
    </div>
    <?php
    if (!empty($errors)){
      print("<h1>There are some shit over there.</h1>");
    }
    ?>
    <input type="submit" value="ОПУБЛИКОВАТЬ ПРОЕКТ">
  </form>
  </body>
</html>
