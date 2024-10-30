<?php  
date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $orderId = $_POST['orderId'];

    $sqlUpdate = "UPDATE orderProduct SET state = '2' WHERE id = '$orderId'";
    $qUpdate = $conn->query($sqlUpdate);

    if($qUpdate){
        echo 1;
    }else{
        echo 0;
    }
?>