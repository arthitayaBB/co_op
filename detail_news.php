<?php
include_once("connectdb.php");
session_start();


// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$N_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// คิวรีข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM news WHERE N_id = $N_id";
$result = mysqli_query($conn, $sql);
$news = mysqli_fetch_assoc($result);
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
        <?php if ($news): ?>
            <div class="card mx-auto shadow-lg border-0" style="max-width: 1100px; border-radius: 15px;">
                <img src="images/news/<?php echo htmlspecialchars($news['N_picture']); ?>" class="card-img-top" style="border-top-left-radius: 15px; border-top-right-radius: 15px;" alt="News Image">
                <div class="card-body p-4">
                    <h1 class="card-title text-center fw-bold " style="color: #333;"><?php echo htmlspecialchars($news['N_heading']); ?></h1>
                    <p class="card-text fs-5"><?php echo nl2br(htmlspecialchars($news['N_detail'])); ?></p>
                    <hr>
                    <div class="row">
                        <p><strong>ปีที่ประกาศ:</strong> <?php echo $news['N_year']; ?></p>
                        <p><strong>วันที่ประกาศ:</strong> <?php echo $news['N_date']; ?></p>
                        <p><strong>ที่มา:</strong> <?php echo $news['N_refer']; ?></p>
                    </div>
                    
                </div>
                
            </div>
            <div class="mt-3 d-flex justify-content-end" style="gap: 10px;">
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="bi bi-house" style="vertical-align: middle;"></i> หน้าหลัก
    </a>
    <a href="news.php" class="btn btn-outline-secondary">
        <i class="bi bi-collection" style="vertical-align: middle;"></i> ข่าวทั้งหมด
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