<?php
	error_reporting(0);
	require_once("connection.php");
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		if (!preg_match($regex_email, $email))
		{
			$m = "<span style='color: red;'>Enter a valid Email Id</span>";
			header('location: contactus.php?m1='.$m);
			exit;
		}
		
		$message = $_POST['message'];
		$query = "INSERT INTO messages
		(Name, Email, Message)
		VALUES
		('{$name}','{$email}','{$message}')";
		if(mysqli_query($con,$query)){
			echo "Thank-you For Your Message. We will get back to you as soon as possible. Go Back To Website <a href='index.php'>here</a>";
		}else{
			echo "error while inserting the records".mysqli_error($con);
		}
	}
?>