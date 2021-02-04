<?php
	session_start();
	if(isset($_SESSION['UEmail'])) {
		session_destroy();
		echo "<script>window.open('Login.php','_self');</script>";
	}
?>