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
</head>
<body>
<div id="page">
    <div class="header">
        <a href="#menu"></a>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d207433.5100227956!2d139.71038800000002!3d35.673343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sja!2sjp!4v1452782196329" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
    <?php require_once('module/menu.php'); ?>
</div>
</body>
<?php require_once('module/script_friend.php'); ?>
</html>