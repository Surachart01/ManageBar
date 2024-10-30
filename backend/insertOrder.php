<?php
include("../config/connect.inc.php");
date_default_timezone_set('Asia/Bangkok');
session_start();
$memberId = $_SESSION['auth']->id;
$userName = $_SESSION['auth']->userName;
$date = date("Y-m-d H:i:s");
$sqlCart = "SELECT * FROM reserve WHERE memberId = '$memberId' AND state = '1'";
$qSql = $conn->query($sqlCart);
$rSql = $qSql->num_rows;


if ($qSql->num_rows > 0) {
    // receive image UID and save to path /image/UID by name is {Username}_{currentDate}
    $UID = $_FILES['UID'];
    $upload_dir = "../image/UID";
    $nameFile = $userName . "_" . $date;
    if ($UID['error'] == 0) {
        $file_exp = strtolower(pathinfo($UID['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
        $upload_UID = "$upload_dir/$nameFile.$file_exp";
        move_uploaded_file($UID['tmp_name'], $upload_UID);
        
    } 

    // receive image SLIP and save to path /image/SLIP by name is {Username}_{currentDate}
    $upload_SLIP = "none";
    if (isset($_FILES['SLIP'])) {
        $SLIP = $_FILES['SLIP'];
        $upload_dir = "../image/SLIP";
        $nameFile = "$userName" . "_" . "$date";
        if ($SLIP['error'] == 0) {
            $file_exp = strtolower(pathinfo($SLIP['name'], PATHINFO_EXTENSION));
            $upload_SLIP = "$upload_dir/$nameFile.$file_exp";
            move_uploaded_file($SLIP['tmp_name'], $upload_SLIP);
            $statusOrder = '1';
        }
    }else{
        $statusOrder = '2';
    }

    $sqlOrder = "INSERT INTO orders (memberId,date,SLIP,UID,state) VALUES ('$memberId','$date','$upload_UID','$upload_SLIP','$statusOrder')";
    $qOrder = $conn->query($sqlOrder);
    $orderId = $conn->insert_id;
    $count = 1;
    if(isset($_POST['total'])){
        $type = 'A';
        $state = '2';
    }else{
        $type = 'N';
        $state = '3';
    }
    while ($item = $qSql->fetch_object()) {
        $sqlUpdateReserve = "UPDATE reserve SET orderId = '$orderId' ,type = '$type', state = '$state' WHERE id = '$item->id' ";
        $qUpdateReserve = $conn->query($sqlUpdateReserve);
        if($qUpdateReserve){
            $count++;
        }
    }

    if($qUpdateReserve){
        echo 1;
    }else{
        echo 0;
    }


}
