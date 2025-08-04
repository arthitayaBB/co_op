<?php
session_start();
include_once("connectdb.php");

if (isset($_POST['Submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $stmt = $conn->prepare("SELECT * FROM student WHERE Std_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่านที่ผู้ใช้กรอกกับรหัสผ่านในฐานข้อมูล
        if (password_verify($password, $data['Std_pwd'])) {
            $_SESSION['Std_id'] = $data['Std_id'];
            echo "<script>window.location='std_home.php';</script>";
            exit;
        } else {
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง');</script>";
        }
    } else {
        echo "<script>alert('ไม่พบผู้ใช้นี้');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- ฟอนต์ -->
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #d6eaff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-form {
            background: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-form .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .login-form .form-group i.fa-user,
        .login-form .form-group i.fa-lock {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #0d6efd;
            font-size: 1.2rem;
        }

        .login-form input.form-control {
            padding: 12px 45px 12px 45px;
            /* padding ขวา-ซ้าย */
            height: 50px;
            /* สูงขึ้น */
            border: 1px solid #0d6efd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .login-form .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #0d6efd;
            font-size: 1.2rem;
        }

        .login-form button {
            background-color: #0d6efd;
            border: none;
            border-radius: 8px;
            font-size: 1.2rem;
            padding: 12px;
        }

        .login-form button:hover {
            background-color: #0b5ed7;
        }

        .login-form .options {
            font-size: 0.9rem;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .login-form .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>

<body>

    <div class="login-form position-relative">
        <a href="index.php" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Close"></a>

        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Avatar" width="80" class="mb-4">

        <form method="POST" action="">
        <h3 class="text-center" style="color: #0b5ed7;">เข้าสู่ระบบ-สำหรับนิสิต</h3>
            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" name="pwd" id="password" placeholder="Password" required>
                <i class="fa fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>

            <div class="mb-3 text-center">
                <span>ยังไม่มีบัญชี?/<a href="register.php">สมัคร</a></span>
            </div>

            <button type="submit" name="Submit" class="btn btn-primary w-100">LOGIN</button>
        </form>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript สำหรับโชว์/ซ่อนรหัสผ่าน -->
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.querySelector(".toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>

</body>

</html>