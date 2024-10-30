<?php
date_default_timezone_set('Asia/Bangkok');
    session_start();
    include("../config/connect.inc.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $EncodePass = md5($password);

    $sqlCheck = "SELECT * FROM members WHERE email = '$email' AND password = '$EncodePass'";
    $qCheck = $conn->query($sqlCheck);
    $rCheck = $qCheck->num_rows;
    $data = $qCheck->fetch_object();
    $_SESSION['auth'] = $data;
    if($rCheck == 1){
        echo $data->role;
    }else{
        echo 0;
    }

?>