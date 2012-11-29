<div id="isi-tengah">
<div class="title-berita">Berita Akademik</div>
<div id="learning-baru">
	<?php
	foreach($slide_akademik->result_array() as $s)
	{
		$isi = substr($s['isi'],0,140);
		echo"<div id='akademik'>
				<div id='berita-tengah'>
					<a href='".base_url()."index.php/web/detberita/".$s['tipe_artikel']."/".$s['id_artikel']."'>
						<h4>".$s['judul']."</h4>
					</a>
					<h6>".$s['tanggal']." - ".$s['waktu']." | Kategori ".$s['nama_kat']." | oleh <b><i>".$s['username']."</i></b></h6>
					<img src='".base_url()."application/views/web/berita/".$s['gambar']."' class='image' height='60'>
						".$isi.".....
					<a href='".base_url()."index.php/web/detberita/".$s['tipe_artikel']."/".$s['id_artikel']."'>
					<br>
					<b><div class='selanjutnya-akademik'>Baca Selengkapnya</div></b>
					</a>
				</div>
			</div>";
}
?>
</div>
<p>&nbsp;</p>
<div class="title-berita">Berita Kegiatan</div>
<div id="learning-baru">
<?php
foreach($slide_kegiatan->result_array() as $s)
{
	$isi = substr($s['isi'],0,180);
	echo"<div id='akademik'>
			<a href='".base_url()."index.php/web/detberita/".$s['tipe_artikel']."/".$s['id_artikel']."'>
				<b><h4>".$s['judul']."</h4></b>
			</a>
				<h6>".$s['tanggal']." - ".$s['waktu']." | Kategori ".$s['nama_kat']." | oleh <b><i>".$s['username']."</i></b></h6>
				<img src='".base_url()."application/views/web/berita/".$s['gambar']."' class='image' height='50'>
				".$isi.".....";
	echo"	<a href='".base_url()."index.php/web/detberita/".$s['tipe_artikel']."/".$s['id_artikel']."'>
					<div class='selanjutnya-akademik'>Baca Selengkapnya</div></a>
			</div>";
	echo "<br></br>";echo "<br></br>";
	echo "<br></br>";echo "<br></br>";
	echo "<br></br>";echo "<br></br>";
}
?>
</div>
</div>