<section class="search">
  <ul class="search__subjects-list">
    <?php foreach($subjects as $s): ?>
    <li class="search__subject">
      <a class="search__subject-title" href="applications.php?subject=<?= $s['id'] ?>"><?= $s['title'] ?></a>
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
<main class="apps">
  <ul class="apps__list">
    <?php
      foreach($applications as $app):
      $per_url = "user.php?" . http_build_query(["id" => $app['user_id']]);
    ?>
    <li class="apps_item">
      <a class="apps__href">
        <div>
          <img class="apps__img" alt="NAME" src="<?= $app['photo']; ?>">
          <h4 class="apps__name"><?= htmlspecialchars($app['author']) ?></h4>
          <h4 class="apps__name apps__name--additional">Москва</h4>
        </div>
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
      </a>
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
