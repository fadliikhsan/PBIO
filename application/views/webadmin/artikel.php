<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
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
	<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
		<tr bgcolor="#FFF" align="center">
			<td><strong>No.</strong></td>
			<td><strong>Judul</strong></td>
			<td><strong>Kategori</strong></td>
			<td><strong>Penulis</strong></td>
			<td colspan="2"><strong>Aksi</strong></td>
		</tr>
		<?php 
		$no = $page+1;
		foreach($daftarartikel->result_array() as $artikel)
		{ ?>
		<tr bgcolor='#D6F3FF'>
			<td align='center'><?php echo $no; ?></td>
			<td>&nbsp;&nbsp;<?php echo $artikel['judul']; ?></td>
			<td>&nbsp;<?php echo $artikel['tipe_artikel']; ?></td>
			<td><?php echo $artikel['username']; ?></td>
			<td>
				<a href='<?php echo base_url()."index.php/webadmin/editartikel/".$artikel['id_artikel'];?>' title='Edit Content'>
					<img src='<?php echo base_url();?>application/views/webadmin/images/icon-edit.png' border='0'>
				</a>
			</td>
			<td>
				<a href='<?php echo base_url()."index.php/webadmin/hapusartikel/".$artikel['id_artikel'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
					<img src='<?php echo base_url();?>application/views/webadmin/images/iconDelete.gif' border='0'>
				</a>
			</td>
		</tr>
		<?php 
			$no++;
		}
  
		?>
	</table>
	<br/>
	<?php echo "<div id='page-center'><table class='widget' style='border: 1pt ridge #DDDDDD;' align='center' bgcolor='#ccc'><tr><td>".$paginator."</td></tr></table></div>";?>
</div>
</div>