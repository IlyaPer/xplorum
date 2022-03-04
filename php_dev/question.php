<?php
  require_once("init.php");
  require_once("function.php");
  $id = intval($_GET['id']) ?? NULL;
  if ($id === NULL or ctype_digit($_GET['id']) === false) {
    header("Location: pages/404.html");
    exit;
  }

  $sql_question = "SELECT questions.id, questions.date_creation, questions.title, description AS content, questions.url, user_id, subject_id, subjects.id, subjects.title AS sub, users.name, users.url AS photo FROM `questions` JOIN subjects ON subjects.id = subject_id JOIN users ON users.id = user_id WHERE questions.id =" . $id;

  $result_question = mysqli_query($connection, $sql_question);
  if (!$result_question) {
    exit;
  }
  $question = mysqli_fetch_assoc($result_question);
  $sql_answers = "SELECT answers.id, answers.date_creation, answers.content, user_id, question_id, users.name AS name, users.id, users.url as photo FROM answers JOIN users ON users.id = user_id WHERE question_id =" . $id;
  $result_answers = mysqli_query($connection,$sql_answers);
  if (!$result_answers) {
    exit;
  }
  $answers = mysqli_fetch_all($result_answers, MYSQLI_ASSOC);
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    $new_info = [$_POST['content'], $user_id, $id];
    $sql = "INSERT INTO answers (`date_creation`, `content`, `user_id`, `question_id`) VALUES (NOW(), ?, ?, ?);";
    $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
    $res = mysqli_stmt_execute($stmt);
  }


  $content = include_template('question.php', ['question' => $question, 'answers' => $answers]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Союз-тайфун', 'username' => $username, 'subjects' => $subjects, 'person_url' => $person_url]);
  print($layout_content);
  ?>
