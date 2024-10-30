<h3>เพิ่มสินค้า</h3>
<label for="">ชื่อสินค้า</label>
<input type="text" id="nameProduct" class="form-control mb-3">
<label for="">ราคา</label>
<input type="text" id="price" class="form-control mb-3">
<label for="">รูปสินค้า</label>
<input type="file" id="image" class="form-control mb-3">

<div class="form-check form-switch">
    <input class="form-check-input" <?php echo $checked ?> type="checkbox" id="type" >
    <p class="form-check-label text-start" for="flexSwitchCheckDefault">โปรโมชั่น</p>
</div>
<button class="btn btn-success" id="submitProduct">ยืนยัน</button>