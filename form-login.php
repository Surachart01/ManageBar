<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('./image/gg.jpg');
            /* ใส่ลิงก์รูปพื้นหลัง */
            background-size: cover;
            /* ปรับขนาดพื้นหลังให้เต็มหน้าจอ */
            background-position: center;
            /* จัดตำแหน่งให้อยู่ตรงกลาง */
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            z-index: 1;
        }

        img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="./image/2023.jpg">
        <h1>เข้าสู่ระบบ</h1>
        <div>
            <input id="email" type="email" placeholder="อีเมล" required>
        </div>
        <div>
            <input id="password" type="password" placeholder="รหัสผ่าน" required>
        </div>
        <button type="submit" id="submitLogin">เข้าสู่ระบบ</button>
        <a href="form-register.php">สร้างบัญชีใหม่</a>
        <hr>
        <div class="d-flex justify-content-center mt-3">
            <div class="">
                <div id="g_id_onload"
                    data-client_id="90310662516-25habl3hsj3dpvmq8nkam580hrtrmrtu.apps.googleusercontent.com"
                    data-context="signin"
                    data-ux_mode="popup"
                    data-callback="loginGoogle"
                    data-auto_prompt="false">
                </div>

                <div class="g_id_signin "
                    data-type="icon"
                    data-shape="circle"
                    data-theme="filled"
                    data-text="signin_with"
                    data-size="large"
                    data-locale="en-GB">
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    $(document).ready(() => {
        $(document).on("click", "#submitLogin", () => {
            const email = $("#email").val();
            const password = $("#password").val();

            const formData = new FormData();
            formData.append("email", email);
            formData.append("password", password);

            $.ajax({
                url: "./backend/checkLogin.php",
                type: "POST",
                data: formData,
                dataType: "text",
                contentType: false,
                processData: false,
                success: (res) => {
                    if (res == 1) {
                        Swal.fire({
                            title: "เข้าสู่ระบบเสร็จสิ้น",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 800
                        }).then(() => {
                            window.location.href = "user/index.php";
                        })
                    } else if (res == 2) {
                        Swal.fire({
                            title: "เข้าสู่ระบบเสร็จสิ้น (ADMIN)",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 800
                        }).then(() => {
                            window.location.href = "admin/index.php";
                        })
                    } else {
                        Swal.fire({
                            title: "email or password ไม่ถูกต้อง",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 800
                        })
                    }
                }
            })
        })
    })

    function decodeJwtResponse(token) {
            var base64Payload = token.split(".")[1];
            var payload = decodeURIComponent(
            atob(base64Payload)
                .split("")
                .map(function (c) {
                return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
                })
                .join("")
            );
            return JSON.parse(payload);
        }

        function loginGoogle(response){
            const responsePayload = decodeJwtResponse(response.credential);
            var formdata = new FormData();
            formdata.append("email",responsePayload.email);
            $.ajax({
                url:"./backend/checkLoginGoogle.php",
                type:"POST",
                data:formdata,
                dataType:"text",
                contentType:false,
                processData:false,
                success:function(res){
                    if(res == 1){
                        Swal.fire({
                            position:"top-end",
                            icon:"success",
                            timer:800,
                            showConfirmButton:false,
                            title:"Login สำเร็จ"
                        }).then((result) => {
                            window.location.href = "user/index.php";
                        });
                    }else if(res == 2){
                        Swal.fire({
                            position:"top-end",
                            icon:"success",
                            timer:800,
                            showConfirmButton:false,
                            title:"Login สำเร็จ (Admin)"
                        }).then((result) => {
                            window.location.href = "admin/index.php";
                        });
                    }
                    else{
                        Swal.fire({
                            position:"top-end",
                            icon:"error",
                            timer:800,
                            showConfirmButton:false,
                            title:"Gmailของคุณไม่ได้ลงทะเบียนกับระบบไว้"
                        });
                    }
                }
            })
        }
    
</script>

</html>