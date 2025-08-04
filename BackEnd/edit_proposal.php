<?php
include 'check_admin.php';
include 'connectdb.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ไม่พบ ID ของ Proposal'); window.location.href = 'indexproposal.php';</script>";
    exit;
}

$proposal_id = (int)$_GET['id'];

// ดึงข้อมูล Proposal เดิม
$query = "SELECT * FROM proposal WHERE Proposal_id = $proposal_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) != 1) {
    echo "<script>alert('ไม่พบข้อมูล Proposal นี้'); window.location.href = 'indexproposal.php';</script>";
    exit;
}
$proposal = mysqli_fetch_assoc($result);

// เมื่อกดบันทึก
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Proposal_name = mysqli_real_escape_string($conn, $_POST['Proposal_name']);
    $Sug_year = (int)$_POST['Sug_year'];
    $Std_id = mysqli_real_escape_string($conn, $_POST['Std_id']);
    $Company_id = (int)$_POST['Company_id'];
    $Pro_status = mysqli_real_escape_string($conn, $_POST['Pro_status']);
    $Com_status = mysqli_real_escape_string($conn, $_POST['Com_status']);
    $Note = mysqli_real_escape_string($conn, $_POST['Note']);
    $new_file_name = $proposal['File_name']; // ตั้งค่าเริ่มต้นจากของเดิม

    if (isset($_FILES['File_name']) && $_FILES['File_name']['error'] == 0) {
        if ($_FILES['File_name']['type'] !== 'application/pdf') {
            echo "<script>alert('อนุญาตให้เฉพาะไฟล์ PDF เท่านั้น');</script>";
            exit;
        }
        $upload_dir = "../uploads/project/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $new_file_name = "project_" . $Std_id . "_" . time() . ".pdf";
        $target_file = $upload_dir . $new_file_name;

        if (!move_uploaded_file($_FILES['File_name']['tmp_name'], $target_file)) {
            echo "<script>alert('อัปโหลดไฟล์ไม่สำเร็จ');</script>";
            exit;
        }
    }

    // อัปเดตข้อมูล
    $updateQuery = "UPDATE proposal 
        SET Proposal_name = '$Proposal_name', 
            File_name = '$new_file_name', 
            Sug_year = $Sug_year, 
            Std_id = '$Std_id', 
            Company_id = $Company_id, 
            Pro_status = '$Pro_status', 
            Com_status = '$Com_status',
            Note = '$Note'
        WHERE Proposal_id = $proposal_id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('แก้ไขข้อมูล Proposal สำเร็จ'); window.location.href = 'indexproposal.php';</script>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
    }
}
function getStudentFullName($conn, $std_id)
{
    $std_id = mysqli_real_escape_string($conn, $std_id);
    $query = "SELECT Std_prefix, Std_name, Std_surname FROM student WHERE Std_id = '$std_id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['Std_prefix'] . $row['Std_name'] . ' ' . $row['Std_surname'];
    }

    return '';
}
function getCompanyName($conn, $company_id)
{
    $company_id = (int)$company_id;
    $query = "SELECT NamecomTH FROM company WHERE Company_id = $company_id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['NamecomTH'];
    }

    return '';
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
                    <input type="text" class="form-control" id="Std_id_input" name="Std_id"
                        value="<?= $proposal['Std_id'] ?>" readonly>



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
                    <input type="text" class="form-control" id="Std_name" name="Std_name"
                        value="<?= getStudentFullName($conn, $proposal['Std_id']) ?>" readonly>

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
                <input type="text" class="form-control" id="Proposal_name" name="Proposal_name"
                    value="<?= htmlspecialchars($proposal['Proposal_name']) ?>" required>

            </div>
            <div class="form-group">
                <label for="Sug_year" class="form-label">ปีการศึกษา</label>
                <input type="number" class="form-control" id="Sug_year" name="Sug_year"
                    value="<?= $proposal['Sug_year'] ?>" required>

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
                <input type="text" class="form-control" list="companyList" id="Company_display" name="Company_display"
                    value="<?= getCompanyName($conn, $proposal['Company_id']) ?>" onblur="validateCompany()" required>

                <!-- ช่องซ่อนสำหรับส่ง Company_id -->
                <input type="hidden" id="Company_id" name="Company_id" value="<?= $proposal['Company_id'] ?>">

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
                    var nameInput = document.getElementById("Company_display").value.trim();
                    var matched = false;
                    Object.keys(companyMap).forEach(function(name) {
                        if (nameInput === name) {
                            document.getElementById("Company_id").value = companyMap[name];
                            matched = true;
                        }
                    });
                    if (!matched) {
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
                        <option value="">-- เลือกสถานะ --</option>
                        <option value="0" <?= $proposal['Pro_status'] == '0' ? 'selected' : '' ?>>ไม่อนุมัติ</option>
                        <option value="1" <?= $proposal['Pro_status'] == '1' ? 'selected' : '' ?>>อนุมัติ</option>
                        <option value="2" <?= $proposal['Pro_status'] == '2' ? 'selected' : '' ?>>แก้ไข</option>
                        <option value="3" <?= $proposal['Pro_status'] == '3' ? 'selected' : '' ?>>รอตรวจสอบ</option>
                        <option value="4" <?= $proposal['Pro_status'] == '4' ? 'selected' : '' ?>>ไม่มีข้อมูล</option>
                    </select>

                </div>

                <div class="form-group col-md-6">
                    <label for="Com_status" class="form-label">สถานะตอบรับสถานประกอบการ</label>
                    <select class="form-control" id="Com_status" name="Com_status" required>
                        <option value="">-- เลือกสถานะ --</option>
                        <option value="0" <?= $proposal['Com_status'] == '0' ? 'selected' : '' ?>>ไม่อนุมัติ</option>
                        <option value="1" <?= $proposal['Com_status'] == '1' ? 'selected' : '' ?>>อนุมัติ</option>
                        <option value="2" <?= $proposal['Com_status'] == '2' ? 'selected' : '' ?>>แก้ไข</option>
                        <option value="3" <?= $proposal['Com_status'] == '3' ? 'selected' : '' ?>>รอตรวจสอบ</option>
                        <option value="4" <?= $proposal['Com_status'] == '4' ? 'selected' : '' ?>>ไม่มีข้อมูล</option>
                    </select>

                </div>
            </div>

            <div class="form-group">
                <label for="Note" class="form-label">คำแนะนำจากอาจารย์</label>
                <textarea class="form-control" id="Note" name="Note" rows="4" ><?= htmlspecialchars($proposal['Note']) ?></textarea>

            </div>

            <div class="form-group">
                <label for="File_name" class="form-label">ไฟล์งาน (เฉพาะไฟล์ PDF)</label>
                <?php if (!empty($proposal['File_name'])): ?>
                    <p>ไฟล์เดิม: <a href="../uploads/project/<?= $proposal['File_name'] ?>" target="_blank">ดาวน์โหลด</a></p>
                <?php endif; ?>
                <input type="file" class="form-control" id="File_name" name="File_name" accept="application/pdf">
                <small class="form-text text-muted">หากไม่ต้องการเปลี่ยนไฟล์ ให้เว้นว่างไว้</small>

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
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const stdId = document.getElementById("Std_id_input").value;
            if (studentNames[stdId]) {
                const majorId = studentNames[stdId].major_id;
                fetch('get_companies_by_major.php?major_id=' + majorId)
                    .then(response => response.json())
                    .then(data => {
                        let datalist = document.getElementById("companyList");
                        datalist.innerHTML = "";
                        companyMap = {};
                        data.forEach(function(company) {
                            let option = document.createElement("option");
                            option.value = company.NamecomTH;
                            datalist.appendChild(option);
                            companyMap[company.NamecomTH] = company.Company_id;
                        });
                    });
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>