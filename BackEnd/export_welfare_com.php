<?php
include 'connectdb.php';
include 'check_admin.php';

$major_id = isset($_GET['major_id']) ? $_GET['major_id'] : '';

// ดึงชื่อสาขา
$major_name = 'ทุกสาขา';
if ($major_id != '') {
    $stmt = $conn->prepare("SELECT Major_name FROM major WHERE Major_id = ?");
    $stmt->bind_param("s", $major_id);
    $stmt->execute();
    $result_major = $stmt->get_result();
    if ($row_major = $result_major->fetch_assoc()) {
        $major_name = $row_major['Major_name'];
    }
}

// Query
$sql = "SELECT advice.Workbenefit, advice.Std_id, advice.Company_id, advice.created_at,
               student.Std_prefix, student.Std_name, student.Std_surname, student.Major_id, major.Major_name,
               company.NamecomTH
        FROM advice
        LEFT JOIN student ON advice.Std_id = student.Std_id
        LEFT JOIN major ON student.Major_id = major.Major_id
        LEFT JOIN company ON advice.Company_id = company.Company_id";

if ($major_id != '') {
    $sql .= " WHERE student.Major_id = " . intval($major_id);
}

$sql .= " ORDER BY major.Major_name, student.Std_name";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $filename = "welfare_report_" . str_replace(' ', '_', $major_name) . ".csv";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');
    fwrite($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM

    fputcsv($output, ['รายงานสวัสดิการนิสิตสหกิจศึกษา']);
    fputcsv($output, []); // บรรทัดว่าง

    $currentMajor = '';
    $headers = ['ลำดับ', 'วันที่บันทึก', 'รหัสนิสิต', 'คำนำหน้า', 'ชื่อ', 'นามสกุล', 'รหัสสถานประกอบการ', 'ชื่อสถานประกอบการ', 'รายละเอียดสวัสดิการ'];

    $index = 1; // เริ่มลำดับที่ 1

    while ($row = $result->fetch_assoc()) {
        // แสดงชื่อสาขาถ้าเปลี่ยน
        if ($major_id == '' && $currentMajor != $row['Major_name']) {
            if ($currentMajor != '') {
                fputcsv($output, []);
            }
            fputcsv($output, ['=== สาขา: ' . $row['Major_name'] . ' ===']);
            fputcsv($output, $headers);
            $currentMajor = $row['Major_name'];
            $index = 1; // รีเซ็ตลำดับสำหรับสาขาใหม่
        } elseif ($major_id != '' && $currentMajor == '') {
            fputcsv($output, $headers);
            $currentMajor = $row['Major_name'];
        }

        // แปลง Std_id เป็นข้อความเพื่อกัน Excel ตัดเลข 0
        $row['Std_id'] = '="' . $row['Std_id'] . '"';

        fputcsv($output, [
            $index++,
            $row['created_at'],
            $row['Std_id'],
            $row['Std_prefix'],
            $row['Std_name'],
            $row['Std_surname'],
            $row['Company_id'],
            $row['NamecomTH'],
            $row['Workbenefit']
        ]);
    }

    fclose($output);
} else {
    echo "ไม่มีข้อมูล";
}

$conn->close();
?>
