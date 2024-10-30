<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "manage_table";

    // สร้างการเชื่อมต่อฐานข้อมูล
    $conn = new mysqli($host, $user, $pass, $dbName);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>
