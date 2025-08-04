<?php
	session_start();
	
	unset($_SESSION['Std_id']);
	
	echo "<script>";
			echo "window.location='index.php'; ";
			echo "</script>";
 
?>