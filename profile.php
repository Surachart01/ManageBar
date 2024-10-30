<?php
session_start();
$member = $_SESSION['auth'];
?>

<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    html,
    body {
        height: 100vh;
        font-family: "Kanit", serif;
        font-weight: 400;
        font-style: normal;
        overflow-x: hidden;
        background-color: #ceb7d3;
    }

    .card {
        height: 80vh;
        border-radius: 20px;
        
    }
</style>

<body class="d-flex justify-content-center">
    <div class="container my-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">
                    โปรไฟล์
                </h4>
                <hr>
                <div class="row">
                    <div class="col-4 border-end">
                        <div class="d-flex justify-content-center">
                            <img src="<?php echo $member->image ?>" width="200px" height="200px" alt="">
                        </div>
                        <input type="file" accept="/*image" id="image" class="form-control">
                    </div>
                    <div class="col-8">
                        <label for="">Username</label>
                        <input type="text " id="userName" value="<?php echo $member->userName ?>" class="form-control mb-3">
                        <label for="">email</label>
                        <input type="text " id="email" value="<?php echo $member->email ?>" class="form-control mb-3">
                        <label for="">phone number</label>
                        <input type="text " id="phone" value="<?php echo $member->phone ?>" class="form-control mb-3">
                    </div>
                    <div class="col-12 mt-4">
                        <button class="btn btn-success form-control" id="submitProfile" data-id="<?php echo $member->id; ?>">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        $(document).on("click","#submitProfile",function(){
            var formData = new FormData()
            if ($('#image')[0].files.length != 0) {
                var image = $('#image')[0].files[0];
                formdata.append("image", image);
            }
            var memberId = $(this).data("id")
            var userName = $("#userName").val()
            var email = $("#email").val()
            var phone = $("#phone").val()
            
            formData.append("userName",userName)
            formData.append("email",email)
            formData.append("phone",phone)
            formData.append("memberId",memberId)

            $.ajax({
                url:"./backend/editProfile.php",
                type:"POST",
                data:formData,
                dataType:"text",
                contentType:false,
                processData:false,
                success:function(res){
                    if(res == 1){
                        Swal.fire({
                            title:"แก้ไขเสร็จสิ้น",
                            icon:"success",
                            showConfirmButton:false,
                            timer:1000
                        }).then(() => {
                            window.location.reload()
                        })
                    }else{
                        Swal.fire({
                            title:"เกิดข้อผิดพลาด",
                            icon:"error",
                            showConfirmButton:false,
                            timer:1000
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
</body>

</html>