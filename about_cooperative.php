<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวประชาสัมพันธ์</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap');

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Sarabun', sans-serif;
        }

        .header {
            text-align: left;
            position: relative;
        }

        .header h1 {
            font-size: 4rem;
            font-weight: 700;
            color: #1E88E5; /* สีฟ้า */
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2); /* เงา */
            display: inline-block;
            margin: 0;
        }

        .underline {
            width: 200px; /* ขยายความกว้าง */
            height: 5px;
            background-color: #90CAF9;
            position: absolute;
            top: 65px; /* ปรับให้ต่ำลงจากตัวอักษร */
            left: 130px; /* ขยับให้เริ่มจากขวาขึ้นนิดนึง */
        }

        .subtext {
            font-size: 2rem;
            color: black;
            font-weight: 400;
            margin-top: 1px; /* เพิ่มช่องว่างระหว่างเส้นกับข้อความ */
            margin-left: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>MBS</h1>
        <div class="underline"></div>
        <div class="subtext">ข่าวประชาสัมพันธ์</div>
    </div>
    
</body>
</html>
