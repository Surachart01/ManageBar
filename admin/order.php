<?php
session_start();
include("../config/connect.inc.php");
$sqlOrder = "SELECT * FROM orders WHERE state = '1'";
$qOrder = $conn->query($sqlOrder);
$rOrder = $qOrder->num_rows;

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
        <div class="my-auto"><h4 class=" my-auto " style="color: #ceb7d3;">MAHANAKHON2023</h4></div>
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
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded active">รายการจองโต๊ะ</a>
                <a href="member.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายชื่อลูกค้า</a>
                <a href="option.php" class="d-flex my-1 justify-content-center py-2 item rounded">ตั้งค่าเพิ่มเติม</a>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ชืิอผู้จอง</th>
                                    <th>จำนวนโต๊ะ</th>
                                    <th>สลิป</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    $count = 1;
                                    while ($item = $qOrder->fetch_object()) {
                                        $sqlMember = "SELECT * FROM members WHERE id = '$item->memberId'";
                                        $qMember = $conn->query($sqlMember);
                                        $itemMember = $qMember->fetch_object();

                                        $sqlReserve = "SELECT * FROM reserve WHERE orderId = '$item->id'";
                                        $qReserve = $conn->query($sqlReserve);
                                        $rReserve = $qReserve->num_rows;
                                    ?>
                                        <tr>
                                            <td><?php echo $count ?></td>
                                            <td><?php echo $itemMember->userName; ?></td>
                                            <td><?php echo $rReserve ?></td>
                                            <td><button class="btn btn-primary" id="SLIP" data-id="<?php echo $item->id ?>">สลิป</button></td>
                                            <td>
                                                <button class="btn btn-success" id="ok" data-id="<?php echo $item->id ?>">OK</button>
                                                <button class="btn btn-warning" id="member" data-id="<?php echo $item->memberId ?>">ติดต่อผู้จอง</button>
                                            </td>
                                        </tr>
                                    <?php $count++;
                                    }
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('.table');
        $(document).on("click", "#SLIP", function() {
            var orderId = $(this).data("id");
            var formData = new FormData()
            formData.append("orderId", orderId);
            $.ajax({
                url: "./components/slip.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        html: res
                    })
                }
            })
        })

        $(document).on("click", "#member", function() {
            var memberId = $(this).data("id");
            var formData = new FormData()
            formData.append("memberId", memberId);
            $.ajax({
                url: "./components/memberContact.php",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        html: res
                    })
                }
            })
        })

        $(document).on("click", "#ok", function() {
            Swal.fire({
                title: "ตรวจสอบการจ่ายเรียบร้อย ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var orderId = $(this).data("id");
                    var formData = new FormData()
                    formData.append("orderId", orderId);
                    $.ajax({
                        url: "../backend/complateOrder.php",
                        type: "POST",
                        data: formData,
                        dataType: "html",
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            console.log(res)
                            Swal.fire({
                                title: "ยืนยันการจองโต๊ะเสร็จสิ้น",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.reload()
                            })
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