<?php
  require_once("../init.php");
  require_once("../function.php");



  $id = $_POST['id'];
  $errors = [];
  $user = $_POST;
  $rules = [
    'title' => function(){
      if(!validateFilled('title')){
        return "Заполните это поле";
      }
    },
    'content' => function(){
      if(!validateFilled('content')){
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

  if (empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = [$_POST['title'], $_POST['content']];
    $sql = "UPDATE applications SET title = ?, content = ? WHERE id = '$id' AND user_id =" . $_SESSION['user_id'];
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
