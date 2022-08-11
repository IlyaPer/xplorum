<?php
    require_once("init.php");
    $hide = 0;
    $id = intval($_GET['id']) ?? NULL;
    if(!isset($_SESSION['user_id'])){
//      header('Location: login.php');
//      exit;
      $hide = 1;
      $user_id = 0;
      $chat_href = 0;
      $person_url = "img/profile.webp";
      $visitor = 0;
    }
    if ($id === NULL or ctype_digit($_GET['id']) === false) {
      header("Location: pages/404.html");
      exit;
    }
    require_once("function.php");
    $my_account = -1;
    if ($hide !== 1):
      if ($id !== intval($_SESSION['user_id']) & intval($_SESSION['user_id']) !== 0){
        $my_account = 0;
        $visitor = $_SESSION['user_id'];
       // header("Location: user.php?id=" . $_SESSION['user_id']);
        $url = array(
          'userid' => $_SESSION['user_id'],
          'reciever' => $id
        );
        $chat_href = "chat.php?" . http_build_query($url, '', '&amp;');
      }
      else {
        $my_account = 1;
        $chat_href = 0;
      }
    endif;

    $sql_user = "SELECT users.id, name, city, email, info, users.url, lock_id FROM users WHERE users.id = '$id';";
    $result_user = mysqli_query($connection, $sql_user);
    if (!$result_user) {
      exit;
    }
    $user = mysqli_fetch_assoc($result_user);

    if (empty($user)) {
      header("Location: login.php");
    }

    $sql_applications = "SELECT applications.id AS appId, `date_creation`, applications.title AS title, `content`, applications.url, `user_id`, `subject_id`, users.id, subjects.id, subjects.title AS mainTitle, subjects.color_hex_id FROM `applications` JOIN users ON user_id = users.id JOIN subjects ON subjects.id = subject_id WHERE user_id = '$id';";
    $result_lots = mysqli_query($connection, $sql_applications);
    if (!$result_lots) {
      exit;
    }
    $applications = mysqli_fetch_all($result_lots, MYSQLI_ASSOC);

    $sql_user_subject = "SELECT subjects.id, subjects.title AS title, user_subjects.user_id AS sub_user_id, user_subjects.text, user_subjects.subject_id AS subject_id FROM subjects JOIN user_subjects ON subjects.id = user_subjects.subject_id WHERE user_subjects.user_id = '$id';";
    $result_user_subject = mysqli_query($connection, $sql_user_subject);
    if (!$result_user_subject) {
      exit;
    }
    $user_subjects = mysqli_fetch_all($result_user_subject, MYSQLI_ASSOC);

//    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//      $safe_text = mysqli_real_escape_string($connection, $_POST['content']);
//      $subject_id = intval($_POST['subject_id']);
//      if (isset($_POST['status']) && intval($_POST['status']) === 1) {
//        $sql = "UPDATE user_help_subjects SET text = '$safe_text' WHERE subject_id = '$subject_id' AND user_id = '$id';";
//      }
//      else {
//        $sql = "UPDATE user_subjects SET text = '$safe_text' WHERE subject_id = '$subject_id' AND user_id = '$id';";
//      }
//      $result_subjects = mysqli_query($connection, $sql);
//      if (!$result_subjects) {
//        die("Ошибка" . mysqli_error($result_subjects));
//      }
//      else {
//        header("Location: user.php?id=" . $id);
//      }
//    }
    $content = include_template('usr.php', ['user' => $user, 'connection' => $connection, 'apps' => $applications, 'userSubjects' => $user_subjects, 'subjects' => $subjects, 'receiver' => $id, 'my_account' => $my_account, 'id' => $id, 'visitor' => $visitor, 'chat_href' => $chat_href, 'hide' => $hide]);
    $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Профиль', 'username' => $username, 'person_url' => $person_url, 'user_id' => $user_id]);
    print($layout_content);
?>
