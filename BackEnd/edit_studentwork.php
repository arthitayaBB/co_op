<?php
include 'connectdb.php';
include 'check_admin.php';

if (!isset($_GET['id'])) {
    die("รหัสผลงานไม่ถูกต้อง");
}

$work_id = intval($_GET['id']); // ป้องกัน SQL injection

// ดึงข้อมูลผลงาน
$sql_work = "SELECT * FROM student_work WHERE Work_id = $work_id"; // แก้ไขตรงนี้: ลบเครื่องหมาย quotes ที่ครอบ $work_id
$result_work = mysqli_query($conn, $sql_work);

if ($result_work && mysqli_num_rows($result_work) > 0) {
    $existingWork = mysqli_fetch_assoc($result_work);
    $work_exists = true;
    $std_id = $existingWork['Std_id'];
    $company_id = $existingWork['Company_id'];
} else {
    die("ไม่พบผลงานนิสิต");
}

if (isset($_POST['Submit'])) { // แก้ไขตรงนี้: ชื่อปุ่ม Submit ไม่ตรงกับใน HTML form
    $work_name = mysqli_real_escape_string($conn, $_POST['Work_name']);
    $work_detail = mysqli_real_escape_string($conn, $_POST['Work_detail']);
    $work_year = mysqli_real_escape_string($conn, $_POST['Work_year']);
    $date = date("Y-m-d");

    $work_picture = $existingWork['Work_picture'] ?? '';
    $work_file = $existingWork['Work_File'] ?? '';

    // อัปโหลดรูป
    if (isset($_FILES['Workpicture']) && $_FILES['Workpicture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Workpicture']['tmp_name'];
        $fileName = $_FILES['Workpicture']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newPicName = "profileWorkfile_" . $std_id . "_" . time() . "." . $fileExtension;
            $uploadDir = '../images/pic_stdwork/';
            $dest_path = $uploadDir . $newPicName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $work_picture = $newPicName;
            }
        } else {
            echo "<script>alert('ประเภทไฟล์รูปภาพไม่ถูกต้อง! อนุญาตเฉพาะ JPG, PNG, GIF เท่านั้น');</script>";
        }
    }

    // อัปโหลดไฟล์ PDF
    if (isset($_FILES['Workfile']) && $_FILES['Workfile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Workfile']['tmp_name'];
        $fileName = $_FILES['Workfile']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if ($fileExtension === 'pdf') {
            $newFileName = "Workfile_" . $std_id . "_" . time() . ".pdf";
            $uploadDir = '../uploads/std_workfile/';
            $dest_path = $uploadDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $work_file = $newFileName;
            }
        } else {
            echo "<script>alert('ไฟล์ต้องเป็น PDF เท่านั้น!');</script>";
        }
    }

    // === UPDATE ข้อมูล ===
    $sql1 = "UPDATE student_work SET 
        Work_name = '$work_name',
        Work_detail = '$work_detail',
        Work_year = '$work_year',
        Company_id = '$company_id',
        Date = '$date'" .
        ($work_picture ? ", Work_picture = '$work_picture'" : "") .
        ($work_file ? ", Work_File = '$work_file'" : "") .
        " WHERE Work_id = '$work_id'";

    if (mysqli_query($conn, $sql1)) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href='indexstudentwork.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขผลงานนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>
    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        <h2 class="heading">แก้ไขข้อมูลผลงานนิสิต</h2> <!-- แก้ไขตรงนี้: เปลี่ยนจาก "แก้ไขข้อมูลอาจารย์" เป็น "แก้ไขข้อมูลผลงานนิสิต" -->
        <div class="d-flex justify-content-between mb-3">
        </div>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <!-- แสดงภาพหน้าปก -->
                <div class="mb-3 text-center">
                    <label class="form-label">รูปภาพ</label><br>
                    <img id="preview"
                        src="<?= !empty($existingWork['Work_picture']) ? '../images/pic_stdwork/' . htmlspecialchars($existingWork['Work_picture']) : 'about:blank' ?>"
                        width="150"
                        class="img-thumbnail <?= empty($existingWork['Work_picture']) ? 'd-none' : '' ?>"><br>

                    <label class="form-label">เปลี่ยนรูปภาพหน้าปก (ถ้าต้องการ)</label><br>
                    <input type="file" class="form-control" name="Workpicture" id="pictureInput" accept="image/*">
                </div>

                <!-- JavaScript สำหรับ preview -->
                <script>
                    document.getElementById('pictureInput').addEventListener('change', function(event) {
                        const [file] = event.target.files;
                        if (file) {
                            const preview = document.getElementById('preview');
                            preview.src = URL.createObjectURL(file);
                            preview.classList.remove('d-none'); // แสดงรูปในกรณีที่ซ่อนอยู่
                        }
                    });
                </script>


                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-briefcase-fill me-2" style="color: skyblue;"></i>ชื่อโปรเจค
                    </label>
                    <input type="text" name="Work_name" class="form-control" required value="<?= htmlspecialchars($existingWork['Work_name'] ?? '') ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-calendar-event-fill me-2" style="color: skyblue;"></i>ปีการศึกษา
                    </label>
                    <input type="number" name="Work_year" class="form-control" required value="<?= htmlspecialchars($existingWork['Work_year'] ?? '') ?>">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">
                        <i class="bi bi-card-text me-2" style="color: skyblue;"></i>รายละเอียด
                    </label>
                    <textarea name="Work_detail" class="form-control" rows="3" required><?= htmlspecialchars($existingWork['Work_detail'] ?? '') ?></textarea>
                </div>



                <!-- ช่องอัปโหลดไฟล์ใหม่ -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        <i class="bi bi-upload me-2" style="color: skyblue;"></i>เปลี่ยนไฟล์ PDF (ถ้าต้องการ)
                    </label>
                    <input type="file" name="Workfile" class="form-control" accept="application/pdf">
                </div>


                <div class="col-12 text-center">
                    <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
        </form>

    </div>

</body>

</html>