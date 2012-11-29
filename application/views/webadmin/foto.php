<div id="kiri"><h2>Module <?php echo $type; ?></h2>
	<div id="isi">
	<br>
	<!-- Batas Content -->
		<a href="<?php echo base_url().'index.php/webadmin/tambahfoto';?>"><div class="pagingpage"><b> + Tambah Foto-Foto Kegiatan</b></div></a> 
			<br /><br />

			<?php echo form_open_multipart('webadmin/uploadfoto');?>
				<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
					<tr bgcolor="#FFF" >
						<td width="150">Nama Album</td>
						<td width="10" align="center">:</td>
						<td>
							<select name="album" class="input">
								<?php
									foreach($album->result_array() as $a)
									{
										echo "<option value='".$a['id_album']."'>".$a['nama_album']."</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr bgcolor="#FFF" >
						<td width="150">Nama Album</td>
						<td width="10" align="center">:</td>
						<td><input type="file" name="userfile" size="50" /></td>
					</tr>
					<tr bgcolor="#FFF" >
						<td width="150"></td>
						<td width="10" align="center"></td>
						<td><input type="submit" value="Upload Foto" class="tombol" name="upload"/></td>
					</tr>
				</table>
			</form> 
		<br />

		<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
			<tr bgcolor="#FFF" align="center"><td><strong>Nomor</strong></td><td><strong>Nama Album Galeri</strong></td><td><strong>Nama File</strong></td><td><strong>Aksi</strong></td></tr>
			<?php 
			$no = 1+$page;
			foreach($daftarartikel->result_array() as $artikel)
			{ ?>
				<tr bgcolor='#D6F3FF'>
					<td><?php echo $no; ?></td>
					<td><?php echo $artikel['nama_album']; ?></td>
					<td><?php echo $artikel['foto_besar']; ?></td>
					<td align="center"><a href='<?php echo base_url()."index.php/webadmin/hapusfoto/".$artikel['id_foto'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
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