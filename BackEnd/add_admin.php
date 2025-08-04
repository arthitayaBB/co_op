<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_POST['Submit'])) {
    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $Adname = mysqli_real_escape_string($conn, $_POST['Adname']);
    $Adsurname = mysqli_real_escape_string($conn, $_POST['Adsurname']);
    $Adphone = mysqli_real_escape_string($conn, $_POST['Adphone']);
    $Ademail = mysqli_real_escape_string($conn, $_POST['Ademail']);
    $Adpwd = isset($_POST['Adpwd']) ? trim($_POST['Adpwd']) : '';

    if (!empty($Adpwd)) {
        // ใช้ password_hash() เพื่อแฮชรหัสผ่าน
        $hashedPwd = password_hash($Adpwd, PASSWORD_DEFAULT); // เพิ่มการเข้ารหัสรหัสผ่าน
    } else {
        die("กรุณากรอกรหัสผ่าน");
    }
    

// คำสั่ง SQL เพื่อเพิ่มข้อมูลอาจารย์
$sql = "INSERT INTO `adminn` (`Ad_name`, `Ad_surname`, `Ad_phone`, `Ad_email`, `Ad_pwd`) 
        VALUES ('$Adname', '$Adsurname', '$Adphone', '$Ademail', '$hashedPwd')";

if (mysqli_query($conn, $sql)) {
    // เมื่อบันทึกข้อมูลสำเร็จ จะแจ้งเตือนและ redirect
    echo "<script>
            alert('เพิ่มข้อมูลอาจารย์สำเร็จ');
            window.location.href = 'indexadmin.php';
          </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>


    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">เพิ่มข้อมูลAdmin</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Adname" class="form-label">ชื่อ</label>
                        <input type="text" name="Adname" id="Adname" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Adsurname" class="form-label">นามสกุล </label>
                        <input type="text" name="Adsurname" id="Adsurname" class="form-control" required>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="Adphone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" name="Adphone" id="Adphone" class="form-control" maxlength="10" required pattern="[0-9]{10}" title="กรอกตัวเลข 10 หลัก">

            </div>

            <div class="form-group">
                <label for="Ademail" class="form-label">Email</label>
                <input type="email" name="Ademail" id="Ademail" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="Adpwd" class="form-label">Password</label>
                <input type="password" name="Adpwd" id="Adpwd" class="form-control" required autofocus>
            </div>


            <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary">เพิ่มข้อมูล</button>

            </div>

        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>

</html>