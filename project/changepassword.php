<html>
	<head>
		<title>Forgot Password</title>
		<link rel='stylesheet' href='css/bootstrap.min.css'>
		<style>
			
		</style>
	</head>
	<body>
		<div class='container'>
		<div class='row'>
			<div class='col-sm-12'>
			<center><h1 style="color:white; background-color:#3b5998; font-family:arial; border-radius:10px;"><strong>Facebook</strong></h1></center>
			<center><h3 style="color:#3b5998; background-color:white; font-family:arial; border:2px solid #3b5998; border-radius:10px;"><strong><i>Change Password</i></strong></h3></center>
			<form method="post">
				<center>
					<br>
					<input class='form-control' style="width:50%; border-radius:5px; height:auto; border:1px solid #3b5998;" type="password" placeholder="Enter Your New Your Password" name="modpass" required />
					<br>
					<input class='form-control' style="width:50%; border-radius:5px; height:auto; border:1px solid #3b5998;" type="password" placeholder="Re-Enter Your Password" name="repass" required id="msg" /><br>
					<button class='btn btn-info' style="width:50%; border-radius:5px; height:auto; border:1px solid #3b5998;"id="SignUp" name="change" type="submit">Change Password</button>
				</center>
			</form>
			</div>
		</div>
		</div>
		<script src='js/jquery.js'></script>
		<script src='js/bootstrap.min.js'></script>
	</body>
</html>
<?php
	session_start();
	include('connection.php');
	if(isset($_POST['change'])) {
		$pass=$_POST['modpass'];
		$repass=$_POST['repass'];
		$email=$_SESSION['UEmail'];
		$getId="select Uid from users where UEmail='$email'";
		$runId=mysqli_query($con,$getId);
		$row=mysqli_fetch_array($runId);
		$userId=$row['Uid'];
		if($pass==$repass) {
			if(strlen($pass)>=6&&strlen($pass)<=60) {
				$update="update users set Upassword='$pass' where Uid='$userId'";
				$run=mysqli_query($con,$update);
				echo "<script>alert('Password Changed....');</script>";
				echo "<script>window.open('Login.php','_self');</script>";
			} else {
				echo "<script>alert('Password should be greater than 6 characters');</script>";
			}
		} else {
			echo "<script>alert('Password did not match');</script>";
			echo "<script>window.open('changepassword.php','_self');</script>";
		}
	}
?>