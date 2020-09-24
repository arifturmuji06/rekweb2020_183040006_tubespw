<?php

require '../functions.php';
$id = $_GET['id'];

if (hapusUser($id) > 0) {
	echo "<script>
			alert('Data Berhasil Dihapus!');
			document.location.href = 'table-user.php';
		</script>";
} else {
	echo "<script>
			alert('Data Gagal Dihapus!');
			document.location.href = 'table-user.php';
		</script>";
}

?>