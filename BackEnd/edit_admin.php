<?php
include 'connectdb.php';
include 'check_admin.php';

// ตรวจสอบว่ามี ID ถูกส่งมาหรือไม่
if (isset($_GET['id'])) {
    $Adminid = intval($_GET['id']);
    $sql = "SELECT * FROM adminn WHERE Admin_id = $Adminid";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        die("User not found.");
    }

    $user = mysqli_fetch_array($result);
} else {
    die("User ID not provided.");
}

// ตรวจสอบว่ามีการส่งแบบฟอร์ม
if (isset($_POST['Submit'])) {
    $adName = mysqli_real_escape_string($conn, $_POST['Adname']);
    $adsurname = mysqli_real_escape_string($conn, $_POST['Adsurname']);
    $adphone = mysqli_real_escape_string($conn, $_POST['Adphone']);
    $ademail = mysqli_real_escape_string($conn, $_POST['Ademail']);
    $adpwd = isset($_POST['Adpwd']) ? trim($_POST['Adpwd']) : '';

    // ตรวจสอบว่ามี Admin_id จริงก่อนรัน UPDATE
    if ($Adminid > 0) {
        $updateSql = "UPDATE adminn SET 
                        Ad_name = '$adName',
                        Ad_surname = '$adsurname',
                        Ad_phone = '$adphone', 
                        Ad_email = '$ademail'";

if (!empty($adpwd)) { 
    $hashedPwd = md5($adpwd); // แฮชรหัสผ่านแบบไม่มี salt
    $updateSql .= ", Ad_pwd = '$hashedPwd'";   
}

        $updateSql .= " WHERE Admin_id = $Adminid";

        // **DEBUG: เช็ก SQL Query**
        echo "<pre>$updateSql</pre>";

        if (mysqli_query($conn, $updateSql)) {
            header("Location: indexadmin.php");
            exit();
        } else {
            die("Error updating record: " . mysqli_error($conn));
        }
    } else {
        die("Error: Invalid Admin ID");
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>

    <!-- พื้นหลัง Particles -->
    <div id="particles-js"></div>

    <button class="toggle-btn" onclick="toggleDarkMode()">Dark/Light Mode</button>

    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        <h2 class="heading" >แก้ไขข้อมูลอาจารย์</h2>
        <div class="d-flex justify-content-between mb-3">
        </div>
        <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">ชื่อ</label>
            <input type="text" class="form-control" name="Adname" value="<?= htmlspecialchars($user['Ad_name']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">นามสกุล</label>
            <input type="text" class="form-control" name="Adsurname" value="<?= htmlspecialchars($user['Ad_surname']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" name="Adphone" value="<?= htmlspecialchars($user['Ad_phone']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">อีเมล</label>
            <input type="email" class="form-control" name="Ademail" value="<?= htmlspecialchars($user['Ad_email']) ?>">
        </div>

  

<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    }
</script>
        
        
        <button type="submit" name="Submit" class="btn btn-primary">บันทึก</button>
    </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>
</html>
