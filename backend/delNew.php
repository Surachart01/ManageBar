<?php  
    $newId = $_POST['newId'];
    include("../config/connect.inc.php");

    $sqlDel = "DELETE FROM News WHERE id = '$newId'";
    $qDel = $conn->query($sqlDel);
    if($qDel){
        echo 1;
    }else{
        echo 0;
    }
?>