<?php
  require_once("init.php");
  require_once("function.php");

  $content = include_template('blog.html', []);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Explorex - knowledge exchange', 'username' => $username, 'user_id' => $user_id]);
  print($layout_content);
  ?>
