
}<?php
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
            // ใช้ password_hash() เพื่อแฮชรหัสผ่าน
            $hashedPwd = password_hash($adpwd, PASSWORD_DEFAULT);

            // เพิ่มคำสั่ง UPDATE เพื่ออัปเดตรหัสผ่านที่แฮชแล้ว
            $updateSql .= ", Ad_pwd = '$hashedPwd'";
        }

        $updateSql .= " WHERE Admin_id = $Adminid";

        // แสดง SQL Query สำหรับตรวจสอบ
        // echo "<pre>$updateSql</pre>";

        if (mysqli_query($conn, $updateSql)) {
            // แจ้งเตือนเมื่ออัปเดตสำเร็จ
            echo "<script>
                    alert('ข้อมูลผู้ใช้งานได้รับการอัปเดตเรียบร้อยแล้ว');
                    window.location.href = 'indexadmin.php';
                  </script>";
            exit();
        } else {
            // แจ้งเตือนเมื่อเกิดข้อผิดพลาด
            echo "<script>
                    alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');
                  </script>";
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
    <title>แก้ไขข้อมูล-Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>



    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        <h2 class="heading">แก้ไขข้อมูล-Admin</h2>
        <div class="d-flex justify-content-between mb-3">
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Adname" class="form-label">ชื่อ</label>
                        <input type="text" name="Adname" id="Adname" class="form-control" value="<?= htmlspecialchars($user['Ad_name']) ?>" required autofocus>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Adsurname" class="form-label">นามสกุล</label>
                        <input type="text" name="Adsurname" id="Adsurname" class="form-control" value="<?= htmlspecialchars($user['Ad_surname']) ?>" required>
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" name="Adphone" maxlength="10" required pattern="[0-9]{10}" value="<?= htmlspecialchars($user['Ad_phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">อีเมล</label>
                <input type="email" class="form-control" name="Ademail" value="<?= htmlspecialchars($user['Ad_email']) ?>">
            </div>


            <div class="form-group">
                <label for="Adpwd" class="form-label">Password</label>
                <input type="password" name="Adpwd" id="Adpwd" class="form-control">
            </div>


            <script>
                function togglePassword() {
                    var passwordField = document.getElementById('Adpwd'); // ให้ตรงกับ ID ด้านบน
                    passwordField.type = passwordField.type === "password" ? "text" : "password";
                }
            </script>

            <div class="form-group text-center">

                <button type="submit" name="Submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>

</html>