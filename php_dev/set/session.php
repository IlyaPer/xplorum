<?php
  require_once("../init.php");
//  if (isset($_SESSION['user_id']) or !isset($_SESSION['user_id']))
//  {
//    header("Location: applications.php");
//  }
//  else {
    $user = array(
      'id' => intval($user_id),
      'username' => $username
    );

    $userid = $user['id'];
    echo json_encode($userid);

//    $sql_history = "SELECT * FROM messages WHERE user_id = '$userid' OR reciever_id = '$userid' ORDER BY date_creation DESC;";
//    $result_user_messages = mysqli_query($connection, $sql_history);
//    if (!$result_user_messages) {
//      exit;
//    }
//    $messages = mysqli_fetch_all($result_user_messages, MYSQLI_ASSOC);
//    echo json_encode($messages);
  //}
?>
