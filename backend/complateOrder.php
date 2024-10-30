<?php  
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $orderId = $_POST['orderId'];
    $sqlReserve = "SELECT * FROM reserve WHERE orderId = '$orderId'";
    $qReserve = $conn->query($sqlReserve);

    while($item = $qReserve->fetch_object()){
        $sqlUpdate = "UPDATE reserve SET state='3' WHERE id = '$item->id'";
        $qUpdate = $conn->query($sqlUpdate);
    }

    $sqlUpdateOrder = "UPDATE orders SET state ='2' WHERE id = '$orderId'";
    $qUpdateOrder = $conn->query($sqlUpdateOrder);

    if($qUpdateOrder){
        echo $orderId;
    }else{
        echo $orderId;
    }

?>