<div id="isi-kanan">
<div id="bg-title">Agenda Terbaru</div>
<div id="bg-isi-widget">
<?php
	foreach($agenda->result_array() as $a)
	{
		echo "<li class='li-class'><a href='".base_url()."index.php/web/detagenda/".$a['id']."' onclick=\"return hs.htmlExpand(this, { objectType: 'iframe' } )\">".$a['title']."</a></li>";
	}
?><br />
	<div id="button-holder"><a href="<?php echo base_url(); ?>index.php/web/data/7" id="button">
							<div class="front">Lihat</div>
							<div class="top">Agenda</div>
						</a>
	</div>
</div>
<div id="bg-bawah-widget"></div>

<div id="bg-title">Statistik Pengunjung</div>
<div id="bg-isi-widget">
<li class="li-class">
<?php
	foreach($counter_pengunjung->result_array() as $c)
	{
		echo "Dikunjungi oleh : <b>".$c['content']."</b> user";
	}
?>
</li>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
?>
<li class="li-class">IP address : <b><?php echo $ip; ?></b></li>
<li class="li-class">OS : <b><?php echo $os; ?></b></li>
<li class="li-class">Browser : <b><?php echo $browser; ?></b></li>
</div>
<div id="bg-bawah-widget"></div>

<div id="bg-title">Link Terkait</div>
<div id="bg-isi-widget">
<li class="li-class"><a href="http://uin-suka.ac.id" target="_blank">UIN Sunan Kalijaga</a></li>
<li class="li-class"><a href="http://informatika.uin-suka.ac.id" target="_blank">Prodi Teknik Informatika</a></li>
</div>
<div id="bg-bawah-widget"></div>

</div>
</div>
