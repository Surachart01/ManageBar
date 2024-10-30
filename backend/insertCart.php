<?php  
    session_start();
    date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $memberId = $_SESSION['auth']->id;
    $productId = $_POST['productId'];
    $qty = $_POST['qty'];
    $tableId = $_POST['tableId'];

    $sqlCheck = "SELECT * FROM cart WHERE productId = '$productId' AND tableId = '$tableId'";
    $qCheck = $conn->query($sqlCheck);
    $rCheck = $qCheck->num_rows;
    if($rCheck != 0){
        $item = $qCheck->fetch_object();
        $total = $item->qty+$qty;
        $sqlUpdate = "UPDATE cart SET qty = '$total' WHERE id = '$item->id'";
        $qUpdate = $conn->query($sqlUpdate);
        if($qUpdate){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        $sqlInsert = "INSERT INTO cart (productId,qty,tableId,memberId) VALUES ('$productId','$qty','$tableId','$memberId')";
        $qInsert = $conn->query($sqlInsert);
        if($qInsert){
            echo 1;
        }else{
            echo 0;
        }
    }
?>