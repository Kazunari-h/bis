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
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/masonry.pkgd.min.js"></script>
    <link rel="stylesheet" href="css/sns.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
<div id="page">
    <div class="header">
        <a href="#menu"></a>
    </div>
<!--    <div class="content">-->
<!--        <p>投稿</p>-->
<!--        <form class="" action="memo_add.php" method="post">-->
<!--            <input type="text" name="name" value='--><?php //echo $name; ?><!--' readonly required><br>-->
<!--            <textarea  name="memo" cols="20" rows="4" maxlength="80" placeholder="内容をご記入ください"></textarea>-->
<!--            <input type="submit" value="送信">-->
<!--        </form>-->
<?php
//    require_once("DBAdapter.class.php");
//    $db = new DBAdapter();
//    $db -> comment_view();
//?>
    <div id="contents">
        <div class="container">
            <div class="grid g3">
                <img src="img/IMG_0227.jpg" alt=""/>
            </div>
            <div class="grid g3">
                <img src="img/IMG_0227.jpg" alt=""/>
            </div>
            <div class="grid g3">
                <img src="img/IMG_0227.jpg" alt=""/>
            </div>
            <div class="grid g3">
                <img src="img/IMG_0227.jpg" alt=""/>
            </div>
        </div>
    </div>

<!--    </div>-->
    <?php require_once('module/menu.php'); ?>
</div>
</body>
<?php require_once('module/script_friend.php'); ?>
</html>