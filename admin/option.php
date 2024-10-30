<?php
session_start();
include("../config/connect.inc.php");
$sql = "SELECT * FROM options WHERE id = '1'";
$qSql = $conn->query($sql);
$dataPrice = $qSql->fetch_object();

$sql = "SELECT * FROM options WHERE id = '2'";
$qSql = $conn->query($sql);
$data = $qSql->fetch_object();


if ($data->state == 0) {
    $checked = "checked";
} else {
    $checked = "";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="loading">
        <h2>Loading...</h2>
    </div>
    <div class="d-flex justify-content-between px-5 py-2 naa text-light">
        <div class="my-auto">
            <h4 class=" my-auto " style="color: #ceb7d3;">MAHANAKHON2023</h4>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <div class="d-flex flex-column ">
                <a href="index.php" class="d-flex my-1 justify-content-center py-2 item rounded ">หน้าหลัก</a>
                <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded">สินค้า</a>
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายการจองโต๊ะ</a>
                <a href="member.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายชื่อลูกค้า</a>
                <a href="option.php" class="d-flex my-1 justify-content-center py-2 item rounded active">ตั้งค่าเพิ่มเติม</a>
                <a href="news.php" class="d-flex my-1 justify-content-center py-2 item rounded">ข่าวสาร</a>
                <a href="orderProduct.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการสั่งอาหาร</a>
                <a href="kitchen.php" class="d-flex my-1 justify-content-center py-2 item rounded ">ครัว</a>
                <a href="orderHistory.php" class="d-flex my-1 justify-content-center py-2 item rounded ">ประวัติการสั่งอาหาร</a>

            </div>
        </div>
        <div class="col-10 content">
            <div class="container mt-3 ">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center">แก้ไขรายบละเอียดของระบบ</h4>
                        <hr>
                        <label for="">ราคาจองทั้งคืน</label>
                        <div class="d-flex">
                            <input type="number" value="<?php echo $dataPrice->price ?>" id="price" class="form-control me-2" style="width: 200px;">
                            <button class="btn btn-primary" id="changeOption1">ยืนยัน</button>
                        </div>


                        <hr>
                        <div class="form-check form-switch">
                            <input class="form-check-input" <?php echo $checked ?> type="checkbox" id="changeOption2" id="changeOption2">
                            <label class="form-check-label" for="flexSwitchCheckDefault">เปิด / ปิด การจองโต๊ะ</label>
                        </div>
                        <hr>
                        <label for="">เปลี่ยน QRcode ชำระเงิน</label>
                        <input type="file" class="form-control" id="qrcode">
                        <button class="btn btn-success mt-2" id="submitQrcode">เปลี่ยน</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js">
        let table = new DataTable('.table');
    </script>
    <script>
        $(document).on("input", "#changeOption2", function() {
            var state = $(this).prop('checked');
            var formData = new FormData();

            if (state) {
                formData.append("state", 0);
            } else {
                formData.append("state", 1);
            }
            $.ajax({
                url: "../backend/updateState.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 1) {
                        Swal.fire({
                            title: "แก้ไขเสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            window.location.reload()
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

        $(document).on("click", "#changeOption1", function() {
            var price = $("#price").val()
            var formData = new FormData()
            formData.append("price", price);

            $.ajax({
                url: "../backend/updatePrice.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 1) {
                        Swal.fire({
                            title: "แก้ไขเสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            window.location.reload()
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

        $(document).on("click", "#submitQrcode", function() {
            if ($('#qrcode')[0].files.length != 0) {
                var formData = new FormData()
                var image = $('#qrcode')[0].files[0]
                formData.append("image", image)

                $.ajax({
                    url: "../backend/updateQr.php",
                    type: "POST",
                    data: formData,
                    dataType: "text",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res == 1) {
                            Swal.fire({
                                title: "เปลี่ยนQrcodeเสร็จสิ้น",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.reload()
                            })
                        } else {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                text: "ลองใหม่อีกครั้ง",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.reload()
                            })
                        }
                    }
                })
            } else {
                Swal.fire({
                    title: "โปรดใส่รูปQRcode",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1000
                })
            }

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