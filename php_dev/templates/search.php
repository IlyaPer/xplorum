<section class="search">
  <h4 class="search__title">Фильтры поиска</h4>
  <form class="search__container" method="get" action="search.php">
    <div>
      <label class="search__label" for="search">
        Заявка
      </label>
      <input class="search__input search__input--region" type="text" placeholder="Введите предмет, тему" name="search" id="search">
    </div>
    <input class="search__submit" type="submit" value="Найти">
  </form>
  <ul class="search__subjects-list">
    <?php foreach($subjects as $subject): ?>
      <li class="search__subject">
        <p class="search__subject-title"><?= htmlspecialchars($subject['title']); ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
<main class="people">
  <?php if (isset($errors["search"])): ?>
    <h2><?= $errors["search"]; ?></h2>
  <?php elseif ($items_count === 0): ?>
    <h2>По вашему запросу ничего не найдено</h2>
  <?php else: ?>
  <ul class="people__list">
    <?php
    foreach($applications as $app):
      $per_url = "user.php?" . http_build_query(["id" => $app['user_id']]);
      ?>
      <li class="people__item people__item--main">
        <a href="<?= $per_url; ?>" class="people__item">
          <img src="<?= htmlspecialchars($app['url']); ?>" class="people__photo" alt="Имя человека">
          <div class="people__info-container">
            <h6 class="people__title"><?= htmlspecialchars($app['title']); ?></h6>
            <div class="people__location-container">
              <img class="people__location-icon" src="css/location.svg" alt="Местоположение">
              <h4 class="people__location-title">Москва</h4>
            </div>
            <div>
              <button class="people__button">
                <?= htmlspecialchars($app['main_title']); ?>
              </button>
            </div>
            <p class="people__description"><?= htmlspecialchars($app['content']); ?></p>
            <div class="people__container">
            </div>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</main>
<footer class="page-footer">
  <a href="mailto:info@explorex.ru" class="page-footer__text">info@explorex.ru</a>
  <br class="page-footer__text">
  <a href="agreement.html" class="page-footer__text">пользовательское соглашение</a>
  <br class="page-footer__text">
  <a href="user-agreement.html" class="page-footer__text">согласие на обработку персональных данных</a>
</footer>
