<?php

//変数初期化モジュール
require('module/module_initialization.php');
$ninsyo = false;

$user = array();
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $ninsyo = true;
}
?>
<nav id="menu" class="fixed">
    <ul>
        <li><span>プロフィール</span>
            <ul>
                <?php
                    if($ninsyo == false){
                        echo '<li><a href="sign_up.php">新規会員登録</a></li>';
                        echo '<li><a href="login.php">ログイン</a></li>';
                    }else{
                        echo '<li><a href="profile.php">'.$user[0]['name'].'’sプロフィール</a></li>';
                        echo '<li><a href="profile_edit.php">編集</a></li>';
                        echo '<li><a href="logout.php">ログアウト</a></li>';
                    }
                ?>
            </ul>
        </li>

        <li id="cnt"><span>SNS</span>
            <ul>
                <li><a href="main.php">投稿一覧</a><!--id="contacts-friends"-->
                </li>
                <li><span>友達</span>
                    <ul>
                        <li class="img">
                            <a href="#/">
                                <img src="http://lorempixel.com/50/50/people/1/" />
                                パプア沼田<br />
                                <small>スーパーカブ５０</small>
                            </a>
                        </li>
                        <li class="img">
                            <a href="#/">
                                <img src="http://lorempixel.com/50/50/people/2/" />
                                鈴木悠太<br />
                                <small>スーパーカブ１１０</small>
                            </a>
                        </li>
                    </ul>
                </li>
                <li><span>お気に入り</span>
                    <ul>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="calendar.php">カレンダー</a></li>
        <li><a href="map.php">地図</a></li>
        <li><span>アルバム</span>
            <ul>
                <li><a class="disable" href="#album/photo">撮影</a>
                    <form action="upload" method="post" enctype="multipart/form-data">
                        <input type="file" accept="image/*">
                        <input type="submit" value="送信">
                    </form>
                </li>
                <li><a href="photolib.php">フォトライブラリ</a></li>
            </ul>
        </li>
        <li><span>　</span></li>
        <li><span>設定</span>
            <ul>

            </ul>
        </li>
        <li><a href="#Config">ヘルプ</a></li>
        <li><a href="#Config">お問い合わせ</a></li>
    </ul>
</nav>