<?php
session_start();

require '../functions.php';
$conn = koneksi();

if ( !isset( $_SESSION["login"]) ) {
 	header("Location: ../../index.php");
 	exit;
}


if ( isset( $_SESSION["authority"] )) {
	if ( $_SESSION["authority"] == 'admin') {
		$login = false;
		$dashboard = true;
	} else if ($_SESSION["authority"] == 'staff') {
		$login = false;
		$dashboard = false;
	}
} else {
	$login = true;
	$dashboard = false;
}

$book = query("SELECT * FROM book JOIN author ON book.author_id = author.author_id LIMIT 0, 2");
$author = query("SELECT * FROM author LIMIT 0, 2");
$user = query("SELECT * FROM user LIMIT 0, 2");


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../assets/css/materialize.min.css" media="screen,projection">
	<link type="text/css" rel="stylesheet" href="../../assets/css/style.css">
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
					<a href="../../index.php" class="brand-logo page-scroll">TitlePedia</a>
					<a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="../../index.php" class="a-hover page-scroll">Home</a></li>
							<li><a href="#" class="a-hover page-scroll">Profile</a></li>
						<?php if ($login == true) : ?>
							<li><a href="../../login.php" class="a-hover page-scroll">Login</a></li>
						<?php else : ?>
							<li><a href="../../logout.php" class="a-hover page-scroll">logout</a></li>
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
    <div id="content-admin" class="container">
    	<div class="row list-table">
    		<div class="col l12">
    			<div class="table-title">
					<h3>Book</h3>
					<a href="table-book.php"><h6>Open to Edit</h6></a>
				</div>
				<div class="table-content">
    				<table>
				    	<thead>
				          	<tr>
				              	<th>Cover</th>
				              	<th>Judul</th>
				              	<th>Pengarang</th>
				          	</tr>
				        </thead>

				        <tbody>
				        	<?php foreach($book as $item) : ?>
				          	<tr>
				            	<td><img src="../../assets/img/<?= $item['img']?>" style="width: 50px" alt=""></td>
				            	<td><?= $item['judul']?></td>
				            	<td><?= $item['nama']?></td>
				          	</tr>
				          	<?php endforeach; ?>
				          	<tr>
				          		<td>...</td>
				          		<td>...</td>
				          		<td>...</td>
				          	</tr>
				        </tbody>
				    </table>
				</div>
    		</div>
    		<div class="col l12">
    			<div class="table-title">
					<h3>Author</h3>
					<a href="table-author.php"><h6>Open to Edit</h6></a>
				</div>
				<div class="table-content">
    				<table>
				    	<thead>
				          	<tr>
				              	<th>Foto</th>
				              	<th>Nama</th>
				              	<th>Awal Karir</th>
				          	</tr>
				        </thead>

				        <tbody>
				        	<?php foreach($author as $item) : ?>
				          	<tr>
				            	<td><img src="../../assets/img/<?= $item['foto']?>" style="width: 50px" alt=""></td>
				            	<td><?= $item['nama']?></td>
				            	<td><?= $item['awal_karir']?></td>
				          	</tr>
				          	<?php endforeach; ?>
				          	<tr>
				          		<td>...</td>
				          		<td>...</td>
				          		<td>...</td>
				          	</tr>
				        </tbody>
				    </table>
				</div>
    		</div>
    		<?php if ($dashboard == true) : ?>
    		<div class="col l12">
    			<div class="table-title">
					<h3>User</h3>
					<a href="table-user.php"><h6>Open to Edit</h6></a>
				</div>
				<div class="table-content">
    				<table>
				    	<thead>
				          	<tr>
				              	<th>Nama</th>
				              	<th>Email</th>
				              	<th>Otoritas</th>
				          	</tr>
				        </thead>

				        <tbody>
				        	<?php foreach($user as $item) : ?>
				          	<tr>
				            	<td><?= $item['name']?></td>
				            	<td><?= $item['email'] ?></td>
				            	<td><?= $item['authority']?></td>
				          	</tr>
				          	<?php endforeach; ?>
				          	<tr>
				          		<td>...</td>
				          		<td>...</td>
				          		<td>...</td>
				          	</tr>
				        </tbody>
				    </table>
				</div>
    		</div>
			<?php endif ?>
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
							<li class="social-icon"><a href="https://plus.google.com/109430811596852598249"><img src="../../assets/img/icon/if_logo_social_media_google_plus_1071017.png" alt="" class="circle responsive-img"></a></li>
							<li class="social-icon"><a href="https://www.instagram.com/arifturmuji/"><img src="../../assets/img/icon/if_instagram_online_social_media_photo_734395.png" alt="" class="circle responsive-img"></a></li>
							<li class="social-icon"><a href="https://www.facebook.com/arif.turmuji"><img src="../../assets/img/icon/if_online_social_media_facebook_734386.png" alt="" class="circle responsive-img"></a></li>
							<li class="social-icon"><a href="https://api.whatsapp.com/send?phone=628977643213"><img src="../../assets/img/icon/if_social_media_logo_whatsapp_1221588.png" alt="" class="circle responsive-img"></a></li>
						</ul>
					</div>
				</div>
			</div>
			<p class="">&copy; Copyright 2018 | Buit by Arif Turmuji.</p>
		</div>
	</footer>

	<script type="text/javascript" src="../../assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../../assets/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="../../assets/js/materialize.min.js"></script>
	<script type="text/javascript" src="../../assets/js/script.js"></script>
</body>
</html>