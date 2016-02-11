<?php
/**
 * Created by PhpStorm.
 * User: Akihiro
 * Date: 16/01/12
 * Time: 15:05
 */

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}else {
    $name = $_SESSION["user"];
}

$search_word = null;
if(isset($_POST['search_word'])){
    $search_word = $_POST["search_word"];
}

$dsn = 'mysql:host=localhost;dbname=iw31;charset=utf8';
$user = 'root';
$pass = 'root';

$reserves = array();

try {

    $sql = 'SELECT * FROM reserve WHERE title LIKE :title OR text LIKE :text';
    $sh = $pdo->prepare($sql);

    $sh->bindValue(':title',"%${search_word}%");
    $sh->bindValue(':text',"%${search_word}%");

    $sh->execute();
    $reserves = $sh->fetchAll(PDO::FETCH_ASSOC);

}catch( PDOException $e){
    echo $e->getMessage();
    exit;
}finally{
    $pdo = null;
}

require_once('smarty-3.1.27/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->assign('reserves',$reserves);
$smarty->display('templates/view.tpl');
?>
