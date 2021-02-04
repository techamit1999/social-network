<?php
	session_start();
	if(isset($_SESSION['UEmail'])) {
		$Uemail=$_SESSION['UEmail'];
	}
	include("header.php");
?>
<html>
	<head>
		<title>Find People</title>
		<style>
			
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
			<center>
				<h2 class="well" id="findNew">Find New People</h2><br><br>
			</center>
			<form method='post'>
				<input class="form-control" id="FindForm" type="text" name="searchUser" placeholder="Find Friends" />
				<br><br>
				<center><button class="btn btn-info" id="search" name='search' type="submit">Search</button></center>
			</form>
			</div>
			</div>
		</div>
			<br><br>
			<?php
				searchUser(); 
			?>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>