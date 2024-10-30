<?php  
include("../config/connect.inc.php");
$image = $_FILES['image'];
$upload_dir = "../image/qrCode";
$nameFile = date("Y-m-d H:i:s");
if ($image['error'] == 0) {
    $file_exp = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
    $upload_image = "$upload_dir/$nameFile.$file_exp";
    move_uploaded_file($image['tmp_name'], $upload_image);

    $sql = "UPDATE options SET QRCODE = '$upload_image' WHERE id = '3'";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 1;
    }else{
        echo 0;
    }
} else{
    echo 2;
}


?>