<html>
	<head>
		<title>Forgot Password</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
			<div class="col-sm-12">
			<center><h1 style="color:white; background-color:#3b5998; font-family:arial; border-radius:10px;"><strong>Facebook</strong></h1></center>
			</div>
			</div>
			<div class="row">
			<div class="col-sm-12">
			<center><h3 style="color:#3b5998; background-color:white; font-family:arial; border:2px solid #3b5998; border-radius:10px;"><strong><i>Forgot Password</i></strong></h3></center>
			</div>
			</div>
			<div class="row">
			<div class="col-sm-12">
			<form method="post">
				<input class="form-control" style="width:50%; border-radius:5px; height:auto; border:1px solid #3b5998;" type="email" placeholder="Enter Your Email" name="email" required />
				<br><hr>
				<pre style="color:#3b5998; opacity:0.5;"><b>Enter Your Friend Name Down Below</b></pre>
				<input class="form-control" style="width:50%; border-radius:5px; height:auto; border:1px solid #3b5998;" type="text" placeholder="someone" name="recover" required id="msg" /><br>
				<a href="SignIn.php" style="text-decoration:none; float:right; color:#3b5998; " title="Sign In">Back to Login</a><br><br>
				<button class="btn btn-info" style="width:50%; border-radius:5px; height:auto; border:1px solid #3b5998;" id="SignUp" name="submit" type="submit">Submit</button>
			</form>
			</div>
		</div>
	</body>
</html>
<?php
	session_start();
	include('connection.php');
	if(isset($_POST['submit'])) {
		$email=$_POST['email'];
		$recovery=$_POST['recover'];
		$selectUsers="select * from users where UEmail='$email' and recoveryAccount='$recovery'";
		$query=mysqli_query($con,$selectUsers);
		$checkUser=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$uid=$row['Uid'];
		if($checkUser==1) {
			echo "<script>window.open('changepassword.php','_self');</script>";
		}
		else {
			
			echo "<script>window.open('Login.php','_self');</script>";			
			exit();
		}
	}
?>