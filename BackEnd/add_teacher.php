<?php
include 'connectdb.php';
include 'check_admin.php';


// ดึงข้อมูลสาขาวิชา
$majorQuery = "SELECT Major_id, Major_name FROM major";
$majorResult = mysqli_query($conn, $majorQuery);
if (!$majorResult) {
    die("Query failed: " . mysqli_error($conn));
}

if (isset($_POST['Submit'])) {
    // รับค่าจากฟอร์ม
    $Tecname = mysqli_real_escape_string($conn, $_POST['Tecname']);
    $Tecsurname = mysqli_real_escape_string($conn, $_POST['Tecsurname']);
    $Tecphone = mysqli_real_escape_string($conn, $_POST['Tecphone']);
    $Tecemail = mysqli_real_escape_string($conn, $_POST['Tecemail']);
    $Tecpwd = isset($_POST['Tecpwd']) ? trim($_POST['Tecpwd']) : '';
    $Majorid = mysqli_real_escape_string($conn, $_POST['Majorid']);

    if (!empty($Tecpwd)) {
        // เข้ารหัสรหัสผ่านด้วย password_hash แทน md5
        $hashedPwd = password_hash($Tecpwd, PASSWORD_DEFAULT);
    } else {
        die("กรุณากรอกรหัสผ่าน");
    }

    // ตรวจสอบว่า Major_id มีอยู่ในระบบ
    $check_major = mysqli_query($conn, "SELECT * FROM major WHERE Major_id = '$Majorid'");
    if (mysqli_num_rows($check_major) == 0) {
        die("Error: Major_id นี้ไม่มีอยู่ในระบบ กรุณาเพิ่ม Major ก่อน");
    }

    // ตรวจสอบข้อมูลให้ครบ
    if (empty($Tecname) || empty($Tecsurname) || empty($Majorid) || empty($Tecphone) || empty($Tecemail) || empty($Tecpwd)) {
        die("กรุณากรอกข้อมูลให้ครบถ้วน");
    }

    // **INSERT ข้อมูลก่อน เพื่อให้ได้ Tec_id**
    $sql = "INSERT INTO teacher (Tec_name, Tec_surname, Major_id, Tec_phone, Tec_email, Tec_pwd) 
            VALUES ('$Tecname', '$Tecsurname', '$Majorid', '$Tecphone', '$Tecemail', '$hashedPwd')";

    if (mysqli_query($conn, $sql)) {
        $Tecid = mysqli_insert_id($conn); // ดึงค่า ID ที่เพิ่งถูกสร้าง
        $Tecpicture = NULL; // กำหนดค่าเริ่มต้นให้ NULL

        // **ตรวจสอบการอัปโหลดไฟล์**
        if (isset($_FILES['Tecpicture']) && $_FILES['Tecpicture']['error'] == 0) {
            $uploadDir = "img_teacher/";
            $fileExtension = strtolower(pathinfo($_FILES['Tecpicture']['name'], PATHINFO_EXTENSION));

            // **ตรวจสอบว่านามสกุลไฟล์ถูกต้อง**
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($fileExtension, $allowedExtensions)) {
                die("ประเภทไฟล์ไม่ถูกต้อง! รองรับเฉพาะ JPG, JPEG, PNG และ GIF");
            }

            // **ตั้งชื่อไฟล์เป็น `ชื่อ_ไอดี.นามสกุล`**
            $Tecname_safe = str_replace(" ", "_", $Tecname);
            $newFileName = $Tecname_safe . "_" . $Tecid . "." . $fileExtension;
            $uploadFile = $uploadDir . $newFileName;

            // **อัปโหลดไฟล์**
            if (move_uploaded_file($_FILES['Tecpicture']['tmp_name'], $uploadFile)) {
                $Tecpicture = $newFileName; // กำหนดค่าไฟล์ใหม่ให้ตัวแปร
            } else {
                die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์ กรุณาลองใหม่.");
            }
        }

        // **อัปเดตชื่อไฟล์รูปภาพในฐานข้อมูล**
        if ($Tecpicture !== NULL) {
            $updateSql = "UPDATE teacher SET Tec_picture = '$Tecpicture' WHERE Tec_id = '$Tecid'";
            mysqli_query($conn, $updateSql);
        }

        // **Redirect ไปหน้าหลัก**
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location='indexteacher.php';</script>";
        exit();
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลอาจารย์</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>

    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">เพิ่มข้อมูลอาจารย์</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Tecname" class="form-label">ชื่อ</label>
                        <input type="text" name="Tecname" id="Tecname" class="form-control" required autofocus>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Tecsurname" class="form-label">นามสกุล</label>
                        <input type="text" name="Tecsurname" id="Tecsurname" class="form-control" required autofocus>
                    </div>
                </div>
            </div>


            <div class="form-group">
    <label for="Tecpicture" class="form-label">รูปภาพ</label>
    <input type="file" name="Tecpicture" id="Tecpicture" class="form-control" accept="image/*">
</div>


            <div class="form-group">
                <label class="form-label">รหัสสาขา</label>
                <select class="form-control" name="Majorid" required>
                    <?php if (mysqli_num_rows($majorResult) > 0) : ?>
                        <?php while ($major = mysqli_fetch_assoc($majorResult)) : ?>
                            <option value="<?= htmlspecialchars($major['Major_id']) ?>">
                                <?= htmlspecialchars($major['Major_name']) ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <option value="">ไม่มีข้อมูลสาขา</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Tecphone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" name="Tecphone" id="Tecphone" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="Tecemail" class="form-label">Email</label>
                <input type="email" name="Tecemail" id="Tecemail" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="Tecpwd" class="form-label">Password</label>
                <input type="password" name="Tecpwd" id="Tecpwd" class="form-control" required autofocus>
            </div>


            <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>

            </div>

        </form>
    </div>

</body>

</html>