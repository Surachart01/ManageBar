<?php
include("../config/auth.php");
date_default_timezone_set('Asia/Bangkok');
session_start();
include("../config/connect.inc.php");
$memberId = $_SESSION['auth']->id;
$sqlcart = "SELECT * FROM reserve WHERE memberId = '$memberId' AND state = '1'";
$qCart = $conn->query($sqlcart);
$rCart = $qCart->num_rows;
$sqlOption = "SELECT * FROM options WHERE id = '1'";
$qOption = $conn->query($sqlOption);
$dataOption = $qOption->fetch_object();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Cart</title>
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
    <link rel="stylesheet" href="../css/cart.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="row px-5 py-5">

        <div class="card">
            <div class="card-header">
                <h4 class="text-center py-2">ตะกร้าสินค้า</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <table class="table">
                            <tHead>
                                <tr>
                                    <th>#</th>
                                    <th>เลขโต๊ะ</th>
                                    <th>วันที่จอง</th>
                                    <th></th>
                                </tr>
                            </tHead>
                            <tBody>
                                <?php
                                $i = 1;
                                while ($item = $qCart->fetch_object()) {
                                    $sql = "SELECT * FROM tables WHERE id = '$item->tableId'";
                                    $qSql = $conn->query($sql);
                                    $itemTable = $qSql->fetch_object();
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $itemTable->tableNum ?></td>
                                        <td><?php echo $item->date ?></td>
                                        <td><button class="btn btn-danger" data-id="<?php echo $item->id ?>" id="del">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                <?php $i++;
                                }
                                ?>
                            </tBody>
                        </table>
                        <input type="hidden" id="count" value="<?php echo $rCart ?>">
                    </div>
                    <div class="col-5">
                        <div class="text-center">
                            สรุปการจอง
                        </div>
                        <hr>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input checkB" name="radioB" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="all">
                            <label class="form-check-label" for="inlineRadio1">ทั้งคืน</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input checkB" name="radioB" type="radio" name="inlineRadioOptions" id="inlineRadio2" checked value="not">
                            <label class="form-check-label" for="inlineRadio2">ไม่ทั้งคืน</label>
                        </div>
                        <div class="ms-3">
                            <span>ยอดเงินทั้งหมด </span><span id="price">0</span><span> ฿</span>
                        </div>
                        <hr>
                        <button class="form-control btn btn-success mb-5" id="submitCart">ยืนยัน</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-warning" id="back">ย้อนกลับ</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="late" value="<?php echo $dataOption->price ?>">


    <script>
        $(document).on("input", ".checkB", function() {
            var option = $(this).val();
            var late = $("#late").val();
            if (option == "all") {
                var count = $("#count").val();
                $("#price").html(count * late);
            } else {
                $("#price").html(0);
            }
        })

        $(document).on("click", "#del", function() {
            var id = $(this).data("id");
            const formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "../backend/delCart.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 0) {
                        Swal.fire({
                            title: "ลบเสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 800
                        }).then(() => {
                            window.location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 800
                        })
                    }
                }
            })
        })

        $(document).on("click", "#back", function() {
            window.history.back()
        });

        $(document).on("click", "#submitCart", function() {
            var total = $("#price").html()
            var formData = new FormData()
            formData.append("total", total)
            $.ajax({
                url: "./components/cash.php",
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

        })

        $(document).on("click", "#submitCash", function() {
            var formdata = new FormData();
            var total = $("#total").html()
            if ($('#UID')[0].files.length != 0) {
                var UID = $('#UID')[0].files[0];
                formdata.append("UID", UID);

                if (total != 0) {
                    if ($('#SLIP')[0].files.length != 0) {
                        var SLIP = $('#SLIP')[0].files[0];
                        formdata.append("total", total);
                        formdata.append("SLIP", SLIP);
                        $.ajax({
                            url: "../backend/insertOrder.php",
                            type: "POST",
                            data: formdata,
                            dataType: "text",
                            contentType: false,
                            processData: false,
                            success: function(res) {
                                console.log(res)
                                if (res == 1) {
                                    Swal.fire({
                                        title: "จองเสร็จสิ้น",
                                        icon: "success",
                                        timer: 1000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.reload()
                                    })
                                } else {
                                    Swal.fire({
                                        title: "เกิดข้อผิดพลาด ลองอีกครั้ง",
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
                            title: "โปรดทำการชำระเงินตามจำนวนและแนบสลิปตรวจสอบ",
                            icon: "error",
                        }).then(() => {
                            return 0;
                        })
                    }
                }else{
                    $.ajax({
                            url: "../backend/insertOrder.php",
                            type: "POST",
                            data: formdata,
                            dataType: "text",
                            contentType: false,
                            processData: false,
                            success: function(res) {
                                console.log(res)
                                if (res == 1) {
                                    Swal.fire({
                                        title: "จองเสร็จสิ้น",
                                        icon: "success",
                                        timer: 1000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.reload()
                                    })
                                } else {
                                    Swal.fire({
                                        title: "เกิดข้อผิดพลาด ลองอีกครั้ง",
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
            } else {
                Swal.fire({
                    title: "โปรดใส่รูปบัตรประชาชนเพื่อทำการตรวจสอบ",
                    icon: "error",
                }).then(() => {
                    return
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
</body>

</html>