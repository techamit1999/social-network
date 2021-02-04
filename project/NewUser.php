<?php
	include("connection.php");
	if(isset($_POST['SignUp'])) {
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$pass=$_POST["Upass"];
		$email=$_POST["email"];
		$country=$_POST["Ucountry"];
		$gender=$_POST["Ugender"];
		$dob=$_POST["Dob"];
		$status="verified";
		$post="no";
		$newgid=rand(0,999999);
		$Uname=strtolower($fname."_".$lname."_".$newgid);
		$checkUserName="select * Uname from users where UEmail='$email'";
		$runCheckUserName=mysqli_query($con,$checkUserName);
		if(strlen($pass)<9) {
			echo "<script>alert('password should be 9 chracters');</script>";
			echo "<script>window.open('SignUp.php','_self');</script>";
			exit();
		}
		$checkEmail="select * from Users where UEmail='$email'";
		$runEmail=mysqli_query($con,$checkEmail);
		$check=mysqli_num_rows($runEmail);
		if($check==1) {
			echo "<script>alert('Email already exists');</script>";
			echo "<script>window.open('SignUp.php','_self');</script>";
			exit();
		}
		$rand=rand(1,3);
		if($rand==1) {
			$profilePic="male.jpeg";
		}
		if($rand==2) {
			$profilePic="female.jpeg";
		}
		if($rand==3) {
			$profilePic="male.jpeg";
		}
		$insert="insert into users(Fname,Lname,Uname,DescUser,RelationStatus,Upassword,UEmail,Ucountry,Ugender,UDOB,Uprofile,Ucover,UregDate,status,posts,recoveryAccount) 
		values('$fname','$lname','$Uname','hello everyone','...','$pass','$email','$country','$gender','$dob','$profilePic','cover.jpeg',NOW(),'$status','$post','demorecovery')";
		$query=mysqli_query($con,$insert);
		if($query) {
			echo "<script>alert('Welcome $Uname');</script>";
			echo "<script>window.open('Login.php','_self');</script>";
		}
		else {
			echo "<script>alert('Registration Failed');</script>";
			echo "<script>window.open('SignUp.php','_self');</script>";
		}
	}
?>