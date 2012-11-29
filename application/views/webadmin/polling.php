<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<a href="<?php echo base_url().'index.php/webadmin/tambahsoalpoll';?>">
	<div class="pagingpage"><b> + Tambah Soal Polling</b></div>
</a> 
<a href="<?php echo base_url().'index.php/webadmin/tambahjwbpoll';?>">
	<div class="pagingpage"><b> + Tambah Jawaban Polling</b></div>
</a> 
<br /><br />
<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
	<tr bgcolor="#FFF" align="center">
		<td><strong>No</strong></td>
		<td><strong>Soal Polling</strong></td>
		<td><strong>Status</strong></td>
		<td colspan="2"><strong>Aksi</strong></td>
	</tr>
	<?php 
		$no = 1;
		foreach($daftarartikel->result_array() as $artikel)
		{ ?>
			<tr bgcolor='#D6F3FF'>
				<td width="40" align="center"><?php echo $no; ?></td>
				<td>&nbsp;&nbsp;<?php echo $artikel['soal']; ?></td>
				<td align="center"><?php echo $artikel['status']; ?></td>
				<td align="center">
					<a href='<?php echo base_url()."index.php/webadmin/editsoalpoll/".$artikel['id'];?>' title='Edit Content'>
						<img src='<?php echo base_url();?>application/views/webadmin/images/icon-edit.png' border='0'>
					</a>
				</td>
				<td align="center">
					<a href='<?php echo base_url()."index.php/webadmin/hapussoalpoll/".$artikel['id'];?>' onClick="return confirm('Anda yakin ingin menghapus data soal <br> "<?php echo $artikel['soal'] ;?>"')" title='Hapus Content'>
						<img src='<?php echo base_url();?>application/views/webadmin/images/iconDelete.gif' border='0'>
					</a>
				</td>
			</tr>
		<?php 
		$no++;
		}
		?>
</table>
<br />
	<?php echo "<div id='page-center'><table class='widget' style='border: 1pt ridge #DDDDDD;' align='center' bgcolor='#ccc'><tr><td>".$paginator."</td></tr></table></div>";?>
	<!-- Batas content bawah -->
</div>
</div>