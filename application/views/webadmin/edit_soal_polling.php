<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<a href="<?php echo base_url().'index.php/webadmin/tambahsoalpoll';?>"><div class="pagingpage"><b> + Tambah Soal Polling</b></div></a> 
<a href="<?php echo base_url().'index.php/webadmin/tambahjwbpoll';?>"><div class="pagingpage"><b> + Tambah Jawaban Polling</b></div></a> 
<br /><br />
<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id'];
	$soal = $d['soal'];
	$status = $d['status'];
}
?>
<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/updatesoalpoll">
<table width="750" style="border:1px dashed #999999;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td>Soal Polling</td><td>:</td><td><input type="text" class="input" size="70" name="soal" value="<?php echo $soal; ?>" /></td></tr>
<tr><td>Status</td><td>:</td><td>
<select class="input" name="status">
<?php
if($status=="Y")
{
?>
<option value="N">Tidak Aktif</option><option value="Y" selected="selected">Aktif</option>
<?php
}
else{
?>
<option value="N" selected="selected">Tidak Aktif</option><option value="Y">Aktif</option>
<?php
}
?>
</select></td></tr>
<tr><td></td><td></td><td><input type="submit" class="tombol" value="Simpan Data" /> <input type="reset" class="tombol" value="Hapus" /><input type="hidden" name="id"  value="<?php echo $id; ?>"  /></td></tr>
</table>
</form>
<br /><br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<!-- Batas content bawah -->
</div>
</div>