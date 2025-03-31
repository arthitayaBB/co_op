<?php 
session_start();
include('connectdb.php'); 

// ตรวจสอบว่ามีการส่งข้อมูลผ่านฟอร์มหรือไม่
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // เชื่อมต่อฐานข้อมูล
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // สร้าง SQL Query เพื่อตรวจสอบข้อมูลผู้ใช้
    $sql = "SELECT * FROM adminn WHERE Ad_email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // ป้องกัน SQL Injection โดยการ bind parameter
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่ามีข้อมูลผู้ใช้หรือไม่
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // เปรียบเทียบรหัสผ่านโดยใช้ MD5
        if (md5($password) === $row['Ad_pwd']) {
            // ถ้ารหัสผ่านถูกต้อง จัดเก็บข้อมูลใน session
            $_SESSION['Admin_id'] = $row['Admin_id'];
            $_SESSION['Ad_name'] = $row['Ad_name'];
            $_SESSION['Ad_surname'] = $row['Ad_surname'];
            $_SESSION['user_email'] = $row['Ad_email'];
            
            // เปลี่ยนเส้นทางไปยังหน้า indexteacher.php
            header("Location: indexteacher.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }

    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1885ed">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Login Page</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Quicksand", sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #111;
            width: 100%;
            overflow: hidden;
        }
        .ring {
            position: relative;
            width: 450px;
            height: 450px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ring i {
            position: absolute;
            inset: 0;
            border: 2px solid #fff;
            transition: 0.5s;
        }
        .ring i:nth-child(1) {
            border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
            animation: animate 6s linear infinite;
            border-color: #0078ff;
        }
        .ring i:nth-child(2) {
            border-radius: 41% 44% 56% 59%/38% 62% 63% 37%;
            animation: animate 4s linear infinite;
            border-color: #0057b8;
        }
        .ring i:nth-child(3) {
            border-radius: 41% 44% 56% 59%/38% 62% 63% 37%;
            animation: animate2 10s linear infinite;
            border-color: #00aaff;
        }
        .ring:hover i {
            border: 6px solid var(--clr);
            filter: drop-shadow(0 0 20px var(--clr));
        }
        @keyframes animate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes animate2 {
            0% { transform: rotate(360deg); }
            100% { transform: rotate(0deg); }
        }
        .login {
            position: absolute;
            width: 300px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }
        .login h2 {

            font-size: 2em;
            color: #0078ff;
        }
        .login .inputBx {
            position: relative;
            width: 100%;
        }
        .login .inputBx input {
            position: relative;
            width: 100%;
            padding: 12px 20px;
            background: transparent;
            border: 2px solid #fff;
            border-radius: 15px;
            font-size: 1.2em;
            color: #fff;
            box-shadow: none;
            outline: none;
            transition: 0.3s;
        }
        .login .inputBx input[type="submit"] {
            width: 100%;
            background: #0078ff;
            background: linear-gradient(45deg, #0078ff, #0057b8);
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .login .inputBx input[type="submit"]:hover {
            background: linear-gradient(45deg, #0057b8, #0078ff);
            transform: scale(1.05);
        }
        .login .inputBx input::placeholder {
            color: rgba(255, 255, 255, 0.75);
        }
        .login .links {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .login .links a {
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }
        .login .links a:hover {
            color: #0078ff;
        }
    </style>
</head>
<body>

<div class="ring">
    <i></i>
    <i></i>
    <i></i>
</div>

<div class="login">
    <h2>Login</h2>
    <form method="POST">
        <div class="inputBx">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="inputBx">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="inputBx">
            <input type="submit" value="Sign in" name="login">
        </div>
       
    </form>
</div>

</body>
</html>
