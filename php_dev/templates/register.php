<form class="registration-form" method="post" enctype="multipart/form-data" action="">
  <div class="registration-form__container">
    <label for="name">
      Ваше имя
    </label>
    <input class="registration-form__input" type="text" name="name" id="name" value="<?= getPostVal('name') ?>">
    <?php if(isset($errors['name'])){
      print("Error/n");
    } ?>
    <label for="email">
      Ваш email
    </label>
    <input class="registration-form__input" type="email" name="email" id="email" value="<?= getPostVal('email') ?>">
    <?php if(isset($errors['email'])){
      print($errors['email']);
    } ?>
  </div>
  <div class="registration-form__container v__container--description">
    <label for="description">
      Расскажите о себе
    </label>
    <textarea class="registration-form__textarea" name="description" id="description" placeholder="Чем подробнее будет ваше описание, тем больше людей захотят с Вами сотрудничать!"></textarea>
  </div>
<!--  <div class="registration-form__container registration-form__container--subjects">-->
<!--    <h4 class="registration-form__subjects-title">-->
<!--      Предметы,  в которых Вы сильны:-->
<!--    </h4>-->
<!--    <div>-->
<!--      <input type="checkbox" id="math" name="math"-->
<!--             checked>-->
<!--      <label for="math">Математика</label>-->
<!---->
<!--      <input type="checkbox" id="russian" name="russian"-->
<!--             checked>-->
<!--      <label for="russian">Русский язык</label>-->
<!---->
<!--      <input type="checkbox" id="english" name="english"-->
<!--             checked>-->
<!--      <label for="english">Английский язык</label>-->
<!--    </div>-->
<!--  </div>-->
<!--  <div class="registration-form__container registration-form__container--subjects">-->
<!--    <h4 class="registration-form__subjects-title">-->
<!--      Предметы, в которых хотите разобраться:-->
<!--    </h4>-->
<!--    <input type="checkbox" id="learn_math" name="math"-->
<!--           checked>-->
<!--    <label for="math">Математика</label>-->
<!---->
<!--    <input type="checkbox" id="learn_russian" name="russian"-->
<!--           checked>-->
<!--    <label for="russian">Русский язык</label>-->
<!---->
<!--    <input type="checkbox" id="learn_english" name="english"-->
<!--           checked>-->
<!--    <label for="english">Английский язык</label>-->
<!--  </div>-->
  <label for="password">
    Придумайте пароль:
  </label>
  <input class="registration-form__input" type="password" name="password" id="password" value="<?= getPostVal('password') ?>">
  <?php if(isset($errors['email'])){
    print($errors['email']);
  } ?>
  <input type="submit" value="Зарегистрироваться">
</form>
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
