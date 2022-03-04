<?php
  session_start();
  if(isset($_SESSION['user_id']) && $_SESSION['user_name']){
      $user_id = intval($_SESSION['user_id']);
      $username = $_SESSION['user_name'];
      $url = $_SESSION['url'];
      $person_url = "user.php?" . http_build_query(['id' => $user_id]);
  }
  else{
      $user_id = null;
      $username = null;
  }
  $connection = mysqli_connect("localhost", "root", "", "taifun");
  if ($connection === false) {
    exit;
  }
  mysqli_set_charset($connection, "utf8");
  $sql_subjects = "SELECT `id`, `title`, `color_hex_id`, `url` FROM `subjects`;";
  $result_subjects = mysqli_query($connection, $sql_subjects);
  if (!$result_subjects) {
    exit;
  }
  $subjects = mysqli_fetch_all($result_subjects, MYSQLI_ASSOC);
?>
