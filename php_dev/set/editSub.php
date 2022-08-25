<?php
  require_once("../init.php");
  require_once("../function.php");

  $errors = [];
  $user = $_POST;
  $rules = [
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

  if (empty($errors)) {
    $info = [$_POST['content']];
    $sql = "UPDATE user_subjects SET text = ? WHERE subject_id = " . intval($_POST['ftp']) . " AND user_id = " . $_SESSION['user_id'];
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
