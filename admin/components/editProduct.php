<?php  
    include("../../config/connect.inc.php");
    $productId = $_POST['productId'];

    $sql = "SELECT * FROM products WHERE id = '$productId'";
    $qSql = $conn->query($sql);
    $data = $qSql->fetch_object();


?>

<h3>แก้ไขสินค้า</h3>
<label for="">ชื่อสินค้า</label>
<input type="text" id="nameProduct" class="form-control mb-3" value="<?php echo $data->productName ?>" >
<label for="">ราคา</label>
<input type="text" id="price" class="form-control mb-3" value="<?php echo $data->price ?>">
<label for="">รูปสินค้า</label>
<input type="file" id="image" class="form-control mb-3" >
<button class="btn btn-success" id="submitEditProduct" data-id="<?php echo $productId ?>">ยืนยัน</button>
