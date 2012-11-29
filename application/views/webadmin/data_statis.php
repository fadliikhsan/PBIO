<div id="kiri"><h2>Module <?php echo $type; ?></h2>
	<div id="isi">
	<br>
	<!-- Batas Content -->
		<a href="<?php echo base_url().'index.php/webadmin/tambahdatastatis';?>">
			<div class="pagingpage"><b> + Tambah Data Statis</b></div>
		</a> 
		<br /><br />
		<table width="750" cellpadding="1" bgcolor="#ccc" cellspacing="1" class="widget-small">
			<?php
				echo"<tr align='center' bgcolor='#fff'>
						<td width='40'><strong>No</strong></td>
						<td width='400'><strong>Judul Data</strong></td>
						<td><strong>ID Parent</strong></td>
						<td><strong>Level</strong></td>
						<td colspan='2' width='10'>
							<strong>Aksi Data</strong>
						</td>
					</tr>";
				$no = 1;
				foreach($daftarartikel->result_array() as $s)
				{
					echo"<tr bgcolor='#D6F3FF'>
							<td align='center'>".$no."</td>
							<td>&nbsp;&nbsp;".$s['title']."</td>
							<td align='center'>".$s['id_parent']."</td>
							<td align='center'>".$s['level']."</td>
							<td align='center'>
								<a href='".base_url()."index.php/webadmin/editdatastatis/".$s['id_data']."'>
									<img src='".base_url()."application/views/webadmin/images/icon-edit.png' title='Edit Data statis' border='0'>
								</a>
							</td>
							<td align='center'>
								<a href='".base_url()."index.php/webadmin/hapusdatastatis/".$s['id_data']."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" >
									<img src='".base_url()."application/views/webadmin/images/iconDelete.gif' title='Delete Data statis' border='0'>
								</a>
							</td>
						</tr>";
						$no++;
				}
			?>
		</table><br />
		<?php echo "<div id='page-center'><table class='widget' style='border: 1pt ridge #DDDDDD;' align='center' bgcolor='#ccc'><tr><td>".$paginator."</td></tr></table></div>";?>
		<!-- Batas content bawah -->
	</div>
</div>