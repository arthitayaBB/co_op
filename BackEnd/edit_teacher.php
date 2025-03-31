<?php
include 'connectdb.php';
include 'check_admin.php';
// ตรวจสอบว่าได้รับค่ารหัสนิสิตหรือไม่

$majorQuery = "SELECT Major_id, Major_name FROM major";
$majorResult = mysqli_query($conn, $majorQuery);
if (!$majorResult) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<?php

// Check if the user ID is set in the URL
if (isset($_GET['id'])) {
    $TecId = intval($_GET['id']);
    $sql = "SELECT * FROM teacher WHERE Tec_id = $TecId";
    $result = mysqli_query($conn, $sql);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        die("User not found.");
    }
    
    $user = mysqli_fetch_array($result);
} else {
    die("User ID not provided.");
}

if (isset($_POST['Submit'])) {
    $Name = mysqli_real_escape_string($conn, $_POST['Tecname']);
    $surname = mysqli_real_escape_string($conn, $_POST['Tecsurname']);
    $Majorid = mysqli_real_escape_string($conn, $_POST['Majorid']);
    $phone = mysqli_real_escape_string($conn, $_POST['Tecphone']);
    $email = mysqli_real_escape_string($conn, $_POST['Tecemail']);
    $Tecpwd = isset($_POST['Tecpwd']) ? trim($_POST['Tecpwd']) : '';

    // เริ่มต้น SQL UPDATE
    $updateSql = "UPDATE teacher SET 
                    Tec_name = '$Name',
                    Tec_surname = '$surname',
                    Major_id = '$Majorid',
                    Tec_phone = '$phone', 
                    Tec_email = '$email' ";

if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'img_teacher/';

    // ดึงค่า ID และชื่ออาจารย์จากฟอร์ม
    $teacherName = preg_replace('/[^a-zA-Z0-9ก-ฮ]/', '_', $Name); // ลบอักขระพิเศษออก
    $fileExtension = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));

    // ตั้งชื่อไฟล์ใหม่เป็น "ชื่ออาจารย์_ID.นามสกุลไฟล์"
    $newFileName = $teacherName . "_" . $TecId . "." . $fileExtension;
    $uploadFile = $uploadDir . $newFileName;

    // ตรวจสอบประเภทไฟล์ที่อนุญาต
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileExtension, $allowedExtensions)) {
        die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
    }

    // ลบไฟล์เก่า (ถ้ามี)
    if (!empty($user['Tec_picture']) && file_exists($uploadDir . $user['Tec_picture'])) {
        unlink($uploadDir . $user['Tec_picture']);
    }

    // อัปโหลดไฟล์ใหม่
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
        $updateSql .= ", Tec_picture = '" . mysqli_real_escape_string($conn, $newFileName) . "' ";
    } else {
        die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
    }
}

if (!empty($Tecpwd)) { 
    $hashedPwd = md5($Tecpwd); // แฮชรหัสผ่านแบบไม่มี salt
    $updateSql .= ", Tec_pwd = '$hashedPwd'";   
}

    // เพิ่มเงื่อนไข WHERE
    $updateSql .= " WHERE Tec_id = $TecId";

    // **DEBUG: เช็ก SQL Query**
    echo "<pre>$updateSql</pre>";

    // ประมวลผลคำสั่ง SQL
    if (mysqli_query($conn, $updateSql)) {
        header("Location: indexteacher.php");
        exit();
    } else {
        die("Error updating record: " . mysqli_error($conn));
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
            <input type="text" class="form-control" name="Tecname" value="<?= htmlspecialchars($user['Tec_name']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">นามสกุล</label>
            <input type="text" class="form-control" name="Tecsurname" value="<?= htmlspecialchars($user['Tec_surname']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">รูปภาพ</label>
            <input type="file" class="form-control" name="picture">
            <br>
            <img src="img_teacher/<?= htmlspecialchars($user['Tec_picture']) ?>" width="150">
        </div>
        <div class="mb-3">
    <label class="form-label">รหัสสาขา</label>
    <select class="form-control" name="Majorid" required>
        <?php while ($major = mysqli_fetch_assoc($majorResult)) : ?>
            <option value="<?= htmlspecialchars($major['Major_id']) ?>" 
                <?= ($user['Major_id'] == $major['Major_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($major['Major_name']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>
        <div class="mb-3">
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" name="Tecphone" value="<?= htmlspecialchars($user['Tec_phone']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">อีเมล</label>
            <input type="email" class="form-control" name="Tecemail" value="<?= htmlspecialchars($user['Tec_email']) ?>">
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
