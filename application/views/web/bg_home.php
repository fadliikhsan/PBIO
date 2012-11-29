<div id="isi-atas">
<div id="isi-berita">
<?php
	echo"<div id='slideshow'>";
	echo"<div class='slides'><ul>";
	$nomor=1;
	foreach($slide_berita->result_array() as $berita)
	{
		$isi_berita1 	= substr($berita['isi'],0,400);
		$isi_berita 	= strip_tags($isi_berita1);
		echo"<li id='slide-$nomor'>
				<h2>
					<a href='".base_url()."index.php/web/detberita/".$berita['tipe_artikel']."/".$berita['id_artikel']."'>
					".$berita['judul']."
					</a>
				</h2>
				<span>
					Kategori <b>Berita</b> - ".$berita['tanggal']." -|- ".$berita['waktu']." WIB -|- oleh <i>
					".$berita['username']."
					</i>
				</span>
				<p>
				<span class=image>
					<img src='".base_url()."application/views/web/berita/".$berita['gambar']."' width=100 border=0>
				</span>
					".$isi_berita." <b>
					.... <a href='".base_url()."index.php/web/detberita/".$berita['tipe_artikel']."/".$berita['id_artikel']."'>[Baca Selengkapnya]</a></b></li>";
			$nomor++;
	}
	echo" </ul></div><ul class='slides-nav'>";
	for($no=1;$no<=10;$no++)
	{
		echo"<li><a href='#slide-$no'>$no</a></li>";
	}
	echo"</ul>
		</div>";
	?>
</div>
<div id="isi-pengumuman">
	<div id="isi-tengah-pengumuman"><h1>Pengumuman Terbaru</h1>
	<?php
		foreach($pengumuman->result_array() as $p)
		{	
			echo 	"<a href='".base_url()."index.php/web/detpengumuman/".$p['id']."' onclick=\"return hs.htmlExpand(this, { objectType: 'iframe' } )\">
						<div id='pengumuman'>
							<img src='".base_url()."application/views/web/images/umum-icon.png' class='image'/>
								Pengumuman ".$p['title']."<br />
									<h3>Diposting tanggal ".$p['posting_date']."</h3>
						</div>
					</a>";
		}
	?>
</div>
</div>
</div>