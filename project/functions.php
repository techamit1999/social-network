<?php
	$con=mysqli_connect("localhost","root","","fb");
	function insertPost() {
		if(isset($_POST['post'])) {
			global $con;
			global $userId;
			$content=$_POST['content'];
			$uploadImage=$_FILES['uploadImage']['name'];
			$imgTmp=$_FILES['uploadImage']['tmp_name'];
			if(strlen($uploadImage)>=250) {
				exit();
			} else {
				if(strlen($content)>=1&&strlen($uploadImage)>=1) {
					move_uploaded_file($imgTmp,"images/post/$uploadImage");
					$postCount="update users set posts='yes' where Uid='$userId'";
					$uploadPost="insert into posts (userId,postContent,uploadImage,postDate) values ('$userId','$content','$uploadImage',NOW())";
					$run=mysqli_query($con,$postCount);
					$runCount=mysqli_query($con,$uploadPost);
					if($run&&$runCount) {
						echo "<script>alert('post uploaded successfully');</script>";
					}
				}
				else if($uploadImage==""&&$content=="") {
					echo "<script>alert('Error');</script>";
				}else if($content==""&&strlen($uploadImage)>=1){
					move_uploaded_file($imgTmp,"images/post/$uploadImage");
					$postCount="update users set posts='yes' where Uid='$userId'";
					$uploadPost="insert into posts (userId,postContent,uploadImage,postDate) values ('$userId','','$uploadImage',NOW())";
					$run=mysqli_query($con,$postCount);
					$runCount=mysqli_query($con,$uploadPost);
					if($run&&$runCount) {
						echo "<script>alert('error uploading post');</script>";
						exit();
					}
				} else if(strlen($content)>=1&&$uploadImage=="") {
					$postCount="update users set posts='yes' where Uid='$userId'";
					$uploadPost="insert into posts (userId,postContent,uploadImage,postDate) values ('$userId','$content','',NOW())";
					$run=mysqli_query($con,$postCount);
					$runCount=mysqli_query($con,$uploadPost);
					if($run&&$runCount) {
						echo "<script>alert('post uploaded successfully');</script>";
					}
				}
			}
		}
	}
	function getPosts() {
		global $con;
		$getPosts="select * from posts order by postDate desc";
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
						<div class='col-sm-2'>
						</div>
						<div class='col-sm-8'>
							<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%;' >
									<img class='img-fluid rounded' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
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
					</div>
				";
			}
			if((strlen($content)==0)&&(strlen($uploadImage)>=1)) {
				echo "
					<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$username</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
							<br><br>
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
					</div>
				";
			}
			if((strlen($content)>=1)&&(strlen($uploadImage)==0)) {
				echo "
				<div class='row'>
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-8'>
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
					</div>
				";
			}
		}
	}
	function getProfilePosts() {
		global $con;
		global $userId;
		$getPosts="select * from posts where userId='$userId' order by postDate desc";
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
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
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
							<a href='delete.php?postId=$postId'>
								<button class='btn btn-primary'>Delete</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
				";
			}
			if((strlen($content)==0)&&(strlen($uploadImage)>=1)) {
				echo "
					<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
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
					</div>
				";
			}
			if((strlen($content)>=1)&&(strlen($uploadImage)==0)) {
				echo "
					<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
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
					</div>
				";
			}
		}
	}
	function singlePost() {
		if(isset($_GET['postId'])) {
			global $con;
			$getId=$_GET['postId'];
			$getPost="select * from posts where postId='$getId'";
			$runPost=mysqli_query($con,$getPost);
			$rowPost=mysqli_fetch_array($runPost);
			$postId=$rowPost['postId'];
			$userId=$rowPost['userId'];
			$postContent=$rowPost['postContent'];
			$uploadImage=$rowPost['uploadImage'];
			$postDate=$rowPost['postDate'];
			$User="select * from users where Uid='$userId' and posts='yes'";
			$runUser=mysqli_query($con,$User);
			$rowUser=mysqli_fetch_array($runUser);
			$userName=$rowUser['Uname'];
			$userImage=$rowUser['Uprofile'];
			$userCom=$_SESSION['UEmail'];
			$getCom="select * from users where UEmail='$userCom'";
			$runCom=mysqli_query($con,$getCom);
			$rowCom=mysqli_fetch_array($runCom);
			$userComId=$rowCom['Uid'];
			$userComName=$rowCom['Uname'];
			$post=$_GET['postId'];
			$getuser="select * from posts where postId='$post'";
			$runuser=mysqli_query($con,$getuser);
			$row=mysqli_fetch_array($runuser);
			$pId=$row['postId'];
			if($pId!=$postId) {
				echo "<script>alert('ERROR');</script>";
				echo "<script>window.open('single.php?postId=$postId','_self');</script>";
			} else {
				if((strlen($postContent)>=1)&&(strlen($uploadImage)>=1)) {
					echo "
					<div class='container'>
					<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div class='col-sm-6'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%; padding:20px;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$userName</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
								$postContent<br><br>
						<center>
							<div >
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:40vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
					</div>
					";
				}
				if((strlen($postContent)==0)&&(strlen($uploadImage)>=1)) {
					echo "
						<div class='container'>
					<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div class='col-sm-6'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%; padding:20px;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$userName</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
								$postContent<br><br>
						<center>
							<div >
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:40vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
					</div>
					";
				}
				if((strlen($postContent)>=1)&&(strlen($uploadImage)==0)) {
					echo "
						<div class='container'>
					<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-6'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%; padding:20px;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$userName</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
								$postContent<br><br>
						<center>
							<div >
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:40vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
					</div>
					";
				}
				include("comments.php");
				echo "
					<div class='container'>
					<div class='row'>
					<div class='col-sm-12'>
					<form method='post'>
						<div class='form-group'>
						<textarea class='form-control' placeholder='Write Your Comment here' name='comment'></textarea><br><br>
						<button class='btn btn-info' name='reply'>Comment</button>
						</div>
					</form>
					</div>
					</div>
					</div>
				";
				if(isset($_POST['reply'])) {
					$comment=$_POST['comment'];
					if($comment=="") {
						echo "<script>alert('Enter Your Comment');</script>";
						echo "<script>window.open('single.php?postId=$postId','_self');</script>";
					}
					else {	
						$insert="insert into comments (postId,userId,comment,commentUser,date) values('$postId','$userComId','$comment','$userComName',NOW())";
						if(mysqli_query($con,$insert)) {
							echo "<script>alert('Your Comment added');</script>";
							echo "<script>window.open('single.php?postId=$postId','_self');</script>";
						}
					}
				}
			}
		} 
	}
	function searchUser() {
		global $con;
		if(isset($_POST['search'])) {
			$search=$_POST['searchUser'];
			$getUser="select * from users where Fname like '%$search%' or Lname like '%$search%' or Uname like '%$search%'";
		} else {
			$getUser="select * from users";
		}
		$runUser=mysqli_query($con,$getUser);
		while($row=mysqli_fetch_array($runUser)) {
			$userId=$row['Uid'];
			$fname=$row['Fname'];
			$lname=$row['Lname'];
			$uname=$row['Uname'];
			$uprofile=$row['Uprofile'];
			echo "
				<div class='container'>
				<div class='row'>
					<div class='col-sm-3'></div>
					<div class='col-sm-6' style='border:1px solid #3b5998; padding:30px;'>
					<center>
					<a href='userProfile.php?Uid=$userId'>
						<img class='img-responsive rounded' id='upro' src='images/userprofile/$uprofile' width='50px' height='50px' title='$uname'/>
					</a>
					<a href='userProfile.php?Uid=$userId' style='text-decoration:none; cursor:pointer; color:#3b5998;'>
						<strong><h2>$fname $lname</h2></strong>
					</a>
					</center>
					</div>
				</div>
				</div>
				<br><br>
			";
		}
	}
	function results() {
		global $con;
		if(isset($_GET['Search'])) {
			$search=$_GET['userQuery'];
			$getPosts="select * from posts where postContent like '%$search%' or uploadImage like '%$search%'";
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
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
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
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:40vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
					";
				}
				if((strlen($content)==0)&&(strlen($uploadImage)>=1)) {
					echo "
						<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
					<div class='well' style='border:1px solid #3b5998; padding:20px; margin:10px; border-radius:5%;'>
							<img class='img-fluid' id='profile' src='images/userprofile/$userImage' style='width:50px; height:50px; border-radius:50%;' />
							<div style='position:relative; top:-50px; left:55px;'>
								<b><a href='profile.php' style='text-decoration:none; color:#3b5998; position:relative; left:0px;'>$username</a></b><br>
								<small stye='color:black;'>Last updated on <strong>$postDate</strong></small>
							</div>
							<hr>
								$content<br><br>
						<center>
							<div>
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:40vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
					";
				}
				if((strlen($content)>=1)&&(strlen($uploadImage)==0)) {
					echo "
						<div class='row'>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-8'>
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
							<img class='img-fluid rounded' src='images/post/$uploadImage' style='width:40vw; height:auto;' /><br><br>
							<a href='single.php?postId=$postId'>
								<button class='btn btn-info'>Comment</button>
							</a> 
							</div>
						</center>
					</div>
					</div>
					</div>
					";
				}
			}
		}
	}
?>