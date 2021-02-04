<?php
	session_start();
	
	if(isset($_SESSION['UEmail'])) {
		$Uemail=$_SESSION['UEmail'];
	}
	include("header.php");
?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
		<?php
			$user=$_SESSION['UEmail'];
			$getUser="select * from users where UEmail='$user'";
			$runUser=mysqli_query($con,$getUser);
			$row=mysqli_fetch_array($runUser);
			$userName=$row['Uname'];
		?>
		<title title='<?php echo "$userName"; ?>'><?php echo "$userName"; ?></title>
		<style>
			#post {
				position:relative;
				opacity:0;
			}
			label {
				position:relative;
				left:10%;
				border:none;
				height:100px;
				line-height:40px;
			}
			#b2 {
				position:relative;
				left:-10%;
			}
		</style>
	</head>
	<body>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<form action="home.php?Uid='<?php echo $userId; ?>'" method="post" enctype="multipart/form-data">
						<div class="form-group" style="text-align:center;">
						<input type="text" class="form-control" name='content' placeholder="What's on your mind ?" style="border:1px solid #3b5998; "><br>
						<label>Select Image</label>
						<input id="post" type="file" name="uploadImage">&nbsp;&nbsp;&nbsp;
						<button class="btn btn-default" style="background-color:#3b5998; color:white;"id="b2" name="post">Post</button>
						</div>
					</form>
				<?php insertPost(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h2 class="well" style="color:#3b5998; text-align:center;"><b>News Feed</b><br></h2>
				</div>
			</div>
		</div>
		<?php getPosts(); ?>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>