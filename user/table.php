<?php
date_default_timezone_set('Asia/Bangkok');
include("../config/auth.php");
// Include the database connection
include("../config/connect.inc.php");
session_start();

if (!isset($_SESSION['auth'])) {
    header("/ManageShop/form-login.php");
}
$memberId = $_SESSION['auth']->id;
$sqlCart = "SELECT * FROM reserve WHERE memberId = '$memberId' AND state = '1'";
$qCart = $conn->query($sqlCart);
$rCart = $qCart->num_rows;
?>


<!doctype html>
<html lang="en">

<head>
    <title>Reserve Table</title>
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
<style>
    .btn {
        font-size: 8px;
        width: 50px;
        margin-bottom: 5px;

    }

    .col {
        width: 4.4%;
    }
</style>

<body>
    <div id="loading">
        <h2>Loading...</h2>
    </div>
    <div class="d-flex justify-content-between px-5 py-2 naa text-light">
        <div class="my-auto"><h4 class=" my-auto " style="color: #ceb7d3;">MAHANAKHON2023</h4></div>
        <a href="cart.php" class="d-flex my-auto ms-auto text-light" style="text-decoration: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill my-auto" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
            </svg>
            <div class="bg-success rounded py-auto my-2 px-2 me-4"><?php echo $rCart ?></div>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['auth']->userName ?>
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
            <div class="d-flex flex-column ">
                <a href="index.php" class="d-flex my-1 justify-content-center py-2 item rounded ">หน้าหลัก</a>
                <a href="table.php" class="d-flex my-1 justify-content-center py-2 item rounded active">จองโต๊ะ</a>
                <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded ">สั่งสินค้า</a>
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายการสั่งอาหาร</a>
                <a href="reserveTable.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการจองโต๊ะ</a>

            </div>
        </div>
        <div class="col-10 content ">
            <div class="container mt-3 ">
                <div class="card shadow " style="height:100% ; background-color: #ceb7d3;">
                    <div class="card-body ">
                        <div class="d-flex justify-content-center">
                            <input type="date" id="Indate" class="form-control" value="<?php echo date('Y-m-d'); ?>">

                        </div>
                        <div class="row">
                            <div class="container-fluid">
                                <h4 class="text-center table-plan-title">ผังการจองโต๊ะร้าน Mahanakhon</h4>
                                <div class="alert alert-warning text-center" role="alert">
                                    <img src="../image/STAGE.jpg" height="150px" width="800px" alt="">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-1 ">
                                        <img src="../image/Tg.jpg" width="75px" height="175px" alt="">
                                        <img src="../image/Tm.jpg" width="75px" height="175px" alt="">

                                    </div>
                                    <div class="col-10">
                                        <div class="row content_table">

                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="d-flex justify-content-start">
                                            <img src="../image/DOOR.jpg" width="75px" height="350px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <h5 class="text-center status-description mt-3">สีเขียว = ว่าง / สีแดง = ถูกจองแล้ว</h5>
                            </div>
                        </div>

                    </div>

                    
                </div>
            </div>
        </div>

    </div>
    </div>

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

    <script>
        $(document).ready(function() {
            var currentDate = $("#Indate").val();
            console.log(currentDate);
            var formData = new FormData();
            formData.append("date", currentDate);

            $.ajax({
                url: "./components/tables.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: (res) => {
                    $(".content_table").html(res);
                }
            })

            $(document).on("change", "#Indate", function() {

                var currentDate = $("#Indate").val();
                console.log(currentDate);
                var formData = new FormData();
                formData.append("date", currentDate);

                $.ajax({
                    url: "./components/tables.php",
                    type: "POST",
                    data: formData,
                    dataType: "html",
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        $(".content_table").html(res);
                    }
                })
            })

            $(document).on("click", "#btn-table", function() {
                var click = $(this).data("click");
                if (click != 1) {
                    var tableNumber = $(this).html()
                    var currentDate = $("#Indate").val();
                    console.log(currentDate);
                    Swal.fire({
                        title: "จองโต๊ะหรือไม่",
                        text: "ต้องการจองโต๊ะ " + tableNumber + " หรือไม่",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ยกเลิก",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var tableId = $(this).data("idtable"); // ใช้ `this` ภายในฟังก์ชันธรรมดา

                            const formData = new FormData();
                            formData.append("id", tableId);
                            formData.append("date", currentDate);
                            formData.append("type", "N");

                            $.ajax({
                                url: "../backend/reserveTable.php",
                                type: "POST",
                                data: formData,
                                dataType: "text",
                                contentType: false,
                                processData: false,
                                success: function(res) {
                                    console.log(res)
                                    if (res == 1) {
                                        Swal.fire({
                                            title: "เพิ่มโต๊ะเสร็จสิ้น",
                                            icon: "success",
                                            timer: 800,
                                            showConfirmButton: false
                                        }).then(() => {
                                            window.location.reload();
                                        })
                                    } else {
                                        Swal.fire({
                                            title: "เกิดข้อผิดพลาด",
                                            icon: "error",
                                            timer: 800,
                                            showConfirmButton: false
                                        }).then(() => {
                                            window.location.reload();
                                        })
                                    }
                                }
                            })
                        }
                    });
                }
            });



        })
    </script>
</body>

</html>