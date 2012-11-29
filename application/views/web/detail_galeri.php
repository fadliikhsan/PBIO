<div id="isi-tengah">
<?php
foreach($detail_galeri->result_array() as $j)
{
	$judul = $j['nama_album'];
}
?>
<div class="title-learn"><?php echo $judul; ?></div>
<div id="galeri">
<?php
echo"Share this article on :";
	?>
	<script language="javascript">
		document.write("<a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a> | <a href='http://www.reddit.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Reddit</a> | <a href='http://digg.com/submit?url=" + document.URL + "' target='_blank'>&#8226; Digg</a>");
	</script>
<?php
echo"<br><br>";
foreach($detail_galeri->result_array() as $b)
{
	echo "<a href='".base_url()."application/views/web/galeri/".$b['foto_besar']."'";
	?>
		onclick="return hs.expand(this,
			{wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})"

	<?php
	echo"><div id='album-besar'><div id='sub-foto'><img src='".base_url()."application/views/web/galeri/thumb/".$b['foto_kecil']."' border='0'></div></div></a>";
}
?>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<?php
echo "<table align='center'><tr><td>".$paginator."</td></tr></table>";
?>
</div>