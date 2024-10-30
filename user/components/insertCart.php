<?php  
$productId = $_POST['productId'];
$tableId = $_POST['tableId'];
?>

<h4>เพิ่มสินค้า</h4>
<hr>
<input type="number" id="qty" class="form-control my-2" placeholder="จำนวน" value="0">
<button class="btn btn-success form-control my-2" id="confirmProduct" data-id="<?php echo $productId ?>" data-table="<?php echo $tableId ?>">เพิ่ม</button>