<?php
include("../config/auth.php");
session_start();

date_default_timezone_set('Asia/Bangkok');
$date = date("Y-m-d");
include("../config/connect.inc.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Order</title>
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
                <a href="table.php" class="d-flex my-1 justify-content-center py-2 item rounded ">จองโต๊ะ</a>
                <a href="product.php" class="d-flex my-1 justify-content-center py-2 item rounded ">สั่งสินค้า</a>
                <a href="order.php" class="d-flex my-1 justify-content-center py-2 item rounded active">รายการสั่งอาหาร</a>
                <a href="reserveTable.php" class="d-flex my-1 justify-content-center py-2 item rounded ">รายการจองโต๊ะ</a>
            </div>
        </div>
        
        <div class="col-10 content" >
            <div class="container mt-3 ">
                <div class="card shadow" >
                    <div class="card-body">
                        <div class="d-flex">
                            <input type="date" class="form-control" id="dateSelect" value="<?php echo $date ?>">
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รายกาออร์เดอร์</th>
                                    <th>ราคา</th>
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody id="contentTable">
                                
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

        $(document).ready(function(){
            var date = $('#dateSelect').val()
            var formData = new FormData()
            formData.append('date',date)
            $.ajax({
                url:"./components/detailOrderHis.php",
                type:"POST",
                data:formData,
                dataType:"html",
                contentType:false,
                processData:false,
                success:function(res){
                    $('#contentTable').html(res)
                }
            })
        })


        $(document).on('input',"#dateSelect",function(){
            var date = $(this).val()
            var formData = new FormData()
            formData.append('date',date)
            $.ajax({
                url:"./components/detailOrderHis.php",
                type:"POST",
                data:formData,
                dataType:"html",
                contentType:false,
                processData:false,
                success:function(res){
                    $('#contentTable').html(res)
                }
            })
        })

        $(document).on("click","#desOrder",function(){
            var orderId = $(this).data("id")
            var formData = new FormData();
            formData.append("orderId",orderId)
            $.ajax({
                url:"./components/descriptionOrder.php",
                type:"POST",
                data:formData,
                dataType:"html",
                contentType:false,
                processData:false,
                success:function(res){
                    Swal.fire({
                        html:res
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