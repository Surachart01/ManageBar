<?php  
    include("../../config/connect.inc.php");

    $orderId = $_POST['orderId'];

    $sqlProduct = "SELECT * FROM detailProduct JOIN products ON detailProduct.productId = products.id WHERE orderId = '$orderId'";
    $qProduct = $conn->query($sqlProduct);



?>

<table class="table">
    <thead>
        <tr>
            <th>รายการ</th>
            <th>จำนวน</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            while($item = $qProduct->fetch_object()){
        ?>
        <tr>
            <td><?php echo $item->productName ?></td>
            <td><?php echo $item->qty ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>