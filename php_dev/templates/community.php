<main class="people">
  <ul class="people__list">
    <?php
    foreach($users as $u):
      $url = "user.php?" . http_build_query(['id' => $u['id']]);
    ?>
    <li class="people__item">
      <a href="<?= $url; ?>" class="people__item">
        <img src="<?= $u['url']; ?>" class="people__photo" alt="<?= htmlspecialchars($u['name']); ?>">
        <div class="people__info-container">
          <h6 class="people__title"><?= htmlspecialchars($u['name']); ?></h6>
          Поможет с:
          <div class="people__buttons">
            <?php
              foreach($subjects as $k){
                if($k['user_id'] === $u['id']){
                  print ('<button class="people__button">' .  $k['main'] . '</button>');
                }
              }
            ?>
          </div>
          <p class="people__description"><?= htmlspecialchars($u['info']); ?></p>
          <div class="people__container">
          </div>
        </div>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
