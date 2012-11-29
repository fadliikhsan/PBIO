<div id="isi-tengah">
<div class="title-learn">Album Galeri Kegiatan</div>
<?php
echo"Share this article on :";
	?>
	<script language="javascript">
document.write("<a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a>");
</script>
	<?php
	echo"<br><br>";
foreach($album->result_array() as $b)
{
	echo "<a href='".base_url()."index.php/web/galeri/".$b['id_album']."'>
			<div id='album-besar'>
				<div id='sub-album'>
					<img src='".base_url()."application/views/web/images/album (1).png' border='0'>
				</div>
				<div id='sub-album'>".$b['nama_album']."</div>
			</div></a>";
}
?>
<?php
echo "<table align='center'><tr><td>".$paginator."</td></tr></table>";
?>
</div>