<section class="adv-search">
  <form class="adv-search__form">
    <label for="title"></label>
    <input class="adv-search__input" type="text" id="title" name="title" placeholder="Введите название предмета">
    <input class="adv-search__button" type="submit" value="Найти">
  </form>
</section>
<main class="questions">
  <ul class="questions__list">
    <?php
      foreach ($questions as $q):
      $url = http_build_query(['id' => $q['id']]);
      ?>
    <li class="questions__item">
      <a class="questions__item-container" href="question.php?<?= $url; ?>">
        <div>
          <button class="questions__subject">
            <?= $q['sub']; ?>
          </button>
          <h2 class="questions__heading"><?= $q['title'] ?></h2>
          <div class="questions__container">
            <p class="questions__info">14 часов назад</p>
            <p class="questions__info">0 ответов</p>
          </div>
        </div>
        <img class="questions__photo" src="img/elenasportmachen.jpg" alt="имя человека">
      </a>
      <hr>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
