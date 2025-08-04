<?php
include 'connectdb.php';
include 'check_admin.php';

if (!isset($_GET['id'])) {
    die("ไม่พบรหัสแบนเนอร์ที่ต้องการแก้ไข");
}

$Bn_id = intval($_GET['id']);
$Admin_id = $_SESSION['Admin_id'] ?? null;

// ดึงข้อมูลเดิม
$sql = "SELECT * FROM banner WHERE Bn_id = $Bn_id";
$result = mysqli_query($conn, $sql);
$banner = mysqli_fetch_assoc($result);

if (!$banner) {
    die("ไม่พบข้อมูลแบนเนอร์ที่ระบุ");
}

if (isset($_POST['Submit'])) {
    // ตรวจสอบสิทธิ์แอดมินก่อนทำงานใด ๆ
    if (!$Admin_id) {
        die("ไม่สามารถระบุผู้ดูแลระบบได้");
    }

    $checkAdmin = mysqli_query($conn, "SELECT Admin_id FROM adminn WHERE Admin_id = '$Admin_id'");
    if (mysqli_num_rows($checkAdmin) === 0) {
        die("สิทธิ์ของผู้ดูแลระบบไม่ถูกต้อง");
    }

    // รับค่าจากฟอร์ม
    $Bn_explain = mysqli_real_escape_string($conn, $_POST['Bn_explain']);
    $Bn_status = intval($_POST['Bn_status']);
    $newFileName = $banner['Bn_image']; // หากไม่ได้เปลี่ยนรูป

    // หากมีการอัปโหลดรูปใหม่
    if (isset($_FILES['Bn_image']) && $_FILES['Bn_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/banner/';
        $timestamp = date("YmdHis");
        $ext = strtolower(pathinfo($_FILES['Bn_image']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowedExtensions)) {
            die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
        }

        $newFileName = "Bn{$Bn_id}_{$timestamp}.$ext";
        $uploadFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['Bn_image']['tmp_name'], $uploadFile)) {
            // ลบรูปเก่าหากมี
            if (!empty($banner['Bn_image']) && file_exists($uploadDir . $banner['Bn_image'])) {
                unlink($uploadDir . $banner['Bn_image']);
            }
        } else {
            die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
        }
    }

    // อัปเดตข้อมูลแบนเนอร์
    $stmt = $conn->prepare("UPDATE banner SET Bn_explain = ?, Bn_status = ?, Bn_image = ? ,Admin_id = $Admin_id WHERE Bn_id = ?");
    $stmt->bind_param("sisi", $Bn_explain, $Bn_status, $newFileName, $Bn_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo "<script>
                alert('อัปเดตเรียบร้อยแล้ว');
                window.location.href = 'indexbanner.php';
              </script>";
        exit();
    } else {
        die("ไม่สามารถอัปเดตข้อมูลได้: " . $stmt->error);
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลแบนเนอร์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>

    <div class="container mt-5">
        <h2 class="heading">แก้ไขข้อมูลแบนเนอร์</h2>
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <?php if (!empty($banner['Bn_image'])): ?>
                    <img src="../images/banner/<?php echo htmlspecialchars($banner['Bn_image']); ?>"
                        alt="รูปแบนเนอร์" class="img-thumbnail mb-2" style="width: 120px;">
                <?php else: ?>
                    <p class="text-muted">ไม่มีรูปภาพ</p>
                <?php endif; ?>
                <br>
                <label class="form-label">อัปโหลดรูปภาพใหม่ (ถ้าต้องการเปลี่ยน)</label>
                <input type="file" class="form-control" name="Bn_image" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="Bn_explain" class="form-label">รายละเอียด</label>
                <input type="text" name="Bn_explain" id="Bn_explain" class="form-control"
                    value="<?php echo htmlspecialchars($banner['Bn_explain']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="Bn_status" class="form-label">Status</label>
                <select name="Bn_status" id="Bn_status" class="form-control" required>
                    <option value="0" <?= $banner['Bn_status'] == 0 ? 'selected' : '' ?>>ไม่แสดง</option>
                    <option value="1" <?= $banner['Bn_status'] == 1 ? 'selected' : '' ?>>แสดง</option>
                </select>
            </div>

            <div class="form-group text-center mt-3">
                <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

</body>

</html>