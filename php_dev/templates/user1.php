<script>
  function sendSub() {
    $.ajax({
      url: "set/new-sub.php",
      type: "POST",
      cashe: false,
      data:{
        subId:$('#new-subject').val(),
        content:$('#sub-description').val()
      }, // Отправка
      success:
        location.reload(),
      error: function () {
        alert("Ошибка передачи. Возможно, были переданы некорреткные данные.");
      }
    });
    document.getElementById("new-sub").className = document.getElementById("new-sub").className + " hide";
  }
  function getAppsPage(pageUrl) {
    document.getElementById('mainBody').remove();
    $.ajax({
      url: pageUrl,
      type: "GET",
      cashe: false,
      data: {},
      success: function(data){
        $('#content').html($(data).find('#content').html());
        foreach()
      },
      error: function () {
        alert("Ошибка передачи. Возможно, были переданы некорреткные данные.");
      }
    });
  }
</script>
<main class="user">
  <section class="user__desktop-menu">
    <div class="user__desktop-img-container">
      <img class="user-info__img-desktop" src="<?= $user['url']; ?>" alt="<?= $user['name']; ?>">
      <h2 class="user-info__heading"><?= $user['name']; ?></h2>
    </div>
    <ul class="user__desktop-mini-menu">
      <li class="user__desktop-menu-item">
        <div class="user__mini-item">
          Личные данные
        </div>
      </li>
      <li class="user__desktop-menu-item">
        <a class="main-menu__default" href="user-apps.php?id=<?= $visitor ?>">
          <div class="user__mini-item user__mini-item--apps">
            Заявки
          </div>
        </a>
      </li>
    </ul>
  </section>
  <section class="user-info" id="mainBody">
    <h2 class="user-info__header">Личные данные</h2>
    <form class="user-info__form" method="post" action="set/edit-profile.php">
      <div class="user-info__form-container">
        <div id="image-edit">
          <label for="name" class="user-info__label">
            Изменить фото
          </label>
          <form method="post">
            <input type="file" name="image" class="image">
          </form>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Загрузка фото</h5>
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
      <div class="user-info__form-container">
        <label for="name" class="user-info__label">
          Имя
        </label>
        <div class="user-info__input-container">
          <input class="user-info__input" type="text" name="name" id="name" value="<?= $user['name']; ?>">
          <picture class="user-info__edit-icon" onclick="inputFocus('name')">
            <source media="(min-width: 1200px)" srcset="img/pen-desktop.svg">
            <img src="img/pen-mob.svg" alt="edit">
          </picture>
        </div>
      </div>
<!--      <div class="user-info__form-container">-->
<!--        <label for="city" class="user-info__label">-->
<!--          Город-->
<!--        </label>-->
<!--        <div class="user-info__input-container">-->
<!--          <input class="user-info__input" type="text" name="city" id="city" value="--><?//= $user['city']; ?><!--">-->
<!--          <picture class="user-info__edit-icon" onclick="inputFocus('name')">-->
<!--            <source media="(min-width: 1200px)" srcset="img/pen-desktop.svg">-->
<!--            <img src="img/pen-mob.svg" alt="edit">-->
<!--          </picture>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="user-info__form-container">-->
<!--        <label for="description" class="user-info__label">-->
<!--          Описание-->
<!--        </label>-->
<!--        <div class="user-info__input-container">-->
<!--          <input class="user-info__input" type="text" name="description" id="description" value="--><?//= $user['info']; ?><!--">-->
<!--          <picture class="user-info__edit-icon">-->
<!--            <source media="(min-width: 1200px)" srcset="img/pen-desktop.svg">-->
<!--            <img src="img/pen-mob.svg" alt="edit">-->
<!--          </picture>-->
<!--        </div>-->
<!--      </div>-->
      <input class="user__submit" type="submit" value="Сохранить">
    </form>
      <hr>
      <div class="user-info__subjects-container">
        <h2 class="user-info__label">Владею предметами</h2>
        <?php foreach($user_subjects as $subject): ?>
        <?php $subid = rand(1, 1000); ?>
        <div class="user-info__subject">
          <button class="user-info__button">
            <?= $subject['title'] ?>
            <img src="img/delete.svg" alt="Удалить">
          </button>
          <picture class="user-info__delete-icon">
            <source media="(min-width: 1200px)" srcset="img/delete-desktop.svg">
            <img src="img/delete.svg" alt="Удалить">
          </picture>
        </div>
        <div class="user-info__input-container">
          <input class="user-info__input" type="text" name="description" id="description" value="<?= $subject['text'] ?>">
          <picture class="user-info__edit-icon">
            <source media="(min-width: 1200px)" srcset="img/pen-desktop.svg">
            <img src="img/pen-mob.svg" alt="edit">
          </picture>
        </div>
        <?php endforeach; ?>
        <a class="user-info__add-button" href="#new-sub">+ Добавить</a>
        <div class="user__form-container" id="new-sub">
          <form class="user__app-form" id="additionalForm">
            <h2 class="user__form-title">Добавление предмета в профиль</h2>
            <p>В каждой заявке высвечивается, в каких предметах ты разбираешься. Напиши подробно о том, в чем ты силен, чтобы быстрее найти человека, с которым ты обменяешься знаниями по заявке.</p>
            <div class="user__max-width">
              <label class="user__max-width">Предмет</label>
              <select name="new-subject" id="new-subject">
                <?php foreach($subjects as $s): ?>
                  <option value="<?= $s['id']; ?>"><?= $s['title']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="user__max-width">
              <label class="user__max-width">Описание навыков</label>
              <textarea class="user__max-width" type="text" name="sub-description" id="sub-description" placeholder="Подробнее опишите проблему. Например: Я не понимаю, как решать параметр через производную."></textarea>
            </div>
            <div class="user__max-width">
              <input class="user__submit" type="button" onclick="sendSub()" value="Добавить">
              <a href="#" class="close">Отменить</a>
            </div>
          </form>
        </div>
<!--        <form class="person__form" id="Dropdown4" method="post" action="set/new-sub.php">-->
<!--          <div class="person__form-container">-->
<!--            <label>Предмет</label>-->
<!--            <select name="new-subject" id="new-subject">-->
<!--              --><?php //foreach($subjects as $s): ?>
<!--                <option value="--><?//= $s['id']; ?><!--">--><?//= $s['title']; ?><!--</option>-->
<!--              --><?php //endforeach; ?>
<!--            </select>-->
<!--          </div>-->
<!--          <div class="person__form-container">-->
<!--            <label for="sub-description">Ваши умения</label>-->
<!--            <textarea class="person__app-description" name="sub-description" id="sub-description" placeholder="Подробно опишите ваши умения в предмете" autofocus="autofocus"></textarea>-->
<!--          </div>-->
<!--          <input class="person__app-btn" type="submit" value="СОХРАНИТЬ">-->
<!--        </form>-->
      </div>
<!--      <div class="user-info__subjects-container">-->
<!--        <h2 class="user-info__label">Хочу разобраться с:</h2>-->
<!--        --><?php //foreach($user_help_subjects as $help_subject): ?>
<!--        --><?php //$subid = rand(1, 1000); ?>
<!--        <div class="user-info__subject">-->
<!--          <button class="user-info__button">-->
<!--            --><?//= $help_subject['title'] ?>
<!--            <picture class="user-info__delete-icon">-->
<!--              <source media="(min-width: 1200px)" srcset="img/delete-desktop.svg">-->
<!--              <img src="img/delete.svg" alt="Удалить">-->
<!--            </picture>-->
<!--          </button>-->
<!--          <picture class="user-info__delete-icon">-->
<!--            <source media="(min-width: 1200px)" srcset="img/delete-desktop.svg">-->
<!--            <img src="img/delete.svg" alt="Удалить">-->
<!--          </picture>-->
<!--        </div>-->
<!--        <div class="user-info__input-container">-->
<!--          <input class="user-info__input" type="text" name="description" id="description" value="--><?//= $help_subject['text'] ?><!--">-->
<!--          <picture class="user-info__edit-icon">-->
<!--            <source media="(min-width: 1200px)" srcset="img/pen-desktop.svg">-->
<!--            <img src="img/pen-mob.svg" alt="edit">-->
<!--          </picture>-->
<!--        </div>-->
<!--        --><?php //endforeach; ?>
<!--        <a class="user-info__add-button" href="#new-help">+ Добавить</a>-->
<!--        <div class="user__form-container" id="new-help">-->
<!--          <form class="user__app-form">-->
<!--            <h2 class="user__form-title">Добавление предмета в профиль</h2>-->
<!--            <p>В каждой заявке высвечивается, в каких предметах ты разбираешься. Напиши подробно о том, в чем ты силен, чтобы быстрее найти человека, с которым ты обменяешься знаниями по заявке.</p>-->
<!--            <div class="user__max-width">-->
<!--              <label class="user__max-width">Предмет</label>-->
<!--              <select>-->
<!--                --><?php //foreach($subjects as $s): ?>
<!--                  <option value="--><?//= $s['id']; ?><!--">--><?//= $s['title']; ?><!--</option>-->
<!--                --><?php //endforeach; ?>
<!--              </select>-->
<!--            </div>-->
<!--            <div class="user__max-width">-->
<!--              <label class="user__max-width">Описание трудностей</label>-->
<!--              <textarea class="user__max-width" type="text" name="app-title" placeholder="Подробнее опишите проблему. Например: Я не понимаю, как решать параметр через производную."></textarea>-->
<!--            </div>-->
<!--            <div class="user__max-width">-->
<!--              <input class="user__submit" type="submit" value="Добавить" onclick="sendNewSubject()">-->
<!--              <a href="#" class="close">Отменить</a>-->
<!--            </div>-->
<!--          </form>-->
<!--        </div>-->
<!--        <form class="person__form" id="Dropdown5" method="post" action="set/new-help-sub.php">-->
<!--          <div class="person__form-container">-->
<!--            <label>Предмет</label>-->
<!--            <select name="new-subject" id="new-subject">-->
<!--              --><?php //foreach($subjects as $s): ?>
<!--                <option value="--><?//= $s['id']; ?><!--">--><?//= $s['title']; ?><!--</option>-->
<!--              --><?php //endforeach; ?>
<!--            </select>-->
<!--          </div>-->
<!--          <div class="person__form-container">-->
<!--            <label for="sub-description">Ваши умения</label>-->
<!--            <textarea class="person__app-description" name="sub-description" id="sub-description" placeholder="Подробно опишите ваши умения в предмете" autofocus="autofocus"></textarea>-->
<!--          </div>-->
<!--          <input class="person__app-btn" type="submit" value="СОХРАНИТЬ">-->
<!--        </form>-->
<!--        <input type="submit" class="user-info__submit" value="Сохранить">-->
<!--      </div>-->
    <div class="banner" id="deleteAccount">
      <div class="banner__wrapper">
        <h2>Удаление аккаунта</h2>
        <p class="banner__description">Нам очень жаль, что у вас появилась такая потребность.</p>
        <p class="banner__instructions">На текущий момент сайт работает в тестовом режиме. Во избежание технических неполадок, для удаления аккаунта просим написать на почту <a href="mailto:info@explorex.ru">info@explorex.ru</a></p>
        <p class="banner__instructions">Просим прощения за неудобства!</p>
        <a class="close" href="#" onclick="nextSlide('deleteAccount')">Отменить</a>
      </div>
    </div>
    <a class="user__apps-button" href="#deleteAccount">Удалить аккаунт</a>
  </section>
</main>
<script>
  // input = document.activeElement;
  // value = $('#name').val();
  // // alert(value);
  // input.onblur = function() {
  //   function isNaS(value) {
  //     if (value.length > 100 || value.length < 5) {
  //       return true;
  //     } else if (!isNaN(value)) {
  //       return true;
  //     }
  //     return false;
  //   }
  //
  //   // if (isNaS(this.value)) { // введено не число // показать ошибку
  //   //   alert(this.value);
  //   // }
  //   if ($('#name').val() !== value) {
  //         alert($('#name').val());
  //         $.ajax({
  //           url: "set/edit-profile.php",
  //           type: "POST",
  //           cashe: false,
  //           data: { content: this.value }, // Отправка
  //           success:
  //             function (data) {
  //               //Окно с сообщением: "данные сохранены"
  //             },
  //           error: function () {
  //             alert("Error 403. Fatal.");
  //           }
  //         });
  //       }
  //     }
</script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="./cropperjs/cropper.min.js" type="text/javascript"></script>
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
    bs_modal.modal('hide');
  });
</script>

