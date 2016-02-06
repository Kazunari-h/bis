<?php
//変数初期化モジュール
require('module/module_initialization.php');

	if (isset($_GET["my_id"],$_GET['your_id'])) {
		$my_id = $_GET['my_id'];
		$your_id = $_GET['your_id'];
		require_once("DBAdapter.class.php");

		$add_friend = new DBAdapter();
		$add_friend -> friend_add($my_id,$your_id);
	}
header("Location: index.php");