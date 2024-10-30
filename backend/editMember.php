<?php  
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');

    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $memberId = $_POST['memberId'];

    $sqlUpdate = "UPDATE members SET userName = '$userName',email = '$email',phone = '$phone' WHERE id = '$memberId'";
    $qUpdate = $conn->query($sqlUpdate);
    if($qUpdate){
        echo 1;
    }else{
        echo 0;
    }
?>