<?php
include 'connectdb.php';
include 'check_admin.php';
// ตรวจสอบว่าได้รับค่ารหัสนิสิตหรือไม่
if (!isset($_GET['id'])) {
    die("รหัสนิสิตไม่ถูกต้อง");
}

$std_id = $_GET['id'];

// ดึงข้อมูลนิสิตจากฐานข้อมูล
$query = "SELECT * FROM student WHERE Std_id = '$std_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("ไม่สามารถดึงข้อมูลนิสิตได้: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

// ถ้าไม่พบข้อมูลนิสิตที่รหัสนี้
if (!$row) {
    die("ไม่พบข้อมูลนิสิตที่รหัสนี้");
}

$major_query = "SELECT * FROM major";
$major_result = mysqli_query($conn, $major_query);

$teacher_query = "SELECT * FROM teacher";
$teacher_result = mysqli_query($conn, $teacher_query);

// ตรวจสอบว่าเป็นการส่งฟอร์มมาแก้ไขข้อมูลหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $Std_id = $_POST['Std_id'];
    $Id_number = $_POST['Id_number'];
    $Std_name = $_POST['Std_name'];
    $Std_surname = $_POST['Std_surname'];
    $Major_id = $_POST['Major_id'];
    $Grade_level = $_POST['Grade_level'];
    $GPA = $_POST['GPA'];
    $GPAX = $_POST['GPAX'];
    $CGX = $_POST['CGX'];
    $Tec_id = $_POST['Tec_id'];
    $Std_phone = $_POST['Std_phone'];
    $Std_email = $_POST['Std_email'];
    $Stdpwd = isset($_POST['Stdpwd']) ? trim($_POST['Stdpwd']) : '';
    
    // อัปโหลดรูปภาพ
    $Std_picture = $_FILES['Std_picture']['name'];
    if ($Std_picture) {
        $target_dir = "img_student/";
        $target_file = $target_dir . basename($_FILES["Std_picture"]["name"]);
        move_uploaded_file($_FILES["Std_picture"]["tmp_name"], $target_file);
    } else {
        $Std_picture = $row['Std_picture']; // ใช้รูปเดิมถ้าไม่ได้อัปโหลดใหม่
    }

    if (!empty($Stdpwd)) { 
        $hashedPwd = md5($Stdpwd); // แฮชรหัสผ่านแบบไม่มี salt
        $updateSql .= ", Std_pwd = '$hashedPwd'";   
    }

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $update_query = "UPDATE student SET 
                        Id_number = '$Id_number',
                        Std_name = '$Std_name',
                        Std_surname = '$Std_surname',
                        Major_id = '$Major_id',
                        Grade_level = '$Grade_level',
                        GPA = '$GPA',
                        GPAX = '$GPAX',
                        CGX = '$CGX',
                        Tec_id = '$Tec_id',
                        Std_phone = '$Std_phone',
                        Std_email = '$Std_email',
                        Std_picture = '$Std_picture'";
// ถ้ามีการเปลี่ยนรหัสผ่าน
if (!empty($Stdpwd)) {  
    $hashedPwd = md5($Stdpwd); 
    $update_query .= ", Std_pwd = '$hashedPwd'";
}

$update_query .= " WHERE Std_id = '$Std_id'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: indexstudent.php"); // หลังจากอัปเดตเสร็จ ให้กลับไปยังหน้าแสดงข้อมูลนิสิต
    } else {
        echo "ไม่สามารถอัปเดตข้อมูลได้: " . mysqli_error($conn);
    }
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

        <h2 class="heading">แก้ไขข้อมูลนิสิต</h2>
        <form action="edit_student.php?id=<?php echo $row['Std_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Std_id" class="form-label">รหัสนิสิต</label>
                <input type="text" class="form-control" id="Std_id" name="Std_id" value="<?php echo $row['Std_id']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="Id_number" class="form-label">รหัสบัตรประชาชน</label>
                <input type="text" class="form-control" id="Id_number" name="Id_number" value="<?php echo $row['Id_number']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Std_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="Std_name" name="Std_name" value="<?php echo $row['Std_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Std_surname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="Std_surname" name="Std_surname" value="<?php echo $row['Std_surname']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Major_id" class="form-label">สาขา</label>
                <select class="form-select" id="Major_id" name="Major_id" required>
                    <?php while ($major_row = mysqli_fetch_assoc($major_result)) { ?>
                        <option value="<?php echo $major_row['Major_id']; ?>" <?php echo ($row['Major_id'] == $major_row['Major_id']) ? 'selected' : ''; ?>><?php echo $major_row['Major_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Grade_level" class="form-label">ระดับการศึกษา</label>
                <input type="text" class="form-control" id="Grade_level" name="Grade_level" value="<?php echo $row['Grade_level']; ?>" required>
            </div>

            <div class="form-group">
                <label for="GPA" class="form-label">GPA</label>
                <input type="text" class="form-control" id="GPA" name="GPA" value="<?php echo $row['GPA']; ?>" required>
            </div>

            <div class="form-group">
                <label for="GPAX" class="form-label">GPAX</label>
                <input type="text" class="form-control" id="GPAX" name="GPAX" value="<?php echo $row['GPAX']; ?>" required>
            </div>

            <div class="form-group">
                <label for="CGX" class="form-label">CGX</label>
                <input type="text" class="form-control" id="CGX" name="CGX" value="<?php echo $row['CGX']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Tec_id" class="form-label">อาจารย์ที่ปรึกษา</label>
                <select class="form-select" id="Tec_id" name="Tec_id" required>
                    <?php while ($teacher_row = mysqli_fetch_assoc($teacher_result)) { ?>
                        <option value="<?php echo $teacher_row['Tec_id']; ?>" <?php echo ($row['Tec_id'] == $teacher_row['Tec_id']) ? 'selected' : ''; ?>><?php echo $teacher_row['Tec_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Std_phone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="Std_phone" name="Std_phone" value="<?php echo $row['Std_phone']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Std_email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" id="Std_email" name="Std_email" value="<?php echo $row['Std_email']; ?>" required>
            </div>



            <div class="form-group">
                <label for="Std_picture" class="form-label">รูปประจำตัว</label>
                <input type="file" class="form-control" id="Std_picture" name="Std_picture">
                <?php if ($row['Std_picture']) { ?>
                    <img src="img_student/<?php echo $row['Std_picture']; ?>" alt="รูปประจำตัว" width="100" class="mt-2">
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>
</html>
