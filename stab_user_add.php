<?php
/**
 * Created by PhpStorm.
 * User: Akihiro
 * Date: 16/02/01
 * Time: 23:31
 */
//変数初期化モジュール
require('module/module_initialization.php');

    $name = "ogawa";
    $password = "00ogawa";
    $mail = "ogawa@hal.ac.jp";

    for($i = 0; $i < 10; $i++){
        require_once("DBAdapter.class.php");
        $c = new DBAdapter();
        $c -> user_add($name.$i,$password.$i,$i.$mail);
    }

header("Location: sign_up_ok.php");