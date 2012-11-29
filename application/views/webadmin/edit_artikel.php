<div id="kiri"><h2>Module <?php echo $type; ?></h2>
<div id="isi"><br />
<script type="text/javascript">
function TabView(id, current){
    if(typeof(TabView.cnt) == "undefined"){
        TabView.init();
    }
    current = (typeof(current) == "undefined") ? 0 : current;
    this.newTab(id, current);
}
TabView.init = function(){
    TabView.cnt = 0;
    TabView.arTabView = new Array();
}
TabView.switchTab = function(TabViewIdx, TabIdx){
    TabView.arTabView[TabViewIdx].TabView.switchTab(TabIdx);
}
TabView.prototype.newTab = function(id, current){
    var TabViewElem, idx = 0, el = '', elTabs = '', elPages = '';
    TabViewElem = document.getElementById(id);
    TabView.arTabView[TabView.cnt] = TabViewElem;
    this.TabElem = TabViewElem;
    this.TabElem.TabView = this;
    this.tabCnt = 0;
    this.arTab = new Array();
    // Loop throught the elements till the object with
    // classname 'Tabs' is obtained
    elTabs = TabViewElem.firstChild;
    while(elTabs.className != "Tabs" )elTabs = elTabs.nextSibling;
    el = elTabs.firstChild;
    do{
        if(el.tagName == "A"){
            el.href = "javascript:TabView.switchTab(" + TabView.cnt + "," + idx + ");";
            this.arTab[idx] = new Array(el, 0);
            this.tabCnt = idx++;
        }
    }while (el = el.nextSibling);

    // Loop throught the elements till the object with
    // classname 'Pages' is obtained
    elPages = TabViewElem.firstChild;
    while (elPages.className != "Pages")elPages = elPages.nextSibling;
    el = elPages.firstChild;
    idx = 0;
    do{
        if(el.className == "Page"){
            this.arTab[idx][1] = el;
            idx++;
        }
    }while (el = el.nextSibling);
    this.switchTab(current);
    // Update TabView Count
    TabView.cnt++;
}
TabView.prototype.switchTab = function(TabIdx){
    var Tab;
    if(this.TabIdx == TabIdx)return false;
    for(idx in this.arTab){
        Tab = this.arTab[idx];
        if(idx == TabIdx){
            Tab[0].className = "ActiveTab";
            Tab[1].style.display = "block";
            Tab[0].blur();
        }else{
            Tab[0].className = "InactiveTab";
            Tab[1].style.display = "none";
        }
    }
    this.TabIdx = TabIdx;
   
}
function init(){
    t1 = new TabView('TabView1');
}
function filetypechanged(rdo)
{
	if(rdo.value=='pdf')
		document.formupload.file_size.disabled=true;
	else
		document.formupload.file_size.disabled=false;
}
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
    document.location = delUrl;
  }
}
</script>
<style type="text/css">
.TabView{
    overflow-y:scroll;
	margin:5px;
	-webkit-box-shadow			: 0px 0px 5px rgba(0,0,0,0.5);
}
.TabView .Tabs {
  height		:30px;
  display		:block;
  background	:#000000;
}
.TabView .Tabs a 
{	
    display	:block;
	float	:left;
	width	:150px;
	height	:30px;
	line-height:25px;
	text-align:center;
	text-decoration:none;
	font-weight:bold;
	border:0px #666 dashed;
	margin:0px 2px;
}

.TabView .Tabs a:hover 
{
	background					: #cbefff;
	-webkit-box-shadow			: 0px 0px 5px rgba(0,0,0,0.5);
}
.TabView .Tabs a.ActiveTab{
    background	:#37a7c7;
	color		:#000000;
	-webkit-box-shadow			: 0px 0px 5px rgba(0,0,0,0.5);
}
.TabView .Tabs a.ActiveTab:hover{
	background	:#cbefff;
}
.TabView .Tabs a.InactiveTab{
	color		:#FFFFFF;
}
.TabView .Pages{
    width:100%;
}
.TabView .Pages .Page{
    border:1px #CCC solid;/*height:400px;*/
}
</style>
<div class="TabView" id="TabView1">
    <!--Tabs-->
    <div class="Tabs"><a>Isi Data Contents</a> <a>Upload File</a> <a>Manajemen File</a> </div>
    <!--Pages-->
		<div class="Pages">
			<!--Page 1-->
				<div class="Page">
				<?php
				foreach($edit->result_array() as $d)
				{
					$id 		= $d["id_artikel"];
					$judul 		= $d["judul"];
					$isi 		= $d["isi"];
					$gambar 	= $d['gambar'];
					$tipe 		= $d['tipe_artikel'];
					$id_tipe 	= $d['id_kategori'];
				}
				?>
			<?php echo form_open_multipart('webadmin/updateartikel');?>
			<table height="100%">
				<tr>
					<td colspan="2">Judul Artikel :<br />
						<input type="text" name="judul" class="input" size="100" value="<?php echo $judul; ?>"/>
					</td>
				</tr>
				<tr>
					<td width="200">Kategori Artikel :<br />
						<select name="kategori" class="input">
						<?php
							foreach($kategori->result_array() as $k)
							{
								if($k['id_kat']== $id_tipe)
								{
									echo"<option value='".$k['id_kat']."' selected='selected'>".$k['nama_kat']."</option>";
								}
								else
								{
									echo"<option value='".$k['id_kat']."'>".$k['nama_kat']."</option>";
								}
							}
						?>
						</select>
					</td>
					<td>Tipe Artikel :<br />
						<?php
						if($tipe == "berita")
						{
						?>
							<input type="radio" value="berita" name="tipe" checked="checked"/>Berita 
							<input type="radio" value="tutorial" name="tipe" />Tutorial
						<?php
						}
						else
						{
						?>
							<input type="radio" value="berita" name="tipe"/>Berita 
							<input type="radio" value="tutorial" name="tipe" checked="checked" />Tutorial
						<?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">Isi Berita :<br />
						<textarea name="content">
							<?php echo $isi;  ?>
						</textarea>
						<input type="hidden" name="id_artikel" value="<?php echo $id; ?>" />
					</td>
				</tr>
				<tr align="center">
					<td colspan="2">Gambar Thumbnail :<br />
						<img src="<?php echo base_url(); ?>application/views/web/<?php echo $tipe; ?>/<?php echo $gambar ?>" width="200"/><br />
					</td>
				</tr>
				<tr>
					<td>
						<input type="file" name="userfile" size="40"/>
					</td>
					<td align="right">*Kosongkan saja, jika gambar thumbnail tidak diganti</td>
				</tr>
					<td><input type="submit"  value="Simpan Data" class="input"/></td>	</tr>
		</table>
    </form>
    </div>
        
    
    <div class="Page">
        <!--Page 2 --> 
		<form name="formupload" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/webadmin/uploadfile" method="POST">
			<table width="96%" border="0">
				<tr>
					<td>Type File</td>
					<td>
						Image <input type="radio" name="filetype" value="image" checked onchange="javascript:filetypechanged(this);""> &nbsp;
						other <input type="radio" name="filetype" value="other">
					</td>	
				</tr>
				<tr>
					<td>Title</td>
					<td>
						<input type="text"name="title" size="60" class="input"/>
					</td>	
				</tr>
				<tr>
					<td valign="top">Description</td>
					<td>
						<input type="text" name="description" size="60" class="input" />	
					</td>	
				</tr>
				<tr>
					<td>Upload file</td>
					<td><input type="file" name="imagefile" size="50"  class="input"/></td>	
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" VALUE="Upload File" class="input"></td>
				</tr>
			</table>
		</form>

    </div>
		
	
	<div class="Page">
        <!--Page 2 --> 
			<table width="100%">
				<tr>
					<td><b>Judul File</b></td>
					<td><b>Deskripsi File</b></td>
					<td><b>Lokasi File</b></td>
					<td><b>Aksi File</b></td>
				</tr>
				<?php
					foreach($imglist->result_array() as $im)
					{
						echo"<tr>
								<td>".$im['title']."</td>
								<td>".$im['image_description']."</td>
								<td>".base_url()."".$im['image_url']."</td>
								<td><a href='".base_url()."index.php/webadmin/hapusmedia/".$im['id_file']."'>Hapus</td>
							</tr>";
					}
				?>
			</table>
    </div>
		</div>
</div>
</div>
</div>