<?php
include("../config/auth.php");
date_default_timezone_set('Asia/Bangkok');
include("../config/connect.inc.php");
session_start();
$memberId = $_SESSION['auth']->id;
$currentDate = date('Y-m-d');

$sqlReserve = "SELECT * FROM reserve WHERE memberId = '$memberId' AND state != '1'";
$qReserve = $conn->query($sqlReserve);
$rReserve = $qReserve->num_rows;
?>

<!doctype html>
<html lang="en">

<head>
    <title>History Reserve Tables</title>
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
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <style>

    </style>
</head>

<body>
    <!-- หน้าโหลด -->
    <div id="loading">
        <h2>Loading...</h2>
    </div>

    <!-- เนื้อหาหลักของหน้า -->
    <div id="content">

        <!-- navbar -->
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
                    <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded ">สั่งสินค้า</a>
                    <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการสั่งอาหาร</a>
                    <a href="reserveTable.php" class="d-flex my-1 justify-content-center py-2 item rounded active">รายการจองโต๊ะ</a>
                </div>
            </div>
            <div class="col-10 content">
                <div class="container mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>เลขโต๊ะ</th>
                                        <th>วันที่จอง</th>
                                        <th>สถานะ</th>
                                        <th>บัตรจอง</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($rReserve == 0) { ?>
                                        <tr>
                                            <td colspan="5">
                                                <p class="text-center">ไม่มีรายการจองโต๊ะ</p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    $count = 1;
                                    while ($item = $qReserve->fetch_object()) {
                                        if (strtotime($currentDate) <= strtotime($item->date)) {
                                            $block = "";
                                            $status = "เสร็จสิ้น";
                                            $delBlock = "";
                                            $sql = "SELECT * FROM tables WHERE id = '$item->tableId'";
                                            $qSql = $conn->query($sql);
                                            $itemTable = $qSql->fetch_object();
                                            if ($item->type == 'A' and $item->state != '3') {
                                                $block = "disabled";
                                                $status = "รอตรวจสอบ";
                                            }
                                            if ($item->type == 'A') {
                                                $delBlock = "disabled";
                                            }
                                    ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $itemTable->tableNum; ?></td>
                                                <td><?php echo $item->date; ?></td>
                                                <td><?php echo $status ?></td>
                                                <td><button class="btn btn-primary" id="showCard" <?php echo $block ?> data-id="<?php echo $item->id ?>">ดูบัตรจอง</button></td>
                                                <td><button class="btn btn-danger" id="cancel" data-id="<?php echo $item->id ?>" <?php echo $block ?> <?php echo $delBlock ?>>ยกเลิก</button></td>
                                            </tr>
                                    <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('.table');
        $(document).on("click", "#showCard", function() {
            var idReserve = $(this).data("id");
            var formData = new FormData();
            formData.append("id", idReserve);

            $.ajax({
                url: "./components/card.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        html: res,
                        showContirmButton: true
                    })
                }
            })
        })

        $(document).on("click", "#cancel", function() {
            Swal.fire({
                title: "ต้องการยกเลิกหรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var idReserve = $(this).data("id");
                    var formData = new FormData();
                    formData.append("id", idReserve);
                    $.ajax({
                        url: "../backend/delReserve.php",
                        type: "POST",
                        data: formData,
                        dataType: "text",
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            if (res == 1) {
                                Swal.fire({
                                    title: "ยกเลิกเสร็จสิ้น",
                                    icon: "success",
                                    timer: 1000,
                                    showContirmButton: false
                                }).then(() => {
                                    window.location.reload()
                                })
                            } else {
                                Swal.fire({
                                    title: "เกิดข้อผิดพลาด",
                                    icon: "error",
                                    timer: 1000,
                                    showContirmButton: false
                                }).then(() => {
                                    window.location.reload()
                                })
                            }
                        }
                    })
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