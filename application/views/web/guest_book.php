<script languange="javascript">
function test(s, p) {
		s = s.nodeType == 1 ? s.value : s;
		return s == '' || new RegExp(p).test(s);
}
function isEmail(s) {
		return test(s, '^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$');
	}
function CekEmail(txt, alertid){
	var input = txt.value;
	var benar = isEmail(input);
	if(input=='')
		benar=false;
  	if(benar) { 
  		document.getElementById(alertid).style.display='none';
  		document.frmguestbook.simpan.disabled=false;
  	} else {
  		document.getElementById(alertid).style.display='';
  		document.frmguestbook.simpan.disabled=true;
  	}
}
function CekNama(txt, alertid) {
	var input = txt.value;
	var benar = false;
	if(input!='')
		benar=true;
	if(benar) { 
  		document.getElementById(alertid).style.display='none';
  		document.frmguestbook.simpan.disabled=false;
  	} else {
  		document.getElementById(alertid).style.display='';
  		document.frmguestbook.simpan.disabled=true;
  	}
}
function CekPesan(txt, alertid) {
	var input = txt.value;
	var benar = false;
	if(input!='')
		benar=true;
	if(benar) { 
  		document.getElementById(alertid).style.display='none';
  		document.frmguestbook.simpan.disabled=false;
  	} else {
  		document.getElementById(alertid).style.display='';
  		document.frmguestbook.simpan.disabled=true;
  	}
}
function dissabledButton() {
	document.frmguestbook.simpan.disabled=true;
}
window.onload = dissabledButton;
</script>
<div id="isi-tengah">
	<div id="title-guestbook">Guest Book</div>
		<div id="detail">
			<form method="post" name="frmguestbook" action="<?php echo base_url(); ?>index.php/web/simpanguestbook">
				<table style="border:1px dashed #999999; padding-left:10px;">
					<tr>
						<td width="100">Nama</td>
						<td width="20">:</td>
						<td><input class="input" name="nama" type="text" value="" size="50"  onchange="javascript:CekNama(this, 'alertnama');" onblur="javascript:CekNama(this, 'alertnama');">
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<div id="alertnama" style="display:none; background-color:#c9f1fd; color:#000000; padding:5px;"><div style="margin:0 0 0 125px;">Nama Harap Diisi Terlebih dahulu</div></div>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input class="input" id="idemail" name="email" type="text" value="" size="50" onchange="javascript:CekEmail(this, 'alertemail');" onblur="javascript:CekEmail(this, 'alertemail');">
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<div id="alertemail" style="display:none; background-color:#c9f1fd; color:#000000; padding:5px;"><div style="margin:0 0 0 125px;">Email tidak diijinkan kosong</div></div>
						</td>
					</tr>
					<tr>
						<td valign="top">Pesan</td>
						<td valign="top">:</td>
						<td><textarea name="pesan" cols="40" rows="7" class="input"  onchange="javascript:CekPesan(this, 'alertpesan');" onblur="javascript:CekPesan(this, 'alertpesan');"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<div id="alertpesan" style="display:none; background-color:#c9f1fd; color:#000000; padding:5px;"><div style="margin:0 0 0 125px;">Harap Mengisi Pesan Terlebih dahulu</div></div>
						</td>
					</tr>
					<tr>
						<td valign="top"></td>
						<td valign="top"></td>
						<td><input type="submit" value="Kirim Pesan" id="simpan" class="poll" name="simpan" />
							<input type="reset" value="Hapus" class="poll" />
						</td>
					</tr>
					<tr><td colspan="3"><br />
						<li class="li-class">Maaf pesan anda tidak langsung kami tampilkan karena pesan tersebut masih perlu kami administrasi terlebih dahulu.</li>
						<li class="li-class">Terimakasih atas Anda telah mengisikan buku tamu pada web site kami</li>
						</td>
					</tr>
				</table>
			</form>
		</div>
</div>