<?php
date_default_timezone_set('Asia/Bangkok');
session_start();
include("../config/connect.inc.php");
$date = date("Y-m-d_H:i:s");

$name = $_POST['name'];
$description = $_POST['description'];
$newId = $_POST['newId'];
$memberId = $_SESSION['auth']->id;

if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $upload_dir = "../image/News";
    $nameFile = $userName . "_" . $date;
    if ($image['error'] == 0) {
        $file_exp = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
        $upload_UID = "$upload_dir/$nameFile.$file_exp";
        move_uploaded_file($image['tmp_name'], $upload_UID);
    }
    $sqlInsert = "UPDATE News SET name = '$name',image = '$upload_UID',description = '$description',memberId = '$memberId' WHERE id = '$newId' ";
    $qInsert = $conn->query($sqlInsert);
    if ($qInsert) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    $sqlInsert = "UPDATE News SET name = '$name',description = '$description',memberId = '$memberId' WHERE id = '$newId' ";
    $qInsert = $conn->query($sqlInsert);
    if ($qInsert) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
