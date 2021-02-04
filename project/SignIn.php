<?php
	session_start();
	include('connection.php');
	if(isset($_POST['Login'])) {
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$selectUsers="select * from users where UEmail='$email' and Upassword='$pass' and status='verified'";
		$query=mysqli_query($con,$selectUsers);
		$checkUser=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$uid=$row['Uid'];
		if($checkUser!=0) {
			$_SESSION['UEmail']=$email;
			echo "<script>window.open('home.php?Uid=$uid','_self');</script>";
		}
		else {
			
			echo "<script>window.open('Login.php','_self');</script>";
			exit();
		}
	}
?>