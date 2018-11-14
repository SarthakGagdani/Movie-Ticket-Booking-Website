<!DOCTYPE HTML>
<html lang="en_US">
<head>
	<meta charset="UTF-8">
		<title>Admin Login</title>
		<link rel="stylesheet" type="text/css" href="css/styles1.css">
		<link href="css/animate.css" type='text/css' rel="stylesheet">

</head>
<body>
	<div class="title">
			<h3 align="right" style="margin-right:20px;"><a href="index.php">User Login</a></h3>

	</div>
	
	<div class="loginbox">
		<img src="images/profile.png" class="profile">
		
		<h2>Admin Login</h2>
		
		<form action="admin.php" method="post" class="animated flipInY">
			<p>Admin-Name</p>
			<input type="text" name="admin_name" placeholder="Enter Admin-Name">
			
			<p>Password</p>
			<input type="password" name="password1" placeholder="Enter Password"><br>
			
			<input type="submit" name="submit1" value="Login"><br>
			
		</form>
	</div>


</body>
</html>		


<?php
	
	session_start();

	include('dbcon.php');
	
	if(isset($_POST['submit1']))
	{
		$admin_name = $_POST['admin_name'];
		$password= $_POST['password1'];
		

		$qry = "select * from admin WHERE username='$admin_name' AND password='$password'";
		
		$run = mysqli_query($con,$qry);
		
		$row = mysqli_num_rows($run);
		
		if($row <1)
		{
			?>
			<script>
			alert("Username and Password Not Match.");
			</script>
			<?php
		}
		else
		{
			?>
			<script>
			alert("Admin login success");
			</script>
			<?php
			$_SESSION['user']=$admin_name;
			$_SESSION['updated']=NULL;
			$_SESSION['updated1']=NULL;
			$_SESSION['updated2']=NULL;
			$_SESSION['updated3']=NULL;
			header('location:dash.php');
		
		}
		
	}


		
?>	 