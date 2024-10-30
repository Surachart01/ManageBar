<?php  
date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $price = $_POST['price'];
    $sql = "UPDATE options SET price = '$price' WHERE id = '1'";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 1;
    }else{
        echo 0;
    }

?>