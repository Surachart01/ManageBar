<?php
include("../config/authAdmin.php");
session_start();
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
                <a href="index.php" class="d-flex my-1 justify-content-center py-2 item rounded active">หน้าหลัก</a>
                <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded">สินค้า</a>
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายการจองโต๊ะ</a>
                <a href="member.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายชื่อลูกค้า</a>
                <a href="option.php" class="d-flex my-1 justify-content-center py-2 item rounded">ตั้งค่าเพิ่มเติม</a>
                <a href="news.php" class="d-flex my-1 justify-content-center py-2 item rounded">ข่าวสาร</a>
                <a href="orderProduct.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการสั่งอาหาร</a>
                <a href="kitchen.php" class="d-flex my-1 justify-content-center py-2 item rounded ">ครัว</a>
                <a href="orderHistory.php" class="d-flex my-1 justify-content-center py-2 item rounded ">ประวัติการสั่งอาหาร</a>


            </div>
        </div>

        <?php
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d");
        include("../config/connect.inc.php");
        $sqlMember = "SELECT * FROM members WHERE role = '1'";
        $qMember = $conn->query($sqlMember);
        $rMember = $qMember->num_rows;
        $sqlAdmin = "SELECT * FROM members WHERE role = '2'";
        $qAdmin = $conn->query($sqlAdmin);
        $rAdmin = $qAdmin->num_rows;
        $sqlReserveTable = "SELECT * FROM reserve WHERE  state = '3' AND date = '$date'";
        $qReserveTable = $conn->query($sqlReserveTable);
        $rReserveTable = $qReserveTable->num_rows;
        $empty = 159-$rReserveTable;

        ?>
        <div class="col-10 content">
            <div class="container mt-3 ">
                <div class="card shadow" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="card shadow border border-1 bg-success" style="min-height: 150px; height: 150px;">
                                    <div class="card-body">
                                        <h5 class="text-light mt-2">จำนวนลูกค้าในระบบ</h5>
                                        <p class="text-light"><?php echo $rMember ?> คน</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card shadow border border-1 bg-warning" style="min-height: 150px; height:150px">
                                    <div class="card-body">
                                        <h5 class="text-light mt-2">จำนวนโต๊ะที่จองในวันนี้</h5>
                                        <p class="text-light"><?php echo $rReserveTable ?> โต๊ะ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card shadow border border-1 bg-primary" style="min-height: 150px; height:150px">
                                    <div class="card-body">
                                        <h5 class="text-light mt-2">จำนวนโต๊ะที่ว่างในวันนี้</h5>
                                        <p class="text-light"><?php echo $empty ?> โต๊ะ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card shadow border border-1 bg-danger" style="min-height: 150px; height:150px">
                                    <div class="card-body">
                                        <h5 class="text-light mt-2">จำนวน พนักงานในระบบ</h5>
                                        <p class="text-light"><?php echo $rAdmin ?> คน</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js">
        let table = new DataTable('.table');
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
    <script>

    </script>
</body>

</html>