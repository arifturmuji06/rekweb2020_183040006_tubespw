<?php
session_start();
require 'functions.php';

$conn = koneksi();

if (isset($_POST["register"])) {

	if (registrasi($_POST) > 0) {
		echo "<script>
				alert('User berhasil ditambahkan!');
			</script>";
		header("Location: ../login.php");
	} else {
		echo mysqli_error($conn);
	}
	
}

if ( isset($_SESSION["login"]) ) {
 	header("Location: ../index.php");
 	exit;
 } 


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../assets/css/materialize.min.css" media="screen,projection">
	<link type="text/css" rel="stylesheet" href="../assets/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TitlePedia | Tambah Buku</title>
	<link rel="shortcut icon" href="" type="image/x-icon">
</head>
<body id="home">

	<!-- Navbar -->
	<div class="navbar-fixed">
		<nav id="navbar" class="my-bg-color">
			<div class="container">
				<div class="nav-wrapper">
					<a href="index.php" class="brand-logo page-scroll">TitlePedia</a>
					<a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="../index.php" class="a-hover page-scroll">Home</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>

	<!-- Sidenav Navbar -->
	<ul class="sidenav" id="mobile-nav">
		<li><a href="#full-library" class="a-hover">Full Library</a>
		<li><a href="#full-library" class="a-hover">Profile</a></li>
		<li><a href="#full-library" class="a-hover">Login</a>
	</ul>


	<!-- Content index -->
    <div id="content-login" class="container">
    	<div class="row list-table">
    		<div class="col l12">
    			<div class="table-title">
					<h3 class="center">Register</h3>
				</div>
				<div class="table-content clear">
					<?php if ( isset($error) ) : ?>
						<p>Username / Password salah</p>
					<?php endif; ?>
    				<form action="" method="post" enctype="multipart/form-data">
    					<div class="form-input">
	    					<div class="input-user">
	    						<div>
		    						<label for="username">Username</label>
		    						<input type="text" name="username" id="username" autofocus required autocomplete="off">
	    						</div>
	    						<div>
	    							<label for="password">Password</label>
	    							<input type="password" name="password" id="password" autofocus required autocomplete="off">
	    						</div>
	    						<div>
	    							<label for="password2">Confirm Password</label>
	    							<input type="password" name="password2" id="password2" autofocus required autocomplete="off">
	    						</div>
	    					</div>
    					</div>
    					<div class="clear center add-btn">
	    					<a class="btn-add">
	    						<button class="btn waves-effect waves-light" type="submit" name="register" id="register">
	    							Register!
								</button>
	    					</a>
    					</div>
    				</form>
				</div>
    		</div>
    	</div>
    </div>

<!--  -->


	<!-- Footer -->
	<footer class="my-bg-color white-text center">
		<div class="bg-opacity">
			<h5>TitlePedia</h5>
			<div class="row footer-content">
				<div class="col m6 s12 left right-align">
					<h6>Darut Tauhid, Geger Kalong</h6>
					<h6><a href="mailto:arifturmuji316@gmail.com">arifturmuji316@gmail.com</a></h6>
					<h6><a href="tell:0812-2483-1880">0812-2483-1880</a></h6>
				</div>
				<div class="col m6 s12 right left-align">
					<div class="social-media social-media-footer">
						<ul>
							<li class="social-icon"><a href="https://plus.google.com/109430811596852598249"><img src="../assets/img/icon/if_logo_social_media_google_plus_1071017.png" alt="" class="circle responsive-img"></a></li>
							<li class="social-icon"><a href="https://www.instagram.com/arifturmuji/"><img src="../assets/img/icon/if_instagram_online_social_media_photo_734395.png" alt="" class="circle responsive-img"></a></li>
							<li class="social-icon"><a href="https://www.facebook.com/arif.turmuji"><img src="../assets/img/icon/if_online_social_media_facebook_734386.png" alt="" class="circle responsive-img"></a></li>
							<li class="social-icon"><a href="https://api.whatsapp.com/send?phone=628977643213"><img src="../assets/img/icon/if_social_media_logo_whatsapp_1221588.png" alt="" class="circle responsive-img"></a></li>
						</ul>
					</div>
				</div>
			</div>
			<p class="">&copy; Copyright 2018 | Buit by Arif Turmuji.</p>
		</div>
	</footer>

	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="../assets/js/materialize.min.js"></script>
	<script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>