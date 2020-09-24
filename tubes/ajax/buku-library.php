<?php 

usleep(500000);
require '../php/functions.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM book JOIN author ON book.author_id = author.author_id 
			WHERE
			judul LIKE '%$keyword%' OR
			genre LIKE '%$keyword%' OR
			nama LIKE '%$keyword%' OR
			penerbit LIKE '%$keyword%' OR
			thnTerbit LIKE '%$keyword%' 
		";
$book = query($query);

?>
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