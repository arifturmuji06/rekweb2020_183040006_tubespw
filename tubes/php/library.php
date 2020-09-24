<?php
session_start();

require 'functions.php';
$conn = koneksi();


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

if (isset($_GET['order'])) {
	$order = $_GET['order'];
} else {
	$order = 'id';
}

if (isset($_GET['sort'])) {
	$sort = $_GET['sort'];
} else {
	$sort = 'ASC';
}


$book = query("SELECT * FROM book JOIN author ON book.author_id = author.author_id ORDER BY $order $sort");

$sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';

if (isset($_GET['cari'])) {
	$book = caribuku($_GET['keyword']);
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
						<li><a href="../index.php" class="a-hover page-scroll">Home</a></li>
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
    <div id="content-library" class="container">
    	<div class="row">
    		<div class="col l2">
    			<div class="option">
    				<form action="" method="get">
						<input type="text" name="keyword" id="keyword" class="form-control" autofocus placeholder="Search..." autocomplete="off">
						<button type="submit" name="cari" id="cari"><i class="small material-icons">search</i></button>
					</form>
					<?php if($login==false) : ?>
					<div class="action-edit">
						<ul>
							<li><a href="dashboard/add-book.php"><h6>Tambah Buku</h6></a></li>
							<li><a href="dashboard/add-book.php"><h6>Tambah Author</h6></a></li>
						</ul>
					</div>
					<?php endif; ?>
					<div class="sorting">
						<h6>Urutkan</h6>
						<ul>
							<li><a href="?order=id&&sort=<?= $sort; ?>">Number</a></li>
							<li><a href="?order=judul&&sort=<?= $sort; ?>">Judul</a></li>
						</ul>
						
					</div>
    			</div>
    		</div>
    		<div class="col l10">
    			<div style="">
    				<div class="row" id="container-ajax">
					<?php foreach ($book as $item) : ?>
						<div class="col m3 list-item-book">
							<div class="data-itemm-book">
								<div class="cover-itemm-book">
									<img src="../assets/img/<?= $item["img"]; ?>" alt="">
								</div>
								<p class="judul-item-book">
									<a href="detail.php?id=<?= $item["id"]; ?>">
										<?= $item['judul']; ?>
									</a>
								</p>
							</div>
						</div>
					<?php endforeach ?>
					</div>
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

	<script type="text/javascript" src="../assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="../assets/js/materialize.min.js"></script>
	<script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>