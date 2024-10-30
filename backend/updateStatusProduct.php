<?php  
date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $status = $_POST['status'];
    $productId = $_POST['productId'];
    $sql = "UPDATE products SET status = '$status' WHERE id = '$productId'";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 1;
    }else{
        echo 0;
    }

?>