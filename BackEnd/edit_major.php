<?php
include 'connectdb.php';
include 'check_admin.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ไม่พบรหัสสาขาที่ต้องการแก้ไข";
    exit;
}

$major_id = $_GET['id'];

// ดึงข้อมูลสาขาที่ต้องการแก้ไข
$query = "SELECT * FROM major WHERE Major_id = '$major_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูลสาขานี้";
    exit;
}

$row = mysqli_fetch_assoc($result);

// อัปเดตข้อมูลเมื่อกดปุ่มบันทึก
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $major_name = mysqli_real_escape_string($conn, $_POST['Major_name']);
    $m_sub = mysqli_real_escape_string($conn, $_POST['M_sub']); // เพิ่มบรรทัดนี้

    $update_query = "UPDATE major SET Major_name = '$major_name', M_sub = '$m_sub' WHERE Major_id = '$major_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย'); window.location='indexmajor.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสาขา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>



    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
    
        <h2 class="heading">แก้ไขข้อมูลสาขา</h2>
        <form action="edit_major.php?id=<?php echo $row['Major_id']; ?>" method="POST">
    
            <div class="form-group">
                <label class="form-label">ชื่อสาขา</label>
                <input type="text" name="Major_name" class="form-control" value="<?php echo htmlspecialchars($row['Major_name']); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">ตัวย่อสาขา</label>
                <input type="text" name="M_sub" class="form-control" value="<?php echo htmlspecialchars($row['M_sub']); ?>" required>
            </div>


            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
