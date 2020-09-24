<?php
require_once __DIR__ . '/../vendor/autoload.php';
require 'functions.php'; 

$user = query("SELECT * FROM user");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Report User</title>
	<link rel="stylesheet" href="../assets/css/print.css">
</head>
<body>
	<h1>Daftar User</h1>
	<h6>by : TitlePedia.turmuji.com</h6>
	<table border="1" cellpadding="10" cellspacing="0" style="margin: 20px auto; width: 100%;">
			<thead>
				<tr>
					<th>#</th>
					<th>Foto</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Otoritas</th>
				</tr>
			</thead>
			<tbody>';
	$i = 1;
	foreach ($user as $row) {
		$html .= '<tr>
			<td>'. $i++ .'</td>
			<td><img src="../assets/img/'.$row["img"].'" width="50"></td>
			<td>'. $row["username"] .'</td>
			<td>'. $row["name"] .'</td>
			<td>'. $row["email"] .'</td>
			<td>'. $row["authority"] .'</td>
		</tr>';
	}

$html .= '</tbody>
		</table>
</body>
</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-user.pdf', \Mpdf\Output\Destination::INLINE);

?>

