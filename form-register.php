<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างบัญชีใหม่</title>
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

        .register-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
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
    <div class="register-container">
        <h1>สร้างบัญชีของคุณ</h1>
        <div>
            <input id="userName" type="text" placeholder="ชื่อผู้ใช้" required>
        </div>
        <div>
            <input id="email" type="email" placeholder="อีเมล" required>
        </div>
        <div>
            <input id="tel" type="text" placeholder="เบอร์โทร" required>
        </div>
        <div>
            <input id="pass1" type="password" placeholder="รหัสผ่านใหม่" required>
        </div>
        <div>
            <input id="pass2" type="password" placeholder="ยืนยันรหัสผ่าน" required>
        </div>
        <button type="submit" id="submitRegister">สร้างบัญชี</button>
        <a href="form-login.php">มีบัญชีแล้วใช่ไหม</a>


    </div>
    
    <script>
        $(document).ready(() => {
            $(document).on("click", "#submitRegister", () => {
                var userName = $("#userName").val();
                var email = $("#email").val();
                var tel = $("#tel").val();
                var pass1 = $("#pass1").val();
                var pass2 = $('#pass2').val();
                console.log("hh")
                if (pass1 != pass2) {
                    Swal.fire({
                        title: "รหัสผ่านไม่ตรงกัน",
                        icon: 'error',
                        timer: 800,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    })
                }
                var formdata = new FormData()
                formdata.append("userName", userName)
                formdata.append("email", email);
                formdata.append("tel", tel)
                formdata.append("password", pass1)

                $.ajax({
                    url: "./backend/insertMember.php",
                    type: "POST",
                    data: formdata,
                    dataType: "text",
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        console.log(res)
                        if (res == 1) {
                            Swal.fire({
                                title: "สมัครเสร็จสิ้น",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 800
                            }).then(() => {
                                window.location.href = "form-login.php"
                            })
                        } else {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด  ",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 800
                            })
                        }
                    },
                })

            })
        })
    </script>
</body>

</html>