<?php 
	session_start();
	
	if($_SESSION['user']==true){
		echo "";
	}
	else{
		header('location:admin.php');
	}
?>

<html class="animated fadeIn">
<head>
	<link href="css/dashstyle.css" type='text/css' rel="stylesheet">
	<link href="css/animate.css" type='text/css' rel="stylesheet">


	<title>Admin Dashboard</title>

	
</head>
<body class='bg-gray'>

<div class='header'>
<center><img src='images/admin.png' alt="AdminLogo" id="adminlogo"><br><center id='head' class="animated flipInX">ADMIN DASHBOARD</center>

</center>

</div>

<div class='navbar'>

<ul align="center">
<li><a href="dash.php" class="active" >HOME</a></li>
<li><a href="users.php" >USERS</a></li>
<li><a href="movie.php" >MOVIES</a></li>
<li><a href="theatres.php" >THEATRES</a></li>
<li><a href="timings.php" >TIMINGS</a></li>
<li><b class='logout' style="padding-top:14px;padding-right:2px;"><?php echo strtoupper("USER:".$_SESSION['user']);?></b></li>
<li><a href="logout.php" class='logout'>LOGOUT</a></li>
</ul>

</div>

<div class='content'>
<br><center><h1 class="animated slideInUp">WELCOME to ADMIN DASHBOARD.</h1></center>
<br>

<table style='margin-left:30px;padding:0;border:none;background-color:#455A64'>
<tr>

	<td>
	<div class="zoomimg">
		<a href="users.php">
		<img height="300px" width="300px" style="transition:0.75s;border-radius:20px;" src="images/users.png"> 
		</a>
	</div>
	<center><h4>MANAGE USERS</h4></center>
	</td>
	
	<td>
	<div class="zoomimg">
		<a href="movie.php">
		<img height="300px" width="300px" style="transition:0.75s;border-radius:20px;" src="images/movies.jpeg"> 
		</a>
	</div>
	<center><h4>MANAGE MOVIES</h4></center>
	</td>
	
	<td>
	<div class="zoomimg">
		<a href="theatres.php">
		<img height="300px" width="300px" style="transition:0.75s;border-radius:20px;" src="images/banner.jpg"> 
		</a>
	</div>
	<center><h4>MANAGE THEATRES</h4></center>
	</td>
	
	<td>
	<div class="zoomimg">
		<a href="timings.php">
		<img height="300px" width="300px" style="transition:0.75s;border-radius:20px;" src="images/timer.png"> 
		</a>
	</div>
	<center><h4>MANAGE TIMINGS</h4></center>
	</td>				 
</tr>
</table>

</div>





</body>
</html>








