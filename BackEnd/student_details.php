<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['Std_id'])) {
  $std_id = mysqli_real_escape_string($conn, $_GET['Std_id']);
  $query = "SELECT student.*, major.Major_name 
            FROM student 
            LEFT JOIN major ON student.Major_id = major.Major_id 
            WHERE student.Std_id = '$std_id'";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Error: " . mysqli_error($conn));
  }

  $row = mysqli_fetch_assoc($result);

  if (!$row) {
    echo "<script>alert('ไม่พบข้อมูลนิสิตที่เลือก'); window.location.href='indexstudent.php';</script>";
    exit();
  }
} else {
  echo "<script>alert('ไม่มีข้อมูลนิสิตที่เลือก'); window.location.href='indexstudent.php';</script>";
  exit();
}
// เตรียม query ดึงชื่อ + นามสกุลอาจารย์ที่ปรึกษา 2 คน
$sql_advisor = "
    SELECT 
        CONCAT(t1.Tec_name, ' ', t1.Tec_surname) AS advisor1, 
        CONCAT(t2.Tec_name, ' ', t2.Tec_surname) AS advisor2
    FROM advisor a
    LEFT JOIN teacher t1 ON a.Tec_id1 = t1.Tec_id
    LEFT JOIN teacher t2 ON a.Tec_id2 = t2.Tec_id
    WHERE LOWER(a.Std_id) = ?
";
$stmt_advisor = $conn->prepare($sql_advisor);
$stmt_advisor->bind_param("s", $std_id);
$stmt_advisor->execute();
$result_advisor = $stmt_advisor->get_result();
$advisor_data = $result_advisor->fetch_assoc();
$advisor1 = $advisor_data['advisor1'] ?? 'ไม่มีข้อมูล';
$advisor2 = $advisor_data['advisor2'] ?? 'ไม่มีข้อมูล';

?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายละเอียดนิสิต</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
      font-family: 'Noto Sans Thai', sans-serif;
      color: #01579b;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: white;
      padding: 30px 40px;
      border-radius: 20px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h1 {
      font-size: 2.5rem;
      color: #0277bd;
    }

    .profile-img-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 30px;
    }

    .profile-img {
      width: 150px;
      height: 150px;
      overflow: hidden;
      border-radius: 50%;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
      border: 5px solid #0277bd;
      transition: transform 0.3s ease;
    }

    .profile-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-img:hover {
      transform: scale(1.05);
    }

    /* เพิ่มช่องที่ใหญ่ขึ้น */
    .details-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(298px, 1fr));
      /* ปรับขนาดช่อง */
      gap: 25px;
      /* เว้นช่องระหว่างการ์ด */
    }

    .detail-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      min-height: 150px;
      /* เพิ่มความสูงขั้นต่ำ */
    }

    .detail-card:hover {
      transform: scale(1.05);
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    }

    .detail-label {
      font-weight: 500;
      margin-bottom: 8px;
      font-size: 1.2rem;
      /* เพิ่มขนาดฟอนต์ */
      color: #01579b;
    }

    .detail-value {
      font-size: 1.1rem;
      /* เพิ่มขนาดฟอนต์ */
      color: #555;
      white-space: nowrap;
    }

    .button-group {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 30px;
    }

    .button {
      padding: 12px 30px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 500;
      display: inline-block;
    }

    .button-danger {
      background-color: #d32f2f;
      color: #fff;
    }

    .button-print {
      background-color: #0277bd;
      color: white;
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="header">
      <h1>รายละเอียดนิสิต</h1>
    </div>
    <div class="profile-img-wrapper">
      <div class="profile-img">
        <?php if (!empty($row['Std_picture'])) { ?>
          <img src="../profile_pic/<?php echo htmlspecialchars($row['Std_picture']); ?>"
            alt="รูปประจำตัว" class="img-fluid">
        <?php } else { ?>
          <img src="img_student/default.jpg" alt="รูปประจำตัว" class="img-fluid">
        <?php } ?>
      </div>
    </div>

    <!-- ส่วนแสดงข้อมูลนิสิตเป็นการ์ด -->
    <div class="details-grid">
      <div class="detail-card">
        <div class="detail-label">เลขบัตรประชาชน</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Id_number']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">รหัสนิสิต</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Std_id']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ชื่อเต็ม</div>
        <div class="detail-value">
          <?php echo htmlspecialchars($row['Std_prefix']) . ' ' .
            htmlspecialchars($row['Std_name']) . ' ' .
            htmlspecialchars($row['Std_surname']); ?>
        </div>
      </div>
      <div class="detail-card">
        <div class="detail-label">สาขา</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Major_name']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ชั้นปี</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Grade_level']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">GPA</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['GPA']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">GPAX</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['GPAX']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">CGX</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['CGX']); ?></div>
      </div>
      <div class="detail-card">
  <div class="detail-label">อาจารย์ที่ปรึกษา</div>
  <div class="detail-value">
    <?php
      $advisors = [];

      if (!empty($advisor1) && $advisor1 !== 'ไม่มีข้อมูล') {
        $advisors[] = htmlspecialchars($advisor1);
      }

      if (!empty($advisor2) && $advisor2 !== 'ไม่มีข้อมูล') {
        $advisors[] = htmlspecialchars($advisor2);
      }

      // แสดงผล
      if (count($advisors) === 1) {
        echo $advisors[0];
      } elseif (count($advisors) === 2) {
        echo '1. ' . $advisors[0] . '<br>';
        echo '2. ' . $advisors[1];
      } else {
        echo 'ไม่มีข้อมูล';
      }
    ?>
  </div>
</div>

      <div class="detail-card">
        <div class="detail-label">เบอร์โทร</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Std_phone']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">อีเมล</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Std_email']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ที่อยู่</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Std_add']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">จังหวัด</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Province']); ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">รหัสไปรษณีย์</div>
        <div class="detail-value"><?php echo htmlspecialchars($row['Zip_id']); ?></div>
      </div>
    </div>

    <div class="button-group">
      <a href="indexstudent.php" class="button button-danger">กลับ</a>
      <a href="view_student.php?Std_ids=<?php echo $std_id; ?>" class="button button-print">แบบฟอร์ม</a>
    </div>
  </div>

</body>

</html>