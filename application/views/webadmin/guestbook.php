<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi">
<br>
<!-- Batas Content -->
<table width="750" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
<tr bgcolor="#FFF" align="center"><td><strong>No.</strong></td><td><strong>Nama Pengirim</strong></td><td><strong>Email Pengirim</strong></td><td><strong>Tanggal Posting</strong></td><td colspan="2"><strong>Aksi</strong></td></tr>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ 
if(($no%2)==0){
$warna="#B3E8FF";
} else{
$warna="#D6F3FF";
}
?>
<tr bgcolor='<?php echo $warna; ?>'>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['nama']; ?></td>
<td><?php echo $artikel['email']; ?></td>
<td><?php echo $artikel['posted_date']; ?></td>
<td align="center"><a href='<?php echo base_url()."index.php/webadmin/editguestbook/".$artikel['id'];?>' title='Edit Content'>
<img src='<?php echo base_url();?>application/views/webadmin/images/icon-edit.png' border='0'></a></td>
<td align="center">
<a href='<?php echo base_url()."index.php/webadmin/hapusguestbook/".$artikel['id'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
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