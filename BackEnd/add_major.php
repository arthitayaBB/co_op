<?php
include 'check_admin.php';
include 'connectdb.php';

// กำหนดค่าตัวแปรเริ่มต้น
$Major_id = $Major_name = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $Major_id = $_POST['Major_id'];
    $Major_name = $_POST['Major_name'];

    // SQL คำสั่งสำหรับเพิ่มข้อมูลสาขา
    $query = "INSERT INTO major (Major_id, Major_name) VALUES ('$Major_id', '$Major_name')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('เพิ่มข้อมูลสาขาสำเร็จ'); window.location.href = 'indexmajor.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสาขา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>

    <!-- พื้นหลัง Particles -->
    <div id="particles-js"></div>

    <button class="toggle-btn" onclick="toggleDarkMode()">Dark/Light Mode</button>

    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
        
        <h2 class="heading">เพิ่มข้อมูลสาขา</h2>
        <form method="POST">
            <div class="form-group">
                <label for="Major_id" class="form-label">รหัสสาขา</label>
                <input type="text" class="form-control" id="Major_id" name="Major_id" required>
            </div>
            <div class="form-group">
                <label for="Major_name" class="form-label">ชื่อสาขา</label>
                <input type="text" class="form-control" id="Major_name" name="Major_name" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ตรวจสอบสถานะของโหมด Dark เมื่อโหลดหน้า
        if (localStorage.getItem("dark-mode") === "enabled") {
            document.body.classList.add("dark-mode");
        }

        // ฟังก์ชันสลับโหมด Dark/Light
        function toggleDarkMode() {
            const body = document.body;
            const currentMode = body.classList.contains("dark-mode");

            if (currentMode) {
                body.classList.remove("dark-mode");
                localStorage.setItem("dark-mode", "disabled");
            } else {
                body.classList.add("dark-mode");
                localStorage.setItem("dark-mode", "enabled");
            }
        }

        // Particles.js configuration
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 100,
                    "density": {
                        "enable": true,
                        "value_area": 1000
                    }
                },
                "color": {
                    "value": "#7dc9f5"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.6,
                    "random": false,
                    "anim": {
                        "enable": true,
                        "speed": 1.5,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 5,
                        "size_min": 0.5,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#7dc9f5",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 4,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    }
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
