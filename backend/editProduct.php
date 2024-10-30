<?php
include("../config/connect.inc.php");
date_default_timezone_set('Asia/Bangkok');
$productName = $_POST['productName'];
$price = $_POST['price'];

$productId = $_POST['productId'];


if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $upload_dir = "../image/product";
    $nameFile = $productName;
    if ($image['error'] == 0) {
        $file_exp = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
        $upload_image = "$upload_dir/$nameFile.$file_exp";
        move_uploaded_file($image['tmp_name'], $upload_image);
    }
    $sql = "UPDATE products SET productName = '$productName',price = '$price' , image = '$upload_image' WHERE id = '$productId'";
    $qSql = $conn->query($sql);
    if ($qSql) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    $sql = "UPDATE products SET productName = '$productName',price = '$price'  WHERE id = '$productId'";
    $qSql = $conn->query($sql);
    if ($qSql) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
