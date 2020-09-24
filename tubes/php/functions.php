<?php 

// Koneksi ke DB 

function koneksi() {
	$conn = mysqli_connect("localhost", "root", "") or die("Koneksi ke DB gagal!");
	mysqli_select_db($conn, "pw_183040006_tubes") or die("Database salah!");

	return $conn;	
}



// Query DB


function query($sql) {
	$conn = koneksi();
	$results = mysqli_query($conn, $sql);

	$rows = [];
	while ($row = mysqli_fetch_assoc($results)) {
		$rows[] = $row;
	}

	return $rows;
}

// tambah data
function tambah($data) {

	$conn = koneksi();

	$judul = htmlspecialchars($data['judul']);
	$genre = htmlspecialchars($data['genre']);
	$nama_author = htmlspecialchars($data['nama_author']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$thnTerbit = htmlspecialchars($data['thnTerbit']);
	$jmlHal = htmlspecialchars($data['jmlHal']);
	$isbn = htmlspecialchars($data['isbn']);
	$sinopsis = htmlspecialchars($data['sinopsis']);

	// upload gambar
	$img = upload();
	if ( !$img ) {
		return false;
	}

	$query_tambah = "INSERT INTO book VALUES ('', '$img', '$judul', '$genre', '3', '$penerbit', '$thnTerbit', '$jmlHal', '$isbn', '$sinopsis', '$nama_author')";

	mysqli_query($conn, $query_tambah);

	return mysqli_affected_rows($conn);
}

function tambahAuthor($data) {

	$conn = koneksi();

	$nama = htmlspecialchars($data['nama']);
	$alamat = htmlspecialchars($data['alamat']);
	$awal_karir = htmlspecialchars($data['awal_karir']);
	$deskripsi = htmlspecialchars($data['deskripsi']);

	// upload gambar
	$foto = uploadAuthor();
	if ( !$foto ) {
		return false;
	}

	$query_tambah = "INSERT INTO author VALUES ('', '$nama', '$alamat', '$awal_karir', '$deskripsi', '$foto')";

	mysqli_query($conn, $query_tambah);

	return mysqli_affected_rows($conn);
}


// upload
function upload() {

	$namaFile = $_FILES['img']['name'];
	$ukuranFile = $_FILES['img']['size'];
	$error = $_FILES['img']['error'];
	$tmpName = $_FILES['img']['tmp_name'];

	// cek ada gambar di upload
	if ($error === 4) {
		echo "<script>
			alert('Pilih gambar terlebih dahulu!');
			</script>";
		return false;
	}

	// cek gambar apa bukan
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
			alert('Yang anda upload bukan gambar!');
			</script>";
		return false;
	}

	// cek jika ukuran terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
			alert('Ukuran file terlalu besar!');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar bisa di upload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../assets/img/' . $namaFileBaru);

	return $namaFileBaru;
}

function uploadAuthor() {

	$namaFile = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	// cek ada gambar di upload
	if ($error === 4) {
		echo "<script>
			alert('Pilih gambar terlebih dahulu!');
			</script>";
		return false;
	}

	// cek gambar apa bukan
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
			alert('Yang anda upload bukan gambar!');
			</script>";
		return false;
	}

	// cek jika ukuran terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
			alert('Ukuran file terlalu besar!');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar bisa di upload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../assets/img/' . $namaFileBaru);

	return $namaFileBaru;


}




// hapus data
function hapus($id) {
	$conn = koneksi();
	mysqli_query($conn, "DELETE FROM book WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapusAuthor($author_id) {
	$conn = koneksi();
	mysqli_query($conn, "DELETE FROM author WHERE author_id = $author_id");

	return mysqli_affected_rows($conn);
}

function hapusUser($id) {
	$conn = koneksi();
	mysqli_query($conn, "DELETE FROM user WHERE id = $id");

	return mysqli_affected_rows($conn);
}

// ubah data
function ubah($data) {
	$conn = koneksi();

	$id = $data['id'];
	$judul = htmlspecialchars($data['judul']);
	$genre = htmlspecialchars($data['genre']);
	$author_id = htmlspecialchars($data['author_id']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$thnTerbit = htmlspecialchars($data['thnTerbit']);
	$jmlHal = htmlspecialchars($data['jmlHal']);
	$isbn = htmlspecialchars($data['isbn']);
	$sinopsis = htmlspecialchars($data['sinopsis']);
	$imgLama = htmlspecialchars($data['imgLama']);


	// cek apakah user pilih gambar baru apa ngga
	if ($_FILES['img']['error'] === 4) {
		$img = $imgLama;
	} else {
		$img = upload();
	}
	

	$query_ubah = "UPDATE book 
							SET 
							img = '$img',
							judul = '$judul', 
							genre = '$genre', 
							author_id = '$author_id', 
							penerbit = '$penerbit', 
							thnTerbit = '$thnTerbit', 
							jmlHal = '$jmlHal', 
							isbn = '$isbn', 
							sinopsis = '$sinopsis'
					WHERE id = '$id' ";

	mysqli_query($conn, $query_ubah);

	return mysqli_affected_rows($conn);
}

function ubahAuthor($data) {
	$conn = koneksi();

	$author_id = $data['author_id'];
	$nama = htmlspecialchars($data['nama']);
	$alamat = htmlspecialchars($data['alamat']);
	$awal_karir = htmlspecialchars($data['awal_karir']);
	$deskripsi = htmlspecialchars($data['deskripsi']);
	$imgLama = htmlspecialchars($data['imgLama']);


	// cek apakah user pilih gambar baru apa ngga
	if ($_FILES['foto']['error'] === 4) {
		$foto = $imgLama;
	} else {
		$foto = uploadAuthor();
	}
	

	$query_ubah = "UPDATE author 
							SET 
							foto = '$foto',
							nama = '$nama', 
							alamat = '$alamat', 
							awal_karir = '$awal_karir', 
							deskripsi = '$deskripsi'
					WHERE author_id = '$author_id' ";

	mysqli_query($conn, $query_ubah);

	return mysqli_affected_rows($conn);
}

function ubahUser($data) {
	$conn = koneksi();

	$id = $data['id'];
	$name = htmlspecialchars($data['name']);
	$email = htmlspecialchars($data['email']);
	$imgLama = htmlspecialchars($data['imgLama']);
	$authority = htmlspecialchars($data['authority']);


	// cek apakah user pilih gambar baru apa ngga
	if ($_FILES['img']['error'] === 4) {
		$img = $imgLama;
	} else {
		$img = upload();
	}
	

	$query_ubah = "UPDATE user 
							SET 
							img = '$img',
							name = '$name', 
							email = '$email',
							authority = '$authority'
					WHERE id = '$id' ";

	mysqli_query($conn, $query_ubah);

	return mysqli_affected_rows($conn);
}


// cari
function caribuku($keyword) {
	$query = "SELECT * FROM book JOIN author ON book.author_id = author.author_id 
					WHERE
					judul LIKE '%$keyword%' OR
					genre LIKE '%$keyword%' OR
					author.nama LIKE '%$keyword%' OR
					penerbit LIKE '%$keyword%' OR
					thnTerbit LIKE '%$keyword%'
				";
	return query($query);
}


function cariauthor($keyword) {
	$query = "SELECT * FROM author WHERE
					nama LIKE '%$keyword%' OR
					alamat LIKE '%$keyword%' OR
					awal_karir LIKE '%$keyword%'
				";
	return query($query);
}

function cariuser($keyword) {
	$query = "SELECT * FROM user WHERE
					username LIKE '%$keyword%' OR
					authority LIKE '%$keyword%'
				";
	return query($query);
}



// fungsi register
function registrasi($data) {
	$conn = koneksi();

	$username = strtolower(stripslashes($data['username']));
	$password = mysqli_real_escape_string($conn, $data['password']);
	$password2 = mysqli_real_escape_string($conn, $data['password2']);


	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar!');     
			</script>";
		return false;
	}


	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user baru ke db
	$query_register = "INSERT INTO user VALUES('', '$username', '$password', 'member', '', '', '')";
	mysqli_query($conn, $query_register);

	return mysqli_affected_rows($conn);
}