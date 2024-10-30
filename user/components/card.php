<?php  
    session_start();

    include("../../config/connect.inc.php");
    $id = $_POST['id'];
    $sqlData = "SELECT * FROM reserve WHERE id = '$id'";
    $qData = $conn->query($sqlData);
    $data = $qData->fetch_object();
    $sqlTable="SELECT * FROM tables WHERE id = $data->tableId";
    $qTable = $conn->query($sqlTable);
    $dataTable = $qTable->fetch_object();
    $dataMember = $_SESSION['auth'];
?>

<div class="text-center">บัตรจองโต๊ะ</div>
<hr>
<img src="../image/2023.jpg" width="300px" alt="">
<hr>
<h4 class="text-start">เลขโต๊ะ : <?php echo $dataTable->tableNum ?></h4>
<h4 class="text-start">วันที่จอง : <?php echo $data->date?></h4>
<h4 class="text-start">ชื่อผู้ใช้งาน : <?php echo $dataMember->userName ?> </h4>
<?php  
    if($data->type == 'A'){
        echo '<h4 class="text-start text-primary">สถานะ : ทั้งคืน</h4>';
    }else{
        echo '<h4 class="text-start text-success">สถานะ : ปกติ</h4>';
    }
?>
