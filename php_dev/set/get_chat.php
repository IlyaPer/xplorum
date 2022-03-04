<?php
  require_once("../init.php");

//  $array = [];
//  $i = 0;
//  foreach ($_GET as $g){
//    $array[$i] = $g[0];
//    $i = $i + 1;
//  }
//  var_dump($_GET['offset']);

  if (isset($_GET['receiverid'])) {
    $receiverid = intval($_GET['receiverid']) ?? 0;
  }

  if (isset($_GET['offset'])) {
    $offset = intval($_GET['offset']) ?? 0;
  }
  else {
    $offset = 0;
  }

  $user = array(
    'id' => intval($user_id),
    'username' => $username
  );
  $id = $user['id'];

if ($offset === 0) {
  $sql_history = "SELECT messages.id, messages.user_id, messages.reciever_id, content, date_creation, users.url  FROM messages JOIN users ON users.id = '$receiverid' WHERE user_id = '$id' AND reciever_id = '$receiverid' OR reciever_id = '$id' AND user_id = '$receiverid' ORDER BY date_creation DESC;";
  $result_user_messages = mysqli_query($connection, $sql_history);
  if (!$result_user_messages) {
    exit;
  }

  function secure($val) {
    return (is_array($val))?array_map('secure',$val):htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
  }

  $messages = mysqli_fetch_all($result_user_messages, MYSQLI_ASSOC);
//  $i = 0;
//  foreach ($messages as $rs) {
//    $content = htmlspecialchars($rs['content']);
//    $messages[$rs['content']] = $content;
//  }
  //array_walk_recursive($messages, "htmlspecialchars");
  $messages = secure($messages);
  echo json_encode($messages);
}
else {
  $sql_history = "SELECT * FROM messages WHERE user_id = '$id' AND reciever_id = '$receiverid' OR reciever_id = '$id' AND user_id = '$receiverid' ORDER BY date_creation ASC LIMIT 100 OFFSET " . $offset;
  $result_user_messages = mysqli_query($connection, $sql_history);
  if (!$result_user_messages) {
    die("hello");
    exit;
  }
  $messages = mysqli_fetch_all($result_user_messages, MYSQLI_ASSOC);
  //array_walk_recursive($messages, "htmlspecialchars");
  if (!empty($messages)) {
    echo json_encode($messages);
  }
  else {
    echo json_encode(["status" => 200]);
  }
}
//  $sql_dialog = "SELECT * FROM messages WHERE user_id = '$id' AND reciever_id = '$recieverid' OR user_id = '$recieverid' AND reciever_id = '$id' ORDER BY date_creation DESC;";
//  $result_user_messages = mysqli_query($connection, $sql_dialog);
//  if (!$result_user_messages) {
//    exit;
//  }
//  $messages = mysqli_fetch_all($result_user_messages, MYSQLI_ASSOC);
//  var_dump($messages);
//  file_put_contents('results.json', json_encode($messages));
//  $fp = fopen('results.json', 'w');
//    fwrite($fp, json_encode($messages));
//  fclose($fp);
  ?>
