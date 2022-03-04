<?php
  function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
      $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
      die($errorMsg);
    }

    if ($data) {
      $types = '';
      $stmt_data = [];

      foreach ($data as $value) {
        $type = 's';

        if (is_int($value)) {
          $type = 'i';
        }
        else if (is_string($value)) {
          $type = 's';
        }
        else if (is_double($value)) {
          $type = 'd';
        }

        if ($type) {
          $types .= $type;
          $stmt_data[] = $value;
        }
      }

      $values = array_merge([$stmt, $types], $stmt_data);

      $func = 'mysqli_stmt_bind_param';
      $func(...$values);

      if (mysqli_errno($link) > 0) {
        $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
        die($errorMsg);
      }
    }

    return $stmt;
  }

  function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
      return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
  }

  function is_date_valid(string $date) : bool {
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
  }

  function getFilesVal(string $name) {
    return $_FILES[$name] ?? "";
  }

  function validateEmail(string $name) {
    if (!filter_input(INPUT_POST, $name, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
    else{
      return true;
    }
  }

  function validateFilled(string $name) {
    if (empty($_POST[$name])) {
      return false;
    }
    else{
      return true;
    }
  }

  function validateSubjects(int $id, array $allowed_list) {
    if (!in_array($id, $allowed_list)) {
      return "Указан несуществующий предмет";
    }
  }

  function validateImage(){
    if (!empty($_FILES['photo']['name'])) {
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $tmp_name = $_FILES['photo']['tmp_name'];
      $file_type = finfo_file($finfo, $tmp_name);
      if($file_type !== "image/jpeg" && $file_type !== "image/png" && $file_type !== "image/jpg"){
        return false;
      }
    }
    if(empty($_FILES['photo']['name'])){
      return "Пусто(";
    }
    else{
      return true;
    }
  }

  function getPostVal(string $name) {
    return $_POST[$name] ?? "";
  }

  function return_validated_errors(array $rules, array $errors)
  {
    foreach ($_POST as $key => $value) {
      if (isset($rules[$key])) {
        $rule = $rules[$key];
        $result = $rule($value);
        if ($result !== null) {
          $errors[$key] = $result;
        }
      }
    }
    return $errors;
  }
?>
