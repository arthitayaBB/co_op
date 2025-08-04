<?php
include 'connectdb.php';
include 'check_admin.php'; // สมมติว่าไฟล์นี้กำหนด $Adminid จาก session

if (isset($_POST['Submit'])) {
    $Bn_explain = mysqli_real_escape_string($conn, $_POST['Bn_explain']);
    $Bn_status = intval($_POST['Bn_status']);
    $Bn_image = NULL;

    // ตรวจสอบว่า Admin_id มีอยู่จริงหรือไม่
    if ($Adminid) {
        $check_admin = mysqli_query($conn, "SELECT Admin_id FROM adminn WHERE Admin_id = '$Adminid'");
        if (mysqli_num_rows($check_admin) > 0) {

            // บันทึกข้อมูลเพื่อให้ได้ Bn_id ก่อน
            $insertSql = "INSERT INTO banner (Bn_explain, Bn_status, Admin_id) VALUES ('$Bn_explain', $Bn_status, '$Adminid')";
            if (mysqli_query($conn, $insertSql)) {
                $Bn_id = mysqli_insert_id($conn); // ได้ Bn_id ล่าสุด

                // ถ้ามีการอัปโหลดรูปภาพ
                if (isset($_FILES['Bn_id']) && $_FILES['Bn_id']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = '../images/banner/';
                    $timestamp = date("YmdHis");
                    $originalExtension = strtolower(pathinfo($_FILES['Bn_id']['name'], PATHINFO_EXTENSION));

                    $newFileName = "Bn" . $Bn_id . "_" . $timestamp . "." . $originalExtension;
                    $uploadFile = $uploadDir . $newFileName;

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (!in_array($originalExtension, $allowedExtensions)) {
                        die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
                    }

                    if (move_uploaded_file($_FILES['Bn_id']['tmp_name'], $uploadFile)) {
                        $safeFileName = mysqli_real_escape_string($conn, $newFileName);
                        $updateSql = "UPDATE banner SET Bn_image = '$safeFileName' WHERE Bn_id = $Bn_id";
                        mysqli_query($conn, $updateSql);
                    } else {
                        die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
                    }
                }

                mysqli_close($conn);
                echo "<script>
                    alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                    window.location.href = 'indexbanner.php';
                </script>";
                exit();
            } else {
                die("ไม่สามารถบันทึกข้อมูลได้: " . mysqli_error($conn));
            }

        } else {
            die("ไม่พบสิทธิ์ของผู้ดูแลระบบ");
        }
    } else {
        die("ไม่พบข้อมูลผู้ดูแลระบบ");
    }
}
?>



<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลแบนเนอร์</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>

<div class="container mt-5">
    <button class="close-btn" onclick="window.history.back();">×</button>
    <h2 class="heading">เพิ่มข้อมูลBanner</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3 text-center">
            <img id="preview" src="" alt="Preview" class="img-thumbnail d-block mx-auto mb-2 d-none" style="width: 120px; height: auto;">
            <p id="noImageText" class="text-muted">ไม่มีรูปภาพ</p>

            <label class="form-label text-start">อัปโหลดรูปภาพ</label>
            <input type="file" class="form-control" name="Bn_id" id="pictureInput" accept="image/*">
        </div>

        <script>
            document.getElementById('pictureInput').addEventListener('change', function(event) {
                const [file] = event.target.files;
                const preview = document.getElementById('preview');
                const noImageText = document.getElementById('noImageText');

                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('d-none');
                    if (noImageText) {
                        noImageText.style.display = 'none';
                    }
                }
            });
        </script>

        <div class="form-group">
            <label for="Bn_explain" class="form-label">รายละเอียด</label>
            <input type="text" name="Bn_explain" id="Bn_explain" class="form-control" required autofocus>
        </div>

        <div class="form-group">
            <label for="Bn_status" class="form-label">Status</label>
            <select name="Bn_status" id="Bn_status" class="form-control" required>
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
   

<script src="scriptBEadd.js"></script>
</body>
</html>
