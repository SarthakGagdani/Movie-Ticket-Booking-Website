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
		<title>Signup</title>
		<link href="css/animate.css" type='text/css' rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="css/signupstyles.css">
</head>
<body>
	<div class="title">
		
	</div>
	<div class="loginbox">
		<img src="images/profile.png" class="profile">
		
		<h2>Signup Here</h2>
		
		<form action="signup.php" method="post" class="animated flipInY">
			<p style="font-size:16px">Username</p>
			<input type="text" name="username" placeholder="Enter Username" required>
			
			<p style="font-size:16px">Email</p>
			<input type="email" name="email" placeholder="Enter Email" required>
			
			<p style="font-size:16px">Password</p> <input type="password" name="password" placeholder="Enter Password" id="myInput" required>
			<table height="10px" width="200px" style="margin-bottom:10px;padding: 0px;"><tr>
			<td> <p style="font-size:12px; padding-top=0px;">Show Password </p> </td>
			<td width='15' style='padding-top:15px; padding-right:90px;'><center><input type="checkbox"  onclick="myFunction()"></center></td></tr></table>
			
			

			<p style="font-size:16px">Confirm Password</p><input type="password" name="password1" placeholder="Enter Password" id="myInput1" required>
		
			<script>
				function myFunction() {
					var x = document.getElementById("myInput");
					if (x.type === "password") {
					x.type = "text";
					} else {
					x.type = "password";
					}
				}
				function myFunction1() {
					var x = document.getElementById("myInput1");
					if (x.type === "password") {
					x.type = "text";
					} else {
					x.type = "password";
					}
				}
			</script><br>
			
			<input type="submit" name="submit" value="Register"><br>
			<a href="index.php">Already have an account?</a>
			

		</form>
	</div>


</body>
</html>	




<?php

	include('dbcon.php');
	
	if(isset($_POST['submit']))
	{
		$user_name = $_POST['username'];
		$email= $_POST['email'];
		$password= $_POST['password'];
		$password1= $_POST['password1'];
		
		$qry1 = "select * from users WHERE username='$user_name'";
		
		$run1 = mysqli_query($con,$qry1);
		
		$row1 = mysqli_num_rows($run1);
		
		if($row1==0)
		{
			
			if($password === $password1)
			{		
				$hashed_pass=password_hash($password,PASSWORD_DEFAULT);

				$qry = "INSERT INTO users(username, email, password) VALUES ('$user_name','$email','$hashed_pass')";
		
				$run = mysqli_query($con,$qry);
		
				session_start();
		
				$_SESSION['name']=$user_name;
				$_SESSION['email']=$email;
				
				?>
				<script>
				alert("Registered Successfully");
				</script>
				
				<?php
				header('location:userdashboard.php');
		
			}
			else
			{
			?>
			<script>
			alert("Password Not Match");
			
			</script>
			<?php
			
			}
			
		}
			
		else
		{
				?>
				<script>
				alert("Username Already Exist.Try other Username.");
				</script>
				<?php
	
	
		
		}
			
		
	
	}


		
?>	 