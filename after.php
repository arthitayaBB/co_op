<?php
include_once("connectdb.php");
session_start();
// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;

// ดึงข้อมูลสาขาของนักศึกษา
$sql = "
SELECT sw.*, s.Std_id, s.Std_name, p.Proposal_id, c.Company_id, c.NamecomTH
FROM student s 
JOIN proposal p ON s.Std_id = p.Std_id 
JOIN student_work sw ON s.Std_id = sw.Std_id 
JOIN company c ON sw.Company_id = c.Company_id
WHERE s.Std_id = $Std_id
";
$result = mysqli_query($conn, $sql);
$sw = mysqli_fetch_assoc($result);

$company_id = $sw['Company_id'] ?? null;
$company_name = $sw['NamecomTH'] ?? '';

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เลือกสถานประกอบการ</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
        }

        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: rgb(22, 22, 22);
        }

        .close-icon:hover {
            color: #ff4d4d;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="proposal.php">
            <i class="bi bi-x-lg close-icon"></i>
        </a>
        <h2 class="mb-4 text-center">ส่งโปรเจคสหกิจ</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">ชื่องาน</label>
                <input type="text" name="Workname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">รายละเอียด</label>
                <input type="text" name="Workdetails" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ปีการศึกษา</label>
                <input type="number" name="Workyear" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">รูปภาพหน้าปก</label>
                <input type="file" name="Workpicture" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ไฟล์โปรเจค (เฉพาะ PDF)</label>
                <input type="file" name="Workfile" class="form-control" accept="application/pdf" required>
            </div>

            <button type="submit" name="Submit" class="btn btn-info w-100">เพิ่ม</button>
        </form>
    </div>

    <?php
    if (isset($_POST['Submit'])) {
        $work_name = mysqli_real_escape_string($conn, $_POST['Workname']);
        $work_detail = mysqli_real_escape_string($conn, $_POST['Workdetails']);
        $work_year = mysqli_real_escape_string($conn, $_POST['Workyear']);
        $std_id = $Std_id;
        $date = date("Y-m-d");

        $work_picture = "";
        $work_file = "";

        // ตรวจสอบและอัปโหลดรูปภาพหน้าปก
        if (isset($_FILES['Workpicture']) && $_FILES['Workpicture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Workpicture']['tmp_name'];
            $fileName = $_FILES['Workpicture']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newPicName = "profile_" . $std_id . "_" . time() . "." . $fileExtension;
                $uploadDir = 'images/';
                $dest_path = $uploadDir . $newPicName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $work_picture = $newPicName;
                }
            } else {
                echo "<script>alert('ประเภทไฟล์รูปภาพไม่ถูกต้อง! อนุญาตเฉพาะ JPG, PNG, GIF เท่านั้น');</script>";
            }
        }

        // ตรวจสอบและอัปโหลดไฟล์โปรเจค PDF
        if (isset($_FILES['Workfile']) && $_FILES['Workfile']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Workfile']['tmp_name'];
            $fileName = $_FILES['Workfile']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExtension == 'pdf') {
                $newFileName = "project_" . $std_id . "_" . time() . ".pdf";
                $uploadDir = 'uploads/';
                $dest_path = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $work_file = $newFileName;
                }
            } else {
                echo "<script>alert('ไฟล์ต้องเป็น PDF เท่านั้น!');</script>";
            }
        }

        // บันทึกลงฐานข้อมูล
        $sql = "INSERT INTO student_work (Work_name, Std_id, Work_detail, Work_picture, Date, Work_year, Company_id, Work_File) 
                VALUES ('$work_name', '$std_id', '$work_detail', '$work_picture', '$date', '$work_year', '$company_id', '$work_file')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ!'); window.location='proposal.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
