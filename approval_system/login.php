<?php
session_start(); // เริ่มต้น session
include "connectdb.php"; // เชื่อมต่อฐานข้อมูล

$error_message = ""; // กำหนดตัวแปรเก็บข้อความแจ้งเตือน

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // ชื่อผู้ใช้ (email)
    $password = $_POST['password'];  // รหัสผ่าน

    // ตรวจสอบว่ากรอกข้อมูลหรือไม่
    if (empty($username) || empty($password)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน";
    } else {
        $login_query = "SELECT * FROM teacher WHERE Tec_email = ?";
        $stmt = $conn->prepare($login_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $teacher = $result->fetch_assoc();

            // ตรวจสอบรหัสผ่านแบบ hash
            if (password_verify($password, $teacher['Tec_pwd'])) {
                $_SESSION['teacher_id'] = $teacher['Tec_id'];
                header("Location: approval_system.php");
                exit;
            } else {
                $error_message = "รหัสผ่านไม่ถูกต้อง";
            }
        } else {
            $error_message = "ไม่พบ Email นี้ในระบบ";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(204, 240, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
        }

        .form-signin {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-signin img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .input-group-text {
            background-color: #dbe9f6;
            border: none;
        }

        .form-control:focus {
            border-color: #5a9bd5;
            box-shadow: 0 0 0 0.2rem rgba(90, 155, 213, 0.25);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.8rem;
            color: #5a9bd5;
        }

        .close-btn:hover {
            color: #dc3545;
        }

        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="form-signin">
        <!-- ปุ่มกากบาท -->
        <a href="../index.php" class="close-btn">
            <i class="bi bi-x-lg"></i>
        </a>

        <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="user icon">

        <h1 class="h5 mb-3 fw-normal">Sign in-สำหรับอาจารย์</h1>

        <form method="POST" action="">
            <!-- ช่องกรอก Email -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-envelope-fill" style="color: #5a9bd5;"></i>
                </span>
                <input type="email" class="form-control" name="username" placeholder="Email" required>
            </div>

            <!-- ช่องกรอก Password พร้อมรูปตา -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill" style="color: #5a9bd5;"></i>
                </span>
                <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" required>
                <span class="input-group-text toggle-password">
                    <i class="bi bi-eye-fill" id="togglePasswordIcon" style="color: #5a9bd5;"></i>
                </span>
            </div>

            <?php if (!empty($error_message)) : ?>
                <script>
                    window.onload = function() {
                        alert("<?php echo $error_message; ?>");
                    }
                </script>
            <?php endif; ?>

            <button class="btn btn-primary w-100 py-2" type="submit" name="Submit">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#passwordInput');
        const togglePasswordIcon = document.querySelector('#togglePasswordIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // เปลี่ยนไอคอน
            if (type === 'text') {
                togglePasswordIcon.classList.remove('bi-eye-fill');
                togglePasswordIcon.classList.add('bi-eye-slash-fill');
            } else {
                togglePasswordIcon.classList.remove('bi-eye-slash-fill');
                togglePasswordIcon.classList.add('bi-eye-fill');
            }
        });
    </script>

</body>

</html>