<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
	
</style>
</head>
<body>
<?php
	global $con;
	if(isset($_GET['postId'])){
		 $getId=$_GET['postId'];
		$getComment="select * from comments where postId='$getId' order by date desc";
		$runComment=mysqli_query($con,$getComment);
		while($row=mysqli_fetch_array($runComment)) {
			$com=$row['comment'];
			$comment=$row['commentUser'];
			$date=$row['date'];
			echo "
				<div class='container'>
				<div class='row'>
					<div class='col-md-6'>
					<div class='well'>
					<h6><strong>$comment</strong><i> commented on </i> $date</h6>
					<p id='commentCon'>$com</p>
					<br>
					</div>
					</div>
				</div>
				</div>
			";
		}
	}
?>
</body>