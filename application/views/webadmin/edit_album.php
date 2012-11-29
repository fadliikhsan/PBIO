<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<a href="<?php echo base_url().'index.php/webadmin/tambahfoto';?>"><div class="pagingpage"><b> + Tambah Foto-Foto Kegiatan</b></div></a> 
<br /><br />
<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_album'];
	$nama = $d['nama_album'];
}
?>
<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/updatealbum">
<table width="750" style="border:1px dashed #999999;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td width="100">Soal Polling</td><td>:</td><td><input type="text" class="input" size="40" name="nama" value="<?php echo $nama; ?>" /></td></tr>
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
<br /><br />
<br />


<!-- Batas content bawah -->
</div>
</div>