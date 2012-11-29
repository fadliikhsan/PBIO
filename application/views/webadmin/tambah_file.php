<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/simpanfile" enctype="multipart/form-data">
<table width="750" style="border:1px dashed #999999;" cellpadding="2" cellspacing="1" class="widget-small">
<tr><td>Judul File</td><td>:</td><td><input type="text" class="input" size="60" name="judul" /></td></tr>
<tr><td>Deskripsi File</td><td>:</td><td><input type="text" class="input" size="60" name="deskripsi" /></td></tr>
<tr><td>Status</td><td>:</td><td><input type="file" class="input" name="userfile" size="50" /></td></tr>
<tr><td></td><td></td><td><input type="submit" class="tombol" value="Simpan Data" /> <input type="reset" class="tombol" value="Hapus" /></td></tr>
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