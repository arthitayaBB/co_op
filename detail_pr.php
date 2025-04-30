

<?php
include_once("connectdb.php");
session_start();

    // ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
    $pr_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // คิวรีข้อมูลจากฐานข้อมูล
    $sql = "
    SELECT p.*, c.NamecomTH, m.Major_name
    FROM public_relations p
    INNER JOIN company c ON p.Company_id = c.Company_id
    INNER JOIN major m ON c.Major_id = m.Major_id
    WHERE p.Pr_id = $pr_id
";


    $result = mysqli_query($conn, $sql);
    $pr = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดข่าวกิจกรรมสหกิจศึกษา
    </title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .carousel-container {
        width: 500px;
        margin: auto;
    }
    .carousel {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .carousel-inner img {
        border-radius: 15px;
    }
</style>
<body>
<?php include("navbar.php"); ?>
<br>


<!-- Carousel for Images -->
<div class="carousel-container fade-in">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
    <?php
    $first = true;
    for ($i = 1; $i <= 4; $i++) {
        $picture = $pr["Pr_picture$i"];
        if (!empty($picture)) {
            ?>
            <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                <img src="images/public_relations/<?php echo htmlspecialchars($picture); ?>" class="d-block w-100" alt="ภาพ <?php echo $i; ?>">
            </div>
            <?php
            $first = false;
        }
    }
    ?>
</div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div><br>
<hr>
<!-- แสดงข้อมูลประกาศ -->
<div class="container fade-in">

    <center><h1><strong></strong> <?php echo $pr['Pr_title']; ?></h1></center>
    <p> <?php echo $pr['Pr_detail']; ?></p>
    <p><strong>บริษัท:</strong> <?php echo $pr['NamecomTH']; ?></p>
    <p><strong>สาขา:</strong> <?php echo $pr['Major_name']; ?></p>
    <p><strong>ปีที่ประกาศ:</strong> <?php echo $pr['Pr_year']; ?></p>
    <p><strong>วันที่ประกาศ:</strong> <?php echo $pr['Pr_date']; ?></p>
</div>


<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
