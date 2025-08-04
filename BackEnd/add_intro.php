<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_POST['Submit'])) {
    $I_detail = mysqli_real_escape_string($conn, $_POST['I_detail']);
    $I_status = intval($_POST['I_status']);
    $I_picture = NULL;

    // ดึง Admin_id จาก session (ควรมีการเซ็ตไว้ใน check_admin.php)
    $Admin_id = $_SESSION['Admin_id'];

    // ตรวจสอบว่ามี Admin_id จริง
    if (!$Admin_id) {
        die("ไม่สามารถระบุผู้ดูแลระบบได้");
    }

    // Insert ข้อมูลเพื่อให้ได้ Intro_id ก่อน พร้อมระบุ Admin_id
    $insertSql = "INSERT INTO intro (I_detail, I_status, Admin_id) VALUES ('$I_detail', $I_status, $Admin_id)";
    if (mysqli_query($conn, $insertSql)) {
        $Intro_id = mysqli_insert_id($conn);

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
                $updateSql = "UPDATE intro SET I_picture = '$safeFileName' WHERE Intro_id = $Intro_id";
                mysqli_query($conn, $updateSql);
            } else {
                die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
            }
        }

        mysqli_close($conn);
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location='indexintro.php';</script>";
        exit();
    } else {
        die("ไม่สามารถบันทึกข้อมูลได้: " . mysqli_error($conn));
    }
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
         <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
         <button class="close-btn" onclick="window.history.back();">×</button>
        <form method="POST" enctype="multipart/form-data">
        <h2 class="heading">เพิ่มข้อมูลLanding Page</h2>
            <div class="mb-3 text-center">
                <img id="preview" src="" alt="Preview" class="img-thumbnail d-block mx-auto mb-2 d-none" style="width: 120px;">
                <p id="noImageText" class="text-muted">ไม่มีรูปภาพ</p>
                <label class="form-label">อัปโหลดรูปภาพ</label>
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
                <textarea name="I_detail" id="I_detail" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="I_status" class="form-label">Status</label>
                <select name="I_status" id="I_status" class="form-control" required>
                    <option value="1">แสดง</option>
                    <option value="0">ไม่แสดง</option>
                </select>
            </div>

            <div class="form-group text-center mt-3">
                <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>