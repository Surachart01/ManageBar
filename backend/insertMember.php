<?php
date_default_timezone_set('Asia/Bangkok');
include("../config/connect.inc.php");
$userName = $_POST['userName'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$password = $_POST['password'];
$encodePass = md5($password);

$sqlCheck = "SELECT * FROM members WHERE phone = '$tel' OR email = '$email'";
$qCheck = $conn->query($sqlCheck);
$rCheck = $qCheck->num_rows;
if ($rCheck == 0) {
    $sqlInsert = "INSERT INTO members (userName,email,phone,password,role) VALUES ('$userName','$email','$tel','$encodePass','1')";
    $res = $conn->query($sqlInsert);
    if ($res) {
        echo 1;
    } else {
        echo 3;
    }
} else {
    echo 0;
}
