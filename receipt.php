<?php
	session_start();
	include 'dbcon.php';
	date_default_timezone_set('Asia/Kolkata');

	if(isset($_SESSION['seatings']) && isset($_SESSION['theatre_n']) && isset($_SESSION['timer']))
	{
		$theatre1=$_SESSION['theatre_n'];
		$time1=$_SESSION['timer'];
		$name=$_SESSION['name'];
		$date1=date("d-m-Y");
		$mname=$_SESSION['movie_n'];
		$seat=implode(" ",$_SESSION['seatings']);
		$loc=$_SESSION['location'];
		$amt=$_SESSION['amt'];
		
	$qry_duplicate="select username,movie,theatre,seats,date,movie_time,location,amount from bookings where 
	username='$name'AND movie='$mname' AND theatre='$theatre1' AND seats='$seat'AND date='$date1'AND movie_time='$time1'AND
	location='$loc' AND amount='$amt'";
	$duplicate_result=mysqli_query($con,$qry_duplicate);
	$duplicate_count=mysqli_num_rows($duplicate_result);
	if ($duplicate_count>0)
	{echo " ";}
	else{
		
	$seat_updated=$_SESSION['seats']-count($_SESSION['seatings']);
	$qry="UPDATE timings SET seats=$seat_updated WHERE Theatre_Name='$theatre1' AND showtime='$time1'";
	mysqli_query($con,$qry);
	$qry_insert_booking="INSERT INTO bookings(username,movie,theatre,seats,date,movie_time,location,amount)
	VALUES ('$name','$mname','$theatre1','$seat','$date1','$time1','$loc','$amt')";
	mysqli_query($con,$qry_insert_booking);
	if(mail($_SESSION['email'],'Movietick','Movie: '.$_SESSION['movie_n']."\n".'Showtime: '.$_SESSION['timer']."\n".'Theatre: '.$_SESSION['theatre_n'].",".$loc."\n".'Seats: '.json_encode($_SESSION['seatings'])."\n"."Your Ticket Booked."))
{
}
else
{
     echo "Mail not sent.";
}
	}
	}
	else
	{
	
	?>
	<script>
	window.open('booking.php','_self');
	</script>
	<?php
	}
	
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Receipt Page</title>
  <link rel="stylesheet" href="css/swiper.min.css">

<link rel="stylesheet" type="text/css" href="css/receiptstyle.css">
</head>
<body onload="myFunction()">


	
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
		
<div id="loader"></div>	
		
<div style="display:none;" id="myDiv" class="animate-bottom" >
<br><h2 style="color:#886D2C;">Congratulations,Ticket booked!</h2>
<br><h2 style="color:#886D2C;">We have sent you email regarding your booking.</h2>


<div class='food2'>
<img src='images/food.gif' height='400px' width='1200px' >
<br><br><br>
</div>
	
		<img src="images/booked.png" class='booked'>
		
		<center class="receipt-holder">
		
		
		<table border="1">
		
			<tr>
				<td>
					<b>DATE</b>
				</td>
				<td>
					<?php echo date("d-m-Y"); ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<b>SHOWTIME</b>
				</td>
				<td>
					<?php echo $_SESSION['timer']; ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<b>MOVIE</b>
				</td>
				<td>
					<?php echo $_SESSION['movie_n']; ?>
				</td>
			</tr>
			<tr>
				<td>
					<b>THEATRE</b>
				</td>
				<td>
					<?php echo $_SESSION['theatre_n']; ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<b>LOCATION</b>
				</td>
				<td>
					<?php echo $_SESSION['location']; ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<b>SEATS</b>
				</td>	
				<td><?php
						
							foreach($_SESSION['seatings'] as $selected)
	                        {
	                            echo $selected." ";
	                        }
					?>
				</td>
				
			</tr>
		
		</table>
		<button class="book" onclick="location.href='booking.php'"> Book Another Ticket?</button>
		</center>
	
</div>


<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 4000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>	

</body>
</html>


