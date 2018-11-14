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

	<title>Edit</title>
</head>
<body class='bg-gray'>

<div class='header'>
<center><img src='images/admin.png' alt="AdminLogo" id="adminlogo"><br><center id='head'>ADMIN DASHBOARD</center>

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
<li><a href="logout.php" class='logout'>LOGOUT</a></li>
</ul>

</div>

<div class='content'>
<?php

include ("dbcon.php");

?>

<div id="edit" style="display:block;"  class="pop animated jackInTheBox">
  <div class="pop-content" style="padding:32px">
  <h1 align='center'>EDIT</h1><br>
    <span class="close" onclick="location.href='theatres.php'">&times;</span>	
	<?php
	if(isset($_REQUEST['eid']))
	{
	
	$id=$_REQUEST['eid'];
	
	$qry1="select Theatre_Name ,Movie_Name ,Location,time1 ,time2 ,time3 ,time4 ,time5 FROM theatres where Theatre_id='$id'";
	$result1 = mysqli_query($con,$qry1);
	$row1=mysqli_fetch_assoc($result1);
	
	?>
	<form  method="post">
	<table align='center'>
	<tr>
	<td><b>THEATRE-</b></td>
	<td><input type='text' name='theatre' value="<?php echo $row1['Theatre_Name']?>" required></td>
	</tr>
	<tr>
	<td><b>MOVIE-</b></td>
	<td><input type='text' name='movie' value="<?php echo $row1['Movie_Name']?>" required></td>
	</tr>
	<tr>
	<td><b>LOCATION-</b></td>
	<td><input type='text' name='location' value="<?php echo $row1['Location']?>" required></td>
	</tr>
	<tr>
	<td><b>TIME 1-</b></td>
	<td><input type='time' name='time1' value="<?php echo $row1['time1']?>" ></td>
	</tr>
	<tr>
	<td><b>TIME 2-</b></td>
	<td><input type='time' name='time2' value="<?php echo $row1['time2']?>" ></td>
	</tr>
	<tr>
	<td><b>TIME 3-</b></td>
	<td><input type='time' name='time3' value="<?php echo $row1['time3']?>" ></td>
	</tr>
	<tr>
	<td><b>TIME 4-</b></td>
	<td><input type='time' name='time4' value="<?php echo $row1['time4']?>" ></td>
	</tr>
	<tr>
	<td><b>TIME 5-</b></td>
	<td><input type='time' name='time5' value="<?php echo $row1['time5']?>" ></td>
	</tr>
	<tr>
	<td ><input type='submit' name='submit' style="margin-left:75%;" value="SUBMIT"></td>
	</tr>
	
	</table>
	
	</form>
	
<?php 
}?>

</div>

</div>
<?php	
if( isset($_REQUEST['submit']))
	{	
		$movie=$_REQUEST['movie'];
		$theatre=$_REQUEST['theatre'];
		$location=$_REQUEST['location'];
		$time1=$_REQUEST['time1'];
		$time2=$_REQUEST['time2'];
		$time3=$_REQUEST['time3'];
		$time4=$_REQUEST['time4'];
		$time5=$_REQUEST['time5'];
	
	
		$update_qry="UPDATE theatres SET Theatre_Name='$theatre',Movie_Name='$movie',Location='$location',time1='$time1',time2='$time2',
		time3='$time3',time4='$time4',time5='$time5' WHERE Theatre_id='$id'";
		if(mysqli_query($con,$update_qry))
		{
			$_SESSION['updated2']=true;
			
			header('location:theatres.php');
		}
		else
			{
			?>
			<div align="center"> <?php echo "<b>ERROR IN UPDATION.</b><br>".$update_qry . "<br>" . mysqli_error($con);?></div>
			<?php
			}
	}	
?>
</div>
</body>
</html>


      