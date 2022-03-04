<?php
require_once("../init.php");
require_once("../function.php");

$id = $_SESSION['user_id'];

$errors = [];
$user = $_POST;
$rules = [
  'per-name' => function(){
    if(!validateFilled('per-name')){
      return "Заполните это поле";
    }
  },
  'per-info' => function(){
    if(!validateFilled('per-info')){
      return "Заполните это поле";
    }
  }
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = return_validated_errors($rules, $errors);
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

if(empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = [$_POST['per-name'], $_POST['per-city'], $_POST['per-info']];
    $sql = "UPDATE users SET name = ?, city = ?, info = ? WHERE users.id =" . $_SESSION['user_id'];
    $stmt = db_get_prepare_stmt($connection, $sql, $info);
    $res = mysqli_stmt_execute($stmt);
    if (!$res) {
      print(mysqli_error($connection));
      exit;
    } else {
      header("Location: ../user.php?id=" . $user_id);
    }
  }
?>
