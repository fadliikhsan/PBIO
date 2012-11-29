<div id="kiri"><h2>Module <?php echo $type; ?></h2>
	<div id="isi">
		<br>
		<!-- Batas Content -->
			<a href="<?php echo base_url().'index.php/webadmin/tambahfoto';?>"><div class="pagingpage"><b> + Tambah Foto-Foto Kegiatan</b></div></a> 
			<br /><br />

		<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/simpanalbum">
			<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
				<tr bgcolor="#FFF" >
					<td width="150">Nama Album</td>
					<td width="10" align="center">:</td>
					<td><input type="text" name="nama" class="input" size="40" /></td>
					<td><input type="submit" value="Simpan Album" class="tombol" /> 
						<input type="reset" value="Ulang Pengisian" class="tombol" />
					</td>
				</tr>
			</table>
		</form>
		<br />

		<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
			<tr bgcolor="#FFF" align="center">
				<td><strong>No</strong></td>
				<td><strong>Nama Album Galeri</strong></td>
				<td colspan="2"><strong>Aksi</strong></td>
			</tr>
				<?php 
				$no = 1+$page;
				foreach($daftarartikel->result_array() as $artikel)
				{ ?>
					<tr bgcolor='#D6F3FF'>
						<td width="35" align="center"><?php echo $no; ?></td>
						<td><?php echo $artikel['nama_album']; ?></td>
						<td align="center">
							<a href='<?php echo base_url()."index.php/webadmin/editalbum/".$artikel['id_album'];?>' title='Edit Content'>
							<img src='<?php echo base_url();?>application/views/webadmin/images/icon-edit.png' border='0'></a></td>
						<td align="center">
							<a href='<?php echo base_url()."index.php/webadmin/hapusalbum/".$artikel['id_album'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
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