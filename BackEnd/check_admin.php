<?php
session_start();
include('connectdb.php');

$Adminid = $_SESSION['Admin_id'] ?? null;

if (!$Adminid) {
    echo "
    <div style='text-align: center; font-family: Arial, sans-serif; margin-top: 50px;'>
        <h2 style='color: #d9534f;'>เกิดข้อผิดพลาด</h2>
        <p style='font-size: 18px;'>ไม่พบข้อมูลผู้ดูแลระบบ กรุณาล็อกอินใหม่</p>
        <p style='font-size: 16px;'>ระบบกำลังพาคุณเข้าสู่หน้าล็อกอินใหม่ใน 
            <span id='countdown' style='color: red; font-weight: bold;'>5</span> วินาที...</p>
        <div style='margin-top: 20px;'>
            <div id='progress-bar' style='width: 100px; height: 10px; background-color: #ddd; border-radius: 5px; overflow: hidden; display: inline-block;'>
                <div id='progress' style='width: 100%; height: 100%; background-color: #d9534f; transition: width 1s linear;'></div>
            </div>
        </div>
    </div>

    <script>
        var timeLeft = 5;
        var countdown = document.getElementById('countdown');
        var progress = document.getElementById('progress');

        var timer = setInterval(function() {
            timeLeft--;
            countdown.textContent = timeLeft;
            progress.style.width = (timeLeft * 20) + '%';

            if (timeLeft <= 0) {
                clearInterval(timer);
                window.location.href = 'login.php';
            }
        }, 1000);
    </script>
    ";
    exit();
}
