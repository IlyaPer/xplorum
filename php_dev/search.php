<?php
require_once("init.php");
require_once("function.php");
  $search = $_GET['search'] ?? '';
  if ($search === '') {
    header("Location: pages/404.html");
  }
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (iconv_strlen($search) < 4) {
    $errors['search'] = 'Введите более 3-х символов для поиска лота';
  }
}
if ($search && empty($errors)) {
  $cur_page = $_GET['page'] ?? 1;
  $page_items = 9;
  $sql = 'SELECT COUNT(*) as cnt, id FROM applications WHERE MATCH(applications.title, content) AGAINST(?) group by applications.id';
  $stmt = db_get_prepare_stmt($connection, $sql, [$search]);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if (!$result) {
    die(mysqli_error($result));
  }
  $count_lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $items_count = count($count_lots);

  $pages_count = ceil($items_count / $page_items);
  $offset = ($cur_page - 1) * $page_items;

  $pages = range(1, $pages_count);
  if ($cur_page > $pages_count + 1 or ctype_digit($cur_page)) {
    header("Location: pages/404.html");
  }

  $sql = 'SELECT subjects.title AS main_title, applications.title, applications.id AS id, applications.url, applications.title, applications.content, date_creation, applications.user_id FROM applications JOIN subjects ON subjects.id = applications.subject_id WHERE MATCH(applications.title, content) AGAINST (?) ORDER BY date_creation DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
  $stmt = db_get_prepare_stmt($connection, $sql, [$search]);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if ($applications) {
    $tpl_data = [
      'subjects' => $subjects,
      'search' => $search,
      'applications' => $applications,
      'pages' => $pages,
      'pages_count' => $pages_count,
      'current_page' => $cur_page,
      'items_count' => $items_count
    ];
  } else {
    $tpl_data = [
      'pages_count' => 0,
      'items_count' => 0,
      'subjects' => $subjects
    ];
  }
} else {
  $tpl_data = [
    'pages_count' => 0,
    'items_count' => 0,
    'errors' => $errors,
    'search' => $search,
    'subjects' => $subjects
  ];
}

$content = include_template('search.php', $tpl_data);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Результаты поиска', 'username' => $username, 'search' => $search]);
print($layout_content);
?>
