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
<li><a href="movie.php" class="active">MOVIES</a></li>
<li><a href="theatres.php" >THEATRES</a></li>
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
  <span class="close" onclick="location.href='movie.php'">&times;</span>
	
	<?php
	include ("dbcon.php");
	if(isset($_REQUEST['eid']))
	{
	
	$eid=$_REQUEST['eid'];
	$qry1=" select * FROM movies where Movie_id='$eid'";
	$result1 = mysqli_query($con,$qry1);
	$row1=mysqli_fetch_assoc($result1);

	?>
	<form  method="post" enctype="multipart/form-data">
	<table align='center'>
	<tr>
	<td><b>MOVIE-</b></td>
	<td><input type='text' name='movie' value="<?php echo $row1['Movie_Name']?>" required></td>
	</tr>
	<tr>
	<td><b>ACTOR-</b></td>
	<td><input type='text' name='actor' value="<?php echo $row1['Actor']?>" required></td>
	</tr>
	<tr>
	<td><b>ACTRESS-</b></td>
	<td><input type='text' name='actress' value="<?php echo $row1['Actress']?>" required></td>
	</tr>
	<tr>
	<td><b>RELEASE DATE-</b></td>
	<td><input type='date' name='rdate' value="<?php echo $row1['Release_date']?>" required></td>
	</tr>
	<tr>
	<td><b>DIRECTOR-</b></td>
	<td><input type='text' name='director' value="<?php echo $row1['Director']?>" required></td>
	</tr>
	<tr>
	<td><b>RUNTIME-</b></td>
	<td><input type='text' name='rtime' placeholder='eg.2Hr 35Mins' value="<?php echo $row1['RunTime']?>" required></td>
	</tr>
	<tr>
	<td><b>GENRE-</b></td>
	<td><input type='text' name='type' value="<?php echo $row1['type']?>" required></td>
	</tr>
	<tr>
	<td><b>DESCRIPTION-</b></td>
	<td><textarea name='info' rows="4" cols="50" required><?php echo $row1['Description']?> </textarea></td>
	</tr>
	<tr>
	<td><b>TRAILER LINK-</b></td>
	<td><input type="text" name="trailer" value="<?php echo $row1['trailer']?>"></td>
	</tr>
	<tr>
	<td><b>WIKI LINK-</b></td>
	<td><input type="text" name="wiki" value="<?php echo $row1['wiki']?>"></td>
	</tr>
	<tr>
	<td><b>POSTER-</b></td>
	<td><input type="file" name="poster[]"  ></td>
	</tr>
	<tr>
	<td><b>ACTOR IMAGE-</b></td>
	<td><input type="file" name="poster[]" ></td>
	</tr>
	<tr>
	<td><b>ACTRESS IMAGE-</b></td>
	<td><input type="file" name="poster[]" ></td>
	</tr>
	<tr>
	<td><b>DIRECTOR IMAGE-</b></td>
	<td><input type="file" name="poster[]" ></td>
	</tr>
	<tr>
	<td ><input type='submit' name='submit' style="margin-left:75%;" value="SUBMIT"></td>
	</tr>
	
	</table>
	
	</form>
	<?php
	if( isset($_REQUEST['submit']))
	{
		$movie=$_REQUEST['movie'];
		$actor=$_REQUEST['actor'];
		$actress=$_REQUEST['actress'];
		$director=$_REQUEST['director'];
		$runtime=$_REQUEST['rtime'];
		$rdate=$_REQUEST['rdate'];
		$type=$_REQUEST['type'];
		$info=$_POST['info'];
		$trailer=$_POST['trailer'];
		$wiki=$_POST['wiki'];
		
		$update_qry="UPDATE movies SET Movie_Name='$movie',Actor='$actor',Actress='$actress',RunTime='$runtime',Release_date='$rdate',Director='$director',type='$type',Description='$info',trailer='$trailer',wiki='$wiki' WHERE Movie_id='$eid'";
		if(mysqli_query($con,$update_qry))
		{
			$_SESSION['updated1']=true;
		}
		else
		{
			?>
			<div align="center"> <?php echo "<b>ERROR IN UPDATION.</b><br>".$update_qry . "<br>" . mysqli_error($con);?></div>
			<?php
		}
	
		$file=$_FILES["poster"]["name"];
		$temp=$_FILES["poster"]["tmp_name"];
		$path=array("Image/".$file[0],"Image/".$file[1],"Image/".$file[2],"Image/".$file[3]);
		if($file[0]!=NULL)
		{
			move_uploaded_file($temp[0],$path[0]);
			mysqli_query($con,"UPDATE movies SET poster='$file[0]' WHERE Movie_id='$eid' ");
		}	
	
		if($file[1]!=NULL)
		{
			move_uploaded_file($temp[1],$path[1]);
			mysqli_query($con,"UPDATE movies SET ActorImg='$file[1]' WHERE Movie_id='$eid' ");
		}	
	
		if($file[2]!=NULL)
		{
			move_uploaded_file($temp[2],$path[2]);
			mysqli_query($con,"UPDATE movies SET ActressImg='$file[2]' WHERE Movie_id='$eid' ");
		}	


		if($file[3]!=NULL)
		{
			move_uploaded_file($temp[3],$path[3]);
			mysqli_query($con,"UPDATE movies SET DirectorImg='$file[3]' WHERE Movie_id='$eid' ");
		}	
		


	header('location:movie.php');  
	}
	
	
	}	
	
	?>
      
	</div>

</div>
</div>

</body>
</html>