<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../build/css/style.min.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico">
  <link rel="icon" href="img/icon.svg" type="img/svg+xml">
  <link rel="apple-touch-icon" href="img/apple.webp">
  <title><?= $title; ?></title>
  <link href="./cropperjs/cropper.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
</head>
<style>
  img {
    display: block;
    max-width: 100%;
  }
  .preview {
    overflow: hidden;
    width: 200px;
    height: 200px;
    margin: 10px;
    border: 1px solid green;
  }
</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  var statusCur = 0;
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

  var status = true
  function greetings(id, receiverId) {
    var string = "app" + id;
    document.getElementById(string).classList.toggle('apps__button--active');
    status = !status; // feedback status was changed
    $.ajax({
      url: "set/feedback.php",
      type: "POST",
      cashe: false,
      data: {
        appId: id,
        delete: status,
        receiverId: receiverId
      }, // Отправка
      success: {
      },
      error: function () {
        alert("Error 403. Fatal.");
      }
    })
    return status;
  }
  e
</script>
<body class="main-body">
<header class="main-header">
  <img class="main-header__heading" src="../img/xplorus_white.svg" alt="XPLORUM">
  <?php if($username !== null): ?>
    <a class="main-header__username">
      <div class="main-header__profile">
        <a href="logout.php"><img class="main-header__photo--logout" src="../build/img/exit.svg" alt="выйти"></a>
        <img class="main-header__photo--logout" src="img/menu-icon.svg" alt="меню" onclick="Dropdown('mini-menu')" aria-label="Меню личного профиля">
        <a href="user.php?id=<?= $user_id ?>"><img class="main-header__photo" src="<?= $_SESSION['url']; ?>" alt="фото"></a>
      </div>
    </a>
  <?php else: ?>
    <div class="main-header__profile">
      <h2 class="main-header__username"><a class="default" style="color:white;" href="logout.php">Войти</a></h2>
      <a href="login.php"><img class="main-header__photo" src="../build/img/profile.jpg" alt="фото"></a>
    </div>
  <?php endif; ?>
</header>
<?= $content; ?>
<footer class="page-footer">
  <a href="mailto:" class="page-footer__text">info@explorex.ru</a>
  <br class="page-footer__text">
  <a href="agreement.html" class="page-footer__text">пользовательское соглашение</a>
  <br class="page-footer__text">
  <a href="user-agreement.html" class="page-footer__text">согласие на обработку персональных данных</a>
</footer>
</body>
</html>
