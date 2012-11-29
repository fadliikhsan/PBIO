<div id="isi-tengah">
<div class="title-berita">Halaman Bioenter</div>
<div id="detail">
<?php
foreach($detail->result_array() as $d)
{
	echo"<div id='title-statis'>".$d['title']."</div>";
	echo"Share this article on :";
	?>
	<script language="javascript">
		document.write("<a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a>");
	</script>
	<?php
	echo"<div id='detail'>".$d['content']."</div>";
	echo"<br></br>";echo"<br></br>";
	echo"<br></br>";echo"<br></br>";
	echo"<br></br>";echo"<br></br>";
}
?>

</div>
</div>