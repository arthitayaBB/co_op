<?php
include 'connectdb.php'; // เชื่อมต่อฐานข้อมูล


$search = ''; // ค่าค้นหาเริ่มต้นเป็นค่าว่าง

if (isset($_GET['search'])) {
    $search = $_GET['search']; // รับค่าคำค้นหาจาก URL
}

// ดึงข้อมูลจากฐานข้อมูลตามคำค้นหาที่กรอง
$query = "SELECT * FROM company WHERE NamecomTH LIKE '%$search%' OR NamecomEng LIKE '%$search%' OR Company_add LIKE '%$search%'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// ตรวจสอบว่ามีการส่งค่าแก้ไขข้อมูล
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_id = $_POST['Company_id'];
    $name_th = $_POST['NamecomTH'];
    $name_en = $_POST['NamecomEng'];
    $address = $_POST['Company_add'];
    $province = $_POST['Province'];
    $phone = $_POST['Com_phone'];
    $email = $_POST['Com_email'];
    $Website = $_POST['Website'];
    $Contact_com = $_POST['Contact_com'];
    $Position = $_POST['Position'];
    $Duration = $_POST['Duration'];
    $Job_description = $_POST['Job_description'];
    $welfare = $_POST['welfare'];
    $Fax_number = $_POST['Fax_number'];
    $Map = $_POST['Map'];
    $year = $_POST['Academic_year'];
    $Major = $_POST['Major_id'];

    $update_query = "UPDATE company SET
    NamecomTH='$name_th', 
    NamecomEng='$name_en', 
    Company_add='$address', 
    Province='$province', 
    Com_phone='$phone', 
    Com_email='$email', 
    Website='$Website', 
    Contact_com='$Contact_com', 
    Position='$Position', 
    Duration='$Duration', 
    Job_description='$Job_description',
	welfare='$welfare', 
    Fax_number='$Fax_number', 
    Map='$Map', 
    Academic_year='$year', 
	Major_id='$Major'
WHERE Company_id='$company_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location.href = 'indexcompany.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
    }
}

if (isset($_GET['id'])) {
    $company_id = $_GET['id'];
    $query = "SELECT * FROM company WHERE Company_id = '$company_id'";
    $result = mysqli_query($conn, $query);
    $company = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสถานประกอบการ</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>



    <div class="container mt-5">
        <!-- ปุ่มย้อนกลับ -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">แก้ไขข้อมูลสถานประกอบการ</h2>
        <form method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">ชื่อบริษัท (ไทย)</label>
                    <input type="text" name="NamecomTH" class="form-control" value="<?php echo $company['NamecomTH']; ?>" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">ชื่อบริษัท (อังกฤษ)</label>
                    <input type="text" name="NamecomEng" class="form-control" value="<?php echo $company['NamecomEng']; ?>">
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label">ที่อยู่</label>
                    <textarea name="Company_add" class="form-control" required><?php echo $company['Company_add']; ?></textarea>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">จังหวัด</label>
                    <input type="text" name="Province" class="form-control" value="<?php echo $company['Province']; ?>">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">เบอร์โทร</label>
                    <input type="text" name="Com_phone" class="form-control" value="<?php echo $company['Com_phone']; ?>">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">เบอร์โทรสาร</label>
                    <input type="text" name="Fax_number" class="form-control" value="<?php echo $company['Fax_number']; ?>" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">อีเมล</label>
                    <input type="email" name="Com_email" class="form-control" value="<?php echo $company['Com_email']; ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">เว็บไซต์</label>
                    <input type="url" name="Website" class="form-control" value="<?php echo $company['Website']; ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">ชื่อผู้ติดต่อ</label>
                    <input type="text" name="Contact_com" class="form-control" value="<?php echo $company['Contact_com']; ?>" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">ตำแหน่ง</label>
                    <input type="text" name="Position" class="form-control" value="<?php echo $company['Position']; ?>" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">ระยะเวลา</label>
                    <input type="text" name="Duration" class="form-control" value="<?php echo $company['Duration']; ?>" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">ปีการศึกษา</label>
                    <input type="text" name="Academic_year" class="form-control" value="<?php echo $company['Academic_year']; ?>" required>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label">รายละเอียดงาน</label>
                    <input type="text" name="Job_description" class="form-control" value="<?php echo $company['Job_description']; ?>" required>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label">สวัสดิการ</label>
                    <input type="text" name="welfare" class="form-control" value="<?php echo $company['welfare']; ?>" required>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label">แผนที่</label>
                    <textarea name="Map" class="form-control" rows="3" required><?php echo $company['Map']; ?></textarea>
                    <div class="form-text">กรุณาใส่ลิงก์แผนที่ Google Maps แบบฝังแผนที่</div>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label">สาขา</label>
                    <select name="Major_id" class="form-control" required>
                        <option value="">-- กรุณาเลือกสาขา --</option>
                        <?php
                        include 'connectdb.php';
                        $result = mysqli_query($conn, "SELECT Major_id, Major_name FROM major");
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = ($company['Major_id'] == $row['Major_id']) ? 'selected' : '';
                            echo "<option value='{$row['Major_id']}' $selected>{$row['Major_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- ปุ่มบันทึก -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary ">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>



</body>

</html>