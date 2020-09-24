<?php
session_start();
if ( !isset( $_SESSION["login"]) ) {
 	$login = true;
} else {
	$login = false;
}

require '../functions.php';
$id = $_GET['author_id'];

if (hapusAuthor($id) > 0) {
	echo "<script>
			alert('Data Berhasil Dihapus!');
			document.location.href = 'table-author.php';
		</script>";
} else {
	echo "<script>
			alert('Data Gagal Dihapus!');
			document.location.href = 'table-author.php';
		</script>";
}

?>