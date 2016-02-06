<?php

//変数初期化モジュール
require('module/module_initialization.php');
$ninsyo = false;

$user = array();

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $ninsyo = true;

    require_once("DBAdapter.class.php");
    $db = new DBAdapter();
    $db -> friend_check($user[0]['user_id']);
    $friend1 = $db->friend_get();

    $user_id = $user[0]['user_id'];

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
                <li><span>フォロー</span>
                    <ul>
<?php

    if($friend1[0]['your_id'] != 0){
        foreach($friend1 as $user1){

            require_once("DBAdapter.class.php");
            $db2 = new DBAdapter();
            $db2 -> friend_data($user1['your_id']);
            $friend_data1 = $db2->frienddata_get();

            echo '<li class="img">';
            echo '<a href="friend.php?user_id='.$friend_data1[0]['user_id'].'" >';
            echo '<img src="http://lorempixel.com/50/50/people/1/" />';
            echo $friend_data1[0]['name'].'<br />';
            $friend_data = $friend_data1[0]['name'];
            echo '<small>スーパーカブ５０</small>';
            echo '</a>';
            echo '</li>';
        }
    }else{
        echo '<li><span>友達が登録されていません</span></li>';
    }
?>



<?php

    require_once("DBAdapter.class.php");
    $db = new DBAdapter();
    $db -> friend_check2($user[0]['user_id']);
    $friend2 = $db->friend_get();

    if($friend2[0]['your_id'] != 0){
        echo '<li><span> </span></li>';
        echo '<li><span>フォロワー</span>';
        echo '<ul>';
        foreach($friend2 as $user2){
            require_once("DBAdapter.class.php");
            $db2 = new DBAdapter();
            $db2 -> friend_data($user2['your_id']);
            $friend_data2 = $db2->frienddata_get();

            echo '<li class="img" style="position: relative;">';
            echo '<a href="friend.php?user_id='.$friend_data2[0]['user_id'].'" >';
            echo '<img src="http://lorempixel.com/50/50/people/1/" />';
            echo $friend_data2[0]['name'].'<br />';
            echo '<small>スーパーカブ５０</small>';
            $friend_data = $friend_data2[0]['user_id'];
            echo '</a><img class="yoko" src="img/add_btn.png" alt="" width="50px" height="50px" onclick="kakunin()"></li>';
        }
        echo '</ul>';
        echo '</li>';
    }
?>


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