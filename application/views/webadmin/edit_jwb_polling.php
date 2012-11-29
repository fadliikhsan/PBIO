<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<a href="<?php echo base_url().'index.php/webadmin/tambahsoalpoll';?>"><div class="pagingpage"><b> + Tambah Soal Polling</b></div></a> 
<a href="<?php echo base_url().'index.php/webadmin/tambahjwbpoll';?>"><div class="pagingpage"><b> + Tambah Jawaban Polling</b></div></a> 
<br /><br />
<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/updatejwbpoll">
<table width="750" style="border:1px dashed #999999;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td>Pertanyaan</td><td>:</td><td>
<?php
foreach($edit->result_array() as $k)
{
	$id_soal = $k['id_soal'];
	$jwb = $k['jawaban'];
	$id_jwb = $k['id_jawaban'];
	$counter = $k['counter'];
}
?>
<select class="input" name="id_soal">
<?php
foreach($soal->result_array() as $s)
{
if($id_soal==$s['id'])
{
echo "<option value='".$s['id']."' selected='selected'>".$s['soal']."</option>";
}
else
{
echo "<option value='".$s['id']."'>".$s['soal']."</option>";
}
}
?>
</select></td></tr>
<tr><td>Jawaban</td><td>:</td><td><input type="text" class="input" size="50" name="jawaban" value="<?php echo $jwb; ?>" /></td></tr>
<tr><td>Counter</td><td>:</td><td><input type="text" class="input" size="50" name="counter" value="<?php echo $counter; ?>" /></td></tr>
<tr><td></td><td></td><td><input type="submit" class="tombol" value="Simpan Data" /> <input type="reset" class="tombol" value="Hapus" /><input type="hidden" name="id" value="<?php echo $id_jwb; ?>" /></td></tr>
</table>
</form>
<br />

<!-- Batas content bawah -->
</div>
</div>