<?php
include 'connectdb.php';
include 'check_admin.php';

$Std_id = $Id_number = $Std_name = $Std_surname = $Major_id = $Grade_level = $GPA = $GPAX = $CGX = $Std_phone = $Std_email = $Std_picture = '';
$Std_prefix = $Academic_year = $address = $province = $postcode = $Std_pwd = '';

$major_query = "SELECT Major_id, Major_name FROM major";
$major_result = mysqli_query($conn, $major_query);

$teacher_query = "SELECT Tec_id, Tec_name FROM teacher";
$teacher_result = mysqli_query($conn, $teacher_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $Std_id = $_POST['Std_id'];
    $Id_number = $_POST['Id_number'];
    $Std_prefix = $_POST['Std_prefix'];
    $Std_name = $_POST['Std_name'];
    $Std_surname = $_POST['Std_surname'];
    $Academic_year = $_POST['Academic_year'];
    $Grade_level = $_POST['Grade_level'];
    $GPA = $_POST['GPA'];
    $GPAX = $_POST['GPAX'];
    $CGX = $_POST['CGX'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $postcode = $_POST['postcode'];
    $Std_phone = $_POST['Std_phone'];
    $Std_email = $_POST['Std_email'];
    $Std_pwd = $_POST['Std_pwd'];

    if (!empty($Std_pwd)) {
        // ใช้ password_hash เพื่อเข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($Std_pwd, PASSWORD_DEFAULT); 
    } else {
        die("กรุณากรอกรหัสผ่าน");
    }
    
 // ตรวจสอบ Std_id ซ้ำ
 $check_std_id_sql = "SELECT Std_id FROM student WHERE Std_id = '$Std_id'";
 $check_result = mysqli_query($conn, $check_std_id_sql);

 if (mysqli_num_rows($check_result) > 0) {
     echo "<script>alert('รหัสนิสิตนี้มีอยู่ในระบบแล้ว'); window.history.back();</script>";
     exit(); // หยุดการทำงานหลังแจ้งเตือน
 }
    // อัปโหลดรูป
    if ($_FILES['Std_picture']['name']) {
        $target_dir = "../profile_pic/";
        $imageFileType = strtolower(pathinfo($_FILES["Std_picture"]["name"], PATHINFO_EXTENSION));
        $Std_picture = "profile_" . $Std_id . "." . $imageFileType;
        $target_file = $target_dir . $Std_picture;

        $check = getimagesize($_FILES["Std_picture"]["tmp_name"]);
        if ($check === false) {
            die("ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ.");
        }
        if ($_FILES["Std_picture"]["size"] > 500000) {
            die("ขนาดไฟล์ใหญ่เกินไป.");
        }
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            die("ไฟล์ที่อัปโหลดต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น.");
        }

        if (!move_uploaded_file($_FILES["Std_picture"]["tmp_name"], $target_file)) {
            die("เกิดข้อผิดพลาดในการอัปโหลดไฟล์.");
        }
    }


    // ดึงข้อมูล Major และ Advisor
    $Major_id = mysqli_real_escape_string($conn, $_POST['Major_id']);

    $sql_major = "SELECT 
        t.Tec_id AS Tec_id1, 
        t2.Tec_id AS Tec_id2 
    FROM teacher t 
    LEFT JOIN teacher t2 ON t.Major_id = t2.Major_id AND t2.Tec_id != t.Tec_id 
    WHERE t.Major_id = '$Major_id' 
    LIMIT 1";

    $result_major = mysqli_query($conn, $sql_major);
    $major_data = mysqli_fetch_assoc($result_major);

    if ($major_data) {
        $tec_id1 = $major_data['Tec_id1'];
        $tec_id2 = !empty($major_data['Tec_id2']) ? $major_data['Tec_id2'] : 'NULL';

       


        // Insert เข้า student
        $query = "INSERT INTO student 
        (Std_id, Id_number, Std_prefix, Std_name, Std_surname, Major_id, Academic_year, Grade_level, GPA, GPAX, CGX, Std_add, province, Zip_id, Std_phone, Std_email, Std_pwd, Std_picture) 
        VALUES 
        ('$Std_id', '$Id_number', '$Std_prefix', '$Std_name', '$Std_surname', '$Major_id', '$Academic_year', '$Grade_level', '$GPA', '$GPAX', '$CGX', '$address', '$province', '$postcode', '$Std_phone', '$Std_email', '$hashed_password', '$Std_picture')";

        if (mysqli_query($conn, $query)) {
            // Insert เข้า proposal
            $proposal_sql = "INSERT INTO proposal (
                Std_id, Sug_year, Pro_status, Com_status, Proposal_name, File_name, Company_id, Note
            ) VALUES (
                '$Std_id', '$Academic_year',4, 4, '', '', NULL, ''
            )";
            mysqli_query($conn, $proposal_sql);

            // Insert เข้า advisor
            $advisor_sql = "INSERT INTO advisor (Tec_id1, Tec_id2, Std_id)
                            VALUES ('$tec_id1', " . ($tec_id2 === 'NULL' ? "NULL" : "'$tec_id2'") . ", '$Std_id')";
            mysqli_query($conn, $advisor_sql);

            echo "<script>alert('เพิ่มข้อมูลนิสิตสำเร็จ'); window.location.href = 'indexstudent.php';</script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "ไม่พบข้อมูลสาขาวิชา";
    }
}
?>



<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>


    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">เพิ่มข้อมูลนิสิต</h2>


        <form method="POST" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="Std_id" name="Std_id" maxlength="11" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="Id_number" class="form-label">รหัสบัตรประชาชน</label>
                    <input type="text" class="form-control" id="Id_number" name="Id_number" maxlength="13" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="Std_prefix" class="form-label">คำนำหน้า</label>
                    <input type="text" class="form-control" id="Std_prefix" name="Std_prefix" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="Std_name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="Std_name" name="Std_name" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="Std_surname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="Std_surname" name="Std_surname" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Major_id" class="form-label">สาขา</label>
                        <select class="form-control" id="Major_id" name="Major_id" required>
                            <?php
                            $sql1 = "SELECT Major_id, Major_name FROM major;";
                            $rs1 = mysqli_query($conn, $sql1);

                            if (!$rs1) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            while ($row = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
                                echo "<option value='{$row['Major_id']}'>{$row['Major_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Academic_year" class="form-label">ปีการศึกษา</label>
                        <input type="number" class="form-control" id="Academic_year" name="Academic_year">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-3">
                    <label for="Grade_level" class="form-label">ชั้นปี</label>
                    <input type="number" class="form-control" id="Grade_level" name="Grade_level" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="GPA" class="form-label">GPA</label>
                    <input type="number" class="form-control" id="GPA" name="GPA" min="0" max="4" step="0.01" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="GPAX" class="form-label">GPAX</label>
                    <input type="number" class="form-control" id="GPAX" name="GPAX" min="0" max="4" step="0.01" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="CGX" class="form-label">CGX</label>
                    <input type="number" class="form-control" id="CGX" name="CGX" min="0" step="1" required>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-6">
                    <label for="floatingCGX" class="form-label">ที่อยู่</label>
                    <input type="text" class="form-control" id="floatingCGX" name="address" required>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="province" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" list="provinceList" id="province" name="province" onblur="validateInput()" required>
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
                    <input type="text" class="form-control" id="floatingPostcode" name="postcode">
                </div>

            </div>

            <div class="form-group">
                <label for="Std_phone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="Std_phone" name="Std_phone" maxlength="10" required>
            </div>

            <div class="form-group">
                <label for="Std_email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" id="Std_email" name="Std_email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="Std_pwd" id="password">
            </div>



            <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary">เพิ่มข้อมูล</button>

        </form>
    </div>
    <script src="scriptBEadd.js"></script>
</body>

</html>