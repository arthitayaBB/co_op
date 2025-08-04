<?php
include_once("connectdb.php");
session_start();

?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สมัครสหกิจศึกษา</title>
  <link rel="icon" href="images/Logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .title {
      font-size: 35px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-label {
      font-weight: bold;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ccc;
      padding: 10px;
      width: 100%;
      font-size: 16px;
    }

    .form-section {
      display: none;
      transition: opacity 0.5s ease-in-out;
    }

    .form-section.active {
      display: block;
      opacity: 1;
    }

    .input-group {
      margin-bottom: 10px;
    }

    label {
      display: block;
      font-weight: bold;
    }

    .btn-container {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    button {
      padding: 10px 20px;
      border: none;
      background: skyblue;
      color: black;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
      /* เพิ่มเอฟเฟกต์ลื่นไหล */
    }

    button:hover {
      background: hotpink;
      /* เปลี่ยนสีพื้นหลัง */
      color: white;
      /* คงสีตัวอักษรให้ชัดเจน */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      /* เพิ่มเงาให้ดูโดดเด่น */
    }
  </style>
  <style>
    .profile-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .profile-box {
      width: 200px;
      height: 200px;
      border: 2px solid #ccc;
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgb(255, 255, 255);
      cursor: pointer;
    }

    .profile-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    #profileImage {
      display: none;
      /* ซ่อน input file */
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
      /* เปลี่ยนเป็นสีแดงเมื่อเมาส์ชี้ */
    }
  </style>
</head>

<body>
  <div class="col-md-12 d-flex justify-content-between align-items-center">
    <!-- ไอคอนปิดทางขวาบน -->
    <a href="index.php"> <i class="bi bi-x-circle-fill close-icon"></i>
  </div></a>

  <div class="container">


    <div class="row">
      <!-- รูปภาพทางซ้าย -->
      <div class="col-md-6 d-flex justify-content-center">
        <img id="image1" src="images/design/step-co_op.svg" alt="รูปภาพ" class="img-fluid">
      </div>

      <!-- ฟอร์มทางขวา -->
      <div class="col-md-6">


        <div class="title" style="color:  #5a6f80;">สมัครสหกิจศึกษา</div>

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="profile-container">

            <div class="profile-box" id="profileBox">
              <img id="displayProfileImage" src="images/design/profile.svg" alt="รูปโปรไฟล์">
            </div>
            <p><strong>กรุณอัพโหลดรูปภาพ</strong></p>
            <input type="file" id="profileImage" accept="image/*" name="Std_picture" required>

          </div>


          <div>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInputid" placeholder="รหัสประจำตัวประชาชน" name="idCard" maxlength="13" required>
                  <label for="floatingInputid">รหัสประจำตัวประชาชน</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInputstdid" placeholder="รหัสนิสิต" name="studentId" maxlength="11" required>
                  <label for="floatingInputstdid">รหัสนิสิต</label>
                </div>
              </div>
            </div>

            <!-- Row 2: คำนำหน้า, ชื่อ, นามสกุล -->
            <div class="row g-3">
              <!-- คำนำหน้า -->
              <div class="col-md-2">
                <div class="form-floating">
                  <select class="form-select" id="floatingSelectprefix" name="prefix">
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                  </select>
                  <label for="floatingSelectprefix">คำนำหน้า</label>
                </div>
              </div>

              <!-- ชื่อ -->
              <div class="col-md-5">
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInputname" placeholder="ชื่อ" name="name" required>
                  <label for="floatingInput3">ชื่อ</label>
                </div>
              </div>

              <!-- นามสกุล -->
              <div class="col-md-5 mb-3">
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInputsurname" placeholder="นามสกุล" name="surname" required>
                  <label for="floatingInput4">นามสกุล</label>
                </div>
              </div>
            </div>
            <!-- Row 3: สาขา, ชั้นปี, GPA, CGX, GPAX -->
            <div class="row g-3">
              <div class="col-md-4">
                <div class="form-floating">
                  <?php
                  // ดึงข้อมูลสาขาจากฐานข้อมูล
                  $sql1 = "SELECT Major_name FROM major;";
                  $rs1 = mysqli_query($conn, $sql1);

                  if (!$rs1) {
                    die("Query failed: " . mysqli_error($conn));
                  }
                  $majors = [];
                  while ($row = mysqli_fetch_array($rs1, MYSQLI_BOTH)) {
                    $majors[] = $row['Major_name'];
                  }
                  ?>
                  <select class="form-select" id="floatingBranch" name="branch">
                    <?php
                    foreach ($majors as $major) {
                      echo "<option value='$major'>$major</option>";
                    }
                    ?>
                  </select>
                  <label for="floatingBranch">สาขา</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-floating">
                  <select class="form-select" id="floatingYear" name="year">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4" selected>4</option>
                  </select>
                  <label for="floatingYear">ชั้นปี</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-floating">
                  <input type="number" class="form-control" id="floatingGPA" placeholder="GPA" name="GPA" step="0.01" max="4" required>
                  <label for="floatingGPA">GPA</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating mb-4">
                  <input type="number" class="form-control" id="floatingGPAX" placeholder="GPAX" name="GPAX" step="0.01" max="4" required>
                  <label for="floatingGPAX">GPAX</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating">
                  <input type="number" class="form-control" id="floatingCGX" placeholder="CGX" name="CGX" required>
                  <label for="floatingCGX">CGX</label>
                </div>
              </div>


            </div>
            <div class="mb-3">

              <div class="form-floating">
                <input type="number" class="form-control" id="floatingAcaYear" placeholder="ปีการศึกษา" name="Acayear" step="1" min="2565" required>
                <label for="floatingAcaYea">ปีการศึกษา</label>
              </div>
            </div>

            <!-- เบอร์โทรศัพท์และที่อยู่ -->
            <div class="mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingCGX" placeholder="เบอร์โทร" name="phone" required maxlength="10">
                <label for="floatingCGX">เบอร์โทร</label>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingCGX" placeholder="ที่อยู่" name="address" required>
                <label for="floatingCGX">ที่อยู่</label>
              </div>
            </div>

            <!-- จังหวัดและรหัสไปรษณีย์ -->
            <div class="row g-3">
              <!-- จังหวัด -->
              <div class="col-md-6">

                <div class="form-floating">
                  <input type="text" class="form-control" list="provinceList" id="province" placeholder="พิมพ์ชื่อจังหวัด" name="province" onblur="validateInput()" required>
                  <label for="floatingGPA">จังหวัด</label>
                </div>
                <datalist id="provinceList">
                  <option value="กระบี่">
                  <option value="กรุงเทพมหานคร">
                  <option value="กาญจนบุรี">
                  <option value="กาฬสินธุ์">
                  <option value="กำแพงเพชร">
                  <option value="ขอนแก่น">
                  <option value="จันทบุรี">
                  <option value="ฉะเชิงเทรา">
                  <option value="ชลบุรี">
                  <option value="ชัยนาท">
                  <option value="ชัยภูมิ">
                  <option value="ชุมพร">
                  <option value="เชียงใหม่">
                  <option value="เชียงราย">
                  <option value="ตรัง">
                  <option value="ตราด">
                  <option value="ตาก">
                  <option value="นครนายก">
                  <option value="นครปฐม">
                  <option value="นครพนม">
                  <option value="นครราชสีมา">
                  <option value="นครศรีธรรมราช">
                  <option value="นครสวรรค์">
                  <option value="นนทบุรี">
                  <option value="นราธิวาส">
                  <option value="หนองคาย">
                  <option value="หนองบัวลำภู">
                  <option value="ระนอง">
                  <option value="ระยอง">
                  <option value="ราชบุรี">
                  <option value="ลพบุรี">
                  <option value="ลำปาง">
                  <option value="ลำพูน">
                  <option value="เลย">
                  <option value="ศรีสะเกษ">
                  <option value="สกลนคร">
                  <option value="สงขลา">
                  <option value="สมุทรปราการ">
                  <option value="สมุทรสงคราม">
                  <option value="สมุทรสาคร">
                  <option value="สระแก้ว">
                  <option value="สระบุรี">
                  <option value="สิงห์บุรี">
                  <option value="สุโขทัย">
                  <option value="สุพรรณบุรี">
                  <option value="สุราษฎร์ธานี">
                  <option value="สุรินทร์">
                  <option value="สตูล">
                  <option value="อ่างทอง">
                  <option value="อำนาจเจริญ">
                  <option value="อุดรธานี">
                  <option value="อุตรดิตถ์">
                  <option value="อุบลราชธานี">
                  <option value="ยโสธร">
                  <option value="ระนอง">
                  <option value="ร้อยเอ็ด">
                  <option value="เพชรบูรณ์">
                  <option value="เพชรบุรี">
                  <option value="บุรีรัมย์">
                  <option value="ปทุมธานี">
                  <option value="พิษณุโลก">
                  <option value="พิจิตร">
                  <option value="พัทลุง">
                  <option value="พะเยา">
                  <option value="แพร่">
                  <option value="ภูเก็ต">
                  <option value="มหาสารคาม">
                  <option value="มุกดาหาร">
                  <option value="แม่ฮ่องสอน">
                  <option value="ลำพูน">
                  <option value="ลำปาง">
                  <option value="นครสวรรค์">
                  <option value="ปัตตานี">
                  <option value="ประจวบคีรีขันธ์">
                  <option value="ภูเก็ต">
                  <option value="สุพรรณบุรี">
                  <option value="สุราษฎร์ธานี">
                  <option value="นครพนม">
                  <option value="เพชรบุรี">
                  <option value="ชัยภูมิ">
                  <option value="สตูล">
                </datalist>
              </div>
              <script>
                function validateInput() {
                  var input = document.getElementById("province").value;
                  var datalistOptions = document.getElementById("provinceList").options;
                  var isValid = false;

                  // ตรวจสอบว่า input ตรงกับค่าที่มีใน datalist หรือไม่
                  for (var i = 0; i < datalistOptions.length; i++) {
                    if (input === datalistOptions[i].value) {
                      isValid = true;
                      break;
                    }
                  }

                  // ถ้าค่าที่พิมพ์ไม่ตรงกับ datalist ให้เคลียร์ช่องกรอก
                  if (!isValid) {
                    alert("กรุณาเลือกจังหวัดจากรายการ");
                    document.getElementById("province").value = ""; // เคลียร์ช่องกรอก
                  }
                }
              </script>

              <!-- รหัสไปรษณีย์-->
              <div class="col-md-6 mb-3">

                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingPostcode" placeholder="รหัสไปรษณีย์" name="postcode">
                  <label for="floatingPostcode">รหัสไปรษณีย์</label>
                </div>
              </div>
            </div>
            <div class="row g-2"> <!-- ลด g-3 เป็น g-2 เพื่อลดช่องว่าง -->
              <div class="col-md-12">
                <div class="form-floating mb-2"> <!-- ลด mb-3 เป็น mb-2 -->
                  <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email">
                  <label for="floatingEmail">Email</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating mb-2"> <!-- ลด mb-3 เป็น mb-2 -->
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                  <label for="floatingPassword">Password</label>
                </div>
              </div>
            </div>
            <div class="form-group mt-3 d-flex justify-content-end align-items-center">
              <span class="text-danger me-3">ตรวจสอบข้อมูลให้ถูกต้อง แล้วกดยืนยัน</span>
              <div class="btn-container">
                <button type="submit" name="submit_form">ยืนยัน</button>
              </div>
            </div>

          </div>



      </div>
      </form>


    </div>

  </div>
  </div>
  <?php
  if (isset($_POST['submit_form'])) {
    // เข้ารหัสรหัสผ่าน
    if (!empty($_POST['password'])) {
      $stdpassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // ใช้ password_hash แทน md5
    } else {
      echo "<script>alert('กรุณากรอกรหัสผ่าน');</script>";
      exit;
    }

    // ตรวจสอบว่า Std_id มีในฐานข้อมูลแล้วหรือยัง
    $std_id = mysqli_real_escape_string($conn, $_POST['studentId']);
    $sql_check_id = "SELECT * FROM student WHERE Std_id = '$std_id'";
    $result_check_id = mysqli_query($conn, $sql_check_id);

    if (mysqli_num_rows($result_check_id) > 0) {
      echo "<script>alert('รหัสนิสิตนี้มีในระบบแล้ว กรุณาเข้าสู่ระบบ');</script>";
      exit;
    }

    // ตรวจสอบและอัปโหลดไฟล์รูปภาพ
    $std_picture = '';
    if (isset($_FILES['Std_picture']) && $_FILES['Std_picture']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['Std_picture']['tmp_name'];
      $fileName = $_FILES['Std_picture']['name'];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

      // ตรวจสอบประเภทไฟล์
      if (in_array($fileExtension, $allowedFileExtensions)) {
        // ตรวจสอบขนาดไฟล์ (5MB)
        if ($_FILES['Std_picture']['size'] <= 5000000) { // 5MB
          $newFileName = "profile_" . $_POST['studentId'] . "." . $fileExtension;
          $uploadFileDir = 'profile_pic/';
          $dest_path = $uploadFileDir . $newFileName;

          if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
          }

          // ย้ายไฟล์ไปยังปลายทาง
          if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $std_picture = $newFileName;
          } else {
            echo "<script>alert('ไม่สามารถอัปโหลดไฟล์ได้');</script>";
            exit;
          }
        } else {
          echo "<script>alert('ขนาดไฟล์ใหญ่เกินไป (ต้องไม่เกิน 5MB)');</script>";
          exit;
        }
      } else {
        echo "<script>alert('ไฟล์ที่อัปโหลดต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น');</script>";
        exit;
      }
    }

    // ดึงข้อมูล Major_id และ Tec_id จากตาราง major
    $major_name = mysqli_real_escape_string($conn, $_POST['branch']);
    $sql_major = "SELECT m.Major_id, t.Tec_id AS Tec_id1, t2.Tec_id AS Tec_id2 
                  FROM major m 
                  JOIN teacher t ON m.Major_id = t.Major_id
                  LEFT JOIN teacher t2 ON m.Major_id = t2.Major_id AND t2.Tec_id != t.Tec_id
                  WHERE m.Major_name = '$major_name'";
    $result_major = mysqli_query($conn, $sql_major);
    $major_data = mysqli_fetch_assoc($result_major);

    if ($major_data) {
      $major_id = $major_data['Major_id'];
      $tec_id1 = $major_data['Tec_id1'];
      $tec_id2 = $major_data['Tec_id2'] ?? null; // ใช้ null ถ้าไม่มี Tec_id2

      // เพิ่มข้อมูลลงใน student
      $sqli = "INSERT INTO student (Std_id, Id_number, Std_prefix, Std_name, Std_surname, Major_id, Grade_level, GPA, GPAX, CGX, Std_phone, Std_email, Std_picture, Std_pwd, Academic_year, Std_add, Province, Zip_id) 
                VALUES ('{$_POST['studentId']}', '{$_POST['idCard']}', '{$_POST['prefix']}', '{$_POST['name']}', '{$_POST['surname']}', '$major_id', '{$_POST['year']}', '{$_POST['GPA']}', '{$_POST['GPAX']}', '{$_POST['CGX']}', '{$_POST['phone']}', '{$_POST['email']}', '$std_picture', '$stdpassword', '{$_POST['Acayear']}', '{$_POST['address']}', '{$_POST['province']}', '{$_POST['postcode']}')";

      if (mysqli_query($conn, $sqli)) {
        // เพิ่มข้อมูลลงใน proposal
        $student_id = $_POST['studentId'];
        $acayear = mysqli_real_escape_string($conn, $_POST['Acayear']);
        $proposal_sql = "INSERT INTO proposal (
                    Std_id, Sug_year, Pro_status, Com_status, Proposal_name, File_name, Company_id, Note
                ) VALUES (
                    '$student_id', '$acayear', 
                    4, 4, '', '', NULL, ''
                )";
        mysqli_query($conn, $proposal_sql);

        // เพิ่มข้อมูลลงใน advisor
        $advisor_sql = "INSERT INTO advisor (Tec_id1, Tec_id2, Std_id)
                                VALUES ('$tec_id1', '$tec_id2', '$student_id')";
        mysqli_query($conn, $advisor_sql);

        echo "<script>alert('สมัครใช้งานสำเร็จ Please sign in'); window.location='index.php';</script>";
      } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
      }
    } else {
      echo "<script>alert('ไม่พบข้อมูลสาขาที่เลือก');</script>";
    }
  }
  ?>






  <script>
    document.getElementById("profileBox").addEventListener("click", function() {
      document.getElementById("profileImage").click();
    });

    document.getElementById("profileImage").addEventListener("change", function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById("displayProfileImage").src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>


</body>

</html>