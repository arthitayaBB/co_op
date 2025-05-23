<?php
include 'connectdb.php';
include 'check_admin.php';

if (!isset($_GET['id'])) {
    die("ไม่พบข้อมูล Intro ที่ต้องการแก้ไข");
}

$Intro_id = intval($_GET['id']);

// ดึงข้อมูลเดิม
$sql = "SELECT * FROM intro WHERE Intro_id = $Intro_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) !== 1) {
    die("ไม่พบข้อมูล Intro ที่ระบุ");
}
$row = mysqli_fetch_assoc($result);

// ถ้ามีการส่งฟอร์ม
if (isset($_POST['Submit'])) {
    $I_detail = mysqli_real_escape_string($conn, $_POST['I_detail']);
    $I_status = intval($_POST['I_status']);

    $updateSql = "UPDATE intro SET I_detail = '$I_detail', I_status = $I_status WHERE Intro_id = $Intro_id";
    mysqli_query($conn, $updateSql);

    if (isset($_FILES['I_picture']) && $_FILES['I_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/intro/';
        $timestamp = date("YmdHis");
        $extension = strtolower(pathinfo($_FILES['I_picture']['name'], PATHINFO_EXTENSION));
        $newFileName = "intro" . $Intro_id . "_" . $timestamp . "." . $extension;
        $uploadFile = $uploadDir . $newFileName;

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extension, $allowedExtensions)) {
            die("ประเภทไฟล์ไม่ถูกต้อง! รองรับ JPG, JPEG, PNG, GIF");
        }

        if (move_uploaded_file($_FILES['I_picture']['tmp_name'], $uploadFile)) {
            $safeFileName = mysqli_real_escape_string($conn, $newFileName);
            $updateImgSql = "UPDATE intro SET I_picture = '$safeFileName' WHERE Intro_id = $Intro_id";
            mysqli_query($conn, $updateImgSql);
        } else {
            die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
        }
    }

    mysqli_close($conn);
    header("Location: indexintro.php");
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>เพิ่มข้อมูลLanding Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
        <link rel="stylesheet" href="stylBEadd.CSS">
    </head>
</head>

<body>
    <div class="container mt-5">
        <button class="close-btn" onclick="window.history.back();">×</button>
        <h2 class="heading">แก้ไขข้อมูล Landing Page</h2>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <?php if (!empty($row['I_picture'])): ?>
                    <img id="preview" src="../images/intro/<?= htmlspecialchars($row['I_picture']) ?>" class="img-thumbnail mb-2" style="width: 120px;">
                <?php else: ?>
                    <img id="preview" src="" class="img-thumbnail mb-2 d-none" style="width: 120px;">
                    <p id="noImageText" class="text-muted">ไม่มีรูปภาพ</p>
                <?php endif; ?>

                <p><label class="form-label">อัปโหลดรูปภาพใหม่ (ถ้ามี)</label></p>
                <input type="file" class="form-control" name="I_picture" id="pictureInput" accept="image/*">
            </div>

            <script>
                document.getElementById('pictureInput').addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    const preview = document.getElementById('preview');
                    const noImageText = document.getElementById('noImageText');

                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.classList.remove('d-none');
                        if (noImageText) noImageText.style.display = 'none';
                    }
                });
            </script>


            <div class="form-group">
                <label for="I_detail" class="form-label">รายละเอียด</label>
                <textarea name="I_detail" id="I_detail" class="form-control" required><?= htmlspecialchars($row['I_detail']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="I_status" class="form-label">Status</label>
                <select name="I_status" id="I_status" class="form-control" required>
                    <option value="1" <?= $row['I_status'] == 1 ? 'selected' : '' ?>>แสดง</option>
                    <option value="0" <?= $row['I_status'] == 0 ? 'selected' : '' ?>>ไม่แสดง</option>
                </select>
            </div>

            <div class="form-group text-center mt-3">
                <button type="submit" name="Submit" class="btn btn-primary">อัปเดตข้อมูล</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>