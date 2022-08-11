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

  function greetings(id, receiverId) {
          var string = "app" + id;
          let stat = $('#' + string).attr('class').split(' ')[1] === '' ? false : true;
          console.log($('#' + string).attr('class').split(' ')[1])
          console.log(stat)
          document.getElementById(string).classList.toggle('apps__button--active');
          $.ajax({
              url: "set/feedback.php",
              type: "POST",
              cashe: false,
              data: {
                  appId: id,
                  delete: stat,
                  receiverId: receiverId
              }, // Отправка
              success: {
              },
              error: function () {
                  alert("Error 403. Fatal.");
              }
          })
  }
</script>
<body class="main-body">
<svg display="none">
  <symbol class="land-main__card-svg" width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg" id="feedback">
    <circle cx="26" cy="26" r="25.5" stroke="#00FF66" stroke-opacity="0.56"/>
    <path d="M19.8706 26.2233L21.6747 29.3409C21.8954 29.5543 22.1485 29.7027 22.4097 29.7801C22.7948 29.8914 23.1987 29.8419 23.5406 29.5914C23.5568 29.579 23.5729 29.5666 23.5918 29.5543C23.9176 29.2945 24.1303 28.8893 24.2084 28.4409C24.2865 27.9893 24.2245 27.5006 23.993 27.0862C23.9795 27.0645 23.9688 27.0429 23.9553 27.0212L21.6046 23.1521C21.3219 22.6851 20.9207 22.3696 20.4953 22.2459C20.1102 22.1315 19.7064 22.184 19.3644 22.4346C19.3482 22.4469 19.3321 22.4593 19.3132 22.4717C18.9874 22.7315 18.7747 23.1397 18.6966 23.5851C18.6185 24.0366 18.6805 24.5253 18.912 24.9398C18.9255 24.9614 18.9363 24.9831 18.9497 25.0047L19.0494 25.1717C19.3429 25.4439 19.6202 25.7934 19.8706 26.2233ZM23.8745 9.42606C23.8476 9.43533 23.818 9.44152 23.791 9.44771C23.3737 9.57142 23.0371 9.89308 22.8217 10.3168C22.5874 10.7776 22.4986 11.3529 22.6117 11.9313L24.8061 23.3469C25.1643 23.0253 25.5708 22.7933 26.0313 22.6572C26.6452 22.4748 27.3345 22.4809 28.1073 22.6882C27.7815 21.0211 27.4637 19.3386 27.1487 17.6561C26.7206 15.3829 26.2925 13.1096 25.894 11.1178C25.8832 11.0807 25.8778 11.0436 25.8697 11.0065C25.7486 10.456 25.4605 10.0044 25.0889 9.71988C24.7308 9.44461 24.3026 9.32708 23.8745 9.42606ZM33.3605 7.01055C33.409 7.01055 33.4575 7.01673 33.5033 7.02601C34.373 7.14972 35.1215 7.6786 35.6331 8.44253C36.1366 9.19409 36.4086 10.1714 36.3359 11.2044C36.3359 11.257 36.3305 11.3065 36.3224 11.356L35.2184 24.1294H35.2211C35.2184 24.148 35.2184 24.1635 35.2158 24.182C35.3746 24.3243 35.5227 24.482 35.66 24.6552C36.2336 25.3728 36.6051 26.3284 36.7667 27.4264C37.0036 29.0409 37.0683 30.9584 36.9229 32.8234C36.7882 34.5461 36.4786 36.2348 35.9643 37.6235C34.7338 40.9452 32.5501 43.2154 30.0271 44.2886C28.8504 44.7896 27.6038 45.0309 26.349 44.9968C25.0889 44.9628 23.8207 44.6566 22.6063 44.0628C20.2072 42.8875 18.0127 40.5957 16.5156 37.0792C15.7859 35.3626 15.6728 34.2925 15.3659 32.4894C15.3174 32.1956 15.3982 31.9079 15.5624 31.7038L14.5689 29.9873C13.753 28.5769 13.8876 27.1171 14.5123 26.0315C14.752 25.6171 15.0643 25.2614 15.4224 24.9892C15.7832 24.714 16.1925 24.5191 16.6233 24.4325C16.8064 24.3954 16.9895 24.3769 17.1753 24.38C17.1349 23.9995 17.1484 23.6191 17.213 23.248C17.3638 22.3758 17.7946 21.5747 18.4516 21.049C18.4839 21.0211 18.5189 20.9964 18.5539 20.9685C19.2702 20.4459 20.0941 20.3314 20.8669 20.5572C21.6289 20.7799 22.3397 21.3366 22.8379 22.1562L23.021 22.4562L21.0715 12.3148C20.8696 11.2725 21.0311 10.2302 21.4566 9.39513C21.8901 8.5415 22.5955 7.89819 23.4787 7.66314C23.4975 7.65695 23.5191 7.65386 23.5379 7.65076C24.3996 7.44354 25.2612 7.67241 25.964 8.21057C26.6667 8.75182 27.208 9.60544 27.4153 10.6446H27.418C27.4207 10.6632 27.4234 10.6848 27.4287 10.7034C27.8623 12.8715 28.2769 15.0705 28.6916 17.2664C28.8235 17.9747 28.9581 18.6798 29.0901 19.3788L29.8494 10.6106C29.8494 10.558 29.8548 10.5086 29.8629 10.4591C29.9706 9.43224 30.4041 8.53532 31.0261 7.91366C31.6588 7.28581 32.4855 6.93322 33.3605 7.01055ZM34.3837 9.55286C34.1226 9.16316 33.751 8.89409 33.3229 8.82914C33.3067 8.82914 33.2905 8.82604 33.2744 8.82604V8.81986C32.8247 8.76728 32.3939 8.94976 32.0627 9.28069C31.7261 9.61781 31.4919 10.1034 31.43 10.6663C31.43 10.6848 31.4273 10.7065 31.4273 10.725H31.4219L30.3879 22.6665L33.7267 23.0469L34.7553 11.1766C34.7553 11.1519 34.758 11.1302 34.758 11.1055H34.7607C34.8119 10.5209 34.6638 9.9673 34.3837 9.55286ZM22.6682 31.5739C22.7517 32.0719 22.7409 32.5791 22.6467 33.0616C22.4744 33.9461 22.022 34.7503 21.3435 35.2699C21.3327 35.276 21.2977 35.3039 21.2384 35.3441L21.2411 35.3472C21.2277 35.3565 21.2169 35.3626 21.2061 35.3688C20.4791 35.8606 19.6498 35.9441 18.8797 35.6967C18.387 35.5389 17.9158 35.242 17.5146 34.8307C18.457 38.1338 20.1399 40.8926 23.2256 42.4019C24.2542 42.9061 25.3231 43.1659 26.3786 43.1937C27.4395 43.2215 28.4896 43.0205 29.4778 42.5968C31.6104 41.6875 33.4602 39.7545 34.513 36.9152C34.9626 35.7029 35.2346 34.2059 35.3558 32.6688C35.4877 30.9584 35.4312 29.2048 35.2131 27.7233C35.1 26.9625 34.863 26.3253 34.5022 25.8738C34.1845 25.4748 33.7537 25.2088 33.2205 25.1253C32.0385 24.9428 29.9006 24.9861 26.8364 25.048C26.5052 25.0542 26.1659 25.0604 25.8132 25.0697C25.6301 25.7655 25.6085 26.3717 25.7055 26.8882C25.797 27.3738 25.9963 27.7883 26.2736 28.1254C26.5671 28.4842 26.9441 28.7656 27.3668 28.9666C28.1369 29.3285 29.0443 29.4213 29.8736 29.2264C30.2856 29.0996 30.7137 29.3687 30.8376 29.8419C30.9614 30.3213 30.7245 30.8285 30.3071 30.9739L30.081 30.1048L30.3071 30.9739C27.1972 32.044 27.1864 32.4925 27.1433 34.1843C27.1406 34.2987 27.1379 34.4162 27.1353 34.4874C27.1218 34.9884 26.7583 35.3781 26.3221 35.3626C25.8886 35.3472 25.5466 34.9296 25.5601 34.4286C25.5628 34.2956 25.5655 34.2121 25.5682 34.1317C25.6112 32.3811 25.6328 31.4564 26.7556 30.6337C26.2628 30.4017 25.8105 30.0862 25.4201 29.6965C25.1993 30.1976 24.8735 30.6399 24.4588 30.9739C24.4238 31.0017 24.3915 31.0265 24.3565 31.0543C23.8287 31.4378 23.2471 31.6017 22.6682 31.5739ZM20.5141 30.4759C20.3499 30.2935 20.1991 30.0924 20.0645 29.8697L17.9723 26.4274C17.6115 26.1552 17.2319 26.0779 16.8818 26.1491C16.6583 26.1954 16.4456 26.2944 16.2544 26.4398C16.0633 26.5851 15.8963 26.7738 15.7698 26.9934C15.4547 27.5377 15.3955 28.2862 15.8263 29.0316L18.1554 33.0585C18.4381 33.5502 18.8447 33.8874 19.2782 34.0234C19.666 34.1472 20.0752 34.11 20.4307 33.8719C20.4387 33.8657 20.4441 33.8595 20.4522 33.8564V33.8595C20.4576 33.8564 20.4657 33.8502 20.5034 33.8193C20.848 33.5564 21.0796 33.142 21.1657 32.6842C21.2546 32.2234 21.1981 31.7162 20.9665 31.277C20.9476 31.243 20.9369 31.2182 20.9288 31.2089L20.5141 30.4759Z" fill="#00FC65" fill-opacity="0.42"/>
  </symbol>
</svg>
<header class="main-header">
  <a href="applications.php">
    <img class="main-header__heading" src="../img/xplorus_white.svg" alt="explorex">
  </a>
  <?php if($username !== null): ?>
  <a class="main-header__username">
      <div class="main-header__profile">
        <img class="main-header__photo--logout-box" src="img/menu-icon.svg" alt="меню" onclick="Dropdown('mini-menu')" aria-label="Меню личного профиля">
        <a href="user.php?id=<?= $user_id ?>" onclick="Dropdown('mini-menu')" aria-label="Меню личного профиля"><img class="main-header__photo" src="<?= $_SESSION['url']; ?>" alt="фото"></a>
      </div>
    </a>
  <?php else: ?>
  <div class="main-header__profile">
    <p class="main-header__username"><a class="default" style="color:white;" href="logout.php">Войти</a></p>
    <a href="login.php"><img class="main-header__photo" src="../build/img/profile.jpg" alt="фото"></a>
  </div>
  <?php endif; ?>
</header>
<section class="main-menu">
  <ul class="main-menu__list">
    <li class="main-menu__item"><a class="main-menu__default" href="applications.php">Главная</a></li>
    <li class="main-menu__item"><a class="main-menu__default" href="community.php">Пользователи</a></li>
    <li class="main-menu__item main-menu__item--notions"><a class="main-menu__default" href="chat.php?userid=<?= $user_id ?>">Чат</a> <button class="main-menu__notion">5</button></li>
  </ul>
  <ul class="main-header__mini-menu" id="mini-menu">
      <li class="main-header__mini-item">
        <a class="main-header__mini-href" href="user.php?id=<?= $user_id ?>">
          Личные данные
        </a>
      </li>
      <li class="main-header__mini-item main-header__mini-item--apps">
        <a class="main-header__mini-href" href="user-apps.php?id=<?= $user_id ?>">
          Заявки
        </a>
      </li>
      <li class="main-header__mini-item main-header__mini-item--logout">
        <a class="main-header__mini-href" href="logout.php">Выход</a>
      </li>
    </ul>
</section>
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
