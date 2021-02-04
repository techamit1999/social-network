<?php
	session_start();
	include("header.php");
?>
<html>
	<head>
		<title>Messages</title>
	</head>
	<body>
		<div class="container">
		<div class="row">
			<?php
				if(isset($_GET['Uid'])) {
					global $con;
					$getId=$_GET['Uid'];
					$getrec="select *from users where Uid='$getId'";
					$runrec=mysqli_query($con,$getrec);
					$rowrec=mysqli_fetch_array($runrec);
					$recId=$rowrec['Uid'];
					$recName=$rowrec['Uname'];
				}
				$user=$_SESSION['UEmail'];
				$getsen="select * from users where UEmail='$user'";
				$runsen=mysqli_query($con,$getsen);
				$rowsen=mysqli_fetch_array($runsen);
				$senId=$rowsen['Uid'];
				$senName=$rowsen['Uname'];
			?>
			<div class="col-md-3" style='border: 2px solid #3b5998; border-radius:10px;'>
				<?php
					$user="select  *from users";
					$runUser=mysqli_query($con,$user);
					while($rowUser=mysqli_fetch_array($runUser)) {
						$uid=$rowUser['Uid'];
						$fname=$rowUser['Fname'];
						$lname=$rowUser['Lname'];
						$uimage=$rowUser['Uprofile'];
						$uname=$rowUser['Uname'];
						echo "
							<center>
							<a href='message.php?Uid=$uid' style='text-decoration:none; color:#3b5998;'>
								<img src='images/userprofile/$uimage' height='90px' width='90px' title='$uname' style='border-radius:50%;' />
								<strong>&nbsp; $fname $lname</strong><br><br>
							</a>
							</center>
							<br>
						";
					}
				?>
			</div>
			<div id="msg" class='col-md-6' style='border: 2px solid #3b5998; border-radius:10px; max-height:500px; overflow-y:scroll;'>
			<?php
				if(isset($_GET['Uid'])) {
					$uid=$_GET['Uid'];
					if($uid=="new") {
						echo "
							<form>
								<center><h3>select someone to start conversation</h3></center>
								<textarea class='form-control' style='position:relative;' disabled placeholder='enter your message'></textarea>
								<input class='btn btn-info' style='position:relative; left:0px; align:center;' type='submit' disabled value='send' />
							</form>
						";
					}
					else {
						
						global $con;
					$selmsg="select * from messages where (reciever='$recId') or (sender='$senId') or (reciever='$senId') or (sender='$recId') order by date";
					$runmsg=mysqli_query($con,$selmsg);
					$rowmsg=mysqli_fetch_array($runmsg);
					$findSen="select Uname from users where Uid='$recId'";
					$runSen=mysqli_query($con,$findSen);
					$rowSen=mysqli_fetch_array($runSen);
					$senName=$rowSen['Uname'];
					echo "<div style='posiiton:fixed;'><h2><center>$senName</center></h2></div>";
					while($rowmsg=mysqli_fetch_array($runmsg)) {
						$reciever=$rowmsg['reciever'];
						$sender=$rowmsg['sender'];
						$msgbody=$rowmsg['messageBody'];
						$date=$rowmsg['date'];
						if($reciever==$recId and $sender==$senId) {
							echo "
								<div title='$date' style='float:right; '>
									$msgbody
								</div><br><br>
							";
						} else if($reciever==$senId and $sender==$recId) {
							echo "
								<div title='$date' style='float:left; position:absolute;'>
									$msgbody
								</div><br><br>
							";
						}
					}
						echo "
							<form method='post'>
								<textarea class='form-control' style='position:relative;' placeholder='enter your message' name='msgbox'></textarea><br>
								<center><input class='btn btn-info' style='position:relative;  align:center;' type='submit' value='send' name='sendmsg' /></center>
							</form>
						";
					}
				}
			?>
			<?php
				global $con;
				if(isset($_POST['sendmsg'])) {
					$msg=$_POST['msgbox'];
					if($msg=="") {
						echo "<h4>Message cannot be Empty</h4>";
					}
					else if(strlen($msg)>=50) {
						echo "<h4>Message is too long</h4>";
					}
					else {
						$insert="insert into messages (reciever,sender,messageBody,date,mSeen) values('$recId','$senId','$msg',NOW(),'no')";
						$run=mysqli_query($con,$insert);
					echo "<script>window.open('message.php?UId=$uid','_self');</script>";
					}
				}
			?>
		</div>
		<div class='col-md-3' style='border: 2px solid #3b5998; background-color:#3b5998; height:500px; padding:20px; border-radius:20px; color:white;'>
		<?php
			global $con;
			if(isset($_GET['Uid'])) {
				$user=$_GET['Uid'];
				$getUser="select * from users where Uid='$user'";
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
				if($user!="new") {
					echo "
						<div style='border:1px solid #3b5998; padding:20px; margin-left:5px;'>
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
					";
				}
			}
		?>
		</div>
		</div>
		</div>
		<script>
			var div=document.getElementById('msg');
			div.scrollTop=div.scrollHeight;
		</script>
	</body>
</html>