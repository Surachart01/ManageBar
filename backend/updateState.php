<?php  
date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $state = $_POST['state'];
    $sql = "UPDATE options SET state = '$state' WHERE id = '2'";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 1;
    }else{
        echo 0;
    }

?>