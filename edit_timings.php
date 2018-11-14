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
<li><a href="theatres.php" >THEATRES</a></li>
<li><a href="timings.php" class="active">TIMINGS</a></li>
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
    <span class="close" onclick="location.href='timings.php'">&times;</span>	
	<?php
	if(isset($_REQUEST['eid']))
	{
	
	$id=$_REQUEST['eid'];
	
	$qry1="Select showtime ,Theatre_Name ,ticket_rate_Gold ,ticket_rate_Silver ,seats  from timings where id='$id'";
	$result1 = mysqli_query($con,$qry1);
	$row1=mysqli_fetch_assoc($result1);
	
	?>
	<form  method="post">
	<table align='center'>
	<tr>
	<td><b>SHOWTIME-</b></td>
	<td><input type='time' name='time' value="<?php echo $row1['showtime']?>" required></td>
	</tr>
	<tr>
	<td><b>THEATRE-</b></td>
	<td><input type='text' name='theatre' value="<?php echo $row1['Theatre_Name']?>" required></td>
	</tr>
	<tr>
	<td><b>GOLD TICKET RATE-</b></td>
	<td><input type='text' name='grate' value="<?php echo $row1['ticket_rate_Gold']?>" required></td>
	</tr>
	<tr>
	<td><b>SILVER TICKET RATE-</b></td>
	<td><input type='text' name='srate' value="<?php echo $row1['ticket_rate_Silver']?>" required></td>
	</tr>
	<tr>
	<td><b>SEATS-</b></td>
	<td><input type='text' name='seats' value="<?php echo $row1['seats']?>" required></td>
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
if( isset($_POST['submit']))
	{	
		include ("dbcon.php");
		$seats=$_POST['seats'];
		$theatre=$_POST['theatre'];
		$grate=$_POST['grate'];
		$srate=$_POST['srate'];
		$time=$_POST['time'];
	
	
		$update_qry="UPDATE timings SET Theatre_Name='$theatre',showtime='$time',ticket_rate_Gold='$grate',
		ticket_rate_Silver='$srate',seats='$seats' WHERE id='$id'";
		if(mysqli_query($con,$update_qry))
		{
			$_SESSION['updated3']=true;
			
			header('location:timings.php');
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


      