<?php
include 'connectdb.php';
include 'check_admin.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>alert('ไม่พบข้อมูลที่ต้องการลบ'); window.history.back();</script>";
    exit;
}

// ดึงข้อมูลรูปภาพจากฐานข้อมูล
$sql_select = "SELECT Pr_picture1, Pr_picture2, Pr_picture3, Pr_picture4 FROM public_relations WHERE Pr_id = ?";
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<script>alert('ไม่พบข้อมูลในระบบ'); window.history.back();</script>";
    exit;
}

// ลบไฟล์รูปภาพ
$uploadDir = "../images/public_relations/";
for ($i = 1; $i <= 4; $i++) {
    $filename = $data["Pr_picture$i"];
    if (!empty($filename)) {
        $filePath = $uploadDir . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

// ลบข้อมูลจากฐานข้อมูล
$sql_delete = "DELETE FROM public_relations WHERE Pr_id = ?";
$stmt_del = $conn->prepare($sql_delete);
$stmt_del->bind_param("i", $id);

if ($stmt_del->execute()) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location='indexactivity.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล');</script>";
}

$stmt->close();
$stmt_del->close();
$conn->close();
?>
