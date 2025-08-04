<?php
include 'connectdb.php';

if (isset($_GET['major_id'])) {
    $major_id = (int)$_GET['major_id'];
    
    // ดึงข้อมูลบริษัทที่ตรงกับ major_id
    $query = "SELECT Company_id, NamecomTH FROM company WHERE Major_id = $major_id ORDER BY NamecomTH ASC";
    $result = mysqli_query($conn, $query);

    $companies = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $companies[] = $row;
    }

    echo json_encode($companies); // ส่งกลับในรูปแบบ JSON
} else {
    echo json_encode([]); // ถ้าไม่มี major_id ให้ส่งข้อมูลว่าง
}
?>
