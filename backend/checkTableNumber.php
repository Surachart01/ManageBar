<?php 
    include("../config/connect.inc.php");
    date_default_timezone_set('Asia/Bangkok');
    $tableNumber = $_POST['tableNumber'];
    $date = date('Y-m-d');

    $sqlCheck = "SELECT * FROM tables WHERE tableNum = '$tableNumber'";
    $qCheck = $conn->query($sqlCheck);
    $rCheck = $qCheck->num_rows;
    if($rCheck > 0){
        $data = $qCheck->fetch_object();
        echo $data->id;
    }else{
        echo 'none';
    }
?>