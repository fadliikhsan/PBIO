<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PENDIDIKAN BIOLOGI UIN SUNAN KALIJAGA</title>
<link href="<?php echo base_url(); ?>application/views/web/images/icon.png" 	rel="shortcut icon" />
<link href="<?php echo base_url(); ?>application/views/web/css/style.css" 		rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/views/web/css/highslide.css" 	rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/views/web/css/jquery-ui.css" 	rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/views/web/css/ui.theme.css" 	rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.dimensions.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery-baru.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/dropdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.cycle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/slideshow.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/highslide-with-html.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/transisi.js"></script>

<script type="text/javascript">
	var nama = "#menuFloat";
	var menuYlock = null;

	$(document).ready(function(){
			menuYlock = parseInt($(nama).css("top").substring(0,$(nama).css("top").indexOf("px")))
			$(window).scroll(function () {
			offset = menuYlock+$(document).scrollTop()+"px";
			$(nama).animate({top:offset},{duration:500,queue:false});
		});
	});

var status = "";
function menuKanan()
{
	if(status=="")
	{
		$('#menukanan').slideUp();
		status = "isi";
	}
	else
	{
		$('#menukanan').slideDown();
		status = "";
	}
	
}
</script>

			<style>
            /* Autocomplete ----------------------------------*/
            .ui-autocomplete { position: absolute; cursor: default; }
            .ui-autocomplete-loading { background: white url('http://jquery-ui.googlecode.com/svn/tags/1.8.2/themes/flick/images/ui-anim_basic_16x16.gif') right center no-repeat; }*/
 
            /* workarounds */
            * html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */
 
            /* Menu     ----------------------------------*/
            .ui-menu {
                list-style:none;
                padding: 2px;
                margin: 0;
                display:block;
            }
            .ui-menu .ui-menu {
                margin-top: -3px;
            }
            .ui-menu .ui-menu-item {
                margin:0;
                padding: 0;
                zoom: 1;
                float: left;
                clear: left;
                width: 100%;
                font-size:80%;
            }
            .ui-menu .ui-menu-item a {
                text-decoration	: none;
                display			: block;
                padding			: .2em .4em;
                line-height		: 1.5;
                zoom			: 1;
            }
            .ui-menu .ui-menu-item a.ui-state-hover,
            .ui-menu .ui-menu-item a.ui-state-active {
					-webkit-box-shadow			: 0px 0px 5px rgba(0,0,0,0.5);
					border-top-right-radius		: 1px;
					border-bottom-right-radius	: 1px;
					border-top-left-radius		: 1px;
					border-bottom-left-radius	: 1px;
                background-color	: #37a7c7;
				font-weight			: normal;
                margin				: -1px;
				color 				: #FFF;
				zoom				: 1.2;
            }
        </style>
 
        <script type="text/javascript">
        $(this).ready( function() {
            $("#cari_sesuatu").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/web/lookup",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        },
                    });
                },
            select:
                function(event, ui) {
                    $("#result").append(
                        "<li>"+ ui.item.value + "</li>"
                    );
                },
            });
        });
        </script>


<script type="text/javascript">
hs.graphicsDir = '<?php echo base_url(); ?>application/views/web/images/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';

</script>
</head>

<body>
<div id="menu-atas">
	<div id="atas">
		<div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>application/views/web/images/logo.png" border="0" /></a></div>
			<div class="menu" id="nav">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
						<?php
							$no=1;
								foreach($menu->result_array() as $m)
								{
									echo "	<li>
											<div id='parent_".$no."' class='sample_attach'>
												<a href='#'>".$m['title']."</a>
											</div>
											</li>";
												$sub_menu=$this->Web_model->Sub_Menu_Atas($m['id'],"1");
												//print_r($sub_menu);
												//echo $m['id_parent'];
												echo"<div id='child_".$no."'>";
													foreach($sub_menu->result_array() as $sm)
													{
														echo "<a class='sample_attach' href='".base_url()."index.php/web/data/".$sm['id']."'>".$sm['title']."</a>";
													}
												echo"</div>";
												echo'	
													<script type="text/javascript">
														at_attach("parent_'.$no.'", "child_'.$no.'", "hover", "y", "pointer");
													</script>';
											$no++;
								}
							?>
	
				</ul>
			</div>
	</div>
</div>
	<div id="menu-samping">
	<div id="menuFloat">
		<ul id="navigationMenu">
			<?php
				foreach($menu_bawah->result_array() as $mb)
				{
					echo "<li><a class='".$mb['title']."' href='".base_url()."index.php/web/data/".$mb['id']."'><span>".$mb['title']."</span></a></li>";
				}
			?>
		</ul>
	</div>
	</div>


<div id="kulit-luar">
<div id="header">
<script type="text/javascript">

var flashyshow=new flashyslideshow({ //create instance of slideshow
	wrapperid: "myslideshow", //unique ID for this slideshow
	imagearray: [
		["<?php echo base_url(); ?>application/views/web/images/header1.png"],
		["<?php echo base_url(); ?>application/views/web/images/header2.png"],
		["<?php echo base_url(); ?>application/views/web/images/header3.png"]
	],
	pause: 5000, //pause between content change (millisec)
	transduration: 1000 //duration of transition (affects only IE users)
})

</script>
</div>
<div id="menu-bawah">
<div class="menu-bottom" id="nav-bawah">
	<ul>
    	<div class="none-ul">
		<form method="POST" action="<?php echo base_url() ?>index.php/web/pencarian">
						<select name="pencarian">
							<option value="tbl_event">Agenda dan Pengumuman</option>
							<option value="tbl_artikel">Berita dan Tutorial</option>
						</select>
				<input id="cari_sesuatu" name="cari_sesuatu" type="text" size="20" class="tombol"/>&nbsp;
				<input type="submit" class="tombol" value="Cari"/>
		</form>
		</div>
	</ul>
</div>
<div id="bawah-menu"><img src="<?php echo base_url(); ?>application/views/web/images/bawah-menu.png" /></div>
</div>
</body>
</html>