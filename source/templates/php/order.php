<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico">
  <link rel="icon" href="img/icon.svg" type="img/svg+xml">
  <link rel="apple-touch-icon" href="img/apple.webp">
  <title>Заказы</title>
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
    <li class="main-menu__item">ФРИЛАНСЕРЫ</li>
    <li class="main-menu__item main-menu__item--active">ЗАКАЗЫ</li>
  </ul>
</section>
<form>
  <input type="text" placeholder="Найти нужный заказ">
  <input type="submit" value="Найти">
</form>
<main class="orders">
  <ul class="orders__list">
    <?php foreach($orders as $o): ?>
    <li class="orders__item">
      <h6 class="orders__title"><?= $o['title']; ?></h6>
      <p class="orders__description"><?= $o['description']; ?></p>
      <div class="orders__container">
        <div class="orders__price">
          <?= $o['price']; ?>
        </div>
        <button class="order__button">
          ОТКЛИКНУТЬСЯ
        </button>
      </div>
      <?php endforeach; ?>
    </li>
  </ul>
</main>
</body>
</html>
