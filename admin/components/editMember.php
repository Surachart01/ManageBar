<?php
include("../../config/connect.inc.php");
$memberId = $_POST['memberId'];

$sql = "SELECT * FROM members WHERE id = '$memberId'";
$qSql = $conn->query($sql);
$data = $qSql->fetch_object();
?>

<h4>แก้ไขข้อมูล</h4>
<hr>
<label for="">Username</label>
<input type="text" class="form-control mb-2" value="<?php echo $data->userName ?>" id="userName" required>
<label for="">email</label>
<input type="email" class="form-control mb-2" value="<?php echo $data->email ?>" id="email" required>
<label for="">phone Number</label>
<input type="text" class="form-control mb-2" value="<?php echo $data->phone ?>" id="phone" required>
<button class="btn btn-success form-control mb-2" id="submitEditMember" data-id="<?php echo $data->id ?>">ยืนยัน</button>