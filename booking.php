<?php
session_start();
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Booking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="css/swiper.min.css">

  <!-- Demo styles -->
  	<link href="css/animate.css" type='text/css' rel="stylesheet">

<style>
 
 * {
	margin: 0px;
	padding: 0px;
	font-family: comic sans;
}
select:required:invalid {
  color: gray;
}
option[value=""][disabled] {
  display: none;
}
option {
  color: black;
}

.locat{
	height: 40px;
	width: 100%px;
	background:  #0b243d;
	color: white;
	display: block;

}


.locat1{
	width: 100%;
	height:auto;
	margin-top: 10px;
	display: block;
	
}

.locat2{
	height: 40px;
	width: 100%;
	background:  #0b243d;
	color: white;
	display:block;
	margin-top: 10px;

}


.swiper-container {
      width: 100%;
      height: 300px;
    }

.swiper-slide {
      text-align: center;
      font-size: 18px;
      background:#fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
}

input[type="submit"]{
	border: 1px;
	background: #fb2525;
	outline: none;
	width:120px;
	height: 30px;
	color: #fff;
	border-radius:15px;
	
}

input[type="button"]{
	border: 1px;
	background: #fb2525;
	outline: none;
	width:120px;
	height: 30px;
	color: #fff;
	border-radius:15px;
	
}

.title2{
	width: 100%;
	height: 70px;
	background: black;
	color: white;
}


.h1{
	margin-left:0px;
	background: #151719;
	color: white;
	height: 50px;
	
}




.h5 a{
	text-decoration: none;
	color: white;
}

.sign{
		
		border-radius:6px;
		background-color:#1976D2;
		border: none;
		color: white;
		padding: 8px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		cursor: pointer;
		float:right;
		
		}
		
.sign:hover {
    background-color:#ECEFF1; 
    color: black;
}
.navbar li a:hover {
     background-color: black;
		color: white;
	
}

.navbar ul 
{	
	height:50px;
    list-style-type: none;
    overflow: hidden;
    background-color: #0b243d;
}

.navbar li a {
  float: left;
  display: block;
  color:white;
  text-align: center;
  padding: 12px 16px;
  text-decoration: none;
  font-size: 22px;
}

</style>
</head>
<body class="animated fadeIn">


	<?php
		include('dbcon.php');
		$count=0;
		$loc="null";
		$mov="null";	

	
		if( isset($_POST['loc']) && isset($_POST['mov']))
		{
			$loc=$_POST['loc'];
			$mov=$_POST['mov'];
			$_SESSION['movie_n']=$mov;
			$_SESSION['location']=$loc;
	
		}
		else
		{
			echo "";
		}
		
		$qry = "select * from movies";
		$run = mysqli_query($con,$qry);
	
		
		$qry1 = "SELECT DISTINCT Location FROM theatres;";
		$run1 = mysqli_query($con,$qry1);

		$qry2 = "SELECT Theatre_name, time1, time2, time3, time4, time5 FROM theatres where Location='$loc' and Movie_Name='$mov';";
		$run2 = mysqli_query($con,$qry2);

		
	?>
	
	
<div class='navbar'>
<ul>	
<li style="margin:0px;padding-left:5px;padding-right:2px;padding-top:0px;float:left;"><a href="userdashboard.php"><img src="images/back.png" height="30px" width="30px"></a> </li>
<li><img src="images/logo.png" style="padding-left:5px;padding-right:10px;padding-top:10px;float:left;height:35px;width:250px"></li>


<li ><a class="active" href="userdashboard.php">Home</a></li>
<li><a href="#about">About</a></li>
<li ><a href="#contact">Contact</a></li>

<?php if(isset($_SESSION['name']))
	{?>
<li style="padding-left:50px;padding-right:20px;padding-top:6px;"><button class='sign' onclick="document.location.href='userlogout.php'">Logout</button></li>
<?php }else{?>
<li style="padding-left:50px;padding-right:20px;padding-top:6px;"><button class='sign'  onclick="document.location.href='index.php'">Sign In</button></li>
<?php }?>


</ul>
</div>

<?php 
include('dbcon.php');
		
$qry1 = "SELECT * from movies";
		
$result = mysqli_query($con,$qry1);


$row_count=mysqli_num_rows($result);
?>

	  <!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
	<?php	
	for($i=0;$i<$row_count;$i++)
	{
	$row1 = mysqli_fetch_array($result);	
	?>
	
      <div class="swiper-slide"><img src="Image/<?php echo $row1['poster'];?>" height="200px" width="200px"></div>
     <?php
	}
	 ?>

    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
  
  

  <!-- Swiper JS -->
  <script src="js/swiper.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
	slidesPerView: 5,
      spaceBetween: 10,
     
      autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>

<center>
<form  method="post" >

	<table width="700px" style="margin-top: 20px; margin-bottom: 20px"  height="50px">
		<tr>
		
			<td width="50%">

				<select  required  style="width:100%; height:30px " name="mov">
					<option value="" disabled selected>Select Movie</option>	
					<?php
					while($data = mysqli_fetch_array($run))
					{
					if($data['Release_date']<="2018-10-15")
					{						
					?>
					<option value="<?php echo $data['Movie_Name']; ?>"> <?php echo $data['Movie_Name']; ?> </option>
					<?php
					}
					}
					?>
				</select>

			</td>
	
			<td width="50%">
				<select  required  style="width:100%; height:30px " name="loc">
					<option value="" disabled selected>Select Location</option>
					
					<?php
					
					while($data1 = mysqli_fetch_array($run1))
					{	
					?>
					<option value="<?php echo $data1["Location"]; ?>"> <?php echo $data1["Location"]; ?> </option>
					<?php
					}
					?>
				</select>

			</td>
	
		</tr>
	</table>
	<input type="submit" name="search_show" value="Search" />
</form>
</center>
<br>
<hr>


<?php
if(isset($_POST['search_show']))
{
	
?>
<br>
<div id="lo" class="locat" ><center><h4 style="padding-top:10px;"><center><?php echo "Location : ".$_POST["loc"];?></center></h4></div>

<div id="lo2" class="locat2" ><center><h4 style="padding-top:10px;"><center><?php echo "Movie : ".$_POST["mov"];?></center></h4></div>
<center>

<div id="lo1" class="locat1">
<form method="post" >
<table width="100%"  border="1" height="200px">	
						<?php
					
					while($data2 = mysqli_fetch_array($run2))
					{	
					?>
						<tr>
							<td>
								<input type="radio" name="theatre" value="<?php echo $data2["Theatre_name"];?>"  /> <?php echo $data2["Theatre_name"];?>
							</td>
							<?php
							if(!empty($data2["time1"]))
							{
							?>
							<td>
								<input type="radio" name="time" value="<?php echo $data2["time1"];?>"  /> <?php echo $data2["time1"];?>
							</td>
							<?php
							}
							 if(!empty($data2["time2"]))
							{
							?>

							<td>
								<input type="radio" name="time" value="<?php echo $data2["time2"];?>"  /> <?php echo $data2["time2"];?>
							</td>
							<?php
							}
							if(!empty($data2["time3"]))
							{
							?>
							<td>
								<input type="radio" name="time" value="<?php echo $data2["time3"];?>"  /> <?php echo $data2["time3"];?>
							</td>
							<?php
							}
							if(!empty($data2["time4"]))
							{
							?>
							<td>
								<input type="radio" name="time" value="<?php echo $data2["time4"];?>"  /> <?php echo $data2["time4"];?>
							</td>
							<?php
							}
							if(!empty($data2["time5"]))
							{
							?>
							<td>
								<input type="radio" name="time" value="<?php echo $data2["time5"];?>"  /> <?php echo $data2["time5"];?>
							</td>
							<?php
							}
							?>
						</tr>
					<?php
					}
					?>

</table>

<input type="submit" name="submit3" value="Next" style="margin-top: 10px;margin-bottom:30px;"  />

</center>
</div>
</form>

<?php }?>
   
</body>
</html>

<?php
$_SESSION['theatre_n']=null;
$_SESSION['timer']=null;
$thea=null;
$tim=null;
if(isset($_POST['submit3']))
{
	if(!isset($_SESSION['name']))
	{
		?>
		<script>
		alert("Please Login to book tickets")
		window.open('index.php','_self');
		</script>
		<?php
	}
	
	elseif( isset($_POST['theatre']) && isset($_POST['time']) )
	{
		include ('dbcon.php');
		$thea=$_POST['theatre'];
		$tim=$_POST['time'];
		$_SESSION['theatre_n']=$thea;
		$_SESSION['timer']=$tim;
		?>
		<script>
		window.open('ticket.php','_self');
		</script>
		<?php
	
	}
	else
	{
		?>
		<script>
		alert("Please Select Theatre and Time");
		</script>
		<?php	
	}
		
          

}


?>