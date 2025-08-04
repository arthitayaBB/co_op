<?php
include 'check_admin.php';
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $Proposal_name = mysqli_real_escape_string($conn, $_POST['Proposal_name']);
    $Sug_year = (int)$_POST['Sug_year'];
    $Std_id = mysqli_real_escape_string($conn, $_POST['Std_id']);
    $Company_id = (int)$_POST['Company_id'];
    $Pro_status = mysqli_real_escape_string($conn, $_POST['Pro_status']);
    $Com_status = mysqli_real_escape_string($conn, $_POST['Com_status']);
    $Note = mysqli_real_escape_string($conn, $_POST['Note']);

    // ตรวจสอบว่ามีการอัพโหลดไฟล์หรือไม่
    if (isset($_FILES['File_name']) && $_FILES['File_name']['error'] == 0) {
        // จัดการไฟล์
        $file_tmp = $_FILES['File_name']['tmp_name'];
        $original_name = $_FILES['File_name']['name'];
        $upload_dir = "../uploads/project/";

        // ตรวจสอบ MIME type ว่าเป็น PDF หรือไม่
        if ($_FILES['File_name']['type'] !== 'application/pdf') {
            echo "<script>alert('อนุญาตให้เฉพาะไฟล์ PDF เท่านั้น');</script>";
            exit;
        }

        // ตรวจสอบโฟลเดอร์
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // เปลี่ยนชื่อไฟล์
        $new_file_name = "project_" . $Std_id . "_" . time() . ".pdf";
        $target_file = $upload_dir . $new_file_name;

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่ต้องการ
        if (move_uploaded_file($file_tmp, $target_file)) {
            // เพิ่มข้อมูลลงฐานข้อมูล
            $query = "INSERT INTO proposal (Proposal_name, File_name, Sug_year, Std_id, Company_id, Pro_status, Note, Com_status) 
                      VALUES ('$Proposal_name', '$new_file_name', $Sug_year, '$Std_id', $Company_id, '$Pro_status', '$Note', '$Com_status')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('เพิ่มข้อมูล Proposal สำเร็จ'); window.location.href = 'indexproposal.php';</script>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('อัปโหลดไฟล์ไม่สำเร็จ');</script>";
        }
    } else {
        // แสดงข้อผิดพลาดที่เฉพาะเจาะจงมากขึ้น
        if (!isset($_FILES['File_name'])) {
            echo "<script>alert('ไม่พบข้อมูลไฟล์ที่อัพโหลด');</script>";
        } else {
            $error_code = $_FILES['File_name']['error'];
            switch ($error_code) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "<script>alert('ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนดในไฟล์ php.ini');</script>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "<script>alert('ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนดในฟอร์ม HTML');</script>";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "<script>alert('ไฟล์ถูกอัพโหลดเพียงบางส่วน');</script>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "<script>alert('กรุณาเลือกไฟล์ PDF ที่ต้องการอัพโหลด');</script>";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "<script>alert('ไม่พบโฟลเดอร์ชั่วคราวสำหรับเก็บไฟล์');</script>";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "<script>alert('ไม่สามารถเขียนไฟล์ลงดิสก์ได้');</script>";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "<script>alert('การอัพโหลดไฟล์ถูกหยุดโดย PHP Extension');</script>";
                    break;
                default:
                    echo "<script>alert('เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุในการอัพโหลดไฟล์');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูล Proposal</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>
    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">เพิ่มข้อมูล Proposal</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <?php
                $sql = "SELECT * FROM student ORDER BY Std_id ASC";
                $result = mysqli_query($conn, $sql);
                ?>
                <!-- คอลัมน์สำหรับรหัสนิสิต -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-briefcase-fill me-2" style="color: skyblue;"></i>พิมพ์หรือเลือกรหัสนิสิต
                    </label>
                    <input type="text" class="form-control" list="studentList" id="Std_id_input" name="Std_id" onblur="validateStudent()" required>
                    <datalist id="studentList">
                        <?php while ($row = mysqli_fetch_assoc($result)) :
                            $fullName = $row['Std_prefix'] . $row['Std_name'] . ' ' . $row['Std_surname'];
                        ?>
                            <option value="<?= $row['Std_id'] ?>" data-name="<?= $fullName ?>">
                                <?= $row['Std_id'] . ' - ' . $fullName ?>
                            </option>
                        <?php endwhile; ?>
                    </datalist>
                </div>

                <!-- คอลัมน์สำหรับชื่อ -->
                <div class="col-md-6 mb-3">
                    <label for="Std_name" class="form-label">ชื่อนิสิต</label>
                    <input type="text" class="form-control" id="Std_name" name="Std_name" readonly required>
                </div>
            </div>

            <script>
                // สร้าง object เพื่อเก็บข้อมูลชื่อของแต่ละ student ID
                const studentNames = {};

                <?php
                mysqli_data_seek($result, 0); // รีเซ็ตตำแหน่งของผลลัพธ์
                while ($row = mysqli_fetch_assoc($result)) {
                    $fullName = $row['Std_prefix'] . $row['Std_name'] . ' ' . $row['Std_surname'];
                    $majorId = (int)$row['Major_id'];
                    echo "studentNames['" . $row['Std_id'] . "'] = { name: '" . addslashes($fullName) . "', major_id: " . (int)$row['Major_id'] . " };\n";
                }
                ?>

                // ฟังก์ชันเพื่อแสดงชื่อนิสิตที่เลือก
                document.getElementById("Std_id_input").addEventListener("input", function() {
                    var input = this.value;
                    if (studentNames[input]) {
                        document.getElementById("Std_name").value = studentNames[input].name;

                        // โหลดบริษัทตาม Major_id
                        var majorId = studentNames[input].major_id;
                        fetch('get_companies_by_major.php?major_id=' + majorId)
                            .then(response => response.json())
                            .then(data => {
                                let datalist = document.getElementById("companyList");
                                datalist.innerHTML = ""; // ล้างรายการเก่า
                                data.forEach(function(company) {
                                    let option = document.createElement("option");
                                    option.value = company.Company_id;
                                    option.text = company.Company_id + " - " + company.NamecomTH;
                                    datalist.appendChild(option);
                                });
                            });
                    } else {
                        document.getElementById("Std_name").value = "";
                    }
                });
            </script>


            <div class="form-group">
                <label for="Proposal_name" class="form-label">ชื่อผลงาน</label>
                <input type="text" class="form-control" id="Proposal_name" name="Proposal_name" required>
            </div>
            <div class="form-group">
                <label for="Sug_year" class="form-label">ปีการศึกษา</label>
                <input type="number" class="form-control" id="Sug_year" name="Sug_year" required>
            </div>
            <?php
            $sqlCompany = "SELECT Company_id, NamecomTH FROM company WHERE Company_id != 0 ORDER BY NamecomTH ASC";
            $resultCompany = mysqli_query($conn, $sqlCompany);
            ?>

            <!-- input บริษัท -->
            <div class="col-md- mb-3">
                <label class="form-label">
                    <i class="bi bi-building me-2" style="color: orange;"></i>พิมพ์หรือเลือกชื่อสถานประกอบการ
                </label>
                <!-- ช่องที่ผู้ใช้เห็น (ชื่อบริษัท) -->
                <input type="text" class="form-control" list="companyList" id="Company_display" name="Company_display" onblur="validateCompany()" required>
                <!-- ช่องซ่อนสำหรับส่ง Company_id -->
                <input type="hidden" id="Company_id" name="Company_id">

                <datalist id="companyList">
                    <!-- จะโหลดผ่าน JS -->
                </datalist>
            </div>

            <script>
                let companyMap = {}; 

                document.getElementById("Std_id_input").addEventListener("input", function() {
                    var input = this.value;
                    if (studentNames[input]) {
                        var majorId = studentNames[input].major_id;
                        fetch('get_companies_by_major.php?major_id=' + majorId)
                            .then(response => response.json())
                            .then(data => {
                                let datalist = document.getElementById("companyList");
                                datalist.innerHTML = "";
                                companyMap = {}; // รีเซ็ต mapping

                                data.forEach(function(company) {
                                    let option = document.createElement("option");
                                    option.value = company.NamecomTH;
                                    datalist.appendChild(option);
                                    companyMap[company.NamecomTH] = company.Company_id;
                                });
                            });
                    }
                });


                function validateCompany() {
                    var nameInput = document.getElementById("Company_display").value;
                    if (companyMap[nameInput]) {
                        document.getElementById("Company_id").value = companyMap[nameInput];
                    } else {
                        alert("กรุณาเลือกชื่อบริษัทจากรายการที่แสดง");
                        document.getElementById("Company_display").value = "";
                        document.getElementById("Company_id").value = "";
                    }
                }
            </script>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="Pro_status" class="form-label">สถานะการขอยื่นฝึกฯ</label>
                    <select class="form-control" id="Pro_status" name="Pro_status" required>
                        <option class="text-center" value="">-- เลือกสถานะ --</option>
                        <option value="0">ไม่อนุมัติ</option>
                        <option value="1">อนุมัติ</option>
                        <option value="2">แก้ไข</option>
                        <option value="3">รอตรวจสอบ</option>
                        <option value="4">ไม่มีข้อมูล</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="Com_status" class="form-label">สถานะตอบรับสถานประกอบการ</label>
                    <select class="form-control" id="Com_status" name="Com_status" required>
                        <option class="text-center" value="">-- เลือกสถานะ --</option>
                        <option value="0">ไม่อนุมัติ</option>
                        <option value="1">อนุมัติ</option>
                        <option value="2">แก้ไข</option>
                        <option value="3">รอตรวจสอบ</option>
                        <option value="4">ไม่มีข้อมูล</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="Note" class="form-label">คำแนะนำจากอาจารย์</label>
                <textarea class="form-control" id="Note" name="Note" rows="4" ></textarea>
            </div>

            <div class="form-group">
                <label for="File_name" class="form-label">ไฟล์งาน (เฉพาะไฟล์ PDF)</label>
                <input type="file" class="form-control" id="File_name" name="File_name" accept="application/pdf" required>
                <small class="form-text text-muted">อัพโหลดได้เฉพาะไฟล์ PDF เท่านั้น</small>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <script>
        function validateStudent() {
            var input = document.getElementById("Std_id_input").value;
            if (!studentNames[input]) {
                alert("กรุณาเลือกรหัสนิสิตจากรายการที่แสดง");
                document.getElementById("Std_id_input").value = "";
                document.getElementById("Std_name").value = "";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>