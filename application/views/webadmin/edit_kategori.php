<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<a href="<?php echo base_url().'index.php/webadmin/tambahberita';?>"><div class="pagingpage"><b> + Tambah Berita </b></div></a> 
<a href="<?php echo base_url().'index.php/webadmin/tambahtutorial';?>"><div class="pagingpage"><b> + Tambah Materi E-Learning </b></div></a> 
<a href="<?php echo base_url().'index.php/webadmin/tambahkategori';?>"><div class="pagingpage"><b> + Tambah Kategori Artikel</b></div></a>
<br /><br />
<?php
foreach($detail->result_array() as $s)
{
	$id_kat = $s['id_kat'];
	$nama_kat = $s['nama_kat'];
	$type = $s['type'];
}
?>
<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/updatekategori">
<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr bgcolor="#FFF" ><td width="150">Tipe Kategori</td><td width="10" align="center">:</td><td>
<select name="tipe" class="input">
<?php
if($type=="berita")
{
?>
<option value="berita" selected="selected">Berita</option>
<option value="tutorial">Tutorial</option>
<?php
}
else{
?>
<option value="berita">Berita</option>
<option value="tutorial" selected="selected">Tutorial</option>
<?php
}
?>
</select>
</td><td rowspan="2" valign="bottom"> <input type="submit" value="Simpan Kategori" class="tombol"/> <input type="reset" value="Ulang Pengisian" class="tombol" /></td></tr>
<tr bgcolor="#FFF" ><td width="150">Nama Kategori</td><td width="10" align="center">:</td><td><input type="text" name="nama_kat" class="input" size="40"  value="<?php echo $nama_kat; ?>" /><input type="hidden" value="<?php echo $id_kat; ?>" name="id_kat" /></td></tr>
</table>
</form><br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</div>
</div>