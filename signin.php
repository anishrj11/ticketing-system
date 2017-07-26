<?php
	error_reporting(0);
	require_once("connection.php");
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$name = mysqli_real_escape_string($con,$name);
		$name = strip_tags($name);
					
		$username = $_POST['username'];
		$username = mysqli_real_escape_string($con,$username);
		$username = strip_tags($username);
		
		$email = $_POST['email'];
		$email = mysqli_real_escape_string($con,$email);
		$email = strip_tags($email);

		$address = $_POST['address'];
		$address = mysqli_real_escape_string($con,$address);
		$address = strip_tags($address);
		
		$password = $_POST['password'];
		$password = mysqli_real_escape_string($con,$password);
		$password = strip_tags($password);
		
		$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		$query = "SELECT * FROM users WHERE Email='$email'";
		$result = mysqli_query($con, $query);
		$num = mysqli_num_rows($result);

		if ($num != 0)
			{
			$m = "<span style='color:red;'>Email Already Exists</span>";
			header('location: login.php?m1='.$m);
			}
		else if (!preg_match($regex_email, $email))
			{
			$m = "<span style='color: red;'>Not a valid Email Id</span>";
			header('location: login.php?m1='.$m);
			}
		else{
			
			$query = "INSERT INTO users
			(Name, Username, Email, Address, Password)
			VALUES
			('{$name}','{$username}','{$email}','{$address}','{$password}')";
			if(mysqli_query($con,$query)){
				session_start();
				$_SESSION['email']=$email;
				header('location: 3.jpg');	
			}else{
				echo "error while inserting the records".mysqli_error($con);
			}
		}
	}
?>