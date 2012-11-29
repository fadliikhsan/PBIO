		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Web Administrator</title>
	<link href="<?php echo base_url();?>application/views/webadmin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<br />
	<br />
	<br />
	<br />
	<br />
	<form method="POST" action="<?php echo base_url();?>index.php/webadmin/login">
	<div id="box-login">
		<table>
			<tr>
				<td colspan="3"><a href="<?php echo base_url(); ?>">
					<img src="<?php echo base_url(); ?>application/views/webadmin/images/title-uin.png" border="0" /></a>
				</td>
			</tr>
			<tr>
				<td width="100">Username</td>
				<td width="20">:</td><td><input type="text" name="username" class="input" size="35"/></td>
			</tr>
			<tr>
				<td width="100">Password</td>
				<td width="20">:</td><td><input type="password" name="password" class="input" size="35"/></td>
			</tr>
			<tr>
				<td width="100"></td><td width="20"></td>
				<td><input type="submit" class="tombol" value="MASUK" />
				<input type="reset" class="tombol" value="HAPUS" /></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><br />Desain dan Program oleh <b>Pendidikan Biologi UIN Sunan Kalijaga</b></td>
			</tr>
</table>
</div>
</form>
</body>
</html>
