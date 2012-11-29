<div id="isi-tengah">
	<div id="title-event"><?php echo $judul; ?></div>
		<div id="detail">
		<?php
		foreach($isi->result_array() as $i)
		{
			echo "<div id='sub-artikel'>
					<h2>".$i['title']."</h2>
						<div class='keterangan'>Artikel <b><i>".$i['type']."</i></b> 
							- Penulis <b><i>".$i['username']."</i></b>| Diposting pada : <i>".$i['posting_date']."</i>
						</div>";
			echo $i['content'];
			echo"</div>";
		}
		echo "<div id='page-center'><table class='widget' style='border: 1pt ridge #DDDDDD; color:#37a7c7;' align='center' bgcolor='#ccc'><tr><td>".$paginator."</td></tr></table></div>";
		?>
	</div>
</div>