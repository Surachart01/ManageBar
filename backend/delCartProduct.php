<?php 
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $cartId = $_POST['id'];

    $sql = "DELETE FROM cart WHERE id = '$cartId'";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 1;
    }else{
        echo 0;
    }
?>