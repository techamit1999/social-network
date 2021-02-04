<?php
	session_start();
	include("header.php");
?>
<html>
	<head>
		<?php
			$user=$_SESSION['UEmail'];
			$getUser="select * from users where UEmail='$user'";
			$runUser=mysqli_query($con,$getUser);
			$row=mysqli_fetch_array($runUser);
			$userName=$row['Uname'];
		?>
		<title title='<?php echo "$userName"; ?>'><?php echo "$userName"; ?></title>
		<style>
			
		</style>
	</head>
	<body>
		<div class="row">
			<div class="col-md-1"></div>
			<?php
				echo "
					<div class='col-md-3' style='border:1px solid #3b5998; border-radius:25px; padding:20px;'>
						<div class='well'><h1><center>Profile Picture</center></h1><br></div>
						<form action='profile.php' method='post' enctype='multipart/form-data'>
						<label style='height:30px; border:1px solid black;'>Select Cover</label>
						<center>
							<input style='position:relative; top:-40px; opacity:0;' id='changeprofile' type='file' name='Uprofile' value='Change Cover' size='100' />
							<button class='btn btn-info' style='position:relative; top:-70px;' type='submit' id='changeprofilebutton' name='submit1'>Change Profile</button>
						</center>
						</form><br>
						<center><img class='img-responsive rounded' style='border-radius:50%;' id='profilepic' src='images/userprofile/$userProfilePic' alt='profile picture'/></center>
					</div>
					<div class='col-md-1'></div>
					<div class='col-md-6' style='border:1px solid #3b5998; border-radius:25px; padding:20px;'>
						<div class='well'><h1><center>Cover Picture</center></h1><br></div>
						<form action='profile.php' method='post' enctype='multipart/form-data'>
						<label style='height:30px; border:1px solid black;'>Select Profile</label>
						<center>
							<input style='position:relative; top:-40px; opacity:0;' id='change' type='file' name='ucover' />
							<button class='btn btn-info' style='position:relative; top:-40px;' type='submit' id='changebutton' name='submit' >Change cover</button>
						</center>
						</form>
						<center><img class='img-responsive rounded' id='cover' src='images/cover/$userCoverPhoto' style='width:80%; height:auto;' alt='cover photo' /></center>
					</div>
						
				";
			?>
		</div>
			<?php
				if(isset($_POST['submit'])) {
					$ucover=$_FILES['ucover']['name'];
					$imgTmp=$_FILES['ucover']['tmp_name'];
					if($ucover=="") {
						exit();
					} else {
						move_uploaded_file($imgTmp,"images/cover/$ucover");
						$update="update users set Ucover='$ucover' where Uid='$userId'";
						$run=mysqli_query($con,$update);
						echo "<script>window.open('profile.php','_self');</script>";
					}
				}
				if(isset($_POST['submit1'])) {
					$uprofile=$_FILES['Uprofile']['name'];
					$imgTmp=$_FILES['Uprofile']['tmp_name'];
					if($uprofile=="") {
						exit();
					} else {
						move_uploaded_file($imgTmp,"images/userprofile/$uprofile");
						$update="update users set Uprofile='$uprofile' where Uid='$userId'";
						$run=mysqli_query($con,$update);
						echo "<script>window.open('profile.php','_self');</script>";
					}
				}
			?>
			<?php
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
				$userRegDate=$row['UregDate'];
				echo "
					<div class='row'><div class='col-sm-12'><br><br></div></div>
					<div class='row'>
						<div class='col-sm-3'></div>
						<div class='col-sm-6' style='border:1px solid #3b5998; padding:20px;'>
						<center>
						<h1 style='margin-top:none; padding-top:none;'>About </h1>
						<b><i><u>$fname $lname</u></i></b><br><br>
						$userDesc<br><br>
						</center>
						<b>RelationshipStatus :</b> $userRelation<br><br>
						<b>Lives in</b> $userCountry<br><br>
						<b>Member Since : </b> $userRegDate<br><br>
						<b>Gender : </b> $userGender<br><br>
						<b>Date of Birth :</b> $userDob<br><br>
						</div>
					</div>
				";
			?>
			<?php 
				getProfilePosts();
				include('delete.php');
			?>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>