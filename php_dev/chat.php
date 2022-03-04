<?php
  require_once("init.php");
  require_once("function.php");

    $id = intval($_SESSION['user_id']) ?? 0;
    if (intval($_GET['userid']) !== $id) {
      header("Location: chat.php?userid=" . $id);
      exit();
    }

  if (isset($_GET['userid']) && isset($_GET['reciever'])) {
    $reciever_id = intval($_GET['reciever']);
    $sql_dialog = "SELECT * FROM messages WHERE user_id = '$id' AND reciever_id = '$reciever_id' ORDER BY date_creation DESC;";
    $result_user_messages = mysqli_query($connection, $sql_dialog);
    if (!$result_user_messages) {
      exit;
    }
    $messages = mysqli_fetch_all($result_user_messages, MYSQLI_ASSOC);
  }

  $id = intval($_GET['userid']) ?? 0;

  if (!isset($_SESSION['user_id'])) {
    header("Location: /index.php");
    exit();
  }
  $sql_messages = "SELECT * FROM users WHERE id IN (SELECT reciever_id FROM messages WHERE user_id = '$id') OR id IN (SELECT user_id FROM messages WHERE reciever_id = '$id')";
  $result_user_messages = mysqli_query($connection, $sql_messages);
  if (!$result_user_messages) {
    exit;
  }
  $all_messages = mysqli_fetch_all($result_user_messages, MYSQLI_ASSOC);
//  foreach ($all_messages as $app):
//    if (!in_array($reciever_id, $app['reciever_id'])) {
//
//    }
//  endforeach;
  $messages = [];

  $content = include_template('chat1.php', ['connection' => $connection, 'messages' => $messages, 'all_messages' => $all_messages, 'user_id' => $user_id]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Профиль', 'username' => $username, 'person_url' => $id, 'user_id' => $user_id]);
  print($layout_content);
?>
