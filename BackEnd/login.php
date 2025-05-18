<?php
session_start();
include('connectdb.php');

// ตรวจสอบว่ามีการส่งข้อมูลผ่านฟอร์มหรือไม่
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // เชื่อมต่อฐานข้อมูล
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // สร้าง SQL Query เพื่อตรวจสอบข้อมูลผู้ใช้
    $sql = "SELECT * FROM adminn WHERE Ad_email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // ป้องกัน SQL Injection โดยการ bind parameter
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่ามีข้อมูลผู้ใช้หรือไม่
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

       
        if (password_verify($password, $row['Ad_pwd'])) {
            // ถ้ารหัสผ่านถูกต้อง จัดเก็บข้อมูลใน session
            $_SESSION['Admin_id'] = $row['Admin_id'];
            $_SESSION['Ad_name'] = $row['Ad_name'];
            $_SESSION['Ad_surname'] = $row['Ad_surname'];
            $_SESSION['user_email'] = $row['Ad_email'];


            // เปลี่ยนเส้นทางไปยังหน้า indexteacher.php
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1885ed">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>Login-Admin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, rgb(187, 223, 255), #1e69de);
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 50px 30px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
            text-align: center;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: white;
            cursor: pointer;
            z-index: 2;
        }

        .avatar {
            width: 90px;
            height: 90px;
            background: #003366;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: -80px auto 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .avatar i {
            color: white;
            font-size: 40px;
        }

        form {
            margin-top: 20px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 340px !important;
            /* ยืดให้เต็มความกว้างที่กำหนดใน .login-container */
            max-width: 500px;
            /* กำหนดความยาวสูงสุด */
            padding: 14px 40px;
            /* เพิ่ม padding เพื่อให้กล่องมีขนาดใหญ่ขึ้น */
            border: 1px solid #ccc;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }


        .input-group .icon-left {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 16px;
        }

        .input-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #fff;
            font-size: 18px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #003366;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #001f4d;
        }

        .text-center {
            color: white;
        }

        .input-group input:focus {
            border-color: #1e69de;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="close-btn" onclick="window.location.href='../index.php';">
            <i class="fas fa-times"></i>
        </div>

        <div class="avatar">
            <i class="fa fa-user"></i>
        </div>

        <form method="POST">
            <h1 class="text-center">Admin Login</h1>

            <div class="input-group">
                <i class="fa fa-envelope icon-left"></i>
                <input type="email" name="email" placeholder="Email ID" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock icon-left"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fa fa-eye toggle-password" id="togglePassword"></i>
            </div>

            <input type="submit" class="btn-login" name="login" value="LOGIN">
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // เปลี่ยนไอคอนตา
            if (type === 'text') {
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    </script>

</body>

</html>