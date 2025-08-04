<?php
include_once("connectdb.php");
include ("checklogin.php");

$Std_id = $_SESSION['Std_id'] ?? 0;

if ($Std_id <= 0) {
    die("ยังไม่ได้เข้าสู่ระบบ");
}

$sql = "SELECT s.*, m.Major_name 
        FROM student s
        LEFT JOIN major m ON s.Major_id = m.Major_id
        WHERE s.Std_id = ?";

$stmt = $conn->prepare($sql); // ✅ แก้ตรงนี้
$stmt->bind_param("i", $Std_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
} else {
    die("ไม่พบข้อมูลนักศึกษา");
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .profile-box {
            max-width: 960px;
            margin: auto;
        }

        .avatar-img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .edit-link {
            float: right;
            font-size: 14px;
        }

        .label-title {
            font-weight: bold;
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
        <a href="std_home.php"> <i class="bi bi-x-circle-fill close-icon"></i>
    </div></a>

    <div class="container my-5 profile-box">
        <h3 class="mb-4">My profile</h3>

        <hr>
        <div class="row">
            <!-- รูปโปรไฟล์ -->
            <div class="col-md-4 text-center">
                <img src="profile_pic/<?= $student['Std_picture'] ?: 'default-avatar.png' ?>" class="avatar-img mb-3" alt="Avatar">
                <p>
                    <?= $student['Std_prefix'] . " " . $student['Std_name'] . " " . $student['Std_surname'] ?>
                    <br>
                    <a href="std_update_profile.php?std_id=<?= $student['Std_id'] ?>" class="d-block text-primary mt-2">(คลิกเพื่อแก้ไข)</a>
                </p>
            </div>


            <!-- ข้อมูลโปรไฟล์ -->
            <div class="col-md-8">

                <div class="mt-4">

                    <p><span class="label-title">Identification Card Number:</span> <?= $student['Id_number'] ?></p>
                    <p><span class="label-title">Student ID:</span> <?= $student['Std_id'] ?></p>
                    <p><span class="label-title">Name:</span> <?= $student['Std_prefix'] . " " . $student['Std_name'] . " " . $student['Std_surname'] ?></p>
                    <p><span class="label-title">Major:</span> <?= $student['Major_name'] ?></p>
                    <p><span class="label-title">Phone:</span> <?= $student['Std_phone'] ?></p>
                    <p><span class="label-title">Email:</span> <?= $student['Std_email'] ?></p>
                    <p><span class="label-title">Address:</span> <?= $student['Std_add'] ?></p>
                    <p><span class="label-title">Province:</span> <?= $student['Province'] ?></p>
                    <p><span class="label-title">Zipcode:</span> <?= $student['Zip_id'] ?></p>
                    <p>
                        <span class="label-title">GPA:</span> <?= $student['GPA'] ?> &nbsp;&nbsp;
                        <span class="label-title">GPAX:</span> <?= $student['GPAX'] ?> &nbsp;&nbsp;
                        <span class="label-title">CGX:</span> <?= $student['CGX'] ?>

                    </p>




                </div>
            </div>
        </div>
    </div>

</body>

</html>