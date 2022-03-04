<?php
  require_once("init.php");
  require_once("function.php");

  $sql_questions = "SELECT questions.id, date_creation, questions.title, `description`, questions.url, `user_id`, `subject_id`, subjects.id, subjects.title AS sub FROM `questions` JOIN subjects ON subjects.id = questions.subject_id;";

  $result_questions = mysqli_query($connection, $sql_questions);
  if (!$result_questions) {
    exit;
  }
  $questions = mysqli_fetch_all($result_questions, MYSQLI_ASSOC);

  $content = include_template('questions.php', ['questions' => $questions, 'connection' => $connection, 'subjects' => $subjects]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Союз-тайфун', 'username' => $username, 'subjects' => $subjects, 'person_url' => $person_url]);
  print($layout_content);
  ?>
