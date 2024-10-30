<?php
date_default_timezone_set('Asia/Bangkok');
include("../../config/connect.inc.php");

$date = $_POST['date'];
$sqlOrder = "SELECT orderProduct.*, tables.tableNum FROM orderProduct JOIN tables ON orderProduct.tableId = tables.id WHERE state = '2' AND date = '$date'";
$qOrder = $conn->query($sqlOrder);
$rOrder = $qOrder->num_rows;


if ($rOrder < 1) { ?>
    <tr>
        <td colspan="5"><p class="text-center">ไม่มีรายการ</p></td>
    </tr>
    <?php } else {
    $count = 1;

    while ($item = $qOrder->fetch_object()) {
        $sqlDetail = "SELECT * FROM detailProduct JOIN products ON products.id = detailProduct.productId WHERE orderId = '$item->id'";
        $qDetail = $conn->query($sqlDetail);
        $total = 0;
        while ($itemDetail = $qDetail->fetch_object()) {
            $total = $total + ($itemDetail->price * $itemDetail->qty);
        }
    ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $item->tableNum   ?></td>
            <td><?php echo $total ?></td>
            <td><button class="btn btn-success" data-id="<?php echo $item->id ?>" id="desOrder">รายละเอียด</button></td>
        </tr>
<?php $count++;
    }
}
?>