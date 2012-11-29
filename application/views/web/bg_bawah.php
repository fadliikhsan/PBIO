<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="isi-bawah">
<div id="sub-isi-bawah">
<div class="title-berita">GALERI KEGIATAN TERBARU</div>

<?php
foreach($cuplikan_galeri->result_array() as $b)
{
	echo "<a href='".base_url()."application/views/web/galeri/".$b['foto_besar']."'"; ?>

onclick="return hs.expand(this,
			{wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})"
<?php
			
			echo"><div id='album-besar2'><div id='sub-album2'><img src='".base_url()."application/views/web/galeri/thumb/".$b['foto_kecil']."' border='0' width='90' title='".$b['nama_album']."'></div></div></a>";
}
?>



</div>

<div id="sub-isi-bawah">
<div class="title-berita">BERGABUNG DENGAN GROUP KAMI DI FACEBOOK</div>

<div class="fb-like-box" data-href="http://www.facebook.com/PendidikanBiologiUINSunanKalijaga" data-width="470" data-height="230" data-show-faces="true" data-stream="false" data-header="true"></div>

</div>

<div id="menubawah">
	<?php
		$ip = $_SERVER['REMOTE_ADDR'];
	?>
Copyright &copy; Pendidikan Biologi UIN Sunan Kalijaga. All Right Reserved || Anda berkunjung dengan IP Address :: <?php echo $ip; ?>
</div>
<div id="list-bawah"><font color="#000">
UIN SUNAN KALIJAGA YOGYAKARTA PENDIDIKAN BIOLOGI<br />
JL Marsda Adisucipto Yogyakarta 55281<br />
Telp. +62-274-512474, +62-274-589621 Fax. +62-274-586117 email : humas@uin-suka.ac.id
</font>
</div>
</body>
</html>