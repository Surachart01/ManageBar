<?php
include("../config/auth.php");
session_start();
include("../config/connect.inc.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
                <a href="index.php" class="d-flex my-1 justify-content-center py-2 item rounded active">หน้าหลัก</a>
                <a href="table.php" class="d-flex my-1 justify-content-center py-2 item rounded ">จองโต๊ะ</a>
                <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded ">สั่งสินค้า</a>
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการสั่งอาหาร</a>
                <a href="reserveTable.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการจองโต๊ะ</a>


            </div>
        </div>
        <div class="col-10 content">
            <div class="container mt-3 ">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center">โปรโมชั่น MAHANAKHON</h4>
                        <hr>
                        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $sqlNews = "SELECT * FROM News WHERE state = '1'";
                                $qNews = $conn->query($sqlNews);
                                $isFirst = true; // ตั้งค่าสถานะสำหรับภาพแรก

                                while ($item = $qNews->fetch_object()) {
                                    // ถ้าเป็นภาพแรก ให้ใช้ class active
                                    $activeClass = $isFirst ? 'active' : '';
                                ?>
                                    <div class="carousel-item <?php echo $activeClass; ?>" style="width: 700px;" data-bs-interval="5000">
                                        <img src="<?php echo $item->image ?>" id="detail" data-id="<?php echo $item->id ?>" style="width: 700px; height:300px" class="d-block w-100" alt="...">
                                    </div>
                                <?php
                                    $isFirst = false; // เปลี่ยนสถานะหลังจากแสดงภาพแรก
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>





                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).on("click", "#detail", function() {
            var newId = $(this).data("id");
            var formData = new FormData();
            formData.append("newId", newId);
            $.ajax({
                url: "./components/desNews.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        html: res,
                        showConfirmButton: true
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
    <script>

    </script>
</body>

</html>