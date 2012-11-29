<div id="isi-tengah">
<div class="title-learn">Download File / Berkas</div>
<div id="galeri">
<?php
	echo"Share this article on :";
?>
	<script language="javascript">
		document.write("<a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'>&#8226; Twitter</a> | <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'>&#8226; Facebook</a>");
	</script>
	<?php
	echo"<br><br>";
		foreach($isi->result_array() as $dwn)
		{
			$file = str_replace('media/file/','',$dwn['image_url']);
			if ($dwn["file_type"]=='pdf')
				{
					echo"<div id='download'><img src='".base_url()."application/views/web/images/pdf_download.png' border='0' class='image2'>";
				}
				else
				{
					echo"<div id='download'><img src='".base_url()."application/views/web/images/Download-icon.png' border='0' class='image2'>";
				}
				echo"<table>";
						echo"<tr>
							<td width='100'>
								<b>Title</b>
							</td>
							<td width='20'> : </td>
							<td>".$dwn['title']."</td>
						</tr>
						<tr>
							<td><b>Deskripsi</b></td>
							<td> : </td>
							<td>".$dwn['image_description']."</td>
						</tr>
						<tr>
							<td><b>Upload</b></td>
							<td> : </td>
							<td>".$dwn['uploaded_date']."</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><a href='".base_url()."media/file/".$file."'><span class='submitButton2'>Download</span></a></td>
						</tr>
					</table>
			</div>";
		}
	?>
</div>
<?php
echo "<div id='page-center'><table class='widget' style='border: 1pt ridge #DDDDDD; color:#37a7c7;' align='center' bgcolor='#ccc'><tr><td>".$paginator."</td></tr></table></div>";
?>
</div>