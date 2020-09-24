<?php
session_start();

if ( !isset( $_SESSION["login"]) ) {
 	$login = true;
} else {
	$login = false;
}

if ( isset( $_SESSION["authority"] )) {
	if ( $_SESSION["authority"] == 'admin' || $_SESSION["authority"] == 'staff' ) {
		$dashboard = true;
	} else if ($_SESSION["authority"] == 'member') {
		$dashboard = false;
	}
} else {
	$dashboard = false;
}

if (!isset($_GET['id'])) {
	header("Lcation: ../index.php");
	exit;
}

require 'functions.php';
$id = $_GET['id'];

$item = query("SELECT * FROM book JOIN author ON book.author_id = author.author_id WHERE id = $id")[0];


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../assets/css/materialize.min.css" media="screen,projection">
	<link type="text/css" rel="stylesheet" href="../assets/css/style.css">
	<link type="text/css" rel="stylesheet" href="../assets/css/detail.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TitlePedia</title>
	<link rel="shortcut icon" href="" type="image/x-icon">
</head>
<body id="home">

	<!-- Navbar -->
	<div class="navbar-fixed">
		<nav id="navbar" class="my-bg-color">
			<div class="container">
				<div class="nav-wrapper">
					<a href="../index.php" class="brand-logo page-scroll">TitlePedia</a>
					<a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="../php/library.php" class="a-hover page-scroll">Full Library</a></li>
						<?php if ($dashboard == true) : ?>
							<li><a href="../php/dashboard/admin.php" class="a-hover page-scroll">Dashboard</a></li>
						<?php endif; ?>
						<?php if ($login == true) : ?>
							<li><a href="../login.php" class="a-hover page-scroll">Login</a></li>
						<?php else : ?>
							<li><a href="#" class="a-hover page-scroll">Profile</a></li>
							<li><a href="../logout.php" class="a-hover page-scroll">logout</a></li>
						<?php endif ?>
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
    <div id="content-detail" class="container">
    	<div class="row">

			<div class="content">
				<h1 class="judul"><?= $item["judul"] ?></h1>
				<div class="cover">
					<img src="../assets/img/<?= $item["img"] ?>">
				</div>
				<div class="detail">
					<table>
						<tr>
							<td>Penulis</td>
							<td>:</td>
							<td><?= $item["nama"] ?></td>
						</tr>
						<tr>
							<td>Genre</td>
							<td>:</td>
							<td><?= $item["genre"] ?></td>
						</tr>
						<tr>
							<td>Penerbit</td>
							<td>:</td>
							<td><?= $item["penerbit"] ?></td>
						</tr>
						<tr>
							<td>Tahun Terbit</td>
							<td>:</td>
							<td><?= $item["thnTerbit"] ?></td>
						</tr>
						<tr>
							<td>Jumlah Halaman</td>
							<td>:</td>
							<td><?= $item["jmlHal"] ?></td>
						</tr>
						<tr>
							<td>ISBN</td>
							<td>:</td>
							<td><?= $item["isbn"] ?></td>
						</tr>
						<tr>
							<td>Sinopsis</td>
							<td>:</td>
							<td><?= $item["sinopsis"] ?></td>
						</tr>
					</table>
					<p><a class="back" href="library.php">Full Library</a></p>
				</div>
			</div>


		</div>
    </div>



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