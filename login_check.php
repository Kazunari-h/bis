<?php
session_start();
if (!isset($_SESSION["user"])) {
	$_SESSION["user"] = "";
}
//変数初期化モジュール
require('module/module_initialization.php');

	if (isset($_POST["mail"], $_POST["password"])) {
		$mail = $_POST["mail"];
		$password = $_POST["password"];
	}

require_once("DBAdapter.class.php");
$db = new DBAdapter();
$db -> user_check($mail,$password);
if ($db->getuser_cnt() == 1) {
	$db -> user_info($mail,$password);
	if (isset($_SESSION["user"])) {
		$_SESSION["user"] = $db->getuser();
	}
	header("Location: index.php");
}else {
	header("Location: login.php");
}
