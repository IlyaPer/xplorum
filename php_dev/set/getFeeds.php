<?php
  require_once("../init.php");

  $receiverId = intval($_GET['receiverid']);
  $sql_history = "SELECT `feeds.id`, `userId`, `appId`, applications.user_id AS receiverId FROM feeds JOIN applications ON applications.id = appId WHERE userId = '$userid' AND receiverId = '$receiverId' ORDER BY date_creation DESC;";
  $result_user_messages = mysqli_query($connection, $sql_history);
  if (!$result_user_messages) {
    exit;
  }
  if (!empty(mysqli_fetch_assoc($result_user_messages))) {
    print(true);
  }
  ?>
