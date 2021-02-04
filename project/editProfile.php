<?php
	session_start();
	include("header.php");
?>
<html>
	<head>
		<title>Edit Your Profile</title>
		<link rel='stylesheet' href='css/bootstrap.min.css'>
		<style>
	
		</style>
	</head>
	<body>
		<div class="container">
			<div class='table-responsive'>
			<form method="post" enctye="multipart/form-data">
				<table class='table table-stripped table-hover' style="border:1px solid #3b5998; border-collapse:collapse; padding:2px; width:100%;">
					<tr  valign="middle" >
						<th colspan="2" style="border:1px solid #3b5998; ">
							<h2>Edit Your Profile</h2>
						</th>
					</tr>
					<tr align="center" valign="middle">
						<td >
							Change Your First Name
						</td>
						<td align="left" >
							<input class="form-control" type="text" name="fname" required value="<?php echo $fname; ?>" />
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Change Your Last Name
						</td>
						<td align="left">
							<input class="form-control" type="text" name="lname" required value="<?php echo $lname; ?>" />
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Change Your User Name
						</td>
						<td align="left">
							<input class="form-control" type="text" name="uname" required value="<?php echo $userName; ?>" />
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Description
						</td>
						<td align="left">
							<input class="form-control" type="text" name="descuser" required value="<?php echo $userDesc; ?>" />
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Relationship Status
						</td>
						<td align="left">
							<select class="form-control" name="relation">
								<option><?php echo $userRelation; ?></option>
								<option>Engaged</option>
								<option>Married</option>
								<option>Single</option>
								<option>In a Relationship</option>
								<option>It's Complicated</option>
								<option>Seperated</option>
								<option>Divorced</option>
								<option>Widowed</option>
							</select>
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Change Your Password
						</td>
						<td align="left">
							<input class="form-control" type="password" name="password" id="mypass" required value="<?php echo $userPass; ?>" style="width:70%;" /><br>
							<input class="form-control" type="checkbox" id='check' onClick="showPassword()" value="Show Password" style="align:left; width:2%; position:relative; top:0px;"  />Show Password
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Change Your Email
						</td>
						<td align="left">
							<input class="form-control" type="email" name="email" required value="<?php echo $userEmail; ?>" />
						</td>
					</tr>
					<tr valign="middle">
						<td >
							Change Your Country
						</td>
						<td align="left">
							<select class="form-control" name="country">
								<option><?php echo $userCountry; ?></option>
								<option>India</option>
								<option>Pakistan</option>
								<option>United States</option>
								<option>Japan</option>
								<option>UK</option>
								<option>France</option>
								<option>Germany</option>
							</select>
						</td>
					</tr>
					<tr valign="middle">
						<td>
							Forgotten password
						</td>
						<td align="left">
							<h2>Recovery Question</h2>
							<strong>What is Your School best Friend name?</strong>
							<textarea class="form-control" cols="50" rows="4" name="content" placeholder="someone"></textarea><br>
							<pre>Answer the above question we will ask this question if you forgot your password.</pre><br><br>
						</td>
					</tr>
					<tr valign="middle">
						<td>
							Change Your Gender
						</td>
						<td align="left">
							<select class="form-control" name="gender">
								<option><?php echo $userGender; ?></option>
								<option>Male</option>
								<option>Female</option>
								<option>Others</option>
							</select>
						</td>
					</tr>
					<tr valign="middle">
						<td>
							Change Your Birth Date
						</td>
						<td align="left">
							<input class="form-control" type="date" name="dob" required value="<?php echo $userDob; ?>" />
						</td>
					</tr>
					<tr align="center" valign="middle">
						<td colspan="2">
							<input class="btn btn-info" type="submit" style="width:250px; " value="update" name="update" required style="text-align:center;" />
						</td>
					</tr>
				</table>
			</form>	
			</div>
		</div>
		<script>
			function showPassword() {
				var  check=document.getElementById('check');
				var change=document.getElementById('mypass');
				if(check.checked==true) {
					change.type='text';
				} else {
					change.type='password';
				}
			}
		</script>
		<script src='js/jquery.js'></script>
		<script src='js/bootstrap.min.js'></script>
	</body>
</html>
<?php
	if(isset($_POST['update'])) {
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$uname=$_POST['uname'];
		$userdesc=$_POST['descuser'];
		$relation=$_POST['relation'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$country=$_POST['country'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$btn=$_POST['content'];
		if($btn=="") {
			echo "<script>alert('Please Enter something');</script>";
			echo "<script>window.open('editProfile.php?Uid=$userId','_self');</script>";
			exit();
		} else {
			$update="update users set recoveryAccount='$btn' where Uid='$userId'";
			$run=mysqli_query($con,$update);
			if($run) {
				echo "<script>alert('working...');</script>";
				echo "<script>window.open('editProfile.php?Uid=$userId','_self');</script>";
			} else {
				echo "<script>alert('Error');</script>";
				echo "<script>window.open('editProfile.php?Uid=$userId','_self');</script>";
			}
		}
		$update="update users set Fname='$fname',Lname='$lname',Uname='$uname',DescUser='$fname',RelationStatus='$relation',Fname='$fname',Upassword='$password',UEmail='$email',Ucountry='$country',Ugender='$gender',UDOB='$dob' where UId='$userId'";
		$run=mysqli_query($con,$update);
		if($run) {
			echo "<script>alert('Profile Updated Succesfully');</script>";
			echo "<script>window.open('editProfile.php?Uid=$userId','_self');</script>";
		} else {
			echo "<script>alert('Error');</script>";
			echo "<script>window.open('editProfile.php?Uid=$userId','_self');</script>";
		}
	}
?>