<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Upcoming Movies</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="css/swiper.min.css">
  <link href="css/animate.css" type='text/css' rel="stylesheet">


  <!-- Demo styles -->
  <style>
   * {
	margin: 0px;
	padding: 0px;
	font-family: comic sans;
}
    .swiper-container {
      width: 100%;
      height: auto;
      background: #CFD8DC;
      
    }
    .swiper-slide {
      font-size: 18px;
      color:black;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      padding: 40px 60px;
    }
    .parallax-bg {
      position: absolute;
      left: 0;
      top: 0;
      width: 130%;
      height: 100%;
      -webkit-background-size: cover;
      background-size: cover;
      background-position: center;
    }
    .swiper-slide .title {
      font-size: 41px;
      font-weight: 300;
    }
    .swiper-slide .subtitle {
      font-size: 21px;
	  padding-bottom:10px
    }
    .swiper-slide .text {
      font-size: 14px;
      max-width: 400px;
      line-height: 1.3;
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
  <!-- Swiper -->
  <div class="swiper-container">
 
    <div class="parallax-bg"  data-swiper-parallax="-23%"></div>
    <div class="swiper-wrapper">
    	<?php
		include('dbcon.php');
		
		$qry = "SELECT * from movies";
		
		$run = mysqli_query($con,$qry);
		
		if(mysqli_num_rows($run)>0)
		{
			while($row = mysqli_fetch_array($run))
			{
				if($row['Release_date']>='2018-10-16')
				{
				?>

	
      <div class="swiper-slide">
	  
	  <table width="auto" height="1200px" >
	  <tr>
	  
		<td style="position:absolute;top:60px;left:40px">
		<center><h2><?php echo $row['Movie_Name']; ?></h2></center>
		
		
        <div class="title" data-swiper-parallax="-300">
		<center>
		<img height="400px" width="340px"  src="Image/<?php echo $row['poster']?>"> 
		</center>
		</div>
		
        <div class="text" data-swiper-parallax="-300">
        	<center>
			<p>RunTime : <?php echo $row['RunTime']; ?> </p>
			<p>ReleaseDate : <?php echo $row['Release_date']; ?></p>
			<p>Type : <?php echo $row['type']; ?></p>
		</center>
        </div>
		
		<td style="position:absolute;top:60px;right:40px">
				<center><h2>TRAILER</h2></center>
		
		<object width="900px" height="400px"  data="http://www.youtube.com/v/<?php echo $row['trailer']; ?>" type="application/x-shockwave-flash">
				<param name="src" value="http://www.youtube.com/v/<?php echo $row['trailer']; ?>" /></object>
				
			
		
		</td>
		
		
		</tr>
		
		<tr>
		<h2 style="position:absolute;top:620px;left:80px;">CAST</h2>
		<td style="position:absolute;top:670px;left:80px">
				<p>ACTOR</p>
				<center>
					
					<img src="Image/<?php echo $row['ActorImg']?>" height="220px"width="150px" style="border-radius: 10px"/> 
					<h5> <?php echo $row['Actor']; ?></h5>
				</center>
		</td>
		
		
		<td style="position:absolute;top:670px;left:380px">
				<center>
					<p>ACTRESS</p>
					<img src="Image/<?php echo $row['ActressImg']?>" height="220px"width="150px" style="border-radius: 10px"/>
					<h5> <?php echo $row['Actress']; ?></h5>
				</center>
		</td>
		
		<td style="position:absolute;top:670px;left:680px">
				<center>
					<p>DIRECTOR</p>
					<img src="Image/<?php echo $row['DirectorImg']?>"height="220px"width="150px" style="border-radius: 10px"/> 
					<h5><?php echo $row['Director']; ?></h5>
				</center>
		</td>
		
		
		</tr>
		
		
		<tr>
		<h2 style="position:absolute;top:1020px;left:80px">SYNOPSIS</h2>
		<td style="position:absolute;top:1080px;left:80px">
		
				
					<p><?php echo $row['Description']?>
				<a style="text-decoration:none;" href="<?php echo $row['wiki']; ?>">More Details</a></p>
				
		</td>
		
		
		
		
		
		</tr>

		
	  </table>
      </div>
      <?php
  		}
	  }
	}

	?>

     
	  
   </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-white"></div>
    <!-- Add Navigation -->
    <div class="swiper-button-prev swiper-button-white" style=" background-color:black;padding:4px"></div>
    <div class="swiper-button-next swiper-button-white" style=" background-color: black;padding:4px"></div>
  </div>

  <!-- Swiper JS -->
  <script src="js/swiper.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      speed: 600,
      parallax: true,
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
</body>
</html>
