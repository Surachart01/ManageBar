<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include("../../config/connect.inc.php");
$total = $_POST['total'];
$tableId = $_POST['tableId'];

$sqlQr = "SELECT * FROM options WHERE id = '3'";
$qQr = $conn->query($sqlQr);
$item = $qQr->fetch_object();
?>
<div class="container">
    <div class="d-flex justify-content-center">
        <img src="" alt="">

    </div>
    <div class="text-center">
        ชำระเงิน
    </div>
    <hr>
    <div class="d-flex justify-content-center">
        <?php
        if ($total != "0") {
            echo '<img src="'.$item->QRCODE.'" width="200px" height="200px" alt="">';
        } else {
            echo '';
        }
        ?>
        

    </div>
    <div class="text-start my-3">
        ยอดรวม = <span id="total"><?php echo  $total ?></span>
    </div>
    <?php
    if ($total != "0") {
        echo '<label for="">สลิปโอนเงิน</label><input type="file" accept="*/image" class="form-control mb-3" id="SLIP" required>';
    }else{
        echo '<input type="hidden" value="0" class="form-control " id="SLIP">';
    }
    ?>
    <button class="btn btn-success form-control" id="submitCash" data-id="<?php echo $tableId ?>">ยืนยัน</button>

</div>