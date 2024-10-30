<?php
session_start();
include("../config/auth.php");
include("../config/connect.inc.php");
$memberId = $_SESSION['auth']->id;
$currentDate = date('Y-m-d');

$sqlProduct = "SELECT * FROM products WHERE status = '1' ORDER BY type DESC";
$qProduct = $conn->query($sqlProduct);


$sqlTable = "SELECT * FROM reserve JOIN tables ON reserve.tableId = tables.id WHERE reserve.memberId = '$memberId' AND reserve.state = '3'";
$qTable = $conn->query($sqlTable);




?>
<!doctype html>
<html lang="en">

<head>
    <title>Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link href="../css/admin.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>
    <!-- หน้าโหลด -->
    <div id="loading">
        <h2>Loading...</h2>
    </div>

    <!-- เนื้อหาหลักของหน้า -->
    <div id="content">
        <div class="d-flex justify-content-between px-5 py-2 naa text-light">
            <div class="my-auto">
                <h4 class=" my-auto " style="color: #ceb7d3;">MAHANAKHON2023</h4>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        $userName = $_SESSION['auth']->userName;
                        echo $userName
                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="../profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="../backend/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-2 sidebar pt-3">
                <div class="d-flex flex-column">
                <a href="index.php" class="d-flex my-1 justify-content-center py-2 item rounded ">หน้าหลัก</a>
                <a href="table.php" class="d-flex my-1 justify-content-center py-2 item rounded ">จองโต๊ะ</a>
                <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded active">สั่งสินค้า</a>
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการสั่งอาหาร</a>
                <a href="reserveTable.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการจองโต๊ะ</a>
                </div>
            </div>
            <div class="col-10 content">
                <div class="container mt-3">
                    <div class="cardd card shadow px-2">
                        <div class="card-body ">
                            <div class="row">
                                <label for="">โปรดเลือดโต๊ะที่ต้องการสั่ง</label>
                                <input type="text" class="form-control" id="tableNumber">
                            </div>
                            <div class="row">
                                <?php

                                while ($itemProduct = $qProduct->fetch_object()) {

                                ?>
                                    <div class="col-3 mt-3">
                                        <div class="card shadow" style="min-height:150px; height: auto;">
                                            <div class="container d-flex justify-content-center mt-3">
                                                <img src="<?php echo $itemProduct->image ?>" width="100px" height="100px">
                                            </div>

                                            <div class="container">
                                                <div class="card-body">
                                                    <h4 class="card-title"><?php echo $itemProduct->productName; ?></h4>
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="price my-auto">ราคา: <?php echo $itemProduct->price;  ?> ฿</div>
                                                        <button class="btn btn-warning my-auto block" id="sub_Product" data-info="<?php echo $itemProduct->id; ?> ">เพิ่มสินค้า</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php  }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="fixed-bottom d-flex justify-content-end">
                        <a href="" class="text-light " id="cart">
                            <div class="rounded-circle shadow border border-3 border-light px-3 py-3 mx-5 my-5 bg-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill my-auto" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                                </svg>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var tableNumber = $("#tableNumber").val()
            var formData = new FormData();
            formData.append("tableNumber", tableNumber)
            if (tableNumber.length == 4) {
                $.ajax({
                    url: "../backend/checkTableNumber.php",
                    type: "POST",
                    data: formData,
                    dataType: "text",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        if (res == 'none') {
                            $('.block').prop('disabled', true)
                            $("#cart").attr("href", "#")
                        } else {
                            $('.block').prop('disabled', false)
                            $("#cart").attr("href", "cartProduct.php?table=" + res)
                        }
                    }
                })
            } else {
                $('.block').prop('disabled', true)
                $("#cart").attr("href", "#")
            }
        })


        $(document).on("input", "#tableNumber", function() {
            var tableNumber = $("#tableNumber").val()
            var formData = new FormData();
            formData.append("tableNumber", tableNumber)
            if (tableNumber.length == 4) {
                $.ajax({
                    url: "../backend/checkTableNumber.php",
                    type: "POST",
                    data: formData,
                    dataType: "text",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        if (res == 'none') {
                            $('.block').prop('disabled', true)
                            $("#cart").attr("href", "#")
                        } else {
                            $('.block').prop('disabled', false)
                            $("#cart").attr("href", "cartProduct.php?table=" + res)
                        }
                    }
                })
            } else {
                $('.block').prop('disabled', true)
                $("#cart").attr("href", "#")
            }

        })


        $(document).on("click", "#sub_Product", function() {
            var productId = $(this).data("info")
            var tableNumber = $("#tableNumber").val()
            var formData = new FormData();
            formData.append("tableNumber", tableNumber)
            $.ajax({
                url: "../backend/checkTableNumber.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    formData.append("productId", productId)
                    formData.append("tableId", res)

                    $.ajax({
                        url: "./components/insertCart.php",
                        type: "POST",
                        data: formData,
                        dataType: "html",
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            Swal.fire({
                                html: res,
                                showConfirmButton: false
                            })
                        }
                    })
                }
            })

        })

        $(document).on("click", "#confirmProduct", function() {
            var productId = $(this).data("id")
            var tableId = $(this).data("table")
            var qty = $('#qty').val()
            var formData = new FormData()
            formData.append("productId", productId)
            formData.append("tableId", tableId)
            formData.append("qty", qty)
            $.ajax({
                url: "../backend/insertCart.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 1) {
                        Swal.fire({
                            title: "เพิ่มเสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        })
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            window.location.reload()
                        })
                    }
                }
            })
        })
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="../assets/loading.js"></script>
</body>

</html>