<?php

session_start();
//変数初期化モジュール
require('module/module_initialization.php');

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}else {
    $name = $_SESSION["user"];
}

$time = "";
$str_year = "";
$str_month = "";
$str_day = "";
$file_name = "";
$memo ="";
$targetTime  = "";

if (isset($_GET["edit_data"]) ){
  $targetTime = $_GET["target_time"];
  $time = $_GET["edit_data"];
  if(!preg_match("/[0-9]{8}/",$time)){
    header("location:calendar.php");
  }
  $str_year = substr("$time"  ,0,4);
  $str_month = substr("$time" ,4,2);
  $str_day = substr("$time" ,6,2);
}else if (isset($_GET["data"]) ){
   $targetTime = $_GET["target_time"];
   $time = $_GET["data"];
   if(!preg_match("/[0-9]{8}/",$time)){
     header("location:calendar.php");
   }
   $str_year = substr("$time"  ,0,4);
   $str_month = substr("$time" ,4,2);
   $str_day = substr("$time" ,6,2);
}else {
  header("location:calendar.php");
}
$file_name ="data/${time}.txt";
if(is_readable($file_name)){
  $memo = file_get_contents($file_name);
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
        <h2>
            <?php echo "${str_year}年"."${str_month}月"."${str_day}日"; ?>
        </h2>
        <p>Memo</p>
        <form action="file_edit.php" method="post">
            <input type="hidden" name="time" value="<?php echo $time; ?>">
            <input type="hidden" name="target_time" value="<?php echo $targetTime; ?>">
            <textarea name="memo" cols="30" rows="10"><?php echo $memo ?></textarea><br>
            <a href="calendar.php?target_time=<?php echo $targetTime; ?>">戻る</a>
            <input type="submit" value="登録" />
        </form>
    </div>
    <?php require_once('module/menu.php'); ?>
</div>
</body>
</html>