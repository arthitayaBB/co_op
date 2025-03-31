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
    
    // ตรวจสอบการอัปโหลดไฟล์
    $Npicture = NULL; // กำหนดเป็น NULL หากไม่มีการอัปโหลดไฟล์
    if (isset($_FILES['Npicture']) && $_FILES['Npicture']['error'] == 0) {
        // กำหนดโฟลเดอร์ที่เก็บไฟล์
        $target_dir = "imgnews/"; // หรือ "imagess/" ตามที่ต้องการ
        $target_file = $target_dir . basename($_FILES["Npicture"]["name"]);

        // ตรวจสอบว่าไฟล์ถูกย้ายไปยังโฟลเดอร์ที่ต้องการหรือไม่
        if (move_uploaded_file($_FILES["Npicture"]["tmp_name"], $target_file)) {
            $Npicture = basename($_FILES["Npicture"]["name"]);
        } else {
            echo "ไม่สามารถอัปโหลดไฟล์ได้ กรุณาลองใหม่.";
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
                header("Location: indexnews.php");
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
    <title>แก้ไขข้อมูลนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>

    <!-- พื้นหลัง Particles -->
    <div id="particles-js"></div>

    <button class="toggle-btn" onclick="toggleDarkMode()">Dark/Light Mode</button>

    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        
        <h2 class="heading">เพิ่มข้อมูล</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Nheading" class="form-label">หัวข้อ</label>
                <input type="text" name="Nheading" id="Nheading" class="form-control" required autofocus>
            </div>


            <div class="form-group">
                <label for="Ndetail" class="form-label">รายระเอียด</label>
                <input type="text" name="Ndetail" id="Ndetail" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for=" Npicture" class="form-label">รูปภาพ</label>
                <input type="file" name="Npicture" id="Npicture" class="form-control">
            </div>

            <div class="form-group">
                <label for="Nstatus" class="form-label">Status</label>
                <select name="Nstatus" id="Nstatus" class="form-control" required>
                    <option value="0">ไม่อนุญาต</option>
                    <option value="1">อนุญาต</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Nrefer" class="form-label">reference</label>
                <input type="text" name="Nrefer" id="Nrefer" class="form-control" required autofocus>
            </div>

            <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>
   
            </div>
            
        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>
</html>
