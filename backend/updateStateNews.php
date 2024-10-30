<?php  
    include("../config/connect.inc.php");
    $state = $_POST['state'];
    $newId = $_POST['newId'];

    $sqlUpdate = "UPDATE News SET state = '$state' WHERE id = '$newId'";
    $qUpdate = $conn->query($sqlUpdate);
    if($qUpdate){
        echo 1;
    }else{
        echo 0;
    }
?>