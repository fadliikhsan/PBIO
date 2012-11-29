<div id="isi-tengah">
<?php
foreach($detail->result_array() as $d)
{
	echo"<div id='bg-detail-berita'>".$d['judul']."</div>";
	echo"<div class='keterangan'>Artikel 
			<b>	<i>".$d['tipe_artikel']."</i></b> - Kategori 
			<b>	<i>".$d['nama_kat']."</i></b> | Diposting pada : 
				<i>".$d['tanggal']." -|- ".$d['waktu']."</i>
				<br>Share this article on ";
?>
	<script language="javascript">
	document.write("<a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a> ");
</script>
	<?php
	echo"</div>";
	$isi=nl2br($d['isi']);
	echo"<div id='detail'>
			<img src='".base_url()."application/views/web/berita/".$d['gambar']."' class='image' width='300'>".$isi."
		</div>";
}
?>
</div>