<?php  
date_default_timezone_set('Asia/Bangkok');
    session_start();
    include("../config/connect.inc.php");
    $email = $_POST['email'];

    $checkSql = "SELECT * FROM members WHERE email = '$email' ";
    $qCheck = $conn->query($checkSql);
    $rCheck = $qCheck->num_rows;

    $res = $qCheck->fetch_object();
    $_SESSION['auth'] = $res;
    if($rCheck == 1 ){
        echo $res->role;
    }else{
        echo 0;
    }

?>