
<?php
    session_start();
    include_once("connectdb.php");
?>

<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>เข้าสู่ระบบ</title>
<!-- icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- ฟ้อนต์ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .form-signin {
        background-color: white;
        border-radius: 0.5rem;
        padding: 2rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }
</style>
</head>

<body>
    <div class="form-signin">
        <a href="index.php" class="btn position-absolute top-0 end-0 m-2">
            <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <form method="POST" action="">
            <h1 class="h5 mb-3 fw-normal"><span >เข้าสู่ระบบ</span></h1>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput"><span>Email address</span></label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="pwd" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword"><span >Password</span></label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" name="Submit"><span >เข้าสู่ระบบ</span></button>
        </form>
        <br>
        <div class="text-center">
            <h1 class="h5 mb-3 fw-normal"><span >ยังไม่มีสมาชิก/<a href="register.php">สมัครสมาชิก</a></span></h1>
        </div>
    </div>

    <?php
if (isset($_POST['Submit'])) {
    $sql = "SELECT * FROM student WHERE Std_email = '{$_POST['email']}' AND Std_pwd = '".md5($_POST['pwd'])."'";
    $rs = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($rs);

    if ($num > 0) {
        $data = mysqli_fetch_array($rs);
        $_SESSION['Std_id'] = $data['Std_id'];
        echo "<script>window.location='std_home.php';</script>";
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
        exit;
    }
    var_dump($_SESSION);
}
?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
