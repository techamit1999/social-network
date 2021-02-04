<?php
	session_start();
	if(isset($_SESSION['UEmail'])) {
		$Uemail=$_SESSION['UEmail'];
	}
?>
<html>
	<head>
		<title>Find People</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<?php
			if(isset($_GET['Uid'])) {
				$uId=$_GET['Uid'];
			}
			if($uId<0||$uId=="") {
				echo "<script>window.open('home.php','_self');</script>";
			}
		?>
		<div class="container">
		<div class="row">
			<?php
				include("connection.php");
				include("functions.php");
				if(isset($_GET['Uid'])) {
					global $con;
					$uId=$_GET['Uid'];
					$select="select * from users where Uid='$uId'";
					$run=mysqli_query($con,$select);
					$row=mysqli_fetch_array($run);
					$id=$row['Uid'];
					$name=$row['Uname'];
					$uprofile=$row['Uprofile'];
					$fname=$row['Fname'];
					$lname=$row['Lname'];
					$descUser=$row['DescUser'];
					$country=$row['Ucountry'];
					$gender=$row['Ugender'];
					$regDate=$row['UregDate'];
					$user="select * from users where UEmail='$Uemail'";
					$runOwn=mysqli_query($con,$user);
					$rowOwn=mysqli_fetch_array($runOwn);
					$ownId=$rowOwn['Uid'];
					if($uId==$ownId) {
						echo "
							<div class='col-md-3'>
							<center>
								<h2>Information about</h2>
								<img style='border-radius:50%;' height='150px' width='150px' src='images/userprofile/$uprofile' />
								<br><br>
								<ul style='list-style-type:none; position:relative; '>
									<li title='User Name'>$fname $lname</li>
									<li title='User Description'>$descUser</li>
									<li title='Gender'>$gender</li>	
									<li title='Country'>$country</li>
									<li title='Registration Date'>$regDate</li>
								</ul>
							</center>
							<center><a href='editProfile.php?Uid=$ownId' style='text-decoration:none; color:#3b5998;'>Edit Profile</a></center>
							</div>
						";
					}
					else {
					echo "
						<div class='col-md-3'>
							<center>
								<h2>Information about</h2>
								<img style='border-radius:50%;' height='150px' width='150px' src='images/userprofile/$uprofile' />
								<br><br>
								<ul style='list-style-type:none; position:relative; '>
									<li title='User Name'>$fname $lname</li>
									<li title='User Description'>$descUser</li>
									<li title='Gender'>$gender</li>	
									<li title='Country'>$country</li>
									<li title='Registration Date'>$regDate</li>
								</ul>
							</center>
						</div>
					";
					}
					$getPosts="select * from posts where userId='$uId' order by postDate desc";
					$runPosts=mysqli_query($con,$getPosts);
					while($rowPosts=mysqli_fetch_array($runPosts)) {
						$postId=$rowPosts['postId'];
						$userId=$rowPosts['userId'];
						$content=substr($rowPosts['postContent'],0,40);
						$uploadImage=$rowPosts['uploadImage'];
						$postDate=$rowPosts['postDate'];
						$user="select * from users where Uid='$userId' and posts='yes'";
						$runUserPost=mysqli_query($con,$user);
						$rowUserPost=mysqli_fetch_array($runUserPost);
						$username=$rowUserPost['Uname'];
						$userImage=$rowUserPost['Uprofile'];
						if((strlen($content)>=1)&&(strlen($uploadImage)>=1)) {
							echo "
								<div class='row'>
								<div class='col-md-6'>
								<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%;'>
								<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
									<div style='position:relative; top:-50px; left:55px;'>
										<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$username</a></b><br>
											<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
										</div>
							<hr>
								$content<br><br>
						<center>
							<div >
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:50vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
				";
			}
			if((strlen($content)==0)&&(strlen($uploadImage)>=1)) {
				echo "
					<div class='col-md-6'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$username</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
								$content<br><br>
						<center>
							<div >
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:50vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
				";
			}
			if((strlen($content)>=1)&&(strlen($uploadImage)==0)) {
				echo "
					<div class='col-md-6'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$username</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
								$content<br><br>
						<center>
							<div >
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:50vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
				";
			}
		}
				}
			?>
		</div>
		</div>
	</body>
</html>