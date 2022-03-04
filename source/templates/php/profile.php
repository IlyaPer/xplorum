<?php
  require_once("init.php");
  require_once("function.php");
  $sql_user_request = "SELECT id, register_date, name, email, role, info, password FROM users WHERE id = 1;";
  $result_user = mysqli_query($connection, $sql_user_request);
  if (!$result_user) {
    die("Ошибка подключения к базе данных.");
    exit;
  }
  $user = mysqli_fetch_assoc($result_user);
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
  <title>Профиль</title>
</head>
<body class="main-body">
  <header class="main-header">
    <h1 class="main-header__heading">youngblood</h1>
    <div class="main-header__profile">
      <h2 class="main-header__username"><?= $user['name']; ?></h2>
      <img class="main-header__photo" src="img/profile.jpg" alt="фото">
    </div>
  </header>
  <section class="main-menu">
    <ul class="main-menu__list">
      <li class="main-menu__item main-menu__item--active">ФРИЛАНСЕРЫ</li>
      <li class="main-menu__item">ЗАКАЗЫ</li>
    </ul>
  </section>
  <main class="wrapper">
    <section class="profile">
      <img class="profile__img" src="img/profile.jpg" alt="profile photo">
      <div>
        <h1 class="profil__name"><?= $user['name']; ?></h1>
        <h2 class="profile__skill">Веб-дизайнер</h2>
        <p class="profile__description"><?= $user['info']; ?></p>
      </div>
    </section>

    <div class="order-form__container">
      <label for="category">
Область проекта
</label>
      <select name="category" id="category">
        <option>Веб-дизайн</option>
        <option>Фронтенд</option>
        <option>Базы данных</option>
        <option>Закрытие проектов</option>
        <option>Информационная безопасность</option>
        <option></option>
        <option>Тестирование</option>
      </select>
    </div>
    <button>Редактировать профиль</button>
  </main>
</body>
</html>
