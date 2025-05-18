<?php
session_start();
if (!isset($_SESSION['Std_id'])) {
  echo '<p style="color:red;">' . htmlspecialchars('Access Denied! กรุณาเข้าสู่ระบบ', ENT_QUOTES, 'UTF-8') . '</p>';
  header('Refresh: 3; URL=../co_op/index.php');
  exit;
}
?>
