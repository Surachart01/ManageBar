<?php  
date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $orderId = $_POST['orderId'];

    $sqlUpdateOrder = "UPDATE orderProduct SET state = '1' WHERE id = '$orderId'";
    $qUpdateOrder = $conn->query($sqlUpdateOrder);

    if($qUpdateOrder){
        echo 1;
    }else{
        echo 0;
    }
?>