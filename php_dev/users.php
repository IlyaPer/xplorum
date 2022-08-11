<?php
    require_once("init.php");
    if(!isset($_SESSION['user_id'])){
      header('Location: login.php');
      exit;
    }
    require_once("function.php");
    $info = [
        [
          [], []
        ]
      ];

    $sql_user = "SELECT users.id AS id, name, city, email, info, users.url AS img, lock_id FROM users LIMIT 15;";
    $result_user = mysqli_query($connection, $sql_user);
    if (!$result_user) {
      exit;
    }
    $users = mysqli_fetch_all($result_user, MYSQLI_ASSOC);;

    $cnt = 0;
    foreach ($users as $u):
      $info[$cnt][0] = $users[$cnt];
      $sql_user_subject = "SELECT subjects.id, subjects.title AS title, user_subjects.user_id AS sub_user_id, user_subjects.text, user_subjects.subject_id AS subject_id FROM subjects JOIN user_subjects ON subjects.id = user_subjects.subject_id WHERE user_subjects.user_id = " .  $u['id'] . ";";
      $result_user_subject = mysqli_query($connection, $sql_user_subject);
      if (!$result_user_subject) {
        exit;
      }
      $user_help_subjects = mysqli_fetch_all($result_user_subject, MYSQLI_ASSOC);
      $info[$cnt][1] = $user_help_subjects;
      $cnt += 1;
    endforeach;

    $content = include_template('users.php', ['info' => $info, 'connection' => $connection, 'subjects' => $subjects, 'visitor' => $_SESSION['user_id']]);
    $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Пользователи', 'username' => $username, 'person_url' => $person_url, 'user_id' => $user_id]);
    print($layout_content);
?>
