<table class="table">
    <thead>
        <tr>
            <th>ชื่อสินค้า</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>ราคารวม</th>
        </tr>
    </thead>
<?php
include("../../config/connect.inc.php");
$orderId = $_POST['orderId'];

    $sqlDetail = "SELECT * FROM detailProduct JOIN products ON products.id = detailProduct.productId WHERE orderId = '$orderId'";
    $qDetail = $conn->query($sqlDetail);

    while ($itemDetail = $qDetail->fetch_object()) {
        $total = $total + ($itemDetail->price * $itemDetail->qty);
        $totalPrice = $itemDetail->price * $itemDetail->qty;
?>

<tr>
    <td><?php echo $itemDetail->productName ?></td>
    <td><?php echo $itemDetail->price?></td>
    <td><?php echo ($itemDetail->qty) ?></td>
    <td><?php echo $totalPrice?></td>
</tr>
<?php }
?>
<tr>
    <td colspan="4">ราคาสุทธิ : <?php echo $total ?> ฿</td>
</tr>
</table>

