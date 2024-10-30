<?php

    include("../../config/connect.inc.php");
    $memberId = $_POST['memberId'];

    $sqlMember = "SELECT * FROM members WHERE id = '$memberId'";
    $qMember = $conn->query($sqlMember);
    $item = $qMember->fetch_object();



?>

<h4>ข้อมูลผู้จอง</h4>
<p class="text-start">ชื่อผู้ใช้ : <?php echo $item->userName ?></p>
<p class="text-start">Email : <?php echo $item->email ?></p>
<p class="text-start">เบอร์โทร : <?php echo $item->phone ?></p>