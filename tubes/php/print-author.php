<?php
require_once __DIR__ . '/../vendor/autoload.php';
require 'functions.php'; 


$jumlahData = count(query("SELECT * FROM author"));

$author = query("SELECT * FROM author LIMIT 1, $jumlahData"); // data pertama atau index ke 0 merupakan author default

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Report Author</title>
	<link rel="stylesheet" href="../assets/css/print.css">
</head>
<body>
	<h1>Daftar Buku</h1>
	<h6>by : TitlePedia.turmuji.com</h6>
	<table border="1" cellpadding="10" cellspacing="0" style="margin: 20px auto; width: 100%;">
			<thead>
				<tr>
					<th>#</th>
					<th>Foto</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Awal Karir</th>
				</tr>
			</thead>
			<tbody>';
	$i = 1;
	foreach ($author as $row) {
		$html .= '<tr>
					<td>'. $i++ .'</td>
					<td><img src="../assets/img/'.$row["foto"].'" width="50"></td>
					<td>'. $row["nama"] .'</td>
					<td>'. $row["alamat"] .'</td>
					<td>'. $row["awal_karir"] .'</td>
				</tr>';
	}

$html .= '</tbody>
		</table>
</body>
</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-author.pdf', \Mpdf\Output\Destination::INLINE);

?>

