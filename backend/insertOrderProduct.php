<?php

//initialize Values
date_default_timezone_set('Asia/Bangkok');
session_start();
include("../config/connect.inc.php");
$tableId = $_POST['tableId'];
$memberId = $_SESSION['auth']->id;
$date = date('Y-m-d');

//Logic
$sqlCheckCart = "SELECT * FROM cart WHERE tableId = '$tableId' AND memberId ='$memberId'";
$qCheckCart = $conn->query($sqlCheckCart);

if ($qCheckCart > 0) {
    $image = $_FILES['SLIP'];
    $upload_dir = "../image/SLIPOrder";
    $nameFile = $userName . "_" . $date;
    if ($image['error'] == 0) {
        $file_exp = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
        $upload_image = "$upload_dir/$nameFile.$file_exp";
        move_uploaded_file($image['tmp_name'], $upload_image);
        
    } 
    $sqlInsertOrder = "INSERT INTO orderProduct (memberId,date,tableId,state,SLIP) VALUES ('$memberId','$date','$tableId','0','$upload_image')";
    $qInsertOrder = $conn->query($sqlInsertOrder);
    if ($qInsertOrder) {
        $orderId = $conn->insert_id;
        while ($item = $qCheckCart->fetch_object()) {
            $sqlInsertDetail = "INSERT INTO detailProduct (productId,qty,orderId) VALUES ('$item->productId','$item->qty','$orderId')";
            $qInsertDetail = $conn->query($sqlInsertDetail);
        }
        if($qInsertDetail){
            $sqlDelCart = "DELETE FROM cart WHERE tableId = '$tableId' AND memberId = '$memberId'";
            $qDelCart = $conn->query($sqlDelCart);
            if($qDelCart){
                echo 4;
            }else{
                echo 3;
            }
        }else{
            echo 2;
    }
    } else {
        echo 1;
    }

} else {
    echo 0;
}

?>
