<?php
//変数初期化モジュール
require('module/module_initialization.php');

	if (isset($_POST["name"], $_POST["password"], $_POST["mail"])) {
		$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
		$password = $_POST["password"];
		$mail = $_POST["mail"];
	}
require_once("DBAdapter.class.php");
$c = new DBAdapter();
$c -> user_add($name,$password,$mail);

header("Location: sign_up_ok.php");







