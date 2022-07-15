<?php
require_once("init.php");
require_once("function.php");

if (isset($_SESSION['user_id'])) {
  header("Location: applications.php");
}

$sql_subjects = "SELECT id, title, color_hex_id, url FROM subjects;";
$result_subjects = mysqli_query($connection, $sql_subjects);
if (!$result_subjects) {
  exit;
}
$subjects = mysqli_fetch_all($result_subjects, MYSQLI_ASSOC);

$result = mysqli_query($connection, "SELECT COUNT(*) as cnt, id FROM applications group by id;");
$app_count = mysqli_fetch_all($result, MYSQLI_ASSOC);
$items_count = count($app_count);

if (isset($_GET['page'])) {
  if (is_numeric($_GET['page']) === false) {
    header("Location: pages/404.html");
  }
  $current_page = intval($_GET['page']);
} else {
  $current_page = 1;
}
$page_items = 20;
$pages_count = ceil($items_count / $page_items);
$offset = ($current_page - 1) * $page_items;
$pages = range(1, $pages_count);

if (($current_page > $pages_count + 1) or $current_page <= 0) {
  header("Location: ../pages/404.html");
}

$sql_applications = 'SELECT applications.id as AppId, date_creation, applications.title, content, applications.url, user_id, subject_id, users.id AS mainId, users.url AS photo, users.name AS author, subjects.id, subjects.title AS main_title, subjects.color_hex_id FROM applications JOIN users ON user_id = users.id JOIN subjects ON subjects.id = subject_id
     ORDER BY date_creation  DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
$result_applications = mysqli_query($connection, $sql_applications);
if (!$result_applications) {
  print("error in connection state");
  exit;
}
$applications = mysqli_fetch_all($result_applications, MYSQLI_ASSOC);

$subject_id = $_GET['subject'] ?? null;
if (isset($_GET['subject']) && ctype_digit($subject_id) === false) {
  header("Location: ../pages/404.html");
}
if ($subject_id !== null) {
  $subject_id = intval($_GET['subject']);

  $result = mysqli_query($connection, "SELECT COUNT(*) as cnt FROM applications WHERE applications.subject_id ='$subject_id' group by applications.id;");
  $apps = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $items_count = count($apps);
  $pages_count = ceil($items_count / $page_items);
  $offset = ($current_page - 1) * $page_items;
  $pages = range(1, $pages_count);
  if ($current_page > $pages_count + 1 or ctype_digit($current_page)) {
    header("Location: pages/404.html");
  }
  // запрос на показ девяти лотов
  $sql = 'SELECT applications.id as AppId, date_creation, applications.title, content, applications.url, user_id, subject_id, users.id AS mainId, users.url AS photo, users.name AS author, subjects.id, subjects.title AS main_title, subjects.color_hex_id FROM applications JOIN users ON user_id = users.id JOIN subjects ON subjects.id = subject_id
     WHERE subject_id = ' . $subject_id . '
     ORDER BY date_creation DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
  $applications = mysqli_query($connection, $sql);
  if ($applications) {
    $tpl_data = [
      'applications' => $applications,
      'pages' => $pages,
      'pages_count' => $pages_count,
      'current_page' => $current_page,
      'subjects' => $subjects,
      'connection' => $connection
    ];
  }
}
else {
  $tpl_data = [
    'applications' => $applications,
    'pages' => $pages,
    'pages_count' => $pages_count,
    'current_page' => $current_page,
    'subjects' => $subjects,
    'connection' => $connection
  ];
}
$content = include_template('view.php', $tpl_data);
$layout_content = include_template('viewLayout.php', ['content' => $content, 'title' => 'Explorex - knowledge exchange', 'username' => $username, 'subjects' => $subjects, 'user_id' => $user_id]);
print($layout_content);
?>
