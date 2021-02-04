<html>
	<head>
		<title title="Login">Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			body {
				overflow-x:hidden;
			}
			.form-controls {
				width:50%;
			}
			a {
				float:right;
				margin-right:25%;
			}
		</style>
	</head>
	<body>
		<div class="row">
			<div class="col-sm-12">
				<center>
					<h1 style="background-color:#3b5998; color:white;">Facebook</h1>
				</center>
			</div>
		</div>
		
		<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<br>
			<center>
				<h3 style="color:#3b5998;"><i>Login to Facebook</i></h3>
				<form action="SignIn.php" method="post" >
						<input class="form-control" type="email" name="email" placeholder="Enter Your Email" required>
						<br><br>
						<input class="form-control" type="password" name="pass" placeholder="Enter Your Password" required>
						<br><br>
						<a href="forgotPassword.php" title="Reset Your Password">Forgot Your Password</a>
						<br><br>
						<a href="SignUp.php" title="Sign Up">Don't have a Account, SignUp</a>
						<br><br>
						<button class="btn btn-info" style="background-color:#3b5998; border:none;" name="Login" type="submit" value="Login">Login</button>
				</form>
			</center>
			</div>
		</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>