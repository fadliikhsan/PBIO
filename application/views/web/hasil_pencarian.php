<div id="isi-tengah">
<?php
	echo"<table>
			<tr>
				<td valign='top' width='55'>
					<img src='".base_url()."application/views/web/images/hasil-cari.png'></td>
				<div class='title-berita'>Hasil Pencarian</div>
			</tr>
		</table>";
if($kata=null)
	{
		echo "Kolom keyword masih kosong!!!!!";
	}
	else
	{
		if($jumlah=null)
		{
			echo "Pencarian dengan keyword <b>".$kata."</b>, tidak ditemukan!!!!</b>";
		}
		else
		{
			
			foreach($hasil->result_array() as $cari)
			{
				if($pilihan =='tbl_event')
				{
								echo "<div id='sub-artikel'>
										<h2>".$cari['title']."</h2>
										<div class='keterangan'>Artikel <b><i>".$cari['type']."</i></b> 
											- Penulis <b><i>".$cari['username']."</i></b>| Diposting pada : <i>".$cari['posting_date']."</i>
										</div>";
								echo $cari['content'];
								echo"</div>";
				}
				else
				{
					$isi_berita = substr($cari['isi'],0,200);
					echo"<div id='akademik'>
							<div id='berita-tengah'>
								<a href='".base_url()."index.php/web/detberita/".$cari['tipe_artikel']."/".$cari['id_artikel']."'>
									<h4>".$cari['judul']."</h4>
								</a>
								<h6>".$cari['tanggal']." - ".$cari['waktu']." | oleh <b><i>".$cari['username']."</i></b></h6>
								<img src='".base_url()."application/views/web/berita/".$cari['gambar']."' class='image' height='60'>
									".$isi_berita.".....
								<a href='".base_url()."index.php/web/detberita/".$cari['tipe_artikel']."/".$cari['id_artikel']."'>
								<br>
								<b><div class='selanjutnya-akademik'>Baca Selengkapnya</div></b>
								</a>
							</div>
						</div>";
				}
				
			}
		}
	}
?>
</div>
