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
	 <div class="content">
		 <div class="circle center">
			 <img src="img/a.jpg" width="100" height="100" alt="">
		 </div>
		 <h1>船田　晃弘</h1>
		 <div class="container">
			 <div class="box border">友達
				 <br><div class="iro">2</div>
			 </div>
			 <div class="box border">投稿
				 <br><div class="iro">4</div>
			 </div>
			 <div class="box"><span class="mar-lef">お気に入り</span>
				 <br><div class="iro">0</div>
		 	</div>
	 	 </div>
		 <div class="haba">
		 	<p>HAL東京IT学部WEB開発学科三年<br>宜しくお願いします。</p>
		 </div>
	 </div>
	 <?php require_once('module/menu.php'); ?>
 </div>
 </body>
 </html>

