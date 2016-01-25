<?php
  // 作成するファイル名の指定
  $file_name = "";
  $edit_memo = "";
  $memo = "";
  $targetTime  = "";

  if (isset($_POST["time"])){

   $targetTime = $_POST["target_time"];
   $time = $_POST["time"];
   if(!preg_match("/[0-9]{8}/",$time)){
     header("location:calendar.php?target_time=${targetTime}");
   }
   $file_name ="data/${time}.txt";

   if (isset($_POST["memo"])){
     $edit_memo = $_POST["memo"];
   }
   if(is_readable($file_name)){
     $memo = file_get_contents($file_name);
     $memo = $edit_memo;
     file_put_contents($file_name,$memo);
   }else {
     file_put_contents($file_name,$edit_memo);
   }
   header("location:web_edit.php?data=${time}&target_time=${targetTime}");

  }else {
    header("location:calendar.php");
  }
?>
