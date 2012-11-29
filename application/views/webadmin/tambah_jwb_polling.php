<div id="kiri"><h2>Module <?php echo $type; ?></h2>
	<div id="isi">
		<br>
		<!-- Batas Content -->
		<a href="<?php echo base_url().'index.php/webadmin/tambahsoalpoll';?>"><div class="pagingpage"><b> + Tambah Soal Polling</b></div></a> 
		<a href="<?php echo base_url().'index.php/webadmin/tambahjwbpoll';?>"><div class="pagingpage"><b> + Tambah Jawaban Polling</b></div></a> 
			<br /><br />
				<form method="post" action="<?php echo base_url(); ?>index.php/webadmin/simpanjwbpoll">
					<table width="750" style="border:1px dashed #999999;" cellpadding="2" cellspacing="1" class="widget-small">
						<tr>
							<td>Pertanyaan</td>
							<td>:</td>
							<td>
								<select class="input" name="pertanyaan">
								<?php
								foreach($soal->result_array() as $s)
								{
								echo "<option value='".$s['id']."'>".$s['soal']."</option>";
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Jawaban</td>
							<td>:</td>
							<td><input type="text" class="input" size="50" name="jawaban" /></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><input type="submit" class="tombol" value="Simpan Data" /> <input type="reset" class="tombol" value="Hapus" /></td>
						</tr>
					</table>
				</form>
			<br />
			<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
				<tr bgcolor="#FFF" align="center">
					<td><strong>No.</strong></td>
					<td><strong>Soal</strong></td>
					<td><strong>Jawaban</strong></td>
					<td><strong>Counter</strong></td>
					<td colspan="2"><strong>Aksi</strong></td>
				</tr>
					<?php 
					$no = $page+1;
					foreach($daftarartikel->result_array() as $artikel)
						{ ?>
					<tr bgcolor='#D6F3FF'>
						<td align='center'><?php echo $no; ?></td>
						<td><?php echo $artikel['soal']; ?></td>
						<td><?php echo $artikel['jawaban']; ?></td>
						<td align="center"><?php echo $artikel['counter']; ?></td>
						<td align="center">
							<a href='<?php echo base_url()."index.php/webadmin/editjwbpoll/".$artikel['id_jawaban'];?>' title='Edit Content'>
							<img src='<?php echo base_url();?>application/views/webadmin/images/icon-edit.png' border='0'></a></td>
						<td align="center">
							<a href='<?php echo base_url()."index.php/webadmin/hapusjwbpoll/".$artikel['id_jawaban'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
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