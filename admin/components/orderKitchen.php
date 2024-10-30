<?php
include("../../config/connect.inc.php");

$sqlOrder = "SELECT orderProduct.* , tables.tableNum FROM orderProduct JOIN tables ON orderProduct.tableId = tables.id  WHERE state = '1' ORDER  BY orderProduct.id ASC";
$qOrder = $conn->query($sqlOrder);

$count = 1;
while ($item = $qOrder->fetch_object()) {
    $sqlCheck = "SELECT * FROM detailProduct WHERE orderId = '$item->id'";
    $qCheck = $conn->query($sqlCheck);
    $rCheck = $qCheck->num_rows;
?>
    <div class="col-3">

        <div class="card" style="min-height:auto ;height: auto;">
            <div class="card-header">
                โต๊ะที่ <?php echo $item->tableNum ?>
            </div>
            <div class="card-body">
                <p>รายการอาหารจำนวน : <?php echo $rCheck  ?></p>
                <button class="btn btn-primary form-control" id="detail" data-id="<?php echo $item->id ?>">รายการอาหาร</button>
            </div>
        </div>

    </div>
<?php $count++;
} ?>