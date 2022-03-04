<?php
  require_once("init.php");
  require_once("function.php");
  $sql_freelancers = "SELECT `id`, `register_date`, `name`, `email`, `role`, `info` FROM users ORDER BY register_date DESC;";
  $result_freelancers = mysqli_query($connection, $sql_freelancers);
  if (!$result_freelancers) {
    exit;
  }
  $freelancers = mysqli_fetch_all($result_freelancers, MYSQLI_ASSOC);
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
    <title>Каталог продукции</title>
</head>
<body class="main-body">
  <header class="main-header">
    <h1 class="main-header__heading">youngblood</h1>
      <div class="main-header__profile">
      <h2 class="main-header__username">ИЛЬЯ</h2>
      <img class="main-header__photo" src="img/profile.jpg" alt="фото">
    </div>
  </header>
  <section class="main-menu">
    <ul class="main-menu__list">
      <li class="main-menu__item main-menu__item--active">ФРИЛАНСЕРЫ</li>
      <li class="main-menu__item">ЗАКАЗЫ</li>
    </ul>
  </section>
  <form>
    <input type="text" placeholder="Найти нужного фрилансера">
    <input type="submit" value="Найти">
  </form>
  <section class="freelancers">
    <ul class="freelancers__list">
      <?php foreach($freelancers as $f): ?>
      <li class="freelancers__person">
        <img class="freelancers__person-photo" src="img/profile.jpg" alt="Арина Смирнова">
        <h4 class="freelancers__person-name"><?=  $f['name']; ?></h4>
        <div>

        </div>
        <p class="freelancers__person-description"><?=  $f['info']; ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>
</body>
</html>
