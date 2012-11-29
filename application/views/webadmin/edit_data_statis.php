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
				<?php echo form_open_multipart('webadmin/updatedatastatis');?>
					<table height="100%">
						<tr>
							<td>Kategori :<br />
							<?php
								foreach($edit->result_array() as $d)
								{
									$dt_id 		= $d["data_id"];
									$id_dt 		= $d["id_data"];
									$content 	= $d["content"];
								}
							?>
								<select name="data_id" class="input">
									<?php
										foreach($statis->result_array() as $s)
										{
											if($s['id']==$dt_id)
											{
											echo "<option value='".$s['id']."-".$s['title']."' selected>".$s['id']." - ".$s['title']."</option>";
											}
											else
											{
											echo "<option value='".$s['id']."-".$s['title']."'>".$s['id']." - ".$s['title']."</option>";
											}
										}
									?>	
								</select>
							<input type="hidden" name="id_data" value="<?php echo $id_dt; ?>" />
							</td>
						</tr>
						<tr>
							<td>Isi Data :<br />
								<textarea name="content"><?php echo $content; ?></textarea></td>
						</tr>
						<tr>
							<td><input type="submit"  value="Simpan Data" class="tombol"/>
							</td>
						</tr>
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
							PDF <input type="radio" name="filetype" value="pdf" checked onchange="javascript:filetypechanged(this);">
							Other <input type="radio" name="filetype" value="other">
						</td>	
					</tr>
					<tr>
						<td>Title</td>
						<td><input type="text" name="title" size="60" class="input"/></td>
					</tr>
					<tr>
						<td valign="top">Description</td>
						<td>
							<input type="text" name="description" size="60" class="input" />	
						</td>	
					</tr>
					<tr>
						<td>Upload file</td>
						<td><input type="file" name="imagefile" size="65"  class="input"/></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" VALUE="Upload File" class="submitButton2"></td>
					</tr>
				</table>
				</form> 

        </div>
		
		<div class="Page">
        <!--Page 2 --> 
	<table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="widget-small">
			<tr bgcolor='#D6F3FF' align="center">
				<td width="30"><b>No.</b></td>
				<td><b>Judul File</b></td>
				<td><b>Deskripsi File</b></td>
				<td><b>Lokasi File</b></td>
				<td><b>Aksi File</b></td>
			</tr>
	<?php
	$no = $page+1;
	foreach($imglist->result_array() as $im)
	{
		?>	<tr bgcolor='#D6F3FF'>
				<td align='center'><?php echo $no; ?></td>
				<td><?php echo $im['title'] ?></td>
				<td><?php echo $im['image_description'] ?></td>
				<td><?php echo base_url()."".$im['image_url'] ?></td>
				<td>
					<a href='<?php echo base_url()."index.php/webadmin/hapusmedia/".$im['id_file'];?>' onClick="return confirm('Anda yakin ingin menghapus data <?php echo $im['title'] ?> ')" title='Hapus File'>
						<img src='<?php echo base_url();?>system/application/views/webadmin/images/hapus-icon.gif' border='0'>
					</a>
				</td>
			</tr>
	<?php
	$no++;
	}
	?>
	</table>
    </div>
    </div>
</div>
</div>
</div>