<?php
include("../config/authAdmin.php");
include("../config/connect.inc.php");
session_start();
$sqlNews = "SELECT * FROM News ";
$qNews = $conn->query($sqlNews);
$rNews = $qNews->num_rows;
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
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายการจองโต๊ะ</a>
                <a href="member.php" class="d-flex my-1 justify-content-center py-2 item rounded">รายชื่อลูกค้า</a>
                <a href="option.php" class="d-flex my-1 justify-content-center py-2 item rounded">ตั้งค่าเพิ่มเติม</a>
                <a href="news.php" class="d-flex my-1 justify-content-center py-2 item rounded active">ข่าวสาร</a>
                <a href="orderProduct.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการสั่งอาหาร</a>
                <a href="kitchen.php" class="d-flex my-1 justify-content-center py-2 item rounded ">ครัว</a>
                <a href="orderHistory.php" class="d-flex my-1 justify-content-center py-2 item rounded ">ประวัติการสั่งอาหาร</a>


            </div>
        </div>
        <div class="col-10 content">
            <div class="container mt-3 ">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-3" id="addNews">เพิ่มข่าว</button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อรายการ</th>
                                    <th>ตัวอย่าง</th>
                                    <th>แสดง/ไม่แสดง</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                if ($rNews == 0) { ?>
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">ไม่มีข่าวสาร</p>
                                        </td>
                                    </tr>
                                    <?php    } else {
                                    $checked = '';
                                    $count = 1;
                                    while ($item = $qNews->fetch_object()) {
                                        if ($item->state == 1) {
                                            $checked = 'checked';
                                        } else {
                                            $checked = '';
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $count ?></td>
                                            <td><?php echo $item->name ?></td>
                                            <td><button class="btn btn-primary" id="desNews" data-id="<?php echo $item->id ?>">รายละเอียด</button></td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input mx-auto" <?php echo $checked ?> data-id="<?php echo $item->id ?>" type="checkbox" id="changeState">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-warning me-2" data-id="<?php echo $item->id ?>" id="editNews">แก้ไข</button>

                                                    <button class="btn btn-danger" data-id="<?php echo $item->id ?>" id="delNews">ลบ</button>
                                                </div>



                                            </td>
                                        </tr>
                                <?php $count++; }
                                    
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js">
        
    </script>
    <script>
        let table = new DataTable('.table');
        $(document).on("click", "#editNews", function() {
            var newId = $(this).data("id")
            var formData = new FormData()
            formData.append("newId", newId)
            $.ajax({
                url: "./components/editNew.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        $(document).on("click", "#delNews", function() {
            Swal.fire({
                title: "ต้องการลบหรือไม่ ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var newId = $(this).data("id")
                    var formData = new FormData()
                    formData.append("newId", newId);

                    $.ajax({
                        url: "../backend/delNew.php",
                        type: "POST",
                        data: formData,
                        dataType: "text",
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            if (res == 1) {
                                Swal.fire({
                                    title: "แก้ไขข้อมูลเสร็จสิ้น",
                                    icon: "success",
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload()
                                })
                            } else {
                                Swal.fire({
                                    title: "เกิดข้อผิดพลาด",
                                    icon: "error",
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload()
                                })
                            }
                        }
                    })
                }
            })
        })

        $(document).on("click", "#submitEditNew", function() {
            var formdata = new FormData()
            if ($('#image')[0].files.length != 0) {
                var image = $('#image')[0].files[0]
                formdata.append("image", image)

            }
            var newId = $(this).data("id")
            var name = $("#name").val()
            var description = $("#description").val()
            formdata.append("name", name)
            formdata.append("description", description)
            formdata.append("newId", newId)
            $.ajax({
                url: "../backend/updateNew.php",
                type: "POST",
                data: formdata,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 1) {
                        Swal.fire({
                            title: "แก้ไขข้อมูลเสร็จสิ้น",
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            icon: "error",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload()
                        })
                    }

                }
            })


        })

        $(document).on("click", "#addNews", function() {
            $.ajax({
                url: "./components/addNew.php",
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        html: res,
                        showConfirmButton: false
                    })
                }
            })
        })

        $(document).on("click", "#changeState", function() {
            var newId = $(this).data("id");
            var state = $(this).prop('checked');
            var formData = new FormData()
            if (state) {
                formData.append('state', 1)
            } else {
                formData.append('state', 0)
            }
            formData.append("newId", newId)
            $.ajax({
                url: "../backend/updateStateNews.php",
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

        $(document).on("click", "#desNews", function() {
            var newId = $(this).data("id");
            var formData = new FormData();
            formData.append("newId", newId);
            $.ajax({
                url: "./components/desNew.php",
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

        $(document).on("click", "#submitNew", function() {
            if ($('#image')[0].files.length != 0) {
                var formdata = new FormData()
                var name = $("#name").val()
                var description = $("#description").val()
                var image = $('#image')[0].files[0]
                formdata.append("image", image)
                formdata.append("name", name)
                formdata.append("description", description)
                $.ajax({
                    url: "../backend/insertNew.php",
                    type: "POST",
                    data: formdata,
                    dataType: "text",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res == 1) {
                            Swal.fire({
                                title: "เพิ่มข้อมูลเสร็จสิ้น",
                                icon: "success",
                                timer: 1000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload()
                            })
                        } else {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                icon: "error",
                                timer: 1000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload()
                            })
                        }

                    }
                })
            } else {
                Swal.fire({
                    title: "โปรดใส่รูปภาพของข่าวสาร",
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
    <script>

    </script>
</body>

</html>