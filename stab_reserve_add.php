<?php
/**
 * Created by PhpStorm.
 * User: Akihiro
 * Date: 16/02/01
 * Time: 23:31
 */
//変数初期化モジュール
require('module/module_initialization.php');

    $title = '東京旅行';
    $lat = '39.12';
    $lon = '135.12';
    $date = date("Y-m-d");
    $tag1 = 0;
    $tag2 = 1;
    $tag3 = 1;
    $tag4 = 0;
    $tag5 = 1;
    $tag6 = 0;
    $tag7 = 1;
    $tag8 = 1;
    $min = 1;
    $max = 10;

    for($i = 0; $i < 10; $i++){
        require_once("DBAdapter.class.php");
        $c = new DBAdapter();
        $c -> reserve_add($title.$i,$lat,$lon,$date,$tag1,$tag2,$tag3,$tag4,$tag5,$tag6,$tag7,$tag8,$min,$max);
    }

header("Location: sign_up_ok.php");






