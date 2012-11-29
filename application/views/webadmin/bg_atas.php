<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="<?php echo base_url(); ?>application/views/webadmin/css/style.css" rel="stylesheet" type="text/css" />
	<?php echo $scriptmce; ?>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>application/views/e-learning/images/icon.png" />
	<title>Halaman Administrator Pendidikan Biologi</title>
	
	<link href="<?php echo base_url(); ?>application/views/webadmin/css/highslide.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.dimensions.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/dropdown.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/jquery.cycle.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/slideshow.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/highslide-with-html.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>application/views/web/js/transisi.js"></script>
	
	<script type="text/javascript">
		hs.graphicsDir = '<?php echo base_url(); ?>application/views/web/images/';
		hs.outlineType = 'rounded-white';
		hs.wrapperClassName = 'draggable-header';
	</script>
	
</head>
<body onload="init()">
	<div id="tengah-header">
		<div id="header">
			<a href="<?php echo base_url(); ?>">
				<img src="<?php echo base_url(); ?>application/views/webadmin/images/pict-logo.png" border="0" />
			</a>
		</div>
		<div id="salam"><br /><br /><br /><br />
			Selamat Datang, <b>
			<?php echo $nama; ?></b> -|- <?php echo $tanggal; ?>
		</div>
	</div>
	<div id="batas-atas">
		<img src="<?php echo base_url(); ?>application/views/webadmin/images/bg-atas.png" />
	</div>
