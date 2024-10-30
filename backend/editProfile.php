<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include("../config/connect.inc.php");

$userName = $_POST['userName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$memberId = $_POST['memberId'];


$sqlupdate = "UPDATE members SET userName = '$userName' , email = '$email' , phone = '$phone' WHERE id = '$memberId' ";
$qUpdate = $conn->query($sqlupdate);

if ($qUpdate) {
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $upload_dir = "../image/profile";
        $nameFile = $userName . "_" . $date;
        if ($image['error'] == 0) {
            $file_exp = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
            $upload_profile = "$upload_dir/$nameFile.$file_exp";
            move_uploaded_file($image['tmp_name'], $upload_profile);
            $sqlUpdateimage = "UPDATE members SET image = '$upload_profile' WHERE id = '$memberId'";
            $qUpdateImage = $conn->query($sqlUpdateimage);
        }
    }
    $sqlData = "SELECT * FROM members WHERE id = '$memberId'";
    $qData = $conn->query($sqlData);
    $data = $qData->fetch_object();
    $_SESSION['auth'] = $data;
    echo 1;
} else {
    echo 0;
}
