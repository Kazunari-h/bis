<?php
class DBAdapter{
//DB接続文字列
    public $dsn = "mysql:host=localhost;dbname=iw31;charset=utf8";
    public $dbUser = "root";
    public $dbPass = "root";

    function __construct(){
        $this->pdo = new PDO($this->dsn,$this->dbUser,$this->dbPass);
        $this->pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    }

    public function user_add($name,$password,$mail){
        $sql = "INSERT INTO t_user(name,password,mail) VALUES(:name,:password,:mail)";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':name',$name);
        $stmt -> bindValue(':password',$password);
        $stmt -> bindValue(':mail',$mail);
        $stmt -> execute();
        $this->pdo = null;
    }

    public function getuser(){
        return $this->row;
    }
    public function user_check($mail,$password){
        $sql = 'SELECT count(*) FROM t_user WHERE  mail = ? AND password = ?';
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array($mail,$password))) {
            while ($row = $stmt->fetch()) {
                $this->row = $row[0];
            }
        }
    }

    public function getinfo(){
        return $this->info;
    }
    public function user_info($mail,$password){
        $sql = 'SELECT name FROM t_user WHERE  mail = ? AND password = ?';
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array($mail,$password))) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->info = $row['name'];
            }
        }
        $this->pdo = null;
    }

    public function Comment_add($name, $memo){
        $sql = "INSERT INTO t_comment(name,memo,time) VALUES(:name,:memo,now())";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':name',$name);
        $stmt -> bindValue(':memo',$memo);
        $stmt -> execute();
        $this->pdo = null;
    }

    public function comment_view(){
        $sql = 'SELECT count(*) FROM t_comment';
        $stmt = $this->pdo->prepare($sql);
        $row = $stmt->fetch();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                if ($row[0] != 0) {
                    $sql = 'SELECT name,memo FROM t_comment';
                    $stmt = $this->pdo->prepare($sql);
                    if ($stmt->execute()) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<p>名前 ";
                            print_r($row['name']);
                            echo "</p>";
                            echo "<p>メモ<br>";
                            print_r($row['memo']);
                            echo "</p>";
                        }
                    }
                }
            }
        }
        $this->pdo = null;
    }
}
