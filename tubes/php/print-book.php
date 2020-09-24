<?php
require_once __DIR__ . '/../vendor/autoload.php';
require 'functions.php'; 

$book = query("SELECT * FROM book JOIN author ON book.author_id = author.author_id");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Report Book</title>
	<link rel="stylesheet" href="../assets/css/print.css">
</head>
<body>
	<h1>Daftar Buku</h1>
	<h6>by : TitlePedia.turmuji.com</h6>
	<table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px;">
			<thead>
				<tr>
					<th>#</th>
					<th>Gambar</th>
					<th>Judul</th>
					<th>Genre</th>
					<th>Penulis</th>
					<th>Penerbit</th>
					<th>Tahun Terbit</th>
					<th>Jumlah Halaman</th>
					<th>ISBN</th>
				</tr>
			</thead>
			<tbody>';
	$i = 1;
	foreach ($book as $row) {
		$html .= '<tr>
			<td>'. $i++ .'</td>
			<td><img src="../assets/img/'.$row["img"].'" width="50"></td>
			<td>'. $row["judul"] .'</td>
			<td>'. $row["genre"] .'</td>
			<td>'. $row["nama"] .'</td>
			<td>'. $row["penerbit"] .'</td>
			<td>'. $row["thnTerbit"] .'</td>
			<td>'. $row["jmlHal"] .'</td>
			<td>'. $row["isbn"] .'</td>
		</tr>';
	}

$html .= '</tbody>
		</table>
</body>
</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-buku.pdf', \Mpdf\Output\Destination::INLINE);

?>

