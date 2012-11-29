<div id="isi">
<div id="isi-kiri">

<div id="bg-title">Polling Bulan Ini</div>
<div id="bg-isi-widget">
<form method="post" action="<?php echo base_url(); ?>index.php/web/hasilpolling">
<?php
foreach($soal_polling->result_array() as $soal)
	{
		echo "<input type='hidden' name='id_soal' value='".$soal['id']."'>";
		echo "<h4><b>".$soal['soal']."</b></h4>";
	}
?>

<?php
foreach($jawaban_polling->result_array() as $jawaban)
	{
		echo"<span>
				<input type='radio' name='polling' value='".$jawaban['id_jawaban']."' class='radio-class'>
					".$jawaban['jawaban']."
			</span>
		<br>";
	}
?>
<br />
	<br />
		<span style="padding-left:25px;">
			<input type="submit" value="Pilih" class="poll"/> 
			<a href="<?php echo base_url(); ?>index.php/web/lihathasil">
				<span class="poll-lihat">Lihat Hasil Polling</span>
			</a>
		</span>
	<br />
</form>
</div>
<div id="bg-bawah-widget"></div>

<div id="bg-title">Download Terbaru</div>
<div id="bg-isi-widget">
<?php
foreach($donlod->result_array() as $dwn)
{
$file = str_replace('media/file/','',$dwn['image_url']);
echo "<li class='li-class'><a href='".base_url()."media/file/".$file."'>".$dwn['title']."</a></li>";
}
?>
	<div id="button-holder">
	<a href="<?php echo base_url(); ?>index.php/web/data/11" id="button">
		<div class="front">Lihat</div>
		<div class="top">Download</div>
	</a>
	</div>
</div>
<div id="bg-bawah-widget"></div>

<div id="bg-title">Hubungi Admin</div>
<div id="bg-isi-widget">
<li class="li-class">Untuk info lebih lanjut, silahkan hubungi admin via YM.<br /><br />
<a href = 'ymsgr:sendim?f_ikhsanp'><img src="http://opi.yahoo.com/online?u=f_ikhsanp&amp;m=g&amp;t=2" border=0></a>
</li>
</div>
<div id="bg-bawah-widget"></div>

</div>