<?php  
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $productId = $_POST['productId'];

    $sql = "DELETE FROM products WHERE id = '$productId'";
    $qSql = $conn->query($sql);

    if($qSql){
        echo 1;
    }else{
        echo 0;
    }

?>