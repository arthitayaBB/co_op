<?php

include_once("connectdb.php");
include("checklogin.php");

$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;

// ตรวจสอบว่ามีการส่งโปรเจคไปแล้วหรือยัง
$sql_check = "SELECT * FROM student_work WHERE Std_id = $Std_id LIMIT 1";
$result_check = mysqli_query($conn, $sql_check);
$existing_work = mysqli_fetch_assoc($result_check);

// ดึงสถานะการอนุมัติจาก proposal
$sql_status = "
    SELECT p.Com_status, p.Pro_status
    FROM proposal p
    WHERE p.Std_id = $Std_id
    LIMIT 1
";
$result_status = mysqli_query($conn, $sql_status);
$std = mysqli_fetch_assoc($result_status);
?>



<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มโปรเจคสหกิจศึกษา</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 10px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            position: relative;
        }

        .close-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .close-icon:hover {
            color: #ff4d4d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-end">
            <a href="std_home.php" class="text-decoration-none">
                <i class="bi bi-x-lg close-icon"></i>
            </a>
        </div>

        <h4 class="text-center mb-4">
            <i class="bi bi-file-earmark-text-fill me-2" style="color: skyblue;"></i>ส่งโปรเจคสหกิจ
        </h4>

      <?php if ($existing_work): ?>
    <div class="alert alert-info text-center">
        <strong>คุณได้ส่งโปรเจคสหกิจแล้ว</strong><br>
        โปรเจค: <?= htmlspecialchars($existing_work['Work_name']) ?><br>
        ปีการศึกษา: <?= htmlspecialchars($existing_work['Work_year']) ?>
    </div>

<?php elseif ($std['Com_status'] != 1 || $std['Pro_status'] != 1): ?>
    <div class="alert alert-warning text-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        ไม่สามารถกรอกข้อมูลโปรเจคได้ <br>
        เนื่องจากยังไม่ได้รับอนุมัติจาก
        <?= $std['Com_status'] != 1 ? 'สถานประกอบการ' : ''; ?>
        <?= ($std['Com_status'] != 1 && $std['Pro_status'] != 1) ? ' และ ' : ''; ?>
        <?= $std['Pro_status'] != 1 ? 'โครงการที่ยื่น' : ''; ?>
    </div>
    
<?php else: ?>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-briefcase-fill me-2" style="color: skyblue;"></i>ชื่อโปรเจค
                        </label>
                        <input type="text" name="Workname" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-event-fill me-2" style="color: skyblue;"></i>ปีการศึกษา
                        </label>
                        <input type="number" name="Workyear" class="form-control" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">
                            <i class="bi bi-card-text me-2" style="color: skyblue;"></i>รายละเอียด
                        </label>
                        <textarea name="Workdetails" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-image-fill me-2" style="color: skyblue;"></i>รูปภาพหน้าปก
                        </label>
                        <input type="file" name="Workpicture" class="form-control" accept="image/*" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-file-earmark-pdf-fill me-2" style="color: skyblue;"></i>ไฟล์โปรเจค (เฉพาะ PDF)
                        </label>
                        <input type="file" name="Workfile" class="form-control" accept="application/pdf" required>
                    </div>


                    <div class="col-12 mb-4">
                        <h5 class="text-center mt-4 mb-3"><i class="bi-chat-dots-fill me-2" style="color: skyblue;"></i>ผลการฝึกงาน (คำแนะนำสู่รุ่นน้อง)</h5>
                        <select name="Workresult" class="form-select" required>
                            <option value="" disabled selected>-- กรุณาเลือกผลการฝึกงาน --</option>
                            <option value="1">ได้งาน</option>
                            <option value="3">เสนอแต่ไม่รับ</option>
                            <option value="2">ไม่ได้งาน</option>
                        </select>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label">
                            <i class="bi bi-gift-fill me-2" style="color: skyblue;"></i>สวัสดิการที่ได้รับ
                        </label>

                        <input type="text" name="Workbenefit" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" name="Submit" class="btn btn-info w-100">ส่งข้อมูล</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($_POST['Submit'])) {
        $work_name = mysqli_real_escape_string($conn, $_POST['Workname']);
        $work_detail = mysqli_real_escape_string($conn, $_POST['Workdetails']);
        $work_year = mysqli_real_escape_string($conn, $_POST['Workyear']);
        $work_result = mysqli_real_escape_string($conn, $_POST['Workresult']);
        $work_benefit = mysqli_real_escape_string($conn, $_POST['Workbenefit']);
        $std_id = $Std_id;
        $date = date("Y-m-d");

        $work_picture = "";
        $work_file = "";

        // รูปภาพหน้าปก
        if (isset($_FILES['Workpicture']) && $_FILES['Workpicture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Workpicture']['tmp_name'];
            $fileName = $_FILES['Workpicture']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newPicName = "profileWorkfile_" . $std_id . "_" . time() . "." . $fileExtension;
                $uploadDir = 'images/pic_stdwork/';
                $dest_path = $uploadDir . $newPicName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $work_picture = $newPicName;
                }
            } else {
                echo "<script>alert('ประเภทไฟล์รูปภาพไม่ถูกต้อง! อนุญาตเฉพาะ JPG, PNG, GIF เท่านั้น');</script>";
            }
        }

        // ไฟล์โปรเจค PDF
        if (isset($_FILES['Workfile']) && $_FILES['Workfile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Workfile']['tmp_name'];
            $fileName = $_FILES['Workfile']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExtension == 'pdf') {
                $newFileName = "Workfile_" . $std_id . "_" . time() . ".pdf";
                $uploadDir = 'uploads/std_workfile/';
                $dest_path = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $work_file = $newFileName;
                }
            } else {
                echo "<script>alert('ไฟล์ต้องเป็น PDF เท่านั้น!');</script>";
            }
        }

        // บันทึกลง student_work
        $sql1 = "INSERT INTO student_work 
            (Work_name, Std_id, Work_detail, Work_picture, Date, Work_year, Company_id, Work_File) 
            VALUES 
            ('$work_name', '$std_id', '$work_detail', '$work_picture', '$date', '$work_year', '$company_id', '$work_file')";

        // บันทึกลง job_offer
        $sql2 = "INSERT INTO job_offer (Std_id, Offer_status) 
            VALUES ('$std_id', '$work_result')";

        // บันทึกลง advice
        // ดึง company_id จากตาราง proposal โดยใช้ Std_id
        $sql_company = "SELECT Company_id FROM proposal WHERE Std_id = '$std_id'";
        $result_company = mysqli_query($conn, $sql_company);
        $row_company = mysqli_fetch_assoc($result_company);
        $company_id = $row_company['Company_id'] ?? null;

        // ทำการบันทึกข้อมูลในตาราง advice พร้อม company_id
        $sql3 = "INSERT INTO advice (Std_id, Workbenefit, Company_id) 
         VALUES ('$std_id', '$work_benefit', '$company_id')";




        // ทำการ insert ทีละอัน
        if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
            echo "<script>alert('บันทึกข้อมูลทั้งหมดสำเร็จ!'); window.location='std_home.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>

</body>

</html>