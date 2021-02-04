<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			body {
				overflow-x:hidden;
			}
		</style>
	</head>
	<body>
		<?php
			include("connection.php");
			include("functions.php");
			$user=$_SESSION['UEmail'];
			$getUser="select * from users where UEmail='$user'";
			$runUser=mysqli_query($con,$getUser);
			$row=mysqli_fetch_array($runUser);
			$userId=$row['Uid'];
			$userName=$row['Uname'];
			$fname=$row['Fname'];
			$lname=$row['Lname'];
			$userDesc=$row['DescUser'];
			$userRelation=$row['RelationStatus'];
			$userPass=$row['Upassword'];
			$userEmail=$row['UEmail'];
			$userCountry=$row['Ucountry'];
			$userGender=$row['Ugender'];
			$userDob=$row['UDOB'];
			$userProfilePic=$row['Uprofile'];
			$userCoverPhoto=$row['Ucover'];
			$userRegDate=$row['UregDate'];
			$userRecovery=$row['recoveryAccount'];
			$userPosts="select * from posts where userId='$userId'";
			$runPosts=mysqli_query($con,$userPosts);
			$posts=mysqli_num_rows($runPosts);
		?>
		<div class="container">
			<nav class="navbar  navbar-expanded-md">
			<h1><a class="navbar-brand" style="text-decoration:none; font-size:50px; color:#3b5998;" href="home.php">Facebook</a></h1>
			<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#mydp" aria-expanded="false" aria-controls="mydp">Menu</button>
			<div class="collapse" id="mydp">
			<ul class="navbar nav nav-tabs justify-content-center nav-fill">
				<li class="nav-item"><a class="nav-link" href="profile.php"><?php echo $fname; ?></a></li>
				<li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="members.php">Find People</a></li>
				<li class="nav-item"><a class="nav-link" href="message.php?Uid=new">Messages</a></li>
				<li class="nav-item"><a class="nav-link" href='MyPost.php' id='mypost'>MyPosts <span class='badge badge-secondary'><?php echo $posts; ?></span></a></li>
				<li class="nav-item"><a class="nav-link" href='editProfile.php'>Edit Account</a></li>
				<li class="nav-item"><a class="nav-link" href='logout.php'>LogOut</a></li>
				<li class="nav-item">
					<form class="d-flex" method="get" action="result.php">
						<div class="form-group">
							<input type="text" name="userQuery" placeholder="Search">
							<button class="btn btn-default" style="color:white; background-color:#3b5998; border:none;" type="submit" name="Search">Search</button>
						</div>
					</form>
				</li>
			</ul>
			</div>
			</nav>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			$('#mydp').collapse({
				toggle: false;
			});
		</script>
	</body>
</html>