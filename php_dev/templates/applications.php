<section class="search">
  <h4 class="search__title">Поиск</h4>
  <ul class="search__subjects-list">
    <?php foreach($subjects as $s): ?>
    <li class="search__subject">
      <a class="search__subject-title" href="applications.php?subject=<?= $s['id'] ?>"><?= $s['title'] ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
  <form class="search__container" method="get" action="search.php">
    <div>
      <label class="search__label" for="search">
        Заявка
      </label>
      <input class="search__input search__input--region" type="text" placeholder="Введите предмет, тему" name="search" id="search">
    </div>
    <input class="search__submit" type="submit" value="Найти">
  </form>
</section>
<main class="people">
  <ul class="people__list">
    <?php
    foreach($applications as $app):
      $per_url = "user.php?" . http_build_query(["id" => $app['user_id']]);
      ?>
    <li class="people__item people__item--main">
      <a href="<?= $per_url; ?>" class="people__item">
        <img src="<?= $app['url']; ?>" class="people__photo" alt="Имя человека">
        <div class="people__info-container">
          <h6 class="people__title"><?= htmlspecialchars($app['title']); ?></h6>
          <div class="people__location-container">
            <img class="people__location-icon" src="img/location.svg" alt="Местоположение">
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
  <?php if ($pages_count > 1): ?>
  <ul class="pagination-list">
    <?php if (intval($current_page) !== 1): ?>
      <li class="pagination-item pagination-item-prev"><a href="/?page=<?= $current_page - 1; ?>">Назад</a>
      </li>
    <?php endif; ?>
    <?php foreach ($pages as $page): ?>
      <li class="pagination-item <?php if ($page === $current_page): ?>pagination__item-active<?php endif; ?>">
        <a href="/?page=<?= $page; ?>"><?= $page; ?></a></li>
    <?php endforeach; ?>
    <?php if ($current_page < $pages_count): ?>
      <li class="pagination-item pagination-item-next"><a href="/?page=<?= $current_page + 1; ?>">Вперед</a>
      </li>
    <?php endif; ?>
  </ul>
  <?php endif; ?>
</main>
