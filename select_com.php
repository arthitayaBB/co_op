<?php
include_once("connectdb.php");

include ("checklogin.php");

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;
$Std_id = $_SESSION['Std_id']; 

// ดึงข้อมูลสาขาของนักศึกษา
$sql = "
    SELECT std.Major_id, m.Major_name 
    FROM student std
    INNER JOIN major m ON std.Major_id = m.Major_id
    WHERE std.Std_id = $Std_id
";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

$Major_id = $student['Major_id'] ?? 0;
$Major_name = $student['Major_name'] ?? '';

// ดึงข้อมูลสถานประกอบการที่มี Major_id ตรงกัน
$sql1 = "SELECT Company_id, NamecomTH, Company_add, Province, Com_phone FROM company WHERE Major_id = $Major_id";
$rs1 = mysqli_query($conn, $sql1);
$companies = [];
while ($row = mysqli_fetch_assoc($rs1)) {
    $companies[] = $row;
}
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>เลือกสถานประกอบการ</title>
  <link rel="icon" href="images/Logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 10px;
    }
    .container {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      position: relative;
    }
    .close-icon {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      cursor: pointer;
      color: rgb(22, 22, 22);
    }
    .close-icon:hover {
      color: #ff4d4d;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="chose_com.php">
      <i class="bi bi-x-lg close-icon"></i>
    </a>
    <h2 class="mb-4 text-center">เลือกสถานประกอบการ</h2>
    <form method="post" action="">
      <div class="mb-3">
        <label class="form-label">สาขา</label>
        <input type="text" name="major" class="form-control" value="<?php echo htmlspecialchars($Major_name); ?>" readonly>
      </div>
      <div class="mb-3">
        <div class="form-floating">
          <select class="form-select" id="floatingBranch" name="company_id" onchange="updateDetails()" required>
            <option value="" disabled selected>เลือกสถานประกอบการ</option>
            <?php foreach ($companies as $company) { ?>
              <option value="<?php echo $company['Company_id']; ?>" data-details="<?php echo htmlspecialchars(json_encode($company)); ?>">
                <?php echo htmlspecialchars($company['NamecomTH']); ?>
              </option>
            <?php } ?>
          </select>
          <label for="floatingBranch">ชื่อสถานประกอบการ</label>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">รายละเอียดสถานประกอบการ</label>
        <textarea id="companyDetails" class="form-control" readonly></textarea>
      </div>
      <button type="submit" name="Submit" class="btn btn-info w-100">เพิ่ม</button>
    </form>
  </div>

  <?php
if (isset($_POST['Submit'])) {
    $company_id = intval($_POST['company_id']);
    $sql_update = "UPDATE proposal SET Company_id = '$company_id',Com_status = 3 WHERE Std_id = '$Std_id'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('เลือกสถานประกอบการสำเร็จ'); window.location='chose_com.php';</script>";
    } else {
        echo "<script>alert('เลือกสถานประกอบการไม่สำเร็จ: " . mysqli_error($conn) . "');</script>";
    }
}
?>

  <script>
    function updateDetails() {
      const select = document.getElementById("floatingBranch");
      const selectedOption = select.options[select.selectedIndex];
      const data = JSON.parse(selectedOption.getAttribute("data-details"));
      document.getElementById("companyDetails").value = `ที่อยู่: ${data.Company_add}\nจังหวัด: ${data.Province}\nเบอร์ติดต่อ: ${data.Com_phone}`;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
