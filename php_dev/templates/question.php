<main>
  <section class="question">
    <div class="question__mini-cont">
      <img class="question__photo" src="<?= $question['photo']; ?>" alt="name">
      <button class="question__subject"><?= htmlspecialchars($question['sub']); ?></button>
    </div>
    <h1 class="question__heading"><?= htmlspecialchars($question['title']); ?></h1>
    <p class="question__desc"><?= htmlspecialchars($question['content']); ?></p>
    <p class="question__info">
      Недавно
    </p>
    <hr>
  </section>
  <section class="answers">
    <h2 class="answers__heading">Ответы</h2>
    <ul class="answers__list">
      <?php foreach($answers as $a): ?>
      <li class="answers__item">
        <img class="answers__photo" src="<?= $a['photo'] ?>" alt="name">
        <div class="answers__container">
          <h2 class="answers__name"><?= htmlspecialchars($a['name']); ?></h2>
          <p class="answers__content"><?= htmlspecialchars($a['content']); ?></p>
        </div>
        <hr>
      </li>
      <?php endforeach; ?>
    </ul>
    <form class="answers__form" method="post" action="">
      <label for="content"></label>
      <input class="answers__input" type="text" name="content" id="content" placeholder="Напишите свой ответ...">
      <input class="answers__submit" type="submit" value="Опубликовать">
    </form>
  </section>
</main>
