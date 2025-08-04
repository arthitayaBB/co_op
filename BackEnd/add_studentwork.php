<?php

include 'connectdb.php';
include 'check_admin.php';

if (isset($_POST['Submit'])) {
    $Std_id = mysqli_real_escape_string($conn, $_POST['Std_id']);
    $Work_name = mysqli_real_escape_string($conn, $_POST['Work_name']);
    $Work_year = mysqli_real_escape_string($conn, $_POST['Work_year']);
    $Work_detail = mysqli_real_escape_string($conn, $_POST['Work_detail']);

    $companyQuery = "SELECT Company_id FROM proposal WHERE Std_id = '$Std_id'";
    $companyResult = mysqli_query($conn, $companyQuery);
    $Company_id = null;

    if ($companyRow = mysqli_fetch_assoc($companyResult)) {
        $Company_id = $companyRow['Company_id'];
    }

    if ($Company_id === null) {
        die("ไม่พบรหัสบริษัทที่เกี่ยวข้องกับนิสิตรหัสนี้");
    }

    $picDir = '../images/pic_stdwork/';
    $fileDir = '../uploads/std_workfile/';
    if (!is_dir($picDir)) mkdir($picDir, 0777, true);
    if (!is_dir($fileDir)) mkdir($fileDir, 0777, true);

    $pictureName = "";
    if (isset($_FILES['Workpicture']) && $_FILES['Workpicture']['error'] === UPLOAD_ERR_OK) {
        $pictureName = $_FILES['Workpicture']['name'];
        $pictureTmp = $_FILES['Workpicture']['tmp_name'];
        move_uploaded_file($pictureTmp, $picDir . $pictureName);
    }

    $fileName = "";
    if (isset($_FILES['Workfile']) && $_FILES['Workfile']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['Workfile']['name'];
        $fileTmp = $_FILES['Workfile']['tmp_name'];
        move_uploaded_file($fileTmp, $fileDir . $fileName);
    }

    $sql = "INSERT INTO student_work (
                Work_name, Std_id, Work_detail, Work_picture, Date, Work_year, Company_id, Work_File
            ) VALUES (
                '$Work_name', '$Std_id', '$Work_detail', '$pictureName', CURDATE(), '$Work_year', '$Company_id', '$fileName'
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location='indexstudentwork.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลผลงานนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>
    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        <h2 class="heading">เพิ่มข้อมูลผลงานนิสิต</h2> <!-- แก้ไขตรงนี้: เปลี่ยนจาก "แก้ไขข้อมูลอาจารย์" เป็น "แก้ไขข้อมูลผลงานนิสิต" -->
        <div class="d-flex justify-content-between mb-3">
        </div>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <!-- แสดงภาพหน้าปก -->
                <div class="mb-3 text-center">
                    <label class="form-label">รูปภาพ</label><br>
                    <img id="preview"
                        src="<?= !empty($existingWork['Work_picture']) ? '../images/pic_stdwork/' . htmlspecialchars($existingWork['Work_picture']) : 'about:blank' ?>"
                        width="150"
                        class="img-thumbnail <?= empty($existingWork['Work_picture']) ? 'd-none' : '' ?>"><br>

                    <label class="form-label">เพิ่มรูปภาพ</label><br>
                    <input type="file" class="form-control" name="Workpicture" id="pictureInput" accept="image/*">
                </div>

                <!-- JavaScript สำหรับ preview -->
                <script>
                    document.getElementById('pictureInput').addEventListener('change', function(event) {
                        const [file] = event.target.files;
                        if (file) {
                            const preview = document.getElementById('preview');
                            preview.src = URL.createObjectURL(file);
                            preview.classList.remove('d-none'); // แสดงรูปในกรณีที่ซ่อนอยู่
                        }
                    });
                </script>
                <?php
                $sql = "SELECT Std_id, Std_prefix, Std_name, Std_surname FROM student ORDER BY Std_id ASC";
                $result = mysqli_query($conn, $sql);
                ?>
                <div class="col-md- mb-3">
                    <label class="form-label">
                        <i class="bi bi-briefcase-fill me-2" style="color: skyblue;"></i>พิมพ์หรือเลือกรหัสนิสิต
                    </label>
                    <input type="text" class="form-control" list="studentList" id="Std_id_input" name="Std_id" onblur="validateStudent()" required>
                    <datalist id="studentList">
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?= $row['Std_id'] ?>">
                                <?= $row['Std_id'] . ' - ' . $row['Std_prefix'] . $row['Std_name'] . ' ' . $row['Std_surname'] ?>
                            </option>
                        <?php endwhile; ?>
                    </datalist>
                </div>

                <script>
                    function validateStudent() {
                        var input = document.getElementById("Std_id_input").value;
                        var datalistOptions = document.getElementById("studentList").options;
                        var isValid = false;

                        for (var i = 0; i < datalistOptions.length; i++) {
                            if (input === datalistOptions[i].value) {
                                isValid = true;
                                break;
                            }
                        }

                        if (!isValid) {
                            alert("กรุณาเลือกรหัสนิสิตจากรายการ");
                            document.getElementById("Std_id_input").value = "";
                        }
                    }
                </script>





                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-briefcase-fill me-2" style="color: skyblue;"></i>ชื่อโปรเจค
                    </label>
                    <input type="text" name="Work_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-calendar-event-fill me-2" style="color: skyblue;"></i>ปีการศึกษา
                    </label>
                    <input type="number" name="Work_year" class="form-control" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">
                        <i class="bi bi-card-text me-2" style="color: skyblue;"></i>รายละเอียด
                    </label>
                    <textarea name="Work_detail" class="form-control" rows="3" required></textarea>
                </div>



                <!-- ช่องอัปโหลดไฟล์ใหม่ -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        <i class="bi bi-upload me-2" style="color: skyblue;"></i>เปลี่ยนไฟล์ PDF 
                    </label>
                    <input type="file" name="Workfile" class="form-control" accept="application/pdf">
                </div>


                <div class="col-12 text-center">
                    <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
        </form>

    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "-- เลือกรหัสนิสิต --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>


</body>

</html>