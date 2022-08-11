<svg style="display: none;">
  <symbol width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="send">
    <g clip-path="url(#clip0_795_42)">
      <path d="M7.98633 22.1422C7.98633 22.286 8.06618 22.4179 8.19316 22.4851C8.32005 22.5522 8.47433 22.5436 8.59292 22.4624L11.2639 20.6386L7.98638 19.0764V22.1422H7.98633Z" fill="#353535"/>
      <path d="M23.8753 1.573C23.8019 1.50536 23.7072 1.46997 23.6115 1.46997C23.5538 1.46997 23.4963 1.48277 23.4418 1.50953L0.383235 12.8204C0.147551 12.9362 -0.00158724 13.1769 1.27467e-05 13.4402C0.00161274 13.7031 0.153272 13.9421 0.390653 14.0554L6.4678 16.9511L18.619 6.96376L7.97349 17.6685L15.5441 21.2757C15.6371 21.3203 15.7386 21.3424 15.8391 21.3424C15.9248 21.3424 16.0097 21.3268 16.0905 21.2951C16.2669 21.2253 16.407 21.0857 16.477 20.9093L23.9725 2.00034C24.0318 1.85154 23.9931 1.68141 23.8753 1.573Z" fill="#353535"/>
    </g>
    <defs>
      <clipPath id="clip0_795_42">
        <rect width="24" height="24" fill="white"/>
      </clipPath>
    </defs>
  </symbol>
</svg>
<main class="users">
  <div class="users__heading-container">
    <h1 class="users__heading">Пользователи недели</h1>
    <img class="users__icon" src="img/fire.svg" alt="fire">
  </div>
  <ul class="users__list">
    <?php
       $cnt = 0;
       var_dump($info);
       foreach ($info as $i):
      ?>
    <li class="users__item">
      <div class="users__max-width">
        <img class="users__img" src="<?= $i[0]['img'] ?>" alt="<?= $i[0]['name'] ?>">
      </div>
      <div class="users__container">
        <div class="users__info">
          <h4 class="users__name"><?= $i[0]['name'] ?></h4>
          <div class="users__feedback-box">
            <p class="users__count"><?= $cnt + $i[0]['id'] ?></p>
            <img class="users__img users__img--max-width" src="/img/feed-mob.svg">
          </div>
        </div>
        <ul class="users__subjects">
          <?php
              if (!isset($i[1])) {
               continue;
              }
              foreach ($i[1] as $c):
            ?>
          <li class="users__subject"><?= $c['title'] ?></li>
          <?php
              $cnt += 1;
              endforeach; ?>
          <li class="users__subject-dots">...</li>
        </ul>
        <div class="users__btn">
          Написать
          <svg class="users__send-icn">
            <use xlink:href="#send"></use>
          </svg>
        </div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <h1 class="users__heading">Активные пользователи</h1>
  <ul class="users__list">
    <li class="users__item">
      <img class="users__img" src="img/egor.jpg" alt="name">
      <div class="users__container">
        <div class="users__info">
          <h4 class="users__name">Лена Клабен-Бабен</h4>
          <div class="users__feedback-box">
            <p class="users__count">5</p>
            <img class="users__img users__img--max-width" src="/img/feed-mob.svg">
          </div>
        </div>
        <ul class="users__subjects">
          <li class="users__subject">Математика</li>
          <li class="users__subject users__subject--left">Русский язык</li>
          <li class="users__subject-dots">...</li>
        </ul>
      </div>
    </li>
  </ul>
</main>
