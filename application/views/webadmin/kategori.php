<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<a href="<?php echo base_url().'index.php/webadmin/tambahberita';?>">
		<div class="pagingpage">
			<b> Tambah Berita </b>
		</div>
	</a>
	<a href="<?php echo base_url().'index.php/webadmin/tambahtutorial';?>">
		<div class="pagingpage">
			<b> Tambah Tutuorial </b>
		</div>
	</a>
	<a href="<?php echo base_url().'index.php/webadmin/tambahkategori';?>">
		<div class="pagingpage">
			<b> Tambah Kategori Arikel </b>
		</div>
	</a>
<br /><br />
<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/simpankategori">
	<table width="750" cellpadding="2" cellspacing="1" class="widget-small">
		<tr bgcolor='#D6F3FF'>
			<td width="150">Tipe Kategori</td>
			<td width="10" align="center">:</td>
			<td><select name="tipe" class="input">
					<option value="berita">Berita</option>
					<option value="tutorial">Tutorial</option>
				</select>
			</td>
		</tr>
		<tr bgcolor='#D6F3FF'>
			<td width="150">Nama Kategori</td>
			<td width="10" align="center">:</td>
			<td><input type="text" name="nama_kat" class="input" size="40" /></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td rowspan="2"> 
				<input type="submit" value="Simpan Kategori" class="tombol" /> 
				<input type="reset" value="Ulang Pengisian" class="tombol" />
			</td>
		</tr>
	</table>
</form>
<br /><br />

<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
	<tr bgcolor="#FFF" align="center">
		<td>
			<strong>No.</strong>
		</td>
		<td>
			<strong>Nama Kategori Artikel</strong>
		</td>
		<td>
			<strong>Tipe Kategori</strong>
		</td>
		<td colspan="2">
			<strong>Aksi</strong>
		</td>
	</tr>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel)	
{ ?>
	<tr bgcolor='#D6F3FF'>
		<td align='center'><?php echo $no; ?></td>
		<td><?php echo $artikel['nama_kat']; ?></td>
		<td><?php echo $artikel['type']; ?></td>
		<td align="center">
			<a href='<?php echo base_url()."index.php/webadmin/editkategori/".$artikel['id_kat'];?>' title='Edit Content'>
			<img src='<?php echo base_url();?>application/views/webadmin/images/icon-edit.png' border='0'></a>
		</td>
		<td align="center">
			<a href='<?php echo base_url()."index.php/webadmin/hapuskategori/".$artikel['id_kat'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
			<img src='<?php echo base_url();?>application/views/webadmin/images/iconDelete.gif' border='0'></a>
		</td>
	</tr>
<?php 
	$no++;
}  
?>
</table><br />
<?php echo $paginator;?>
<!-- Batas content bawah -->
</div>
</div>