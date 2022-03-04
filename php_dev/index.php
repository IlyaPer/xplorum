<?php
  require_once("init.php");
  require_once("function.php");
  if(isset($_SESSION['user_id'])) {
    header("Location: applications.php");
  }
  $content = include_template('index.php', ['connection' => $connection]);
  print($content);
?>
