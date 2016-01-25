<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
		<title>bis</title>
		<?php require_once('module/head.php'); ?>
	</head>
	<body>
		<div id="page">
			<div class="header">
				<a href="#menu"></a>
			</div>
			<div class="content">
				<img src="img/logo.png" alt="logo" width="60%" height="60%">
			</div>
			<?php require_once('module/menu.php'); ?>
		</div>
	</body>
</html>
