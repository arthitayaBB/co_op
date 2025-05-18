<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['Company_id'])) {
  $company_id = mysqli_real_escape_string($conn, $_GET['Company_id']);

  // JOIN ตาราง major เพื่อดึง Major_name
  $query = "
        SELECT company.*, major.Major_name 
        FROM company 
        LEFT JOIN major ON company.Major_id = major.Major_id 
        WHERE company.Company_id = '$company_id'
    ";

  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  // ตรวจสอบและเติมโปรโตคอลให้กับ URL ถ้าไม่มี
  $website = $row['Website'];
  if (!preg_match("~^(?:f|ht)tps?://~i", $website)) {
    $website = "http://" . $website;
  }
  $row['Website'] = $website;
} else {
  echo "<script>alert('ไม่มีข้อมูลบริษัทที่เลือก'); window.location.href='index.php';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายละเอียดบริษัท</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Noto Sans Thai Font -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
      font-family: 'Noto Sans Thai', sans-serif;
      color: #01579b;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: rgba(255, 255, 255, 0.98);
      padding: 30px 40px;
      border-radius: 20px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
      animation: fadeIn 1s ease-in-out;
      position: relative;
      overflow: hidden;
    }

    /* Decorative animated background element */
    .container::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at center, rgba(2, 136, 209, 0.15), transparent 70%);
      animation: rotate 6s linear infinite;
      z-index: 0;
    }

    @keyframes rotate {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
      z-index: 1;
    }

    .header h1 {
      font-size: 3rem;
      letter-spacing: 2px;
      margin: 0;
      font-weight: 700;
      color: #0277bd;
    }

    .details-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      position: relative;
      z-index: 1;
    }

    .detail-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .detail-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Effect ลากเส้น gradient */
    .detail-card::after {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(120deg, rgba(2, 136, 209, 0.3), transparent);
      transform: skewX(-25deg);
      transition: left 0.5s;
    }

    .detail-card:hover::after {
      left: 100%;
    }

    .detail-label {
      font-weight: 500;
      margin-bottom: 8px;
      font-size: 1.1rem;
    }

    .detail-value {
      font-size: 1rem;
      line-height: 1.4;
      word-wrap: break-word;
    }

    .button-group {
      text-align: center;
      margin-top: 40px;
      position: relative;
      z-index: 1;
    }

    .button {
      display: inline-block;
      margin: 10px;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 1.1rem;
      text-decoration: none;
      transition: background 0.3s, transform 0.3s;
      font-weight: 500;
    }

    .button-primary {
      background-color: #0288d1;
      color: #fff;
    }

    .button-primary:hover {
      background-color: #0277bd;
      transform: scale(1.05);
    }

    .button-danger {
      background-color: #d32f2f;
      color: #fff;
    }

    .button-danger:hover {
      background-color: #b71c1c;
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px;
        margin: 20px;
      }

      .header h1 {
        font-size: 2.2rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>รายละเอียดบริษัท</h1>
    </div>
    <div class="details-grid">
      <div class="detail-card">
        <div class="detail-label">ID</div>
        <div class="detail-value"><?php echo $row['Company_id']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ชื่อบริษัท (TH)</div>
        <div class="detail-value"><?php echo $row['NamecomTH']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ชื่อบริษัท (EN)</div>
        <div class="detail-value"><?php echo $row['NamecomEng']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ที่อยู่</div>
        <div class="detail-value"><?php echo $row['Company_add']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">จังหวัด</div>
        <div class="detail-value"><?php echo $row['Province']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">เบอร์โทร</div>
        <div class="detail-value"><?php echo $row['Com_phone']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">Email</div>
        <div class="detail-value"><?php echo $row['Com_email']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">เว็บไซต์</div>
        <div class="detail-value">
          <a href="<?php echo $row['Website']; ?>" target="_blank" class="button button-primary" style="padding:6px 15px; border-radius: 15px;">เยี่ยมชม</a>
        </div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ผู้ติดต่อ</div>
        <div class="detail-value"><?php echo $row['Contact_com']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ตำแหน่ง</div>
        <div class="detail-value"><?php echo $row['Position']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">ระยะเวลา</div>
        <div class="detail-value"><?php echo $row['Duration']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">รายละเอียดงาน</div>
        <div class="detail-value"><?php echo $row['Job_description']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">สวัสดิการ</div>
        <div class="detail-value"><?php echo $row['welfare']; ?></div>
      </div>
      <div class="detail-card">
        <div class="detail-label">เบอร์โทรสาร</div>
        <div class="detail-value"><?php echo $row['Fax_number']; ?></div>
      </div>

      <div class="detail-card">
        <div class="detail-label">สาขา</div>
        <div class="detail-value"><?php echo $row['Major_name']; ?></div>
      </div>

      <div class="detail-card">
        <div class="detail-label">ปีการศึกษา</div>
        <div class="detail-value"><?php echo $row['Academic_year']; ?></div>
      </div>

      <div class="detail-card">
        <div class="detail-label">แผนที่</div>
        <div class="detail-value">
          <!-- ปุ่มแสดง iframe -->
          <a href="javascript:void(0);"
            onclick="document.getElementById('mapIframe').style.display = 'block';"
            class="button button-primary"
            style="padding:6px 15px; border-radius: 15px; background-color:#388e3c;">
            ดูแผนที่
          </a>

          <!-- iframe ฝังแผนที่ (src มาจาก embed link ที่เก็บในฐานข้อมูล) -->
          <div id="mapIframe" style="display:none; margin-top: 15px;">
            <iframe src="<?php echo htmlspecialchars($row['Map']); ?>"
              width="100%"
              height="300px"
              style="border: none; border-radius: 15px; max-width: 800px;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>

    </div>
    <div class="button-group">
      <a href="indexcompany.php" class="button button-danger">กลับ</a>
    </div>
  </div>
</body>

</html>