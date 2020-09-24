<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
 	header("Location: ../../index.php");
 	exit;
 } 

if ( isset( $_SESSION["authority"] )) {
	if ( $_SESSION["authority"] == 'member') {
		$dashboard = true;
	} else if ($_SESSION["authority"] == 'staff' || $_SESSION["authority"] == 'member') {
		header("Location: ../../index.php");
		exit;
	}
}


require '../functions.php';

$id = $_GET['id'];
$user = query("SELECT * FROM user WHERE id = $id")[0];
if (isset($_POST['update'])) {
	if (ubahUser($_POST) > 0) {
		echo "<script>
			alert('Data Berhasil Diubah!');
			document.location.href = 'table-user.php';
		</script>";
	} else {
		echo "<script>
			alert('Data Gagal Diubah!');
		</script>";
	}
}

if (isset($_POST['back'])) {
	header("Location: table-author.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../assets/css/materialize.min.css" media="screen,projection">
	<link type="text/css" rel="stylesheet" href="../../assets/css/style.css">
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
					<a href="../../index.php" class="brand-logo page-scroll">TitlePedia</a>
					<a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="../../index.php" class="a-hover page-scroll">Home</a></li>
						<li><a href="#full-library" class="a-hover page-scroll">Profile</a></li>
						<li><a href="#full-library" class="a-hover page-scroll">Login</a></li>
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
    <div id="content-admin" class="container add-author">
    	<div class="row list-table">
    		<div class="col l12">
    			<div class="table-title">
					<h3>Update Author</h3>
				</div>
				<div class="table-content clear">
    				<form action="" method="post" enctype="multipart/form-data">
    					<div class="form-input">
	    					<div class="left">	    						
								<input type="hidden" name="id" 	value="<?= $user['id']?>">
								<input type="hidden" name="imgLama" 	value="<?= $user['img']?>">
	    						<div>
		    						<label for="name">Nama</label>
		    						<input type="text" name="name" id="name" autofocus required autocomplete="off" value="<?= $user['name']?>">
	    						</div>
	    						<div>
	    							<label for="email">Email</label>
	    							<input type="text" name="email" id="email" autofocus required autocomplete="off" value="<?= $user['email']?>">
	    						</div>
	    					</div>
	    					<div class="right">
	    						<div class="file-field input-field">
								    <div class="btn">
								    	<span>File</span>
								    	<input type="file" name="img" id="img">
								    </div>
								    <div class="file-path-wrapper">
								    	<input class="file-path validate" type="text" value="<?= $user['img']?>">
								    </div>
							    </div>
	    						<div class="input-field">
								    <select name="authority">
								      <option value="<?= $user['authority']?>" selected><?= $user['authority']?></option>
								      <option value="admin">Admin</option>
								      <option value="staff">Staff</option>
								      <option value="member">Member</option>
								    </select>
								    <label>Authority</label>
								</div>
	    					</div>
    					</div>
    					<div class="clear center add-btn">
	    					<a class="btn-add">
	    						<button class="btn waves-effect waves-light" type="submit" name="update" id="update">Update
								</button>
	    					</a>
	    					<a class="btn-add" href="table-user.php">
	    						<button class="btn waves-effect waves-light" name="back">Cancel
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