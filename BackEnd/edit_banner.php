<?php
include 'connectdb.php';
include 'check_admin.php';

if (!isset($_GET['id'])) {
    die("ไม่พบรหัสแบนเนอร์ที่ต้องการแก้ไข");
}

$Bn_id = intval($_GET['id']);

// ดึงข้อมูลเดิม
$sql = "SELECT * FROM banner WHERE Bn_id = $Bn_id";
$result = mysqli_query($conn, $sql);
$banner = mysqli_fetch_assoc($result);

if (!$banner) {
    die("ไม่พบข้อมูลแบนเนอร์ที่ระบุ");
}

if (isset($_POST['Submit'])) {
    $Bn_explain = mysqli_real_escape_string($conn, $_POST['Bn_explain']);
    $Bn_status = intval($_POST['Bn_status']);
    $newFileName = $banner['Bn_image']; // กรณีไม่เปลี่ยนรูป

    // หากอัปโหลดรูปใหม่
    if (isset($_FILES['Bn_id']) && $_FILES['Bn_id']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/banner/';
        $timestamp = date("YmdHis");
        $ext = strtolower(pathinfo($_FILES['Bn_id']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowedExtensions)) {
            die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
        }

        $newFileName = "Bn{$Bn_id}_{$timestamp}.$ext";
        $uploadFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['Bn_id']['tmp_name'], $uploadFile)) {
            // ลบไฟล์เก่าหากมี
            if (!empty($banner['Bn_image']) && file_exists($uploadDir . $banner['Bn_image'])) {
                unlink($uploadDir . $banner['Bn_image']);
            }
        } else {
            die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
        }
    }

    // อัปเดตฐานข้อมูล
    $updateSql = "UPDATE banner SET 
                    Bn_explain = '$Bn_explain', 
                    Bn_status = $Bn_status,
                    Bn_image = '$newFileName'
                  WHERE Bn_id = $Bn_id";

    if (mysqli_query($conn, $updateSql)) {
        mysqli_close($conn);
        header("Location: indexbanner.php");
        exit();
    } else {
        die("ไม่สามารถอัปเดตข้อมูลได้: " . mysqli_error($conn));
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
<h2 class="heading">เพิ่มข้อมูลแบนเนอร์</h2>
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
            <input type="file" class="form-control" name="Bn_id" accept="image/*">
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
