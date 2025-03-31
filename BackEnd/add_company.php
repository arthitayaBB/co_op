<?php
include 'connectdb.php'; 
include 'check_admin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameTH = mysqli_real_escape_string($conn, $_POST['NamecomTH']);
    $nameEN = mysqli_real_escape_string($conn, $_POST['NamecomEng']);
    $address = mysqli_real_escape_string($conn, $_POST['Company_add']);
    $province = mysqli_real_escape_string($conn, $_POST['Province']);
    $phone = mysqli_real_escape_string($conn, $_POST['Com_phone']);
    $email = mysqli_real_escape_string($conn, $_POST['Com_email']);
    $website = mysqli_real_escape_string($conn, $_POST['Website']);
    $contactName = mysqli_real_escape_string($conn, $_POST['Contact_com']);
    $position = mysqli_real_escape_string($conn, $_POST['Position']);
    $duration = mysqli_real_escape_string($conn, $_POST['Duration']);
    $jobDescription = mysqli_real_escape_string($conn, $_POST['Job_description']);
    $welfare = mysqli_real_escape_string($conn, $_POST['welfare']);
    $faxNumber = mysqli_real_escape_string($conn, $_POST['Fax_number']);
    $map = mysqli_real_escape_string($conn, $_POST['Map']);
    $academicYear = mysqli_real_escape_string($conn, $_POST['Academic_year']);
    $major_id = mysqli_real_escape_string($conn, $_POST['Major_id']);

    if (!empty($nameTH) && !empty($address) && !empty($major_id) && !empty($contactName) && !empty($position)) {
        $sql = "INSERT INTO company (NamecomTH, NamecomEng, Company_add, Province, Com_phone, Com_email, Website, 
                                    Contact_com, Position, Duration, Job_description, welfare, Fax_number, Map, Academic_year, Major_id) 
                VALUES ('$nameTH', '$nameEN', '$address', '$province', '$phone', '$email', '$website', 
                        '$contactName', '$position', '$duration', '$jobDescription', '$welfare', '$faxNumber', '$map', '$academicYear', '$major_id')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href='indexcompany.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลสถานประกอบการ</title>
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

        <h2 class="heading">เพิ่มข้อมูลสถานประกอบการ</h2>
    <form method="POST">
        <form method="POST">
    <div class="mb-3">
        <label class="form-label">ชื่อบริษัท (TH)</label>
        <input type="text" name="NamecomTH" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ชื่อบริษัท (EN)</label>
        <input type="text" name="NamecomEng" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">ที่อยู่</label>
        <input type="text" name="Company_add" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">จังหวัด</label>
        <input type="text" name="Province" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">เบอร์โทร</label>
        <input type="text" name="Com_phone" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">อีเมล</label>
        <input type="email" name="Com_email" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">เว็บไซต์</label>
        <input type="url" name="Website" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">ชื่อผู้ติดต่อ</label>
        <input type="text" name="Contact_com" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ตำแหน่ง</label>
        <input type="text" name="Position" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ระยะเวลา</label>
        <input type="text" name="Duration" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">รายละเอียดงาน</label>
        <input type="text" name="Job_description" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">สวัสดิการ</label>
        <input type="text" name="welfare" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">เบอร์โทรสาร</label>
        <input type="text" name="Fax_number" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">แผนที่</label>
        <input type="text" name="Map" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">ปีการศึกษา</label>
        <input type="text" name="Academic_year" class="form-control" required>
    </div>
    <div class="mb-3 input-group">
      <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
        <select name="Major_id" class="form-select" required>
          <option value="">-- กรุณาเลือกสาขา --</option>
            <?php
            include 'connectdb.php'; 
            $result = mysqli_query($conn, "SELECT Major_id, Major_name FROM major");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Major_id']}'>{$row['Major_name']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- เพิ่มปุ่มบันทึกข้อมูล -->
    <div class="text-center">
        <button type="submit" class="btn btn-success mt-4">บันทึกข้อมูล</button>
    </div>
</form>

<script>
        // ฟังก์ชันสลับโหมด
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
<script src="scriptBEadd.js"></script>

</body>
</html>