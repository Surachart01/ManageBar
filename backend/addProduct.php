<?php  
date_default_timezone_set('Asia/Bangkok');
    include("../config/connect.inc.php");
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $type = $_POST['type'];


    $upload_dir = "../image/product";
    $nameFile = $productName;
    if ($image['error'] == 0) {
        $file_exp = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  // รับนามสกุลไฟล์
        $upload_image = "$upload_dir/$nameFile.$file_exp";
        move_uploaded_file($image['tmp_name'], $upload_image);
    } 

    $sql = "INSERT INTO products (productName,price,image,status,type) VALUES ('$productName','$price','$upload_image','1','$type')";
    $qSql = $conn->query($sql);
    if($qSql){
        echo 1;
    }else{
        echo 0;
    }

?>