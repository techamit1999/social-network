<?php
	session_start();
	
	if(isset($_SESSION['UEmail'])) {
		$Uemail=$_SESSION['UEmail'];
	}
	include("header.php");
?>
<html>
	<head>
		<title>Showing Results</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
		<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
		<center><h2 class="well" style="color:#3b5998; background-color:white; font-family:arial; border:2px solid #3b5998; border-radius:10px;"><i>See Your Results Here</i></h2></center>
		</div>
		</div>
		</div>
		<?php
			results();
		?>
		<script scr="js/jquery.js"></script>
		<script scr="js/bootstrap.min.js"></script>
	</body>
</html>