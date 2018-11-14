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
<body class='bg-gray'>

<div class='header'>
<center><img src='images/admin.png' alt="AdminLogo" id="adminlogo"><br><center id='head' class="animated flipInX">ADMIN DASHBOARD</center>

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
if($_SESSION['updated1']==true)
	{
		?>
			<br><div align="center"> <?php echo "<b>DETAILS UPDATED.</b>";?></div><br>
		<?php
		$_SESSION['updated1']=NULL;
	}
?>
<div id='insert' class='pop animated rotateInDownRight'>
<div class="pop-content" style="padding:32px">
  <h1 align='center'>CREATE</h1><br>

  <span class="close" onclick="document.getElementById('insert').style.display='none'">&times;</span>
  
	<form action="movie.php" method="post" enctype="multipart/form-data">
	<table align='center' >

		
			<tr>
			<td><font color="red">* Upload (jpg,jpeg,png,gif extensions only)</font></td>
			</tr>
			<tr>
			<td><b>MOVIE-</b></td>
			<td><input type="text" name="movie_name"  required></td>
			</tr>
			<tr>
			<td><b>ACTOR-</b></td>
			<td><input type="text" name="actor"  required></td>
			</tr>
			<tr>
			<td><b>ACTRESS-</b></td>
			<td><input type="text" name="actress"  required></td>
			</tr>
			<tr>
			<td><b>DIRECTOR-</b></td>
			<td><input type="text" name="director"  required></td>
			</tr>
			<tr>
			<td><b>RELEASE DATE-</b></td>
			<td><input type="date" name="rdate"  required></td>
			</tr>
			<tr>
			<td><b>RUNTIME-</b></td>
			<td><input type="text" name="runtime" placeholder='2hr 35mins' required></td>
			</tr>
			<tr>
			<td><b>GENRE-</b></td>
			<td><input type="text" name="type"  required></td>
			</tr>
			<tr>
			<td><b>DESCRIPTION-</b></td>
			<td><textarea name='info' placeholder="Write Something.." rows="4" cols="50" required ></textarea></td>
			</tr>
			<tr>
			<td><b>TRAILER LINK-</b></td>
			<td><input type="text" name="trailer"></td>
			</tr>
			<tr>
			<td><b>WIKI LINK-</b></td>
			<td><input type="text" name="wiki"></td>
			</tr>
			<tr>
			<td><b>POSTER-</b></td>
			<td><input type="file" name="poster[]"></td>
			</tr> 
			<tr>
			<td><b>ACTOR IMAGE-</b></td>
			<td><input type="file" name="poster[]"></td>
			</tr>
			<tr>
			<td><b>ACTRESS IMAGE-</b></td>
			<td><input type="file" name="poster[]"></td>
			</tr>
			<tr>
			<td><b>DIRECTOR IMAGE-</b></td>
			<td><input type="file" name="poster[]"></td>
			</tr>
			<tr><td><input type="submit" style="margin-left:90%" name="submit" value="SAVE"></td></tr>
	</table>
	</form>
</div>
</div>
<?php

	include('dbcon.php');
	if(isset($_POST['submit']))
	{
		$movie=$_POST['movie_name'];
		$actor=$_POST['actor'];
		$actress=$_POST['actress'];
		$director=$_POST['director'];
		$rdate=$_POST['rdate'];
		$runtime=$_POST['runtime'];
		$type=$_POST['type'];
		$info=$_POST['info'];
		$trailer=$_POST['trailer'];
		$wiki=$_POST['wiki'];
		
		
		
		//to get uploaded poster
		$file=$_FILES["poster"]["name"];

		$qry_duplicate="Select Movie_Name,Actor,Actress,Release_date,Director from movies where Movie_Name='$movie' AND Actor='$actor' AND Actress='$actress' AND
		Release_date='$rdate' AND Director='$director'";
		
		$duplicate_result=mysqli_query($con,$qry_duplicate);
		$duplicate_count=mysqli_num_rows($duplicate_result);
		if ($duplicate_count>0)
		{?>
			<br><div align="center"> <?php echo "<b>MOVIE DETAILS ALREADY PRESENT.</b>";?></div><br>
		
			<?php
		}
		
		else
		{
			if($file[0]!=NULL && $file[1]!=NULL && $file[2]!=NULL && $file[3]!=NULL)
			{
				$temp=$_FILES["poster"]["tmp_name"];
				$path=array("Image/".$file[0],"Image/".$file[1],"Image/".$file[2],"Image/".$file[3]);
				
				$file1=explode(".",$file[0]);
				$file2=explode(".",$file[1]);
				$file3=explode(".",$file[2]);
				$file4=explode(".",$file[3]);
				
				$file1_name=array($file1[0],$file2[0],$file3[0],$file4[0]);
				$file_ext=array($file1[1],$file2[1],$file3[1],$file4[1]);
				$allowed_ext=array('jpg','jpeg','png','gif');

				if(in_array($file_ext[0],$allowed_ext)&& in_array($file_ext[1],$allowed_ext) && in_array($file_ext[2],$allowed_ext) && in_array($file_ext[3],$allowed_ext))
				{
			
			
			
					for($i=0;$i<4;$i++)
					{
						move_uploaded_file($temp[$i],$path[$i]);
					}
					
					
					$qry="INSERT INTO movies (Movie_Name,Actor,Actress,Release_date,Director,poster,RunTime,type,ActorImg,ActressImg,DirectorImg,Description,trailer,wiki) 
					VALUES ('$movie','$actor','$actress','$rdate','$director','$file[0]','$runtime','$type','$file[1]','$file[2]','$file[3]','$info',
					'$trailer','$wiki')";
		
		
					if (mysqli_query($con, $qry)) 
					{?>
					<br><div align="center"> <?php echo "<b>NEW RECORD CREATED SUCCESSFULLY.</b>";?></div><br>
		
					<?php
					}
					else
					{
					?>
					<br><div align="center"> <?php echo "<b>ERROR IN INSERTION.</b><br>".$qry . "<br>" . mysqli_error($con);?></div><br>
					<?php
					}
				}
				
			}	
				else
				{
					$qry="INSERT INTO movies (Movie_Name,Actor,Actress,Release_date,Director,RunTime,type,Description,trailer,wiki) 
					VALUES ('$movie','$actor','$actress','$rdate','$director','$runtime','$type','$info','$trailer','$wiki')";
					if (mysqli_query($con, $qry)) 
					{
						?>
						<br><div align="center"> <?php echo "<b>NEW RECORD CREATED SUCCESSFULLY.</b>";?></div><br>
						<div align="center"> <?php echo "<b>UPLOAD FAILED(jpg,jpeg,png,gif EXTENSIONS ONLY)</b>";?></div><br>
						<?php
					}
					else
					{
						?>
						<div align="center"> <?php echo "<b>ERROR IN INSERTION.</b><br>".$qry . "<br>" . mysqli_error($con);?></div>
						<?php
			
					}	
							
				}		
			}
	
		
		
		mysqli_close($con);
	}
		
?>	 

<?php

include ("dbcon.php");
if(isset($_REQUEST['delid']))
{
	$delid=$_REQUEST['delid'];
	$unlink_media_query="select poster from movies where Movie_id='$delid'";
	$result2=mysqli_query($con,$unlink_media_query);
	$row_count2=mysqli_num_rows($result2);
	$row2=mysqli_fetch_assoc($result2);
	if($row2['poster']==''){mysqli_query($con,"delete from movies where Movie_id='$delid'");}
	else
	{
		$unlink_media="Image/".$row2['poster'];
		unlink("$unlink_media");
		mysqli_query($con,"delete from movies where Movie_id='$delid'");
	}
	
	
	 
	?>
	<br><div align="center"> <?php echo "<b>DELETED.</b>";?></div><br>
	<?php
	
}		

$qry="select Movie_Name,Movie_id,Actor,Actress,Release_date,Director,poster,RunTime,type FROM movies";
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
<th>MOVIE</th>
<th>ACTOR</th>
<th>ACTRESS</th>
<th>RELEASE DATE</th>
<th>DIRECTOR</th>
<th>RUNTIME</th>
<th>GENRE</th>
<th>POSTER</th>
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
	<td><?php echo $row["Movie_Name"] ?></td>
	<td><?php echo $row["Actor"] ?></td>
	<td><?php echo $row["Actress"] ?></td>
	<td><?php echo $row["Release_date"] ?></td>
	<td><?php echo $row["Director"] ?></td>
	<td><?php echo $row["RunTime"] ?></td>
	<td><?php echo $row["type"] ?></td>
	
	
	<td><img class="myImg" style="cursor: pointer;" onclick="imgdisp(this.src)" alt="No Image" src="Image/<?php echo $row["poster"] ?>" height="50px" width='50px' ></td>

	<td><center><a href="movie.php?delid=<?php echo $row["Movie_id"] ?>" style="color:white"><img style="height:20px;width:20px" src="images/delete.png">
	</a></center></td>
	
	<td><a href="edit.php?eid=<?php echo $row["Movie_id"] ?>" style="color:white"><img style="height:20px;width:20px" src="images/edit.png">
	</a></td>

	</tr>
	<?php
}
}

?>



</div>

<div id="myModal" class="modal animated zoomIn">
  <span class="close" style="color:white;top:20px;right: 35px;" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
  <img class="modal-content" id="img01">

</div >


<script>
var modal = document.getElementById('myModal');
var modalImg = document.getElementById("img01");

function imgdisp(img){
    modal.style.display = "block";
    modalImg.src = img;  
}

</script>


</body>
</html>









