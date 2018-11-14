<?php 
	session_start();
	if($_SESSION['user']==true){
		echo "";
	}
	else{
		header('location:admin.php');
	}
?>

<html>
<head>
	<link href="css/dashstyle.css" type='text/css' rel="stylesheet">
	<link href="css/animate.css" type='text/css' rel="stylesheet">


	<title>Dashboard</title>

	
</head>
<body class='bg-gray animated fadeIn'>

<div class='header'>
<center><img src='images/admin.png' alt="AdminLogo" id="adminlogo"><br><center id='head' class="animated flipInX">ADMIN DASHBOARD</center>

</center>

</div>

<div class='navbar'>

<ul align="center">
<li><a href="dash.php"  >HOME</a></li>
<li><a href="users.php" >USERS</a></li>
<li><a href="movie.php" >MOVIES</a></li>
<li><a href="theatres.php" class="active">THEATRES</a></li>
<li><a href="timings.php" >TIMINGS</a></li>
<li><b class='logout' style="padding-top:14px;padding-right:2px;"><?php echo strtoupper("USER:".$_SESSION['user']);?></b></li>
<li><a href="logout.php" class='logout' >LOGOUT</a></li>
</ul>

</div>

<div class='content'>

<?php
if($_SESSION['updated2']==true){
		?>
			<br><div align="center"> <?php echo "<b>DETAILS UPDATED.</b>";?></div><br>
		
		<?php
		$_SESSION['updated2']=NULL;
		
	}
?>
<div id='insert' class='pop animated jackInTheBox'>
<div class="pop-content" style="padding:32px">
  <h1 align='center'>CREATE</h1><br>

  <span class="close"  onclick="document.getElementById('insert').style.display='none'">&times;</span>
  
	<form action="theatres.php" method="post">
	<table align='center' >
	
			<tr>
			<td><b>THEATRE-</b></td>
			<td><input type="text" name="theatre"  required></td>
			</tr>
			<tr>
			<td><b>MOVIE-</b></td>
			<td><input type="text" name="movie_name"  required></td>
			</tr>
			<tr>
			<tr>
			<td><b>LOCATION-</b></td>
			<td><input type="text" name="location"  required></td>
			</tr>
			<tr>
			<td><b>TIME 1-</b></td>
			<td><input type="time" name="time1" ></td>
			</tr>
			<tr>
			<td><b>TIME 2-</b></td>
			<td><input type="time" name="time2" ></td>
			</tr>
			<tr>
			<td><b>TIME 3-</b></td>
			<td><input type="time" name="time3" ></td>
			</tr>
			<tr>
			<td><b>TIME 4-</b></td>
			<td><input type="time" name="time4" ></td>
			</tr>
			<tr>
			<td><b>TIME 5-</b></td>
			<td><input type="time" name="time5" ></td>
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
	mysqli_query($con,"delete from theatres where Theatre_id='$delid'");
	?>
	<br><div align="center"> <?php echo "<b>DELETED.</b>";?></div><br>
	<?php
	
}	
	if(isset($_POST['submit']))
	{
		$movie=$_POST['movie_name'];
		$theatre=$_POST['theatre'];
		$location=$_POST['location'];
		$time1=$_POST['time1'];
		$time2=$_POST['time2'];
		$time3=$_POST['time3'];
		$time4=$_POST['time4'];
		$time5=$_POST['time5'];
	
		$qry_duplicate="Select Theatre_Name ,Movie_Name ,Location,time1,time2 ,time3 ,time4 ,time5 from theatres
		where Theatre_Name='$theatre' AND Movie_Name='$movie' AND Location='$location'";
		
		$duplicate_result=mysqli_query($con,$qry_duplicate);
		$duplicate_count=mysqli_num_rows($duplicate_result);
		if ($duplicate_count>0)
		{?>
			<br><div align="center"> <?php echo "<b>SHOWS ALREADY PRESENT.PLEASE UPDATE IF NEEDED.</b>";?></div><br>
		
			<?php
		}
		
		else
		{
			$qry="INSERT INTO theatres (Theatre_Name ,Movie_Name ,Location,time1 ,time2 ,time3 ,	time4 ,	time5) 
			VALUES ('$theatre','$movie','$location','$time1','$time2','$time3','$time4','$time5')";
		
		
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
$qry="select Theatre_id,Theatre_Name ,Movie_Name ,Location,time1 ,time2 ,time3 ,time4 ,time5 FROM theatres";
$result = mysqli_query($con,$qry);
$row_count=mysqli_num_rows($result);

if($row_count==0){echo  "<br><center><b>SHOWING 0 RESULTS.<b></center>";
?><center><button class='create animated fadeIn' onclick="document.getElementById('insert').style.display='block'"> INSERT </button></center><?php
}
else{
	echo  "<br><center><b>SHOWING ".$row_count." RESULTS.<b></center><br>";
	
?>
<table align='center' class="animated fadeIn"  border='1'>

<tr><center><button class='create animated fadeIn' onclick="document.getElementById('insert').style.display='block'"> INSERT </button></center></tr>
<tr>
<th>Sr.No</th>
<th>THEATRE</th>
<th>MOVIE</th>
<th>LOCATION</th>
<th>TIME 1</th>
<th>TIME 2</th>
<th>TIME 3</th>
<th>TIME 4</th>
<th>TIME 5</th>
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
	<td><?php echo $row["Theatre_Name"] ?></td>
	<td><?php echo $row["Movie_Name"] ?></td>
	<td><?php echo $row["Location"] ?></td>
	<td><?php echo $row["time1"] ?></td>
	<td><?php echo $row["time2"] ?></td>
	<td><?php echo $row["time3"] ?></td>
	<td><?php echo $row["time4"] ?></td>
	<td><?php echo $row["time5"] ?></td>
	

	<td><center><a href="?delid=<?php echo $row["Theatre_id"] ?>" style="color:white"><img style="height:20px;width:20px" src="images/delete.png">
	</a></center></td>
	
	<td><a href="theatre_edit.php?eid=<?php echo $row["Theatre_id"] ?>" style="color:white"><img style="height:20px;width:20px" src="images/edit.png">
	</a></td>

	</tr>
	<?php
}
}

?>

</div>


</body>
</html>


