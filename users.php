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

	<title>users</title>

	
</head>
<body class='bg-gray animated fadeIn'>

<div class='header'>
<center><img src='images/admin.png' alt="AdminLogo" id="adminlogo"><br><center id='head' class="animated flipInX">ADMIN DASHBOARD</center>

</center>

</div>

<div class='navbar'>

<ul align="center">
<li><a href="dash.php"  >HOME</a></li>
<li><a href="users.php" class="active">USERS</a></li>
<li><a href="movie.php" >MOVIES</a></li>
<li><a href="theatres.php" >THEATRES</a></li>
<li><a href="timings.php" >TIMINGS</a></li>
<li><b class='logout' style="padding-top:14px;padding-right:2px;"><?php echo strtoupper("USER:".$_SESSION['user']);?></b></li>
<li><a href="logout.php" class='logout'>LOGOUT</a></li>
</ul>

</div>

<div class='content'>
<?php

include ("dbcon.php");

$qry="select * FROM users";
$result = mysqli_query($con,$qry);
$row_count=mysqli_num_rows($result);

if($row_count==0){echo  "<br><center><b>SHOWING 0 RESULTS.<b></center>";
}
else{
	echo  "<br><center><b>SHOWING ".$row_count." RESULTS.<b></center><br>";
	
?>
<table align='center' border='1'>

<tr>
<th>Sr.No</th>
<th>USERNAME</th>
<th>EMAIL-ID</th>
<th>BOOKINGS</th>

</tr>

<?php

for($i=0;$i<$row_count;$i++)
{
	$row=mysqli_fetch_assoc($result);
	?>
	<tr>
	<td><?php echo $i+1 ?></td>
	<td><?php echo $row["username"] ?></td>
	<td><?php echo $row["email"] ?></td>
	<td><?php $user=$row["username"];$qry5 = "select * from bookings where username='$user' ";
		$res=mysqli_query($con,$qry5);
		$book=mysqli_fetch_array($res);
		while($book=mysqli_fetch_array($res)){
		echo nl2br("\n"."Movie-".$book['movie']."\nDate-".$book['date']."\n");
		}?></td>
	</tr>
	<?php
}
}

?>


</div>

</body>
</html>








