<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=drawing,places"></script>
		<script src="js/gmaps.js"></script>
		<title>bis</title>
		<?php require_once('module/head.php'); ?>
	</head>
	<body>
		<div id="page" style="height: 500px;">
			<div class="header">
				<a href="#menu"></a>
			</div>
			<div class="content" id="map_canvas" style="width:100%;height:100%;" data-lon="" ></div>
			<?php require_once('module/menu.php'); ?>
		</div>
	</body>
	<?php require_once('module/script_friend.php'); ?>
</html>
