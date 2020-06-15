<?php
	if(!isset($_SESSION)){
		session_start();
	}
	require('db/db.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>NAMI Integrated Learning Environment</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">


  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
	<link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css"> 
	<link rel="shortcut icon" href="images/title.png" type="image/x-icon">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Pricing -->
	<link rel="stylesheet" href="css/pricing.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body onclick="return check(event)">
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-right">
						<p class="site"><a href="javascript:history.back();"><i class="fas fa-arrow-circle-left"></i></a></p>
						<p class="site">namilearn.edu.np</p>
						<p class="num"><iframe src="https://freesecure.timeanddate.com/clock/i74qhtgz/n117/tlnp/pt5/pb0/tt0/th2" frameborder="0" width="290" height="22"></iframe></p>
						<ul class="fh5co-social">
							<li><a href="https://www.facebook.com/NamiCollege/" target="_blank"><i class="icon-facebook2"></i></a></li>
							<li><a href="https://twitter.com/NamiCollege" target="_blank"><i class="icon-twitter2"></i></a></li>
							<li><a href="https://www.instagram.com/namicollege/" target="_blank"><i class="icon-instagram"></i></a></li>
							<li><a href="https://www.linkedin.com/company/nami-college/" target="_blank"><i class="icon-linkedin2"></i></a></li>
							<li><a href="https://www.youtube.com/user/naminepal" target="_blank"><i class="icon-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.php"><img src="images/logo.jpg"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="active"><a href="index.php">Home</a></li>
							<li><a href="public-staffs.php">Staffs</a></li>
							<?php
								if(isset($_SESSION['std']['std_id'])){?>
									<li><a href="courses.php">Courses</a></li>
							<?php } ?>
							<?php
								if(isset($_SESSION['stf']['stf_id'])){?>
									<li><a href="courses.php">Courses</a></li>
									<li><a href="students.php">Students</a></li>
							<?php } ?>
							
							<?php if(isset($_SESSION['std']) || isset($_SESSION['stf'])){
								echo '<li class="btn-cta" onclick= "return profile()"><a href="javascript:void(0)">';
							} 
							else echo '<li class="btn-cta"><a href="login">';?>

							<span id="userName">
								<?php if(isset($_SESSION['std'])){
									$query = $data->prepare("SELECT CONCAT(firstname,' ',surname) as name FROM students WHERE std_id = :std_id");
									$query->execute($_SESSION['std']);

									$name = $query->fetch();

									echo $name['name'];
								}

								else if (isset($_SESSION['stf'])){
									$query = $data->prepare("SELECT CONCAT(firstname,' ',surname) as name FROM staffs WHERE stf_id = :stf_id");
									$query->execute($_SESSION['stf']);

									$name = $query->fetch();

									echo $name['name'];
								}
								else echo 'Login'?>
							</span></a></li>
						</ul>
					</div>
					<div class="profile">
						<ul>
							<li><a href="profile.php">Profile</a></li>
							<li><a href="notifications.php">Notifications</a></li>
							<li><a href="login">LogOut</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<hr style="margin-top:-5px;margin-bottom:-2px;">