<?php
include_once("connectdb.php");

session_start();

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Company_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// คิวรีข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM company WHERE Company_id = $Company_id";
$result = mysqli_query($conn, $sql);
$company = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<style>
    .rounded-box {
        padding: 20px;
        border-radius: 15px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-size: 18px;
        color: #333;
    }
</style>

<body>
    <?php include("navbar.php"); ?>
    <br>

    <div class="container-fluid py-4">
        <?php if ($company): ?>
            <div class="card mx-auto shadow-lg border-0" style="max-width: 1100px; border-radius: 15px;">
                <div class="card-body p-4">
                    <h1 class="card-title text-center fw-bold " style="color: #333;"><?php echo htmlspecialchars($company['NamecomTH']); ?></h1>
                    <h1 class="card-title text-center fw-bold " style="color: #333;"><?php echo htmlspecialchars($company['NamecomEng']); ?></h1>
                    <hr>
                    <div class="row">
                        <p><strong>ตำแหน่งที่เปิดรับสมัคร : </strong> <?php echo $company['Position']; ?></p>
                        <p><strong>ลักษณะบริษัท : </strong></strong> <?php echo $company['Job_description']; ?></p>
                        <p><strong>ระยะเวลาการฝึกงาน : </strong> <?php echo $company['Duration']; ?></p>
                        <hr>

                        <p><strong>จังหวัด : </strong> <?php echo $company['Province']; ?></p>
                        <p><strong>ผู้ประสาน : </strong> <?php echo $company['Contact_com']; ?></p>
                        <p><strong>อีเมลบริษัท : </strong></strong> <?php echo $company['Com_email']; ?></p>
                        <p><strong>เบอร์ติดต่อบริษัท : </strong> <?php echo $company['Com_phone']; ?></p>
                        <p><strong>เบอร์โทรสาร : </strong></strong> <?php echo $company['Fax_number']; ?></p>
                        <p><strong>รหัสไปรณีย์ : </strong> <?php echo $company['Zip_id']; ?></p>
                        <p><strong>เว็บไซต์ :</strong>
                            <a href="<?php echo $company['Website']; ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo $company['Website']; ?>
                            </a>
                        </p>

                        <hr>

                        <p><strong>ปีการศึกษา : </strong></strong> <?php echo $company['Academic_year']; ?></p>
                        <p><strong>ที่อยู่ : </strong> <?php echo $company['Company_add']; ?></p>
                        <hr>
                        <iframe
                            src="<?php echo $company['Map']; ?>"
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>



                    </div>

                </div>

            </div>
            <div class="mt-3 d-flex justify-content-end" style="gap: 10px;">
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-house" style="vertical-align: middle;"></i> หน้าหลัก
                </a>
                <a href="company.php" class="btn btn-outline-secondary">
                    <i class="bi bi-collection" style="vertical-align: middle;"></i> สถานประกอบการทั้งหมด
                </a>
            </div>

    </div>

<?php else: ?>
    <div class="alert alert-warning text-center">
        <p>ไม่พบข้อมูลข่าวสาร</p>
    </div>
<?php endif; ?>

</div>


<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>

</html>