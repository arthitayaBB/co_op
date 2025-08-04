<?php
include 'connectdb.php';
include 'check_admin.php';

// ตรวจสอบว่ามีการส่งฟอร์มมาหรือไม่
if (isset($_POST['Submit'])) {
    // รับค่าจากฟอร์ม
    $Nheading = mysqli_real_escape_string($conn, $_POST['Nheading']);
    $Ndetail = mysqli_real_escape_string($conn, $_POST['Ndetail']);
    $Nrefer = mysqli_real_escape_string($conn, $_POST['Nrefer']);
    $Nstatus = intval($_POST['Nstatus']); // แปลงค่าเป็น int
    $Adminid = $_SESSION['Admin_id'] ?? null; // ดึง Admin_id จาก session (ถ้ามี)
    $Ndate = date('Y-m-d'); // วันที่ปัจจุบัน
    $Nyear = date('Y'); // ปีปัจจุบัน

    $Npicture = NULL;

    if (isset($_FILES['Npicture']) && $_FILES['Npicture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/news/';
        $timestamp = date("YmdHis");
        $originalExtension = strtolower(pathinfo($_FILES['Npicture']['name'], PATHINFO_EXTENSION));

        // ตั้งชื่อใหม่จากหัวข้อข่าว
        $sanitizedHeading = preg_replace("/[^ก-๙a-zA-Z0-9]/u", "_", $Nheading);
        $newFileName = $sanitizedHeading . "_" . $timestamp . "." . $originalExtension;
        $uploadFile = $uploadDir . $newFileName;

        // ตรวจสอบนามสกุลไฟล์
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($originalExtension, $allowedExtensions)) {
            die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
        }

        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES['Npicture']['tmp_name'], $uploadFile)) {
            $Npicture = mysqli_real_escape_string($conn, $newFileName);
        } else {
            die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์");
        }
    }


    // ตรวจสอบว่า Admin_id มีอยู่จริงหรือไม่
    if ($Adminid) {
        $check_admin = mysqli_query($conn, "SELECT Admin_id FROM adminn WHERE Admin_id = '$Adminid'");
        if (mysqli_num_rows($check_admin) > 0) {
            // คำสั่ง SQL เพื่อเพิ่มข้อมูลข่าว
            $sql = "INSERT INTO news (N_picture, N_heading, N_detail, N_date, N_year, N_status, Admin_id, N_refer) 
                    VALUES ('$Npicture', '$Nheading', '$Ndetail', '$Ndate', '$Nyear', '$Nstatus', '$Adminid', '$Nrefer')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('เพิ่มข้อมูลข่าวสารเรียนร้อยแล้ว');
                    window.location.href = 'indexnews.php';
                  </script>";
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Admin_id ไม่มีอยู่ในระบบ";
        }
    } else {
        echo "Error: Admin_id ไม่ได้ถูกกำหนด";
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลข่าวสาร</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>


    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">เพิ่มข้อมูลข่าวสาร</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <!-- แสดงรูปภาพข่าวถ้ามี -->
                <?php if (!empty($user['N_picture'])): ?>
                    <img id="preview"
                        alt="รูปภาพข่าว"
                        class="img-thumbnail d-block mx-auto mb-2"
                        style="width: 120px; height: auto;">
                <?php else: ?>
                    <img id="preview"
                        src=""
                        alt="Preview"
                        class="img-thumbnail d-block mx-auto mb-2 d-none"
                        style="width: 120px; height: auto;">
                    <p id="noImageText" class="text-muted">ไม่มีรูปภาพ</p> <!-- เพิ่ม id ตรงนี้ -->
                <?php endif; ?>

                <label class="form-label text-start">อัปโหลดรูปภาพ</label>
                <input type="file" class="form-control" name="Npicture" id="pictureInput" accept="image/*">


            </div>

            <!-- JavaScript สำหรับ preview -->
            <script>
                document.getElementById('pictureInput').addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    const preview = document.getElementById('preview');
                    const noImageText = document.getElementById('noImageText');

                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.classList.remove('d-none');
                        if (noImageText) {
                            noImageText.style.display = 'none'; // ซ่อนข้อความ "ไม่มีรูปภาพ"
                        }
                    }
                });
            </script>

            <div class="form-group">
                <label for="Nheading" class="form-label">หัวข้อ</label>
                <input type="text" name="Nheading" id="Nheading" class="form-control" required autofocus>
            </div>


            <div class="form-group">
                <label for="Ndetail" class="form-label">รายระเอียด</label>
                <textarea  name="Ndetail" id="Ndetail" class="form-control" required autofocus></textarea>
            </div>


            <div class="form-group">
                <label for="Nrefer" class="form-label">reference</label>
                <input type="text" name="Nrefer" id="Nrefer" class="form-control" required autofocus>
            </div>
             <div class="form-group">
                <label for="Nstatus" class="form-label">Status</label>
                <select name="Nstatus" id="Nstatus" class="form-control" required>
                    <option value="0">แสดง</option>
                    <option value="1">ไม่แสดง</option>
                </select>
            </div>

            <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>

            </div>

        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>

</html>