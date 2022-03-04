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
  <link href="cropperjs/cropper.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
<body class="main-body">
<header class="main-header">
  <img class="main-header__heading" src="../img/logotype.svg" alt="explorex">
  <?php if($username !== null): ?>
  <a class="main-header__username" href="user.php?id=<?= $user_id ?>">
    <div class="main-header__profile">
      <img class="main-header__photo--logout" src="../build/img/exit.svg" alt="выйти">
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
<section class="main-menu">
  <ul class="main-menu__list">
    <li class="main-menu__item"><a class="main-menu__default" href="applications.php">Главная</a></li>
    <li class="main-menu__item"><a class="main-menu__default" href="community.php">Пользователи</a></li>
    <li class="main-menu__item"><a class="main-menu__default" href="chat.php?userid=<?= $user_id ?>">Чат</a></li>
  </ul>
</section>
<?= $content; ?>
</body>
</html>
