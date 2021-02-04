<?php
	$con=mysqli_connect("localhost","root","","fb");
	if(isset($_GET['postId'])) {
		$postId=$_GET['postId'];
		$deletePost="delete from posts where postId='$postId'";
		$rundelete=mysqli_query($con,$deletePost);
		if($rundelete) {
			echo "<script>alert('post has been deleted');</script>";
			echo "<script>window.open('profile.php','_self');</script>";
		}
	}
?>