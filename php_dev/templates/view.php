<section class="search">
  <ul class="search__subjects-list">
    <?php foreach($subjects as $s): ?>
      <li class="search__subject">
        <a class="search__subject-title" href="view.php?subject=<?= $s['id'] ?>"><?= $s['title'] ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
<main class="apps">
  <ul class="apps__list">
    <?php
    foreach($applications as $app):
      ?>
      <li class="apps_item">
        <a class="apps__href">
          <div>
            <img class="apps__img" alt="NAME" src="<?= $app['photo']; ?>">
            <h4 class="apps__name"><?= $app['author'] ?></h4>
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
            </div>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
  <ul class="pagination">
    <?php if ($pages_count > 1): ?>
      <?php if (intval($current_page) !== 1): ?>
        <li class="pagination__item pagination__item--prev"><a class="pagination__text" href="view.php?page=<?= $current_page - 1; ?>">Назад</a>
        </li>
      <?php endif; ?>
      <?php foreach ($pages as $page): ?>
        <li class="pagination__item <?php if ($page === $current_page): ?>pagination__item--active<?php endif; ?>">
          <a class="pagination__text" href="view.php?page=<?= $page; ?>"><?= $page; ?></a></li>
      <?php endforeach; ?>
      <?php if ($current_page < $pages_count): ?>
        <li class="pagination__item pagination__item--next"><a class="pagination__text" href="view.php?page=<?= $current_page + 1; ?>">Вперед</a>
        </li>
      <?php endif; ?>
    <?php endif; ?>
  </ul>
</main>
