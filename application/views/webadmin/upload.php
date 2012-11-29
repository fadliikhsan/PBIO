<div id="kiri"><h2>Module <?php echo $type; ?></h2>
	<div id="isi">
	<br>
	<!-- Batas Content -->
		<a href="<?php echo base_url().'index.php/webadmin/tambahfile';?>">
			<div class="pagingpage"><b> + Upload File / Berkas</b></div>
		</a> 
		<br /><br />
		<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
			<tr bgcolor="#FFF" align="center">
				<td><strong>No.</strong></td>
				<td><strong>Judul File</strong></td>
				<td><strong>Tipe File</strong></td>
				<td><strong>Deskripsi File</strong></td>
				<td><strong>Aksi</strong></td>
			</tr>
			<?php 
				$no = $page+1;
					foreach($daftarartikel->result_array() as $artikel)
					{ ?>
					<tr bgcolor='#D6F3FF'>
						<td align='center'><?php echo $no; ?></td>
						<td><?php echo $artikel['title']; ?></td>
						<td><?php echo $artikel['file_type']; ?></td>
						<td><?php echo $artikel['image_description']; ?></td>
						<td align="center">
							<a href='<?php echo base_url()."index.php/webadmin/hapusfile/".$artikel['id_file'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
							<img src='<?php echo base_url();?>application/views/webadmin/images/hapus-icon.gif' border='0'></a>
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