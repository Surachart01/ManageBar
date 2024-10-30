<?php  
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $id = $_POST['id'];
    $sqlDel = "DELETE FROM reserve WHERE id = '$id'";
    $qDel = $conn->query($sqlDel);
    if($qDel){
        echo 1;
    }else{
        echo 0;
    }

?>