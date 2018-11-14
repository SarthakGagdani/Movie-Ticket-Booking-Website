<?php 
	session_start();
	if($_SESSION['user']==true){
		echo "";
	}
	else{
		header('location:admin.php');
	}
		
	
?>

<html  >
<head>
	<link href="css/dashstyle.css" type='text/css' rel="stylesheet">
	<link href="css/animate.css" type='text/css' rel="stylesheet">


	<title>Admin Page</title>

	
</head>
<body class='bg-gray'>

<div class='header'>
<center><img src='images/admin.png' alt="AdminLogo" id="adminlogo"><br><center id='head' class="animated flipInX">ADMIN DASHBOARD</center>

</center>

</div>

<div class='navbar'>

<ul align="center">
<li><a href="dash.php"  >HOME</a></li>
<li><a href="users.php" >USERS</a></li>
<li><a href="movie.php" >MOVIES</a></li>
<li><a href="theatres.php" >THEATRES</a></li>
<li><a href="timings.php" class="active">TIMINGS</a></li>
<li><b class='logout' style="padding-top:14px;padding-right:2px;"><?php echo strtoupper("USER:".$_SESSION['user']);?></b></li>
<li><a href="logout.php" class='logout' >LOGOUT</a></li>
</ul>

</div>

<div class='content'>

<?php
if($_SESSION['updated3']==true){
		?>
			<br><div align="center"> <?php echo "<b>DETAILS UPDATED.</b>";?></div><br>
		
		<?php
		$_SESSION['updated3']=NULL;
		
	}
?>
<div id='insert' class='pop animated jackInTheBox'>
<div class="pop-content" style="padding:32px">
  <h1 align='center'>CREATE</h1><br>

  <span class="close"  onclick="document.getElementById('insert').style.display='none'">&times;</span>
  
	<form action="timings.php" method="post">
	<table align='center' >
	
			<tr>
			<td><b>SHOWTIME-</b></td>
			<td><input type="time" name="time" required></td>
			</tr>
			<tr>
			<td><b>THEATRE-</b></td>
			<td><input type="text" name="theatre"  required></td>
			</tr>
			<tr>
			<td><b>GOLD TICKET RATE-</b></td>
			<td><input type="text" name="grate"  required></td>
			</tr>
			<tr>
			<td><b>SILVER TICKET RATE-</b></td>
			<td><input type="text" name="srate"  required></td>
			</tr>
			<tr>
			<td><b>SEATS-</b></td>
			<td><input type="text" name="seats" required></td>
			</tr>
			
			<tr><td><input type="submit" style="margin-left:90%" name="submit" value="SAVE"></td></tr>
			
		
	</table>
	</form>

</div>
</div>
<?php

	include('dbcon.php');
	if(isset($_REQUEST['delid']))
{
	
	$delid=$_REQUEST['delid'];
	mysqli_query($con,"delete from timings where id='$delid'");
	?>
	<br><div align="center"> <?php echo "<b>DELETED.</b>";?></div><br>
	<?php
	
}	
	if(isset($_POST['submit']))
	{
		$seats=$_POST['seats'];
		$theatre=$_POST['theatre'];
		$grate=$_POST['grate'];
		$srate=$_POST['srate'];
		$time=$_POST['time'];
		
	
		$qry_duplicate="Select showtime ,Theatre_Name ,ticket_rate_Gold ,ticket_rate_Silver ,seats  from timings
		where Theatre_Name='$theatre' AND showtime='$time'";
		
		$duplicate_result=mysqli_query($con,$qry_duplicate);
		$duplicate_count=mysqli_num_rows($duplicate_result);
		if ($duplicate_count>0)
		{?>
			<br><div align="center"> <?php echo "<b>SHOWS ALREADY PRESENT.PLEASE UPDATE IF NEEDED.</b>";?></div><br>
		
			<?php
		}
		
		else
		{
			$qry="INSERT INTO timings (showtime ,Theatre_Name ,ticket_rate_Gold ,ticket_rate_Silver ,seats) 
			VALUES ('$time','$theatre','$grate','$srate','$seats')";
		
		
			if (mysqli_query($con, $qry)) 
			{?>
			<br><div align="center"> <?php echo "<b>NEW RECORD CREATED SUCCESSFULLY.</b>";?></div><br>
		
			<?php
			}
			
			else
			{
			?>
			<br><div align="center"> <?php echo "<b>ERROR IN INSERTION.</b><br>".$qry . "<br>" . mysqli_error($con);?></div>
			<?php
			}

			mysqli_close($con);
		}	
	}		
?>

<?php
include('dbcon.php');
$qry="Select id,showtime ,Theatre_Name ,ticket_rate_Gold ,ticket_rate_Silver ,seats  from timings";
$result = mysqli_query($con,$qry);
$row_count=mysqli_num_rows($result);

if($row_count==0){echo  "<br><center><b>SHOWING 0 RESULTS.<b></center>";
?><center><button class='create animated fadeInUp' onclick="document.getElementById('insert').style.display='block'"> INSERT </button></center><?php
}
else{
	echo  "<br><center><b>SHOWING ".$row_count." RESULTS.<b></center><br>";
	
?>
<table align='center' class="animated fadeInUp"  border='1'>

<tr><center><button class='create animated fadeInUp' onclick="document.getElementById('insert').style.display='block'"> INSERT </button></center></tr>
<tr>
<th>Sr.No</th>
<th>SHOWTIME</th>
<th>THEATRE</th>
<th>GOLD RATE</th>
<th>SILVER RATE</th>
<th>SEATS</th>
<th>DELETE</th>
<th>EDIT</th>
</tr>

<?php

for($i=0;$i<$row_count;$i++)
{
	$row=mysqli_fetch_assoc($result);
	?>
	<tr>
	<td><?php echo $i+1 ?></td>
	<td><?php echo $row["showtime"] ?></td>
	<td><?php echo $row["Theatre_Name"] ?></td>
	<td><?php echo $row["ticket_rate_Gold"] ?></td>
	<td><?php echo $row["ticket_rate_Silver"] ?></td>
	<td><?php echo $row["seats"] ?></td>
	

	<td><center><a href="?delid=<?php echo $row["id"] ?>" style="color:white"><img style="height:20px;width:20px" src="images/delete.png">
	</a></center></td>
	
	<td><a href="edit_timings.php?eid=<?php echo $row["id"] ?>" style="color:white"><img style="height:20px;width:20px" src="images/edit.png">
	</a></td>

	</tr>
	<?php
}
}

?>

</div>


</body>
</html>


