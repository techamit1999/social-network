<html>
	<head>
		<title title="SignUp">SignUp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
			<div class="col-sm-12" class="well">
				<center>
					<h1 style="background-color:#3b5998; color:white;">Facebook</h1>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12" class="well">
				<br>
				<center>
					<h3 style="color:#3b5998;"><i>Join Facebook</i></h3>
				</center>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<center>
					<form action="NewUser.php" method="post">
						<input class="form-controls" type="text" name="fname" placeholder="first name" required>
						<br><br>
						<input class="form-controls" type="text" name="lname" placeholder="last name" required>
						<br><br>
						<input class="form-controls" id="password" type="password" name="Upass" placeholder="password" required>
						<br><br>
						<input class="form-controls" id="Email" type="email" name="email" placeholder="E-mail" required>
						<br><br>
						<select class="form-controls" name="Ucountry" required>
							<option disabled>Select Your Country</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>United States</option>
							<option>Japan</option>
							<option>UK</option>
							<option>France</option>
							<option>Germany</option>
						</select>
						<br><br>
						<select class="form-controls" name="Ugender" required>
							<option disabled>Select Your Gender</option>
							<option>Male</option>
							<option>Female</option>
							<option>Others</option>
						</select>
						<br><br>
						<input class="form-controls" type="date" name="Dob" placeholder="Date Of Birth" required>
						<br><br>
						<a href="Login.php" title="Sign In">Have a Account, Login</a>
						<br><br>
						<button class="btn btn-info" id="SignUp" type="submit" name="SignUp" style="background-color:#3b5998; border:none;">Create new Account</button>
					</form>
				</center>
			</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
<html>