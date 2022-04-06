<?php
  require_once("init.php");
  require_once("function.php");

  $sql_applications = 'SELECT date_creation, applications.title, content, applications.url, user_id, subject_id, users.id, subjects.id, subjects.title AS main_title, subjects.color_hex_id FROM applications JOIN users ON user_id = users.id JOIN subjects ON subjects.id = subject_id
       ORDER BY date_creation  DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
  $result_applications = mysqli_query($connection, $sql_applications);
  if (!$result_applications) {
    print("error in connection state");
    exit;
  }
  $applications = mysqli_fetch_all($result_applications, MYSQLI_ASSOC);
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
  <title>Сообщество "тайфун"</title>
</head>
<body class="main-body">
<header class="main-header">
  <h1 class="main-header__heading">СОЮЗ-ТАЙФУН</h1>
  <a class="main-header__username" href="person.html">
    <div class="main-header__profile">
      <h2 class="main-header__username">ИЛЬЯ</h2>
      <img class="main-header__photo" src="img/profile.jpg" alt="фото">
    </div>
  </a>
</header>
<section class="main-menu">
  <ul class="main-menu__list">
    <li class="main-menu__item"><a class="default" href="community.html">ПОЛЬЗОВАТЕЛИ</a></li>
    <li class="main-menu__item main-menu__item--active"><a class="default" href="search.html">СОЮЗ</a></li>
    <li class="main-menu__item"><a class="default" href="search.html">ЧАТ</a></li>
  </ul>
  <hr>
</section>

