<?php 
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $memberId = $_POST['memberId'];

    $sqlDel = "DELETE FROM members WHERE id ='$memberId'";
    $qDel = $conn->query($sqlDel);
    if($qDel){
        echo 1;
    }else{
        echo 0;
    }
?>