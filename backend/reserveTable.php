<?php  
date_default_timezone_set('Asia/Bangkok');
    session_start();
    include("../config/connect.inc.php");
    $memberId = $_SESSION['auth']->id;
    $tableId = $_POST['id'];
    $date = $_POST['date'];
    $log = date("Y-m-d");
    $type = $_POST['type'];
    $sqlCheck = "SELECT * FROM reserve WHERE tableId = '$tableId' AND date = '$date'";
    $qCheck = $conn->query($sqlCheck);
    $rCheck = $qCheck->num_rows;
    if($rCheck == 0){
        $sqlInsert = "INSERT INTO reserve (memberId,tableId,date,log,state,type) VALUES ('$memberId','$tableId','$date','$log','1','$type')";
        $qInsert = $conn->query($sqlInsert);
        if($qInsert){
            echo 1;
        }else{
            echo 3;
        }
    }else{
        echo 2;
    }

?>