<?php
	session_start();
	include("header.php");
?>
<html>
	<head>
		<title title="View Your Post">View Your Post</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<div class="row">
			<div class="col-sm-12">
			<center>
				<h2>Comments</h2>
			</center>
			</div>
			<?php singlePost(); ?>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>