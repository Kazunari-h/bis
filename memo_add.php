<?php
//変数初期化モジュール
require('modules/module_initialization.php');

	if (isset($_POST["name"], $_POST["memo"])) {
		$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
		$memo = nl2br(htmlspecialchars($_POST["memo"], ENT_QUOTES));
	}
require_once("DBAdapter.class.php");
$c = new DBAdapter();
$c -> comment_add($name,$memo);

header("Location: comment_ok.php");
