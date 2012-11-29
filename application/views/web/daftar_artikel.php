<div id="isi-tengah">
<div class="title-berita"><?php echo $judul; ?></div>
<div id="detail">
<?php
	foreach($isi->result_array() as $i)
	{
		if($judul=="Materi Tutorial")
		{
			$dir="tutorial";
			$dir2="dettutorial";
		}
		else if($judul=="Indexs Berita")
		{
			$dir="berita";
			$dir2="detberita";
		}
		$isi1 	= substr($i['isi'],0,300);
		$isi 	= strip_tags($isi1);
		echo"<div id='sub-artikel'>
				<h2><a href='".base_url()."index.php/web/".$dir2."/".$i['tipe_artikel']."/".$i['id_artikel']."'>".$i['judul']."</a></h2>
					<div class='keterangan'>Artikel <b><i>".$i['tipe_artikel']."</i></b> 
					- Kategori <b><i>".$i['nama_kat']."</i></b>| Diposting pada : <i>".$i['tanggal']." -|- ".$i['waktu']."</i></div>";
		echo"	<img src='".base_url()."application/views/web/".$dir."/".$i['gambar']."' class='image' height='60'>
					".$isi." ..... ";
		echo"	<a href='".base_url()."index.php/web/".$dir2."/".$i['tipe_artikel']."/".$i['id_artikel']."'>
					<div class='selanjutnya'>Baca Selanjutnya</div></a>
			</div>";
	}
echo "<div id='page-center'><table class='widget' style='border: 1pt ridge #DDDDDD; color:#37a7c7;' align='center' bgcolor='#ccc'><tr><td>".$paginator."</td></tr></table></div>";
echo "<br></br>";echo "<br></br>";
echo "<br></br>";echo "<br></br>";
echo "<br></br>";echo "<br></br>";
?>
</div>
</div>