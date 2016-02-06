<?php
session_start();
//変数初期化モジュール
require('module/module_initialization.php');

if (!isset($_SESSION["user"])) {
	header("Location: login.php");
}else {
	$user = $_SESSION["user"];}

	if(isset($_GET['user_id'])){
		$your_user = $_GET['user_id'];

		require_once("DBAdapter.class.php");
		$db = new DBAdapter();
		$db -> friend_data($your_user);
		$friend_data = $db->frienddata_get();
	}else{
		$your_user = array();
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
		 <h1><?php echo $friend_data[0]['name'] ?></h1>
<!--		 <div class="container">-->
<!--			 <div class="box border">友達-->
<!--				 <br><div class="iro">2</div>-->
<!--			 </div>-->
<!--			 <div class="box border">投稿-->
<!--				 <br><div class="iro">4</div>-->
<!--			 </div>-->
<!--			 <div class="box"><span class="mar-lef">お気に入り</span>-->
<!--				 <br><div class="iro">0</div>-->
<!--		 	</div>-->
<!--	 	 </div>-->
		 <div class="haba">
		 	<p><?php echo $friend_data[0]['text'] ?></p>
		 </div>
	 </div>
	 <?php require_once('module/menu.php'); ?>
 </div>
 </body>
 <?php require_once('module/script_friend.php'); ?>
 </html>

