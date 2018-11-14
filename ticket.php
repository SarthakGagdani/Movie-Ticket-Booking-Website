
<?php
    include 'dbcon.php';
    session_start();
	date_default_timezone_set('Asia/Kolkata');
if(isset($_SESSION['theatre_n']) && isset($_SESSION['timer']))
	{
	$time1=$_SESSION['timer'];
	$theatre1=$_SESSION['theatre_n'];
	$qry="SELECT * FROM timings WHERE Theatre_Name='$theatre1' AND showtime='$time1';";
	$run=mysqli_query($con,$qry);
	$row=mysqli_fetch_array($run);
	$_SESSION['seats']=$row['seats'];
	if($row['seats']>0)
	{
	echo "";
	$movie_name=$_SESSION['movie_n'];
	$today_date=date("d-m-Y");
	$loc=$_SESSION['location']; 
	$qry_seats="Select seats from bookings where theatre='$theatre1' AND movie_time='$time1' AND movie='$movie_name'
	AND date='$today_date' AND location='$loc' ";
	$run5=mysqli_query($con,$qry_seats);
	$seats_booked=array();
	while($row5=mysqli_fetch_array($run5)){
	$s=	explode(" ",$row5['seats']);
	$seats_booked=array_merge($seats_booked,$s);
	}
	}
	else
	{?>
		<script>
			alert("All seats booked,Select another show.");
			window.location="booking.php";
		</script>
	<?php	
	}
}
else{ header('location:booking.php');}



?>

<html>

<head>
    <title>Seat Selection</title>
   
    <script>
	
        addEventListener("load", function () {setTimeout(hideURLbar, 0); }, false);

        function hideURLbar() 
		{
            window.scrollTo(0, 1);
        }
		
    </script>
	
   	<link href="css/animate.css" type='text/css' rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
   
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
 
</head>

<body onload="onLoaderFunc()">

	<div class="header">
		<table  width="100%" >
			<tr>
				<td>
					<h5 style="padding-top: 15px"><center><a href="booking.php"><img src="images/back.png" height="25px" width="25px"></a></center></h5>
				</td>
				<td width="15%" >
					<center>
					<h4>
                     Movie: <?php
                       
						echo $_SESSION['movie_n'];
					 ?>               
                     </h4>
                 </center><br>

                </td>
                <td width="15%" >  
                      <center>  <h6>
                        Theatre: <?php echo 
                        $_SESSION['theatre_n']; 
                        ?>
                        </h6>
                    </center>

				</td>
				
				<td width="15%" >  
                      <center>  <h6>
                        Location: <?php echo 
                        $_SESSION['location']; 
                        ?>
                        </h6>
                    </center>

				</td>
				
                <td width="15%" >
                 <center>   <h4>
                    Time: <?php 
                    echo $_SESSION['timer']; 
                    ?>
                    </h4></center>
                </td>
                <td width="20%" >
                  <center>  <h6>Silver Price:
                        <?php
                         echo $row['ticket_rate_Silver']; 
                        ?>
                     </h6> </center>
                 </td>
                 <td width="20%" >
                    <center> <h6>Gold Price:
                        <?php 
                        echo $row['ticket_rate_Gold']; 
                        ?> </center>
                </h6> 
                </td>
			</tr>

		</table>

		
	</div>



    <div class="container">

        <div class="w3ls-reg">
            <!-- input fields -->
            <div class="inputForm">
                <div class="mr_agilemain">
                    <div class="agileits-right">
                        <label> Number of Seats
                            <span>*</span>
                        </label>
                        <input type="number" id="Numseats"  required min="1">
                    </div>
                </div>
                <button onclick="takeData()">Start Selecting</button>
            </div>
            <!-- //input fields -->
            <!-- seat availabilty list -->
            <ul class="seat_w3ls">
                <li class="smallBox greenBox">Booked Seat</li>

    

                <li class="smallBox emptyBox">Empty Seat</li>
            </ul>
            <!-- seat availabilty list -->
            <!-- seat layout -->
            <div class="seatStructure txt-center" style="overflow-x:auto;">
			<form method="Post" >
                <table id="seatsBlock">
                    <p id="notification" style="margin-bottom: 10px"></p>
					
                    <tr>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td></td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                    </tr>
		
					<tr><td style="color:#886D2C" >GOLD</td></tr>
					
                    <tr>
                        <td>A</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A1",$seats_booked)){echo "checked ";echo " disabled";}?> value="A1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A2",$seats_booked)){echo "checked ";echo " disabled";}?> value="A2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A3",$seats_booked)){echo "checked ";echo " disabled";}?> value="A3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A4",$seats_booked)){echo "checked ";echo " disabled";}?> value="A4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A5",$seats_booked)){echo "checked ";echo " disabled";}?> value="A5">
                        </td>
                        <td class="seatGap"></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A6",$seats_booked)){echo "checked ";echo " disabled";}?> value="A6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A7",$seats_booked)){echo "checked ";echo " disabled";}?> value="A7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A8",$seats_booked)){echo "checked ";echo " disabled";}?> value="A8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A9",$seats_booked)){echo "checked ";echo " disabled";}?> value="A9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A10",$seats_booked)){echo "checked ";echo " disabled";}?> value="A10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A11",$seats_booked)){echo "checked ";echo " disabled";}?> value="A11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("A12",$seats_booked)){echo "checked ";echo " disabled";}?> value="A12">
                        </td>
                    </tr>

                    <tr>
                        <td>B</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B1",$seats_booked)){echo "checked ";echo " disabled";}?> value="B1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B2",$seats_booked)){echo "checked ";echo " disabled";}?> value="B2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B3",$seats_booked)){echo "checked ";echo " disabled";}?> value="B3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B4",$seats_booked)){echo "checked ";echo " disabled";}?> value="B4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B5",$seats_booked)){echo "checked ";echo " disabled";}?> value="B5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B6",$seats_booked)){echo "checked ";echo " disabled";}?> value="B6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B7",$seats_booked)){echo "checked ";echo " disabled";}?> value="B7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B8",$seats_booked)){echo "checked ";echo " disabled";}?> value="B8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B9",$seats_booked)){echo "checked ";echo " disabled";}?> value="B9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B10",$seats_booked)){echo "checked ";echo " disabled";}?> value="B10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B11",$seats_booked)){echo "checked ";echo " disabled";}?> value="B11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("B12",$seats_booked)){echo "checked ";echo " disabled";}?> value="B12">
                        </td>
                    </tr>

                    <tr>
                        <td>C</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C1",$seats_booked)){echo "checked ";echo " disabled";}?> value="C1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C2",$seats_booked)){echo "checked ";echo " disabled";}?> value="C2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C3",$seats_booked)){echo "checked ";echo " disabled";}?> value="C3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C4",$seats_booked)){echo "checked ";echo " disabled";}?> value="C4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C5",$seats_booked)){echo "checked ";echo " disabled";}?> value="C5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C6",$seats_booked)){echo "checked ";echo " disabled";}?> value="C6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C7",$seats_booked)){echo "checked ";echo " disabled";}?> value="C7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C8",$seats_booked)){echo "checked ";echo " disabled";}?> value="C8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C9",$seats_booked)){echo "checked ";echo " disabled";}?> value="C9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C10",$seats_booked)){echo "checked ";echo " disabled";}?> value="C10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C11",$seats_booked)){echo "checked ";echo " disabled";}?> value="C11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("C12",$seats_booked)){echo "checked ";echo " disabled";}?> value="C12">
                        </td>
                    </tr>

                    <tr>
                        <td>D</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D1",$seats_booked)){echo "checked ";echo " disabled";}?> value="D1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D2",$seats_booked)){echo "checked ";echo " disabled";}?> value="D2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D3",$seats_booked)){echo "checked ";echo " disabled";}?> value="D3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D4",$seats_booked)){echo "checked ";echo " disabled";}?> value="D4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D5",$seats_booked)){echo "checked ";echo " disabled";}?> value="D5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D6",$seats_booked)){echo "checked ";echo " disabled";}?> value="D6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D7",$seats_booked)){echo "checked ";echo " disabled";}?> value="D7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D8",$seats_booked)){echo "checked ";echo " disabled";}?> value="D8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D9",$seats_booked)){echo "checked ";echo " disabled";}?> value="D9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D10",$seats_booked)){echo "checked ";echo " disabled";}?> value="D10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D11",$seats_booked)){echo "checked ";echo " disabled";}?> value="D11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("D12",$seats_booked)){echo "checked ";echo " disabled";}?> value="D12">
                        </td>
                    </tr>

                    <tr>
                        <td>E</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E1",$seats_booked)){echo "checked ";echo " disabled";}?> value="E1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E2",$seats_booked)){echo "checked ";echo " disabled";}?> value="E2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E3",$seats_booked)){echo "checked ";echo " disabled";}?> value="E3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E4",$seats_booked)){echo "checked ";echo " disabled";}?> value="E4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E5",$seats_booked)){echo "checked ";echo " disabled";}?> value="E5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E6",$seats_booked)){echo "checked ";echo " disabled";}?> value="E6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E7",$seats_booked)){echo "checked ";echo " disabled";}?> value="E7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E8",$seats_booked)){echo "checked ";echo " disabled";}?> value="E8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E9",$seats_booked)){echo "checked ";echo " disabled";}?> value="E9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E10",$seats_booked)){echo "checked ";echo " disabled";}?> value="E10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E11",$seats_booked)){echo "checked ";echo " disabled";}?> value="E11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("E12",$seats_booked)){echo "checked ";echo " disabled";}?> value="E12">
                        </td>
                    </tr>

                    <tr class="seatVGap"></tr>
					<tr><td style="color:#886D2C">SILVER</td></tr>

                    <tr>
                        <td>F</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F1",$seats_booked)){echo "checked ";echo " disabled";}?> value="F1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F2",$seats_booked)){echo "checked ";echo " disabled";}?> value="F2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F3",$seats_booked)){echo "checked ";echo " disabled";}?> value="F3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F4",$seats_booked)){echo "checked ";echo " disabled";}?> value="F4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F5",$seats_booked)){echo "checked ";echo " disabled";}?> value="F5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F6",$seats_booked)){echo "checked ";echo " disabled";}?> value="F6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F7",$seats_booked)){echo "checked ";echo " disabled";}?> value="F7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F8",$seats_booked)){echo "checked ";echo " disabled";}?> value="F8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F9",$seats_booked)){echo "checked ";echo " disabled";}?> value="F9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F10",$seats_booked)){echo "checked ";echo " disabled";}?> value="F10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F11",$seats_booked)){echo "checked ";echo " disabled";}?> value="F11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("F12",$seats_booked)){echo "checked ";echo " disabled";}?> value="F12">
                        </td>
                    </tr>

                    <tr>
                        <td>G</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G1",$seats_booked)){echo "checked ";echo " disabled";}?> value="G1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G2",$seats_booked)){echo "checked ";echo " disabled";}?> value="G2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G3",$seats_booked)){echo "checked ";echo " disabled";}?> value="G3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G4",$seats_booked)){echo "checked ";echo " disabled";}?> value="G4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G5",$seats_booked)){echo "checked ";echo " disabled";}?> value="G5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G6",$seats_booked)){echo "checked ";echo " disabled";}?> value="G6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G7",$seats_booked)){echo "checked ";echo " disabled";}?> value="G7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G8",$seats_booked)){echo "checked ";echo " disabled";}?> value="G8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G9",$seats_booked)){echo "checked ";echo " disabled";}?> value="G9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G10",$seats_booked)){echo "checked ";echo " disabled";}?> value="G10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G11",$seats_booked)){echo "checked ";echo " disabled";}?> value="G11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("G12",$seats_booked)){echo "checked ";echo " disabled";}?> value="G12">
                        </td>
                    </tr>

                    <tr>
                        <td>H</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H1",$seats_booked)){echo "checked ";echo " disabled";}?> value="H1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H2",$seats_booked)){echo "checked ";echo " disabled";}?> value="H2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H3",$seats_booked)){echo "checked ";echo " disabled";}?> value="H3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H4",$seats_booked)){echo "checked ";echo " disabled";}?> value="H4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H5",$seats_booked)){echo "checked ";echo " disabled";}?> value="H5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H6",$seats_booked)){echo "checked ";echo " disabled";}?> value="H6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H7",$seats_booked)){echo "checked ";echo " disabled";}?> value="H7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H8",$seats_booked)){echo "checked ";echo " disabled";}?> value="H8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H9",$seats_booked)){echo "checked ";echo " disabled";}?> value="H9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H10",$seats_booked)){echo "checked ";echo " disabled";}?> value="H10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H11",$seats_booked)){echo "checked ";echo " disabled";}?> value="H11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("H12",$seats_booked)){echo "checked ";echo " disabled";}?> value="H12">
                        </td>
                    </tr>

                    <tr>
                        <td>I</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I1",$seats_booked)){echo "checked ";echo " disabled";}?> value="I1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I2",$seats_booked)){echo "checked ";echo " disabled";}?> value="I2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I3",$seats_booked)){echo "checked ";echo " disabled";}?> value="I3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I4",$seats_booked)){echo "checked ";echo " disabled";}?> value="I4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I5",$seats_booked)){echo "checked ";echo " disabled";}?> value="I5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I6",$seats_booked)){echo "checked ";echo " disabled";}?> value="I6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I7",$seats_booked)){echo "checked ";echo " disabled";}?> value="I7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I8",$seats_booked)){echo "checked ";echo " disabled";}?> value="I8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I9",$seats_booked)){echo "checked ";echo " disabled";}?> value="I9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I10",$seats_booked)){echo "checked ";echo " disabled";}?> value="I10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I11",$seats_booked)){echo "checked ";echo " disabled";}?> value="I11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("I12",$seats_booked)){echo "checked ";echo " disabled";}?> value="I12">
                        </td>
                    </tr>

                    <tr>
                        <td>J</td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J1",$seats_booked)){echo "checked ";echo " disabled";}?> value="J1">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J2",$seats_booked)){echo "checked ";echo " disabled";}?> value="J2">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J3",$seats_booked)){echo "checked ";echo " disabled";}?> value="J3">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J4",$seats_booked)){echo "checked ";echo " disabled";}?> value="J4">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J5",$seats_booked)){echo "checked ";echo " disabled";}?> value="J5">
                        </td>
                        <td></td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J6",$seats_booked)){echo "checked ";echo " disabled";}?> value="J6">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J7",$seats_booked)){echo "checked ";echo " disabled";}?> value="J7">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J8",$seats_booked)){echo "checked ";echo " disabled";}?> value="J8">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J9",$seats_booked)){echo "checked ";echo " disabled";}?> value="J9">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J10",$seats_booked)){echo "checked ";echo " disabled";}?> value="J10">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J11",$seats_booked)){echo "checked ";echo " disabled";}?> value="J11">
                        </td>
                        <td>
                            <input type="checkbox" class="seats" name="a[]" <?php if(in_array("J12",$seats_booked)){echo "checked ";echo " disabled";}?> value="J12">
                        </td>
                    </tr>
                </table>

                <div class="screen">
                    <h2 class="wthree">Screen this way</h2>
                </div>
				
				
				<input type="submit" class='seat_submit' name='submit_seat' value="Confirm Selection" >
				</form>
            </div>            
        </div>
	</div>
<!-- //details after booking displayed here -->		
  
	
		<?php
			if(isset($_POST['submit_seat']))
			{
				
					
				
				
				
				$amt=0;
				foreach($_POST['a'] as $seat)
				{
				if(substr($seat,0,1)=='A'||substr($seat,0,1)=='B'||substr($seat,0,1)=='C'||substr($seat,0,1)=='D'||substr($seat,0,1)=='E')
				{
					$amt=$amt+$row['ticket_rate_Gold'];
				}
				else{$amt=$amt+$row['ticket_rate_Silver'];}
				}
				
				
				$_SESSION['seatings']=$_POST['a'];
				$_SESSION['amt']=$amt;				

					
			?>
            <!-- details after booking displayed here -->
			<div id="display" class="pop-content pop">
			<span class="close" onclick="document.getElementById('display').style.display='none'">&times;</span>
            <div class="displayerBoxes txt-center" style="overflow-x:auto;">
				<form>
                <table class="Displaytable w3ls-table" width="100%">
                    <tr>
                        
                        <th>Number of Seats</th>
                        <th>Seats</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        
                        <td>
                            <textarea><?php echo count($_POST['a']);?></textarea>
                        </td>
                        <td>
                            <textarea><?php foreach($_POST['a'] as $seat){
								
								echo $seat." " ;}?></textarea>
                        </td>
						
                        <td>
                            <textarea><?php echo $amt;?>
							</textarea>
                        </td>
						
                    </tr>
					
                </table>
				
				<center><a class='pay' href="receipt.php">Pay <?php echo $amt;?></a> </center> 
				</form>
				
            </div>
			</div>
			<?php
			}
			?>
    
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- script for seat selection -->
    <script>
	

        function onLoaderFunc() {
            $(".seat_submit*").prop("disabled", true);
			$('input[type=checkbox]').not(':checked').prop("disabled", true);

       
        }

        function takeData() {
            if ($("#Numseats").val().length == 0) {
                alert("Please Enter Number of Seats");
				}
			
			if ($("#Numseats").val() > <?php echo $_SESSION['seats'] ?>) {
                alert("Seats are not available.");
				}
			else
				{
				$('input[type=checkbox]').not(':checked').prop("disabled", false);
	
                $(".inputForm *").prop("disabled", false);
				$(".seat_submit*").prop("disabled", true);

                document.getElementById("notification").innerHTML =
                    "<b style='padding:10px 10px 10px 10px;background:white;color:red; '>Please select Seats NOW!</b>";
					
					
				

					
				}
		}
		
		$('input[type=checkbox]').not(':checked').click(function () {
			
			if (($('input:checkbox:checked').length-<?php echo count($seats_booked);?>) == ($("#Numseats").val())) 
			{
                $('input[type=checkbox]').not(':checked').prop("disabled", true);

				$(".seat_submit*").prop("disabled", false);

            } else {
                $('input[type=checkbox]').not(':checked').prop("disabled", false);
				$(".seat_submit*").prop("disabled", true);
				}	
		
		
		 });
				
			
		
		
        

 
    </script>

</body>

</html>




