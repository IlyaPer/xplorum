<?php
?>
<script>
  function deleteElement(id) {
    $.ajax({
      url: "set/delete-app.php",
      type: "POST",
      cashe: false,
      data:{
        appId: id
      }, // Отправка
      success:
        function (data) {
          alert(data); //print
        },
      error: function () {
        alert("Ошибка передачи. Возможно, были переданы некорреткные данные.");
      }
    });
    element = document.getElementById(id);
    element.remove();
  }
</script>
<main class="user">
  <section class="user__desktop-menu">
    <div class="user__desktop-img-container">
      <img class="user-info__img-desktop" src="<?= $user['url']; ?>" alt="<?= $user['name']; ?>">
      <h2 class="user-info__heading"><?= $user['name']; ?></h2>
    </div>
    <ul class="user__desktop-mini-menu">
      <li class="user__desktop-menu-item">
        <a class="main-menu__default" href="user.php?id=<?= $visitor ?>">
          <div class="user__mini-item">
            Личные данные
          </div>
        </a>
      </li>
      <li class="user__desktop-menu-item">
        <a class="main-menu__default" href="user-apps.php?id=<?= $visitor ?>">
          <div class="user__mini-item user__mini-item--apps">
            Заявки
          </div>
        </a>
      </li>
    </ul>
  </section>
<section class="user__apps" id="my-apps">
  <div class="user__apps-heading">
    <h2 class="user__apps-text">Мои заявки</h2>
    <a class="user__apps-button" href="#new-app">Создать заявку</a>
    <div class="user__form-container" id="new-app">
      <form class="user__app-form" action="application-add.php" method="post">
        <h2 class="user__form-title">Публикация заявки</h2>
        <div class="user__max-width">
          <label class="user__max-width">Название заявки</label>
          <input class="user__max-width" type="text" name="app-title" placeholder="Например: прошу помочь с экстремумами функции">
        </div>
        <div class="user__max-width">
          <label class="user__max-width">Предмет заявки</label>
          <select name="app-subject">
            <?php foreach($subjects as $s): ?>
              <option value="<?= $s['id']; ?>"><?= $s['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="user__max-width">
          <label class="user__max-width">Содержание заявки</label>
          <textarea class="user__max-width" type="text" name="app-description" placeholder="Подробнее опишите проблему. Например: Я не понимаю, как решать параметр через производную."></textarea>
        </div>
        <div class="user__max-width">
          <input class="user__submit" type="submit" value="Опубликовать">
          <a href="#" class="close">Отменить</a>
        </div>
      </form>
    </div>
  </div>
  <ul class="apps__list">
    <?php foreach ($apps as $app): ?>
    <li class="apps_item" id="<?= $app['appId'] ?>">
      <a class="apps__href">
        <picture class="apps__img apps__img--user">
          <source media="(min-width: 1200px)" srcset="<?= $href; ?>">
          <img class="apps__img apps__img--user" alt="NAME" src="<?= $href; ?>">
        </picture>
        <div class="apps__content-container">
          <div class="apps__head-content">
            <h2 class="apps__heading">
              <?= $app['title']; ?>
            </h2>
            <p class="apps__time">1 день назад</p>
          </div>
          <div class="apps__subject">
            <?= $app['mainTitle']; ?>
          </div>
          <p class="apps__description">
            <?= $app['content']; ?>
          </p>
          <div class="apps__footer-container">
            <div class="apps__subjects-container">
              <p class="apps__subjects-heading">Знаю:</p>
              <?php foreach ($userSubjects as $u): ?>
              <div class="apps__subject"><?= $u['title'] ?></div>
              <?php endforeach; ?>
            </div>
            <div class="apps__feedback-container">
              <p class="apps__feedback-text">1</p>
            </div>
          </div>
        </div>
      </a>
      <div class="apps__container-deleter" onclick="deleteElement(<?= $app['appId'] ?>)">
        <img class="apps__delete-icon" src="img/delete.svg" alt="delete">
        <p class="apps__delete-text">Удалить завку</p>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php if(empty($apps)): ?>
    <p class="user__text-helpfull">У вас пока нет опубликованных заявок.</p>
  <?php endif; ?>
</section>
</main>
