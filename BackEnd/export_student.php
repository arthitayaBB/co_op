<?php
include 'connectdb.php';
include 'check_admin.php';

// ตรวจสอบปีที่เลือก
$yearCondition = '';
$yearLabel = 'all'; // ค่าเริ่มต้น กรณีไม่ได้เลือกปี

if (isset($_GET['year']) && !empty($_GET['year'])) {
    $year = $conn->real_escape_string($_GET['year']);
    $yearCondition = "WHERE student.Academic_year = '$year'";
    $yearLabel = $year; // ใช้ตั้งชื่อไฟล์
}

// ตั้ง header พร้อมใส่ชื่อไฟล์ตามปี
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=student_report_' . $yearLabel . '.csv');

// ส่ง BOM
echo "\xEF\xBB\xBF";

$output = fopen('php://output', 'w');

// เขียนหัวตาราง
fputcsv($output, [
    'รหัสนิสิต',
    'เลขประจำตัวประชาชน',
    'คำนำหน้า',
    'ชื่อ',
    'นามสกุล',
    'สาขา',
    'ชั้นปี',
    'GPA',
    'GPAX',
    'CGX',
    'เบอร์โทร',
    'Email',
    'ที่อยู่',
    'จังหวัด',
    'รหัสไปรษณีย์',
    'ปีการศึกษา'
]);

// ดึงข้อมูล + เชื่อมตาราง major
$sql = "SELECT 
            student.Std_id,
            student.Id_number,
            student.Std_prefix,
            student.Std_name,
            student.Std_surname,
            major.Major_name,
            student.Grade_level,
            student.GPA,
            student.GPAX,
            student.CGX,
            student.Std_phone,
            student.Std_email,
            student.Std_add,
            student.Province,
            student.Zip_id,
            student.Academic_year
        FROM student
        LEFT JOIN major ON student.Major_id = major.Major_id
        $yearCondition
        ORDER BY student.Std_id ASC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row['Std_id'] = '="' . $row['Std_id'] . '"';
    $row['Id_number'] = '="' . $row['Id_number'] . '"';
    $row['Std_phone'] = '="' . $row['Std_phone'] . '"';
    

    fputcsv($output, [
        $row['Std_id'],
        $row['Id_number'],
        $row['Std_prefix'],
        $row['Std_name'],
        $row['Std_surname'],
        $row['Major_name'],
        $row['Grade_level'],
        $row['GPA'],
        $row['GPAX'],
        $row['CGX'],
        $row['Std_phone'],
        $row['Std_email'],
        $row['Std_add'],
        $row['Province'],
        $row['Zip_id'],
        $row['Academic_year']
    ]);
}

fclose($output);
$conn->close();
exit();
?>
