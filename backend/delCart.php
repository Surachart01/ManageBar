<?php  
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $id = $_POST['id'];
    $sql = "DELETE FROM reserve WHERE id ='$id'";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 0;
    }else{
        echo 1;
    }
?>