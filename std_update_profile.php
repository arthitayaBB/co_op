<?php
include_once("connectdb.php");
include ("checklogin.php");

$Std_id = $_SESSION['Std_id'] ?? 0;

if ($Std_id <= 0) {
    die("ยังไม่ได้เข้าสู่ระบบ");
}

$sql = "SELECT s.*, m.Major_name 
        FROM student s
        LEFT JOIN major m ON s.Major_id = m.Major_id
        WHERE s.Std_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Std_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
} else {
    die("ไม่พบข้อมูลนักศึกษา");
}


?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f8f9fa;
        }

        .profile-box {
            max-width: 960px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .close-icon:hover {
            color: #ff4d4d;
        }

        .btn-primary {
            width: 100%;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.5);
        }

        #displayProfileImage {
            cursor: pointer;
            transition: 0.3s ease;
            border-radius: 10px;
            border: 2px solid #ccc;
        }

        #displayProfileImage:hover {
            opacity: 0.8;
            border-color: #007bff;
        }

        #profileImage {
            display: none;
            /* ซ่อน input ไว้ */
        }
    </style>
</head>

<body>
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <a href="std_profile.php"><i class="bi bi-x-circle-fill close-icon"></i></a>
    </div>

    <div class="container my-5 profile-box">
        <h3 class="mb-4 text-center">แก้ไขข้อมูลส่วนตัว</h3>
        <form method="POST" action="" enctype="multipart/form-data">

            <div class="mb-3">
                <div>
                    <div class="row g-3">
                        <?php
                        $currentPicture = $student['Std_picture'] ?? 'default-avatar.png';
                        ?>

                        <div class="text-center mb-4">
                            <img id="displayProfileImage"
                                src="profile_pic/<?= htmlspecialchars($currentPicture) ?>"
                                class="rounded mb-2"
                                width="150"
                                alt="คลิกเพื่อเปลี่ยนรูปโปรไฟล์"
                                title="คลิกเพื่อเปลี่ยนรูปโปรไฟล์">

                            <input type="file" id="profileImage" name="Std_picture" accept="image/*">
                            <p class="mt-2 text-muted">คลิกที่รูปเพื่อเปลี่ยนรูปโปรไฟล์</p>
                        </div>

                        <script>
                            const profileImage = document.getElementById("profileImage");
                            const displayImage = document.getElementById("displayProfileImage");

                            displayImage.addEventListener("click", function() {
                                profileImage.click(); // เมื่อคลิกที่รูป ให้เปิด file picker
                            });

                            profileImage.addEventListener("change", function() {
                                const file = this.files[0];
                                if (file) {
                                    displayImage.src = URL.createObjectURL(file); // แสดง preview
                                }
                            });
                        </script>

                        <div class="col-md-6">

                            <div class="form-floating mb-3">
                                <input type="text"
                                    class="form-control"
                                    id="floatingInputid"
                                    placeholder="รหัสประจำตัวประชาชน"
                                    name="idCard"
                                    maxlength="13"
                                    value="<?= htmlspecialchars($student['Id_number']) ?>"
                                    required>
                                <label for="floatingInputid">รหัสประจำตัวประชาชน</label>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputstdid" placeholder="รหัสนิสิต" name="studentId" maxlength="11" value="<?= htmlspecialchars($student['Std_id']) ?>" required readonly>
                                <label for="floatingInputstdid">รหัสนิสิต</label>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: คำนำหน้า, ชื่อ, นามสกุล -->
                    <div class="row g-3">
                        <!-- คำนำหน้า -->
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelectprefix" name="prefix" required>
                                    <option value="นาย" <?= $student['Std_prefix'] == 'นาย' ? 'selected' : '' ?>>นาย</option>
                                    <option value="นาง" <?= $student['Std_prefix'] == 'นาง' ? 'selected' : '' ?>>นาง</option>
                                    <option value="นางสาว" <?= $student['Std_prefix'] == 'นางสาว' ? 'selected' : '' ?>>นางสาว</option>
                                </select>
                                <label for="floatingSelectprefix">คำนำหน้า</label>
                            </div>
                        </div>

                        <!-- ชื่อ -->
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputname" placeholder="ชื่อ" name="name" value="<?= htmlspecialchars($student['Std_name']) ?>" required>
                                <label for="floatingInput3">ชื่อ</label>
                            </div>
                        </div>

                        <!-- นามสกุล -->
                        <div class="col-md-5 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputsurname" placeholder="นามสกุล" name="surname" value="<?= htmlspecialchars($student['Std_surname']) ?>" required>
                                <label for="floatingInput4">นามสกุล</label>
                            </div>
                        </div>
                    </div>
                    <!-- Row 3: สาขา, ชั้นปี, GPA, CGX, GPAX -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <?php
                                // ดึงข้อมูลสาขาจากฐานข้อมูล
                                $sql1 = "SELECT Major_id, Major_name FROM major";
                                $rs1 = mysqli_query($conn, $sql1);

                                if (!$rs1) {
                                    die("Query failed: " . mysqli_error($conn));
                                }

                                // ดึง Major_id ของนักศึกษา
                                $student_major_id = $student['Major_id'];

                                ?>
                                <select class="form-select" id="floatingBranch" name="branch" required>
                                    <?php
                                    while ($major = mysqli_fetch_assoc($rs1)) {
                                        $selected = ($major['Major_id'] == $student_major_id) ? 'selected' : '';
                                        echo "<option value='{$major['Major_id']}' $selected>{$major['Major_name']}</option>";
                                    }
                                    ?>
                                </select>
                                <label for="floatingBranch">สาขา</label>
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingYear" name="year">
                                    <?php
                                    $current_year = $student['Grade_level'];

                                    // วนลูปเพื่อแสดงชั้นปีใน dropdown
                                    for ($i = 1; $i <= 4; $i++) {
                                        // เช็คว่า ปีที่เลือกตรงกับปีในฐานข้อมูลหรือไม่
                                        $selected = ($current_year == $i) ? 'selected' : '';
                                        echo "<option value='$i' $selected>$i</option>";
                                    }
                                    ?>
                                </select>
                                <label for="floatingYear">ชั้นปี</label>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingGPA" placeholder="GPA" name="GPA" step="0.01" max="4" value="<?= htmlspecialchars($student['GPA']) ?>" required>
                                <label for="floatingGPA">GPA</label>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingCGX" placeholder="CGX" name="CGX" value="<?= htmlspecialchars($student['CGX']) ?>" required>
                                <label for="floatingCGX">CGX</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control" id="floatingGPAX" placeholder="GPAX" name="GPAX" step="0.01" max="4" value="<?= htmlspecialchars($student['GPAX']) ?>" required>
                                <label for="floatingGPAX">GPAX</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">

                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingAcaYear" placeholder="ปีการศึกษา" name="Acayear" step="1" min="2565" value="<?= htmlspecialchars($student['Academic_year']) ?>" required>
                            <label for="floatingAcaYea">ปีการศึกษา</label>
                        </div>
                    </div>

                    <!-- เบอร์โทรศัพท์และที่อยู่ -->
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingCGX" placeholder="เบอร์โทร" name="phone" required maxlength="10" value="<?= htmlspecialchars($student['Std_phone']) ?>">
                            <label for="floatingCGX">เบอร์โทร</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingCGX" placeholder="ที่อยู่" name="address" value="<?= htmlspecialchars($student['Std_add']) ?>" required>
                            <label for="floatingCGX">ที่อยู่</label>
                        </div>
                    </div>

                    <!-- จังหวัดและรหัสไปรษณีย์ -->
                    <div class="row g-3">
                        <!-- จังหวัด -->
                        <div class="col-md-6">

                            <div class="form-floating">
                                <input type="text" class="form-control" list="provinceList" id="province" placeholder="พิมพ์ชื่อจังหวัด" name="province" value="<?= htmlspecialchars($student['Province']) ?>" onblur="validateInput()" required>
                                <label for="floatingGPA">จังหวัด</label>
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
                        </div>
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

                        <!-- รหัสไปรษณีย์-->
                        <div class="col-md-6 mb-3">

                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPostcode" placeholder="รหัสไปรษณีย์" name="postcode" value="<?= htmlspecialchars($student['Zip_id']) ?>">
                                <label for="floatingPostcode">รหัสไปรษณีย์</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2"> <!-- ลด g-3 เป็น g-2 เพื่อลดช่องว่าง -->
                        <div class="col-md-12">
                            <div class="form-floating mb-2"> <!-- ลด mb-3 เป็น mb-2 -->
                                <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" value="<?= htmlspecialchars($student['Std_email']) ?>">
                                <label for="floatingEmail">Email</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-text text-muted text-end mb-3" style="margin-top: -10px; font-size: 0.85rem;">
                                หากไม่ต้องการเปลี่ยนรหัสผ่าน ให้ปล่อยว่างไว้
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" name="submit_form" class="btn btn-primary">Update Profile</button>

        </form>
    </div>

    <?php
    if (isset($_POST['submit_form'])) {
        // เข้ารหัสรหัสผ่าน (เฉพาะถ้ามีการเปลี่ยนรหัสผ่าน)
        $stdpassword = '';
        if (!empty($_POST['password'])) {
            $stdpassword = md5($_POST['password']);
        }

        // ตรวจสอบและอัปโหลดไฟล์รูปภาพ
        $std_picture = '';
        if (isset($_FILES['Std_picture']) && $_FILES['Std_picture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['Std_picture']['tmp_name'];
            $fileName = $_FILES['Std_picture']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedFileExtensions)) {
                $newFileName = "profile_" . $_POST['studentId'] . "." . $fileExtension;
                $uploadFileDir = 'profile_pic/';
                $dest_path = $uploadFileDir . $newFileName;

                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $std_picture = $newFileName;
                }
            }
        }

        // ดึง Major_id และ Tec_id จากชื่อสาขา
        $major_id = intval($_POST['branch']);
        $sql_major = "SELECT m.Major_id, t.Tec_id 
                  FROM major m 
                  JOIN teacher t ON m.Major_id = t.Major_id 
                  WHERE m.Major_id = '$major_id'";


        $result_major = mysqli_query($conn, $sql_major);
        $major_data = mysqli_fetch_assoc($result_major);

        if ($major_data) {
            $major_id = $major_data['Major_id'];

            // เตรียมข้อมูล
            $student_id = $_POST['studentId'];

            // อัปเดตข้อมูลใน student
            $update_sql = "UPDATE student SET
        Id_number = '{$_POST['idCard']}',
        Std_prefix = '{$_POST['prefix']}',
        Std_name = '{$_POST['name']}',
        Std_surname = '{$_POST['surname']}',
        Major_id = '$major_id',
        Grade_level = '{$_POST['year']}',
        GPA = '{$_POST['GPA']}',
        GPAX = '{$_POST['GPAX']}',
        CGX = '{$_POST['CGX']}',
        Std_phone = '{$_POST['phone']}',
        Std_email = '{$_POST['email']}',
        Academic_year = '{$_POST['Acayear']}',
        Std_add = '{$_POST['address']}',
        Province = '{$_POST['province']}',
        Zip_id = '{$_POST['postcode']}'";

            // เพิ่มรูปถ้ามีการอัปโหลด
            if (!empty($std_picture)) {
                $update_sql .= ", Std_picture = '$std_picture'";
            }

            // เพิ่มรหัสผ่านถ้ามีการเปลี่ยน
            if (!empty($stdpassword)) {
                $update_sql .= ", Std_pwd = '$stdpassword'";
            }

            // ปิดท้าย WHERE
            $update_sql .= " WHERE Std_id = '$student_id'";

            if (mysqli_query($conn, $update_sql)) {
                echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='std_profile.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดต: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('ไม่พบข้อมูลสาขาที่เลือก');</script>";
        }
    }
    ?>

</body>

</html>