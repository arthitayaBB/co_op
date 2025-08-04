<?php
include 'connectdb.php';
include 'check_admin.php';

// ตรวจสอบการเลือกสาขา
$majorCondition = '';
$majorLabel = 'all'; // ตั้งค่าเริ่มต้น (กรณีไม่ได้เลือก)

if (isset($_GET['major_id']) && !empty($_GET['major_id'])) {
    $majorId = intval($_GET['major_id']); // กัน SQL Injection
    $majorCondition = "AND company.Major_id = '$majorId'";

    // ไปดึงชื่อ Major_name มา
    $sql_major_name = "SELECT Major_name FROM major WHERE Major_id = '$majorId' LIMIT 1";
    $result_major_name = $conn->query($sql_major_name);

    if ($result_major_name && $row_major_name = $result_major_name->fetch_assoc()) {
        $majorLabel = str_replace(' ', '_', $row_major_name['Major_name']); // เอาชื่อมาใช้ ตั้งชื่อไฟล์
    } else {
        $majorLabel = 'unknown'; // เผื่อหาไม่เจอ
    }
}

// ตั้ง header เพื่อดาวน์โหลด CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=company_report_' . $majorLabel . '.csv');

// ส่ง BOM
echo "\xEF\xBB\xBF";

$output = fopen('php://output', 'w');

// เขียนหัวตาราง
fputcsv($output, [
    'รหัสบริษัท',
    'ชื่อบริษัท (TH)',
    'ชื่อบริษัท (EN)',
    'ที่อยู่บริษัท',
    'จังหวัด',
    'เบอร์โทร',
    'รหัสไปรษณีย์',
    'อีเมล',
    'เว็บไซต์',
    'ผู้ติดต่อ',
    'ตำแหน่ง',
    'ระยะเวลา',
    'ลักษณะงาน',
    'เบอร์แฟกซ์',
    'ปีการศึกษา',
    'สาขา'
]);

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT 
            company.Company_id,
            company.NamecomTH,
            company.NamecomEng,
            company.Company_add,
            company.Province,
            company.Com_phone,
            company.Zip_id,
            company.Com_email,
            company.Website,
            company.Contact_com,
            company.Position,
            company.Duration,
            company.Job_description,
            company.Fax_number,
            company.Academic_year,
            company.Major_id,
            major.Major_name
        FROM company
        LEFT JOIN major ON company.Major_id = major.Major_id
        WHERE company.Company_id != 0
        $majorCondition
        ORDER BY company.Major_id, company.Company_id ASC";  // จัดลำดับตาม Major_id ก่อน

$result = $conn->query($sql);

// แปรข้อมูลให้แยกตามสาขา
$currentMajor = '';  // เก็บสาขาปัจจุบัน

while ($row = $result->fetch_assoc()) {
    // ตรวจสอบว่าเปลี่ยนสาขาหรือยัง
    if ($currentMajor != $row['Major_name']) {
        // ถ้าเปลี่ยนสาขา ให้พิมพ์ชื่อสาขาก่อน
        if ($currentMajor != '') {
            // เพิ่มแถวว่างเพื่อแยกส่วนสาขา
            fputcsv($output, []);
        }

        // พิมพ์ชื่อสาขา
        fputcsv($output, [ '=== สาขา: ' . $row['Major_name'] . ' ===' ]);
        $currentMajor = $row['Major_name'];  // อัปเดตสาขาปัจจุบัน
    }

    // เขียนข้อมูลบริษัท
    $row['Company_id'] = '="' . $row['Company_id'] . '"';
    $row['Com_phone'] = '="' . $row['Com_phone'] . '"';
    $row['Zip_id'] = '="' . $row['Zip_id'] . '"';
    $row['Fax_number'] = '="' . $row['Fax_number'] . '"';

    fputcsv($output, [
        $row['Company_id'],
        $row['NamecomTH'],
        $row['NamecomEng'],
        $row['Company_add'],
        $row['Province'],
        $row['Com_phone'],
        $row['Zip_id'],
        $row['Com_email'],
        $row['Website'],
        $row['Contact_com'],
        $row['Position'],
        $row['Duration'],
        $row['Job_description'],
        $row['Fax_number'],
        $row['Academic_year'],
        $row['Major_name']
    ]);
}

fclose($output);
$conn->close();
exit();
?>
