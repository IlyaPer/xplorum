<?php
  $connection = mysqli_connect("localhost", "root", "", "youngblood");
  if ($connection === false) {
    exit;
  }
  mysqli_set_charset($connection, "utf8");
?>
