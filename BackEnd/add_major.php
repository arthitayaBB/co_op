<?php
include 'check_admin.php';
include 'connectdb.php';

// กำหนดค่าตัวแปรเริ่มต้น
$Major_id = $Major_name = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม

    $Major_name = $_POST['Major_name'];
    $M_sub = $_POST['M_sub'];

    // SQL คำสั่งสำหรับเพิ่มข้อมูลสาขา
    $query = "INSERT INTO major ( Major_name, M_sub) VALUES ( '$Major_name','$M_sub')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('เพิ่มข้อมูลสาขาสำเร็จ'); window.location.href = 'indexmajor.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลสาขา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>

   

   

    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        
        <h2 class="heading">เพิ่มข้อมูลสาขา</h2>
        <form method="POST">
          
            <div class="form-group">
                <label for="Major_name" class="form-label">ชื่อสาขา</label>
                <input type="text" class="form-control" id="Major_name" name="Major_name" required>
            </div>
            <div class="form-group">
                <label for="Major_name" class="form-label">ตัวย่อสาขา</label>
                <input type="text" class="form-control" id="M_sub" name="M_sub" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>
