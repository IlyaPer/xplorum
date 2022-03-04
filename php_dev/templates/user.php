<script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    function myFunction1() {
      document.getElementById("myDropdown1").classList.toggle("show");
    }
    function Dropdown(id) {
      document.getElementById(id).classList.toggle("show");
    }
    function Edit(edit_id, delete_id) {
      document.getElementById(edit_id).classList.toggle("show");
      document.getElementById(delete_id).classList.toggle("hide");
    }
  </script>
<main class="person">
  <div class="person__info-container">
    <div>
      <?php if($my_account === 1): ?>
      <form class="person__form" id="edit-profile" method="post" action="set/edit-profile.php">
        <img class="person__photo" src="<?= $user['url']; ?>" alt="<?= $user['name']; ?>">
        <div class="person__form-container">
          <label class="person__label">Ваше имя</label>
          <input class="person__input" name="per-name" id="per-name" type="text" value="<?= $user['name']; ?>">
        </div>
        <div class="person__form-container">
          <label class="person__label">Город</label>
          <input class="person__input" name="per-city" id="per-city" type="text" value="erf">
        </div>
        <div class="person__form-container">
          <label class="person__label">Информация о вас</label>
          <textarea class="person__textarea" name="per-info" id="per-info"><?= $user['info']; ?></textarea>
        </div>
        <input class="person__submit-form" type="submit" value="Сохранить изменения">
      </form>
      <div class="person__info" id="person-info">
        <div id="image-edit" class="hide">
          <h5>Изменить фото</h5>
          <form method="post">
            <input type="file" name="image" class="image">
          </form>
        </div>
          <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel">Crop image</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="img-container">
                    <div class="row">
                      <div class="col-md-8">
                        <!--  default image where we will set the src via jquery-->
                        <img id="image" src="">
                      </div>
                      <div class="col-md-4">
                        <div class="preview"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                  <button type="button" class="btn btn-primary" id="crop">Загрузить</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a id="user-image" class="person__info__photo-edit" onclick="Edit('image-edit', 'user-image')">
          <?php endif; ?>
          <img class="person__photo" src="<?= $user['url']; ?>" alt="<?= $user['name']; ?>">
          <?php if($my_account === 1): ?>
        </a>
        <?php endif; ?>
        <h1 class="person__info-heading"><?= $user['name']; ?></h1>
        <div class="people__location-container">
          <img class="people__location-icon" src="img/location.svg" alt="Местоположение">
          <h4 class="people__location-title"><?= $user['city']; ?></h4>
        </div>
        <p class="person__center-text"><?= $user['info']; ?></p>
        <?php if($my_account === 1): ?>
          <button class="person__button" onclick="Edit('edit-profile', 'person-info')">
            Редактировать
          </button>
        <?php else: ?>
        <?php $chat_href = 0 ?>
        <button class="person__button" id="sent-message" onclick="Edit('message-form', 'sent-message')">
          Написать
        </button>
        <form class="person__form" id="message-form" method="post" action="set/message-sent.php">
          <div class="person__form-container">
            <label class="person__label">
              Написать сообщение
            </label>
            <textarea class="person__app-description" id="message" name="message"></textarea>
          </div>
          <input type="hidden" id="visitor" name="visitor" value="<?= $visitor ?>">
          <input type="hidden" id="user_id" name="user_id" value="<?= $id ?>">
          <input class="settings__submit" type="submit" value="Отправить">
        </form>
        <?php endif; ?>
        <div class="person__forms">
        </div>
      </div>
    <section class="person__applications-container">
      <?php if($my_account === 1): ?>
      <h2 class="person__title">Мои заявки</h2>
      <?php if(empty($applications)): ?>
      <img src="img/premium.svg" alt="Заявок нет">
      <?php else: ?>
      <ul class="people__list people__list--profile">
        <?php foreach($applications as $app): ?>
          <li class="people__item people__item--main people__item--profile" id="app_element<?= $app['app_id'] ?>">
              <div class="people__info-container" id="edit_app_element<?= $app['app_id'] ?>">
                <div class="person__skill-mini">
                  <h6 class="people__title people__title--profile"><?= $app['title'] ?></h6>
                  <div class="person__icons-box">
                    <picture>
                      <source srcset="img/edit.svg" media="(min-width: 1000px)">
                      <img class="person__skill-icon person__skill-icon--app" src="img/edit-mob.svg" alt="Edit" onclick="Edit('app_form<?= $app["app_id"] ?>', 'edit_app_element<?= $app['app_id'] ?>')">
                    </picture>
                    <a href="set/delete-app.php?id=<?= $app['app_id'] ?>">
                      <img class="person__skill-icon person__skill-icon--app" src="img/trash-can_115312.svg" >
                    </a>
                  </div>
                </div>
                <div class="people__location-container people__location-container--profile">
                  <img class="people__location-icon" src="img/location.svg" alt="Местоположение">
                  <h4 class="people__location-title">Зальзбург</h4>
                </div>
                <div>
                  <button class="people__button people__button--profile">
                    <?= $app['main_title'] ?>
                  </button>
                </div>
                <p class="people__description"><?= $app['content'] ?></p>
              </div>
          <form id="app_form<?= $app['app_id'] ?>" method="post" class="person__form" action="set/application-edit.php">
            <label for="title"></label>
            <input name="title" id="title" type="text" placeholder="Напишите с чем вы хотите получить помощь" value="<?= $app['title'] ?>">
            <input name="id" id="id" type="hidden" value="<?= $app['app_id'] ?>">
            <label for="content"></label>
            <textarea name="content" id="content" placeholder="Напишите подробнее, что вы хотели бы узнать"><?= $app['content'] ?></textarea>
            <input type="submit" value="Сохранить">
          </form>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <form class="person__form" id="application_form" method="post" action="application-add.php">
        <img class="person__form-cancel" src="img/cancel-cross_icon-icons.com_71726.svg" alt="close">
        <div class="person__form-container">
          <label for="app-subject">
            Предмет заявки
          </label>
          <select name="app-subject" id="app-subject">
            <?php foreach($subjects as $s): ?>
              <option value="<?= $s['id']; ?>"><?= $s['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="person__form-container">
          <label for="app-title">
            Заголовок заявки
          </label>
          <input class="person__form-input" type="text" id="app-title" name="app-title" placeholder="Кратко напишите о том, в чем хотите получить помощь">
        </div>
        <div class="person__form-container">
          <label for="app-description">
            Содержание заявки
          </label>
          <textarea class="person__app-description" name="app-description" id="app-description" placeholder="Кратко напишите о том, в чем хотите получить помощь"></textarea>
        </div>
        <input type="hidden" id="url" name="url" value="<?= $user['url']; ?>">
        <input type="hidden" id="user_id" name="user_id" value="<?= $id ?>">
        <input class="person__app-btn" type="submit" value="Опубликовать">
      </form>
      <button class="person__button" onclick="Dropdown('application_form')">
        Создать заявку
      </button>
    </section>
    <?php endif; ?>
    <section class="person__skills-info">
      <div class="person__skills-wrapper">
        <?php if($my_account === 1): ?>
        <h2 class="person__skills-title">Владею предметами:</h2>
        <?php else: ?>
        <h2 class="person__skills-title">Владеет предметами:</h2>
        <?php endif; ?>
        <ul class="person__list">
          <?php foreach($user_subjects as $subject): ?>
          <?php $subid = rand(1, 1000); ?>
          <li class="person__skill">
            <div class="person__skill-mini">
              <p class="person__skill-title"><?= $subject['title'] ?></p>
              <?php if($my_account === 1): ?>
              <img class="person__skill-icon" src="img/edit.svg" alt="Редактировать" onclick="Edit('myDropdown<?= $subid ?>', 'edit<?= $subid ?>')">
              <?php endif; ?>
            </div>
            <hr class="person__skill-hr">
            <p class="person__skill-description" id="edit<?= $subid ?>"><?= $subject['text'] ?></p>
            <?php if($my_account === 1): ?>
            <form class="person__form" id="myDropdown<?= $subid ?>" method="post" action="">
              <textarea name="content" id="content"><?= $subject['text'] ?></textarea>
              <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
              <input type="submit" value="сохранить">
            </form>
            <?php endif; ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <form class="person__form" id="Dropdown4" method="post" action="set/new-sub.php">
          <div class="person__form-container">
            <label>Предмет</label>
            <select name="new-subject" id="new-subject">
              <?php foreach($subjects as $s): ?>
                <option value="<?= $s['id']; ?>"><?= $s['title']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php if($my_account === 1): ?>
          <div class="person__form-container">
            <label for="sub-description">Ваши умения</label>
            <textarea class="person__app-description" name="sub-description" id="sub-description" placeholder="Подробно опишите ваши умения в предмете" autofocus="autofocus"></textarea>
          </div>
          <input class="person__app-btn" type="submit" value="СОХРАНИТЬ">
        </form>
        <div class="person__addbtn-container">
          <button class="person__skill-addbtn" onclick="Dropdown('Dropdown4')"></button>
          <p class="person__add-text">Добавить предмет</p>
        </div>
        <?php endif; ?>
      </div>
      <div class="person__skills-wrapper">
        <?php if($my_account === 1): ?>
        <h2 class="person__skills-title">Хочу разобраться в предметах:</h2>
        <?php else: ?>
        <h2 class="person__skills-title">Хочет разобраться в предметах:</h2>
        <?php endif; ?>
        <ul class="person__list">
          <?php foreach($user_help_subjects as $help_subject): ?>
          <?php $subid = rand(1, 1000); ?>
          <li class="person__skill">
            <div class="person__skill-mini">
              <p class="person__skill-title"><?= $help_subject['title'] ?></p>
              <?php if($my_account === 1): ?>
              <img class="person__skill-icon" src="img/edit.svg" alt="Редактировать" onclick="Edit('myDropdown<?= $subid ?>', 'edit<?= $subid ?>')">
              <?php endif; ?>
            </div>
            <hr class="person__skill-hr">
            <p class="person__skill-description" id="edit<?= $subid ?>"><?= $help_subject['text'] ?></p>
          </li>
          <?php if($my_account === 1): ?>
          <form class="person__form" id="myDropdown<?= $subid ?>" method="post" action="">
            <textarea name="content" id="content"><?= $help_subject['text'] ?></textarea>
            <input type="hidden" name="subject_id" value="<?= $help_subject['id'] ?>">
            <input type="hidden" name="status" value="1">
            <input type="submit" value="сохранить">
          </form>
          <?php endif; ?>
        </ul>
        <?php endforeach; ?>
        <?php if($my_account === 1): ?>
        <form class="person__form" id="Dropdown5" method="post" action="set/new-help-sub.php">
          <div class="person__form-container">
            <label>Предмет</label>
            <select name="new-subject" id="new-subject">
              <?php foreach($subjects as $s): ?>
                <option value="<?= $s['id']; ?>"><?= $s['title']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="person__form-container">
            <label for="sub-description">Темы, которые вы хотите улучшить</label>
            <textarea class="person__app-description" name="sub-description" id="sub-description" placeholder="Подробно опишите ваши слабые стороны в предмете" autofocus="autofocus"></textarea>
          </div>
          <input class="person__app-btn" type="submit" value="СОХРАНИТЬ">
        </form>
        <button class="person__skill-addbtn" onclick="Dropdown('Dropdown5')"></button>
        <p class="person__add-text">Добавить предмет</p>
      </div>
      <?php endif; ?>
    </section>
    </div>
  <?php if($my_account === 1): ?>
  <section class="settings">
    <div class="settings__heading-container">
      <img class="settings__icon" src="img/settings.svg" alt="Настройки">
      <h2 class="settings__title">Настройки</h2>
    </div>
    <form class="settings__form" method="post" action="set/reset_password.php">
      <label for="current-pass"></label>
      <input class="settings__input" type="password" placeholder="Текущий пароль" id="password" name="password">
      <label for="new-pass"></label>
      <input class="settings__input" type="password" placeholder="Новый пароль" id="new-password" name="new-password">
      <input class="settings__submit" type="submit" value="Изменить">
    </form>
    <button class="person__submit-form person__submit-form--destroy">
      Удалить аккаунт
    </button>
  </section>
  <?php endif; ?>
</main>
<footer class="page-footer">
  <a href="mailto:info@explorex.ru" class="page-footer__text">info@explorex.ru</a>
  <br class="page-footer__text">
  <a href="agreement.html" class="page-footer__text">пользовательское соглашение</a>
  <br class="page-footer__text">
  <a href="user-agreement.html" class="page-footer__text">согласие на обработку персональных данных</a>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="cropperjs/cropper.min.js" type="text/javascript"></script>
<script>

  var bs_modal = $('#modal');
  var image = document.getElementById('image');
  var cropper,reader,file;


  $("body").on("change", ".image", function(e) {
    var files = e.target.files;
    var done = function(url) {
      image.src = url;
      bs_modal.modal('show');
    };


    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

  bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
      preview: '.preview'
    });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });

  $("#crop").click(function() {
    canvas = cropper.getCroppedCanvas({
      width: 200,
      height: 200,
    });

    canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function() {
        var base64data = reader.result;
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "upload.php",
          data: {image: base64data},
          success: function(data) {
            bs_modal.modal('hide');
            alert("success upload image");
          }
        });
      };
    });
  });
</script>
