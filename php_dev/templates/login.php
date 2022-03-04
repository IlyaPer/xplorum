<form class="login" action="" method="post">
  <label class="login__label">
    Логин
  </label>
  <input class="login__input" type="email" placeholder="Электронная почта" name="email" id="email" value="<?= getPostVal('email') ?>">
  <?php if(isset($errors['email'])){
    print($errors['email']);
  } ?>
  <label class="login__label">
    Пароль
  </label>
  <input class="login__input" type="password" name="password" id="password" placeholder="Только никому не говорите">
  <?php if(isset($errors['password'])){
    print($errors['password']);
  } ?>
  <input class="login__input_button" type="submit" value="Войти">
</form>
