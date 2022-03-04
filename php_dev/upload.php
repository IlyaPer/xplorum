<?php
  require_once("function.php");
  require_once("init.php");

  $folderPath = 'uploads/';

  var_dump($_POST);
  $image_parts = explode(";base64,", $_POST['image']);
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];
  $image_base64 = base64_decode($image_parts[1]);
  $file = $folderPath . uniqid() . '.jpg';
  file_put_contents($file, $image_base64);
//  move_uploaded_file($_POST['image'], $file);
//  $file_upload_result = move_uploaded_file($_POST['image'], $file);
//  if (!$file_upload_result){
//    die('Произошла ошибка загрузки фото!' . var_dump($_FILES));
//  }
  echo json_encode(["image uploaded successfully."]);

  $sql = "UPDATE users SET url = '$file' WHERE users.id = '$user_id'";
  $stmt = mysqli_query($connection, $sql);
  if (!$stmt){
    die('error');
  }
?>
