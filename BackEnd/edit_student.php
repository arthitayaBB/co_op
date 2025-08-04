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
    $Std_prefix = $_POST['Std_prefix'];  // <<== เพิ่มมารับค่าด้วย
    $Std_name = $_POST['Std_name'];
    $Std_surname = $_POST['Std_surname'];
    $Major_id = $_POST['Major_id'];
    $Grade_level = $_POST['Grade_level'];
    $GPA = $_POST['GPA'];
    $GPAX = $_POST['GPAX'];
    $CGX = $_POST['CGX'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $postcode = $_POST['postcode'];
    $Std_phone = $_POST['Std_phone'];
    $Std_email = $_POST['Std_email'];
    $Academic_year = $_POST['Academic_year'];
    $Stdpwd = isset($_POST['Std_pwd']) ? trim($_POST['Std_pwd']) : '';


    // อัปโหลดรูปภาพ
    if (!empty($_FILES['Std_picture']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES["Std_picture"]["name"], PATHINFO_EXTENSION));
        $Std_picture = "profile_" . $Std_id . "." . $imageFileType;
        $target_dir = "../profile_pic/";
        $target_file = $target_dir . $Std_picture;

        // ตรวจสอบว่าเป็นรูปภาพจริง
        $check = getimagesize($_FILES["Std_picture"]["tmp_name"]);
        if ($check === false) {
            die("ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ.");
        }

        // ตรวจสอบขนาดไฟล์ (ไม่เกิน 500KB)
        if ($_FILES["Std_picture"]["size"] > 500000) {
            die("ขนาดไฟล์ใหญ่เกินไป.");
        }

        // ตรวจสอบนามสกุลที่อนุญาต
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            die("ไฟล์ต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น.");
        }

        // อัปโหลดไฟล์
        if (!move_uploaded_file($_FILES["Std_picture"]["tmp_name"], $target_file)) {
            die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์.");
        }
    } else {
        $Std_picture = $row['Std_picture']; // ใช้รูปเดิมถ้าไม่ได้อัปโหลดใหม่
    }


    // เริ่มสร้าง SQL อัปเดต
    $update_query = "UPDATE student SET 
            Id_number = '$Id_number',
            Std_prefix = '$Std_prefix',
            Std_name = '$Std_name',
            Std_surname = '$Std_surname',
            Major_id = '$Major_id',
            Grade_level = '$Grade_level',
            GPA = '$GPA',
            GPAX = '$GPAX',
            CGX = '$CGX',
            Std_phone = '$Std_phone',
            Std_email = '$Std_email',
            Std_picture = '$Std_picture',
            Std_add = '$address',
            Province = '$province',
            Zip_id = '$postcode',
            Academic_year = '$Academic_year'
            ";


    // ถ้ามีการเปลี่ยนรหัสผ่าน
    if (!empty($Stdpwd)) {
        // ใช้ password_hash() เพื่อแฮชรหัสผ่าน
        $hashedPwd = password_hash($Stdpwd, PASSWORD_DEFAULT);
        $update_query .= ", Std_pwd = '$hashedPwd'";
    }
    
    $update_query .= " WHERE Std_id = '$Std_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>
            alert('อัปเดตข้อมูลนิสิตเรียบร้อยแล้ว');
            window.location.href = 'indexstudent.php';
        </script>";
        exit();
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


    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">แก้ไขข้อมูลนิสิต</h2>


        <form action="edit_student.php?id=<?php echo $row['Std_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <label class="form-label">รูปภาพ</label><br>
                <img id="preview" src="../profile_pic/<?= htmlspecialchars($row['Std_picture']) ?>" width="150" class="mb-2"><br>
                <label class="form-label">กรุณาอัพโหลดรูปภาพใหม่</label><br>
                <input type="file" class="form-control" name="Std_picture" id="pictureInput" accept="image/*">
            </div>

            <script>
                document.getElementById('pictureInput').addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    if (file) {
                        const preview = document.getElementById('preview');
                        preview.src = URL.createObjectURL(file);
                    }
                });
            </script>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="Std_id" class="form-label">รหัสนิสิต</label>
                    <input type="text" class="form-control" id="Std_id" name="Std_id" value="<?php echo $row['Std_id']; ?>" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="Id_number" class="form-label">รหัสบัตรประชาชน</label>
                    <input type="text" class="form-control" id="Id_number" name="Id_number" value="<?php echo $row['Id_number']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="Std_prefix" class="form-label">คำนำหน้า</label>
                    <input type="text" class="form-control" id="Std_prefix" name="Std_prefix" value="<?php echo $row['Std_prefix']; ?>" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="Std_name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="Std_name" name="Std_name" value="<?php echo $row['Std_name']; ?>" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="Std_surname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="Std_surname" name="Std_surname" value="<?php echo $row['Std_surname']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Major_id" class="form-label">สาขา</label>
                        <select class="form-control" id="Major_id" name="Major_id" required>
                            <?php while ($major_row = mysqli_fetch_assoc($major_result)) { ?>
                                <option value="<?php echo $major_row['Major_id']; ?>" <?php echo ($row['Major_id'] == $major_row['Major_id']) ? 'selected' : ''; ?>>
                                    <?php echo $major_row['Major_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Academic_year" class="form-label">ปีการศึกษา</label>
                        <input type="text" class="form-control" id="Academic_year" name="Academic_year" value="<?php echo $row['Academic_year']; ?>">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-3">
                    <label for="Grade_level" class="form-label">ชั้นปี</label>
                    <input type="text" class="form-control" id="Grade_level" name="Grade_level" value="<?php echo $row['Grade_level']; ?>" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="GPA" class="form-label">GPA</label>
                    <input type="text" class="form-control" id="GPA" name="GPA" value="<?php echo $row['GPA']; ?>" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="GPAX" class="form-label">GPAX</label>
                    <input type="text" class="form-control" id="GPAX" name="GPAX" value="<?php echo $row['GPAX']; ?>" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="CGX" class="form-label">CGX</label>
                    <input type="text" class="form-control" id="CGX" name="CGX" value="<?php echo $row['CGX']; ?>" required>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-6">
                    <label for="floatingCGX" class="form-label">ที่อยู่</label>
                    <input type="text" class="form-control" id="floatingCGX" placeholder="ที่อยู่" name="address" value="<?= htmlspecialchars($row['Std_add']) ?>" required>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="province" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" list="provinceList" id="province" placeholder="พิมพ์ชื่อจังหวัด" name="province" value="<?= htmlspecialchars($row['Province']) ?>" onblur="validateInput()" required>
                    </div>
                </div>
                <datalist id="provinceList">
                    <option value="กระบี่">
                    <option value="กรุงเทพมหานคร">
                    <option value="กาญจนบุรี">
                    <option value="กาฬสินธุ์">
                    <option value="กำแพงเพชร">
                    <option value="ขอนแก่น">
                    <option value="จันทบุรี">
                    <option value="ฉะเชิงเทรา">
                    <option value="ชลบุรี">
                    <option value="ชัยนาท">
                    <option value="ชัยภูมิ">
                    <option value="ชุมพร">
                    <option value="เชียงใหม่">
                    <option value="เชียงราย">
                    <option value="ตรัง">
                    <option value="ตราด">
                    <option value="ตาก">
                    <option value="นครนายก">
                    <option value="นครปฐม">
                    <option value="นครพนม">
                    <option value="นครราชสีมา">
                    <option value="นครศรีธรรมราช">
                    <option value="นครสวรรค์">
                    <option value="นนทบุรี">
                    <option value="นราธิวาส">
                    <option value="หนองคาย">
                    <option value="หนองบัวลำภู">
                    <option value="ระนอง">
                    <option value="ระยอง">
                    <option value="ราชบุรี">
                    <option value="ลพบุรี">
                    <option value="ลำปาง">
                    <option value="ลำพูน">
                    <option value="เลย">
                    <option value="ศรีสะเกษ">
                    <option value="สกลนคร">
                    <option value="สงขลา">
                    <option value="สมุทรปราการ">
                    <option value="สมุทรสงคราม">
                    <option value="สมุทรสาคร">
                    <option value="สระแก้ว">
                    <option value="สระบุรี">
                    <option value="สิงห์บุรี">
                    <option value="สุโขทัย">
                    <option value="สุพรรณบุรี">
                    <option value="สุราษฎร์ธานี">
                    <option value="สุรินทร์">
                    <option value="สตูล">
                    <option value="อ่างทอง">
                    <option value="อำนาจเจริญ">
                    <option value="อุดรธานี">
                    <option value="อุตรดิตถ์">
                    <option value="อุบลราชธานี">
                    <option value="ยโสธร">
                    <option value="ระนอง">
                    <option value="ร้อยเอ็ด">
                    <option value="เพชรบูรณ์">
                    <option value="เพชรบุรี">
                    <option value="บุรีรัมย์">
                    <option value="ปทุมธานี">
                    <option value="พิษณุโลก">
                    <option value="พิจิตร">
                    <option value="พัทลุง">
                    <option value="พะเยา">
                    <option value="แพร่">
                    <option value="ภูเก็ต">
                    <option value="มหาสารคาม">
                    <option value="มุกดาหาร">
                    <option value="แม่ฮ่องสอน">
                    <option value="ลำพูน">
                    <option value="ลำปาง">
                    <option value="นครสวรรค์">
                    <option value="ปัตตานี">
                    <option value="ประจวบคีรีขันธ์">
                    <option value="ภูเก็ต">
                    <option value="สุพรรณบุรี">
                    <option value="สุราษฎร์ธานี">
                    <option value="นครพนม">
                    <option value="เพชรบุรี">
                    <option value="ชัยภูมิ">
                    <option value="สตูล">
                </datalist>

                <script>
                    function validateInput() {
                        var input = document.getElementById("province").value;
                        var datalistOptions = document.getElementById("provinceList").options;
                        var isValid = false;

                        // ตรวจสอบว่า input ตรงกับค่าที่มีใน datalist หรือไม่
                        for (var i = 0; i < datalistOptions.length; i++) {
                            if (input === datalistOptions[i].value) {
                                isValid = true;
                                break;
                            }
                        }

                        // ถ้าค่าที่พิมพ์ไม่ตรงกับ datalist ให้เคลียร์ช่องกรอก
                        if (!isValid) {
                            alert("กรุณาเลือกจังหวัดจากรายการ");
                            document.getElementById("province").value = ""; // เคลียร์ช่องกรอก
                        }
                    }
                </script>

                <div class="form-group col-md-3">
                    <label for="floatingPostcode" class="form-label">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control" id="floatingPostcode" placeholder="รหัสไปรษณีย์" name="postcode" value="<?= htmlspecialchars($row['Zip_id']) ?>">
                </div>

            </div>

            <div class="form-group">
                <label for="Std_phone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="Std_phone" name="Std_phone" value="<?php echo $row['Std_phone']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Std_email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" id="Std_email" name="Std_email" value="<?php echo $row['Std_email']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="Std_pwd" id="password">
            </div>



            <div class="text-center">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>

        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>

</html>