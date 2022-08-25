<section class="search">
  <ul class="search__subjects-list">
    <?php foreach($subjects as $s): ?>
    <li class="search__subject">
      <a class="search__subject-title" href="applications.php?subject=<?= $s['id'] ?>"><?= htmlspecialchars($s['title']); ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
<!--  <form class="search__container" method="get" action="search.php">-->
<!--    <div>-->
<!--      <label class="search__label" for="search">-->
<!--        Заявка-->
<!--      </label>-->
<!--      <input class="search__input search__input--region" type="text" placeholder="Введите предмет, тему" name="search" id="search">-->
<!--    </div>-->
<!--    <input class="search__submit" type="submit" value="Найти">-->
<!--  </form>-->
</section>
<a class="apps__create-button" href="#new-app">
  Создать
</a>
<main class="apps">
  <ul class="apps__list">
    <?php
      foreach($applications as $app):
      $per_url = "user.php?" . http_build_query(["id" => $app['user_id']]);
    ?>
    <li class="apps_item">
      <div class="apps__href">
        <a class="apps__href-container" href="<?= $per_url ?>">
          <img class="apps__img" alt="NAME" src="<?= $app['photo']; ?>">
          <h4 class="apps__name"><?= htmlspecialchars($app['author']) ?></h4>
          <h4 class="apps__name apps__name--additional">Москва</h4>
        </a>
        <div class="apps__content-container">
          <h2 class="apps__heading">
            <?= htmlspecialchars($app['title']); ?>
          </h2>
          <div class="apps__subject">
            <?= htmlspecialchars($app['main_title']); ?>
          </div>
          <p class="apps__description">
            <?= htmlspecialchars($app['content']); ?>
          </p>
          <div class="apps__footer-container">
            <div class="apps__subjects-container">
              <p class="apps__subjects-heading">Знаю:</p>
              <?php
                $reverance =  $app['user_id'];
                $sql_user_subject = "SELECT subjects.id, subjects.title AS title, user_subjects.user_id AS sub_user_id, user_subjects.text, user_subjects.subject_id AS subject_id FROM subjects JOIN user_subjects ON subjects.id = user_subjects.subject_id WHERE user_subjects.user_id = '$reverance';";
                $result_user_subject = mysqli_query($connection, $sql_user_subject);
                if (!$result_user_subject) {
                  exit;
                }
              $user_subjects = mysqli_fetch_all($result_user_subject, MYSQLI_ASSOC);
              foreach ($user_subjects as $user_subject):
              ?>
              <div class="apps__subject"><?= $user_subject['title'] ?></div>
              <?php endforeach; ?>
            </div>
            <div class="apps__button <?php echo(is_int(array_search($app['AppId'], array_column($feeds, 'appId'))) ? 'apps__button--active' : '' );?>" id="app<?= htmlspecialchars($app['AppId']); ?>" onclick="greetings('<?= htmlspecialchars($app['AppId']); ?>', '<?= htmlspecialchars($app['mainId']); ?>')"></div>
          </div>
        </div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <ul class="pagination">
    <?php if ($pages_count > 1): ?>
    <?php if (intval($current_page) !== 1): ?>
      <li class="pagination__item pagination__item--prev"><a class="pagination__text" href="applications.php?page=<?= $current_page - 1; ?>">Назад</a>
      </li>
    <?php endif; ?>
    <?php foreach ($pages as $page): ?>
      <li class="pagination__item <?php if ($page === $current_page): ?>pagination__item--active<?php endif; ?>">
        <a class="pagination__text" href="applications.php?page=<?= $page; ?>"><?= $page; ?></a></li>
    <?php endforeach; ?>
    <?php if ($current_page < $pages_count): ?>
      <li class="pagination__item pagination__item--next"><a class="pagination__text" href="applications.php?page=<?= $current_page + 1; ?>">Вперед</a>
      </li>
    <?php endif; ?>
    <?php endif; ?>
  </ul>
</main>
<div class="user__form-container" id="new-app">
  <form class="user__app-form">
    <h2 class="user__form-title">Публикация заявки</h2>
    <div class="user__max-width">
      <label class="user__max-width">Название заявки</label>
      <input class="user__max-width" type="text" name="app-title" placeholder="Например: прошу помочь с экстремумами функции">
    </div>
    <div class="user__max-width">
      <label class="user__max-width">Предмет заявки</label>
      <select>
        <option>Математика</option>
        <option>Русский язык</option>
        <option>Физика</option>
        <option>Информатика</option>
      </select>
    </div>
    <div class="user__max-width">
      <label class="user__max-width">Содержание заявки</label>
      <textarea class="user__max-width" type="text" name="app-title" placeholder="Подробнее опишите проблему. Например: Я не понимаю, как решать параметр через производную."></textarea>
    </div>
    <div class="user__max-width">
      <input class="user__submit" type="submit" value="Опубликовать">
      <a class="user__submit user__submit--cancel" href="#" class="close">Отменить</a>
    </div>
  </form>
</div>
