<?php
  require_once("init.php");
  require_once("function.php");
  $sql_users = "SELECT users.id, name, age, info, url FROM users;";
  $result_users = mysqli_query($connection, $sql_users);
  if (!$result_users) {
    exit;
  }
  $users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
  $sql = "SELECT user_id, subject_id, subjects.title AS main FROM user_subjects JOIN subjects ON subjects.id = subject_id LIMIT 20 OFFSET 0;";
  $result = mysqli_query($connection, $sql);
  if ($user_id === null) {
    $person_url = null;
  }
  $subjects = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $content = include_template('reject.php', ['users' => $users, 'subjects' => $subjects, 'connection' => $connection]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Сообщество', 'username' => $username, 'person_url' => $person_url, 'user_id' => $user_id,  'classname_index' => '', 'classname_comm' => 'main-menu__item--active']);
  print($layout_content);
  ?>
