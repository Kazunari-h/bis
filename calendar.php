<?php
session_start();
//変数初期化モジュール
require('module/module_initialization.php');

if (!isset($_SESSION["user"])) {
	header("Location: login.php");
}else {
	$name = $_SESSION["user"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
	<title>bis</title>
	<?php require_once('module/head.php'); ?>
	<link rel="stylesheet" href="css/calendar.css">
</head>
<body>
<div id="page">
	<div class="header">
		<a href="#menu"></a>
	</div>
	<div class="content">
		<?php include("module/module.php"); ?>
	</div>
	<?php require_once('module/menu.php'); ?>
</div>
</body>
<?php require_once('module/script_friend.php'); ?>
</html>

