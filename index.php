<?php
  require_once("init.php");
  require_once("function.php");
  if(isset($_SESSION['user_id'])) {
    header("Location: applications.php");
  }

  $errors = [];
  $user = $_POST;
  $rules = [
    'inputEmail' => function(){
      if(!validateEmail('email')){
        return "Введите корректный email";
      }
    },
    'name' => function(){
    if(!validateFilled('email')){
      return "Введите всое имя";
    }
    },
    'password' => function(){
      if(!validateFilled('password')){
        return "Введите всое имя";
      }
    },
    'checkbox' => function() {
      if(!isset($_POST['checkbox'])){
          return "Необходимо согласиться с политикой конфиденциальности";
        }
      }
  ];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($user as $key => $value) {
      if (isset($rules[$key])) {
        $rule = $rules[$key];
        $result = $rule($value);
        if ($result !== null) {
          $errors[$key] = $result;
        }
      }
    }
  }
  if(!isset($_POST['checkbox'])){
    $errors['checkbox'] = "Необходимо согласиться с политикой конфиденциальности";
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)) {
    $safe_email = mysqli_real_escape_string($connection, $user['email']);
    $sql = "SELECT id FROM users WHERE email = '$safe_email'";
    $res = mysqli_query($connection, $sql);
    $file_path_db = 'img/profile.webp';
    if (mysqli_num_rows($res) > 0) {
      $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
    }
    else{
      $safe_name = mysqli_real_escape_string($connection, $_POST['name']);
      $passwordHash = password_hash($user['password'], PASSWORD_DEFAULT);
      $new_user = [$safe_name, $safe_email, '', $passwordHash, 'Россия'];
      $sql = "INSERT INTO `users`(`register_date`, `name`, `age`, `email`, `info`, `password`, `city`, `url`, `lock_id`) VALUES (NOW(), ?, NOW(), ?, ?, ?, ?, '$file_path_db', 0);";
      $stmt = db_get_prepare_stmt($connection, $sql, $new_user);
      $res = mysqli_stmt_execute($stmt);
      if(!$res){
        die ("offwhite");
      }

      $user_id = intval(mysqli_insert_id($connection));

      if ($res && empty($errors)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['url'] = $file_path_db;
        header("Location: greetings.html");
        exit;
      }
    }
  }
  $content = include_template('index.php', ['connection' => $connection, 'errors' => $errors]);
  print($content);
?>
