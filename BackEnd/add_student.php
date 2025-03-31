<?php
include 'connectdb.php';
include 'check_admin.php';
$Std_id = $Id_number = $Std_name = $Std_surname = $Major_id = $Grade_level =$GPA = $GPAX = $CGX = $Tec_id = $Std_phone = $Std_email = $Std_picture = '';
$major_query = "SELECT Major_id, Major_name FROM major";
$major_result = mysqli_query($conn, $major_query);
$teacher_query = "SELECT Tec_id, Tec_name FROM teacher"; 
$teacher_result = mysqli_query($conn, $teacher_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    if ($_FILES['Std_picture']['name']) {
        $target_dir = "img/"; 
        $target_file = $target_dir . basename($_FILES["Std_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (getimagesize($_FILES["Std_picture"]["tmp_name"]) === false) {
            echo "ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ.";
            $uploadOk = 0;
        }
        if ($_FILES["Std_picture"]["size"] > 500000) {
            echo "ขนาดไฟล์ใหญ่เกินไป.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "ไฟล์ที่อัปโหลดต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "ไม่สามารถอัปโหลดไฟล์ได้.";
        } else {
            if (move_uploaded_file($_FILES["Std_picture"]["tmp_name"], $target_file)) {
                $Std_picture = basename($_FILES["Std_picture"]["name"]);
            } else {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์.";
            }
        }
    }

// SQL คำสั่งสำหรับเพิ่มข้อมูล
$query = "INSERT INTO student (Std_id, Id_number, Std_name, Std_surname, Major_id, Grade_level, GPA, GPAX, CGX, Tec_id, Std_phone, Std_email, Std_picture) 
          VALUES ('$Std_id', '$Id_number', '$Std_name', '$Std_surname', '$Major_id', '$Grade_level', '$GPA', '$GPAX', '$CGX', '$Tec_id', '$Std_phone', '$Std_email', '$Std_picture')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('เพิ่มข้อมูลนิสิตสำเร็จ'); window.location.href = 'indexstudent.php';</script>";
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
        
        <h2 class="heading">เพิ่มข้อมูลนิสิต</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Std_id" class="form-label">รหัสนิสิต</label>
                <input type="text" class="form-control" id="Std_id" name="Std_id" required>
            </div>

            <div class="form-group">
                <label for="Id_number" class="form-label">รหัสบัตรประชาชน</label>
                <input type="text" class="form-control" id="Id_number" name="Id_number" required>
            </div>

            <div class="form-group">
                <label for="Std_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="Std_name" name="Std_name" required>
            </div>

            <div class="form-group">
                <label for="Std_surname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="Std_surname" name="Std_surname" required>
            </div>

            <div class="form-group">
                <label for="Major_id" class="form-label">สาขา</label>
                <select class="form-select" id="Major_id" name="Major_id" required>
                    <?php while ($row = mysqli_fetch_assoc($major_result)) { ?>
                        <option value="<?php echo $row['Major_id']; ?>"><?php echo $row['Major_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Grade_level" class="form-label">ระดับการศึกษา</label>
                <input type="text" class="form-control" id="Grade_level" name="Grade_level" required>
            </div>

            <div class="form-group">
                <label for="GPA" class="form-label">GPA</label>
                <input type="text" class="form-control" id="GPA" name="GPA" required>
            </div>

            <div class="form-group">
                <label for="GPAX" class="form-label">GPAX</label>
                <input type="text" class="form-control" id="GPAX" name="GPAX" required>
            </div>

            <div class="form-group">
                <label for="CGX" class="form-label">CGX</label>
                <input type="text" class="form-control" id="CGX" name="CGX" required>
            </div>

            <div class="form-group">
                <label for="Tec_id" class="form-label">อาจารย์ที่ปรึกษา</label>
                <select class="form-select" id="Tec_id" name="Tec_id" required>
                    <?php while ($row = mysqli_fetch_assoc($teacher_result)) { ?>
                        <option value="<?php echo $row['Tec_id']; ?>"><?php echo $row['Tec_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Std_phone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="Std_phone" name="Std_phone" required>
            </div>

            <div class="form-group">
                <label for="Std_email" class="form-label">อีเมล</label>
                <input type="email" class="form-control" id="Std_email" name="Std_email" required>
            </div>

            <div class="form-group">
                <label for="Std_picture" class="form-label">รูปภาพนิสิต</label><br>
                <div class="upload-btn-wrapper">
                 
                    <input type="file" name="Std_picture" accept="image/*" />
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>
</html>
