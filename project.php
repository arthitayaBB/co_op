<?php
include_once("connectdb.php");
include ("checklogin.php");

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ดึงข้อมูลโปรเจคของนักศึกษา ถ้ามีอยู่แล้ว
$sql = "SELECT Proposal_id FROM proposal WHERE Std_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $Std_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$Proposal_id = $row['Proposal_id'] ?? null;

if (isset($_POST['Submit'])) {
    $Proposalname = mysqli_real_escape_string($conn, $_POST['Proposalname']);
    $Sugyear = intval($_POST['Sugyear']);

    // ตรวจสอบว่าไฟล์ถูกอัปโหลดหรือไม่
    if (isset($_FILES['Filename']) && $_FILES['Filename']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Filename']['tmp_name'];
        $fileName = basename($_FILES['Filename']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // ตรวจสอบว่าเป็น PDF หรือไม่
        if ($fileExtension !== 'pdf') {
            echo "<script>alert('กรุณาอัปโหลดไฟล์ PDF เท่านั้น!'); window.history.back();</script>";
            exit;
        }

        // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันการชนกัน
        $newFileName = "project_" . $Std_id . "_" . time() . ".pdf";
        $uploadPath = "uploads/project/" . $newFileName;

        // ย้ายไฟล์ไปยังโฟลเดอร์ปลายทาง
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // ถ้ามีอยู่แล้วให้อัปเดต
            if ($Proposal_id) {
                $sql = "UPDATE proposal SET Proposal_name = ?, File_name = ?, Sug_year = ?, Pro_status = 3 WHERE Std_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssii", $Proposalname, $newFileName, $Sugyear, $Std_id);
            } else {
                // ถ้ายังไม่มีให้เพิ่มใหม่
                $sql = "INSERT INTO proposal (Std_id, Proposal_name, File_name, Sug_year, Pro_status) VALUES (?, ?, ?, ?, 3)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "issi", $Std_id, $Proposalname, $newFileName, $Sugyear);
            }

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('บันทึกข้อมูลสำเร็จ!'); window.location='proposal.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('ไม่สามารถอัปโหลดไฟล์ได้!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('กรุณาเลือกไฟล์ก่อนทำการบันทึก!'); window.history.back();</script>";
    }
}
 // เปิด error reporting
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มไฟล์โปรเจคจบ</title>
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

    <h2 class="mb-4 text-center">เพิ่มไฟล์โปรเจคจบ</h2>
    
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">ชื่อโปรเจค</label>
            <input type="text" name="Proposalname" class="form-control" placeholder="เช่น ระบบจัดการร้านค้าออนไลน์" required autofocus>
        </div>
   
        <div class="mb-3">
            <label class="form-label">ปีการศึกษา</label>
            <input type="number" name="Sugyear" class="form-control" placeholder="เช่น 2565" required min="2565">
        </div>

        <div class="mb-3">
            <label class="form-label">เพิ่มไฟล์โปรเจค (เฉพาะ PDF เท่านั้น)</label>
            <input type="file" name="Filename" class="form-control" accept="application/pdf" required>
        </div>
        
        <button type="submit" name="Submit" class="btn btn-info w-100">เพิ่ม</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
