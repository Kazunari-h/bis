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
	 <link rel="stylesheet" href="css/profile.css">
 </head>
 <body>
 <div id="page">
	 <div class="header">
		 <a href="#menu"></a>
	 </div>
	 <div class="content ">
		 <h1>プロフィール変更</h1>
		 <form action="" method="post">
			 名前：<input type="text" name="" value=""><br>
			 サムネイル：<input type="file" name=""><br>
			 パスワード：<input type="text" name="" value=""><br>
			 バイク車種：<input type="text" name="" value=""><br>
			 一言コメント：<input type="text" name="" value=""><br>
			 <input type="submit" value="送信">
		 </form>
	 </div>
	 <?php require_once('module/menu.php'); ?>
 </div>
 </body>
 </html>

