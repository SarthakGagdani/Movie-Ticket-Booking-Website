<?php 
	session_start();
	
	if(isset($_SESSION['name'])){
		header('location:userdashboard.php');
	}

?>


<!DOCTYPE HTML>
<html lang="en_US">
<head>
	<meta charset="UTF-8">
		<title>Sign In</title>
		<link href="css/animate.css" type='text/css' rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="css/indexstyles.css">
</head>
<body >
	<div class="title">
	</div>
	<div class="loginbox">
		<img src="images/profile.png" class="profile" />
		
		<h2>Login Here</h2>
		
		<form action="index.php" method="post" class="animated flipInY">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter Username" required>
			
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password" required><br>
			
			<input type="submit" name="submit" value="Login"><br>
			
			<a href="signup.php">Create new account?</a>
		</form>
	</div>


</body>
</html>		


<?php

	include('dbcon.php');
	
	if(isset($_POST['submit']))
	{
		$username = $_POST['username'];
		$password= $_POST['password'];
		
		$qry = "select * from users WHERE username='$username'";
		
		$run = mysqli_query($con,$qry);
		
		$row = mysqli_num_rows($run);
		
		if($row <1)
		{
			?>
			<script>
			alert("Invalid Username");
			</script>
			<?php
		}
		else
		{
			$data = mysqli_fetch_array($run);
			
			if(password_verify($password,$data['password']))
			{
			
			$un = $data['username'];
			$em = $data['email'];

			session_start();
		
			$_SESSION['name']=$un;
			$_SESSION['email']=$em;
			header('location:userdashboard.php');
		
			}
			
			else
			{
				?>
			<script>
			alert("Invalid Password");
			</script>
			<?php
				
				
			}
		
	}
	}


		
?>	