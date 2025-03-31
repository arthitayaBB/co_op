<?php
session_start(); // เริ่มต้น session
include "connectdb.php"; // เชื่อมต่อฐานข้อมูล

$error_message = ""; // กำหนดตัวแปรเก็บข้อความแจ้งเตือน

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบว่ากรอกรหัสอาจารย์หรือไม่
    if (empty($username) || empty($password)) {
        $error_message = "กรุณากรอกข้อมูลให้ครบถ้วน";
    } else {
        $login_query = "SELECT * FROM teacher WHERE Tec_id = ?";
        $stmt = $conn->prepare($login_query);
        $stmt->bind_param("i", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $teacher = $result->fetch_assoc();

            if (md5($password) == $teacher['Tec_pwd']) {
                $_SESSION['teacher_id'] = $teacher['Tec_id'];
                header("Location: approval_system.php");
                exit;
            } else {
                $error_message = "รหัสผ่านไม่ถูกต้อง";
            }
        } else {
            $error_message = "ไม่พบรหัสอาจารย์";
        }
    }
}
?>

<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>เข้าสู่ระบบ</title>
<!-- icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    .form-signin {
        background-color: white;
        border-radius: 0.5rem;
        padding: 2rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }
</style>
</head>

<body>
    <div class="form-signin">
        <a href="../index.php" class="btn position-absolute top-0 end-0 m-2">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <form method="POST" action="">
            <h1 class="h5 mb-3 fw-normal"><span>เข้าสู่ระบบ</span></h1>

            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="username" id="floatingInput" placeholder="รหัสอาจารย์ (Tec_id)" required>
                <label for="floatingInput"><span>รหัสอาจารย์ (Tec_id)</span></label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword"><span>Password</span></label>
            </div>

            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger py-2" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span>เข้าสู่ระบบ</span></button>
        </form>
    </div>
</body>
</html>
