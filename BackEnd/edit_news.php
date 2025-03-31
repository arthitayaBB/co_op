<?php
include 'check_admin.php';
include 'connectdb.php';
?>

<?php
// Check if the user ID is set in the URL
if (isset($_GET['id'])) {
    $TecId = intval($_GET['id']);
    $sql = "SELECT * FROM news WHERE N_id = $TecId";
    $result = mysqli_query($conn, $sql);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        die("ไม่พบข้อมูล");
    }
    
    $user = mysqli_fetch_array($result);
} else {
    die("ไม่พบ ID");
}

if (isset($_POST['Submit'])) {
    $Nheading = mysqli_real_escape_string($conn, $_POST['Nheading']);
    $Ndetail = mysqli_real_escape_string($conn, $_POST['Ndetail']);
    $Nrefer = mysqli_real_escape_string($conn, $_POST['Nrefer']);
    $Nstatus = intval($_POST['Nstatus']); // แปลงค่าเป็น int

    // เริ่มต้น SQL UPDATE
    $updateSql = "UPDATE news SET 
                    N_heading = '$Nheading',
                    N_detail = '$Ndetail',
                    N_refer = '$Nrefer',
                    N_status = '$Nstatus'";

    // ตรวจสอบการอัพโหลดไฟล์รูปภาพ
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/';
        $fileName = basename($_FILES['picture']['name']);
        $uploadFile = $uploadDir . $fileName;

        // ตรวจสอบนามสกุลไฟล์เพื่อป้องกันการอัพโหลดไฟล์อันตราย
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
        }

        // ลบไฟล์เก่า (ถ้ามี)
        if (!empty($user['N_picture']) && file_exists($uploadDir . $user['N_picture'])) {
            unlink($uploadDir . $user['N_picture']);
        }

        // อัพโหลดไฟล์ใหม่
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            $updateSql .= ", N_picture = '" . mysqli_real_escape_string($conn, $fileName) . "' ";
        } else {
            die("เกิดข้อผิดพลาดในการอัพโหลดไฟล์");
        }
    }

    // เพิ่มเงื่อนไข WHERE
    $updateSql .= " WHERE N_id = $TecId";

    // **DEBUG: เช็ก SQL Query**
    // echo "<pre>$updateSql</pre>";

    // ประมวลผลคำสั่ง SQL
    if (mysqli_query($conn, $updateSql)) {
        header("Location: indexnews.php");
        exit();
    } else {
        die("เกิดข้อผิดพลาดในการอัพเดตข้อมูล: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลข่าวสาร</title>
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
        <h2 class="heading" >แก้ไขข้อมูลข่าวสาร</h2>
        <div class="d-flex justify-content-between mb-3">
        </div>
        <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">หัวข้อ</label>
            <input type="text" class="form-control" name="Nheading" value="<?= htmlspecialchars($user['N_heading']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">รายละเอียด</label>
            <input type="text" class="form-control" name="Ndetail" value="<?= htmlspecialchars($user['N_detail']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">รูปภาพ</label>
            <input type="file" class="form-control" name="picture">
            <br>
            <img src="../images/<?= htmlspecialchars($user['N_picture']) ?>" width="120" alt="Current Image">
        </div>

        <div class="form-group">
            <label for="Nstatus" class="form-label">Status</label>
            <select name="Nstatus" id="Nstatus" class="form-control" required>
                <option value="0" <?= $user['N_status'] == "0" ? "selected" : "" ?>>ไม่อนุญาต</option>
                <option value="1" <?= $user['N_status'] == "1" ? "selected" : "" ?>>อนุญาต</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Reference</label>
            <input type="text" class="form-control" name="Nrefer" value="<?= htmlspecialchars($user['N_refer']) ?>" required>
        </div>

        <button type="submit" name="Submit" class="btn btn-primary">บันทึก</button>
    </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>
</html>
