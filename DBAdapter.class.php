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

    public function user_check($mail,$password){
        $sql = 'SELECT count(*) FROM t_user WHERE mail = :mail AND password = :password';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':mail',$mail);
        $stmt -> bindValue(':password',$password);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $this->row = $row[0];
            }
        }
    }

    public function getuser_cnt(){
        return $this->row;
    }

    public function user_info($mail,$password){
        $sql = 'SELECT * FROM t_user WHERE mail = :mail AND password = :password';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':mail',$mail);
        $stmt -> bindValue(':password',$password);
        if ($stmt->execute()) {
            while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $this->user = $row;
            }
        }
        $this->pdo = null;
    }

    public function getuser(){
        return $this->user;
    }

    public function friend_check($user){

        $sql1 = 'SELECT count(*) FROM friend WHERE my_id = :id AND flag = 1';
        $stmt = $this->pdo->prepare($sql1);
        $stmt -> bindValue(':id',$user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['count(*)'] == 0) {
            $this->friend = array(array('your_id' => '0'));
        }else{
            $sql2 = 'SELECT your_id FROM friend WHERE my_id = :id AND flag = 1';
            $stmt = $this->pdo->prepare($sql2);
            $stmt -> bindValue(':id',$user);
            if ($stmt->execute()) {
                while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    $this->friend = $row;
                }
            }
            $this->pdo = null;
        }
    }
    public function friend_check2($user){

        $sql1 = 'SELECT count(*) FROM friend WHERE my_id = :id AND flag = 0';
        $stmt = $this->pdo->prepare($sql1);
        $stmt -> bindValue(':id',$user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['count(*)'] == 0) {
            $this->friend = array(array('your_id' => '0'));
        }else{
            $sql2 = 'SELECT your_id FROM friend WHERE my_id = :id AND flag = 0';
            $stmt = $this->pdo->prepare($sql2);
            $stmt -> bindValue(':id',$user);
            if ($stmt->execute()) {
                while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    $this->friend = $row;
                }
            }
            $this->pdo = null;
        }
    }

    public function friend_get(){

        return $this->friend;
    }

    public function friend_data($user){

        $sql = 'SELECT * FROM t_user WHERE user_id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':id',$user);
        if ($stmt->execute()) {
            while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $this->friend_info = $row;
            }
        }
        $this->pdo = null;
    }

    public function frienddata_get(){
        return $this->friend_info;
    }

    public function friend_add($my_id,$your_id){
        $sql = 'UPDATE friend SET flag = 1 WHERE my_id = :my_id AND your_id = :your_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':my_id',$my_id);
        $stmt -> bindValue(':your_id',$your_id);
        $stmt -> execute();
        $this->pdo = null;
    }


    public function reserve_add($title, $lat, $lon, $date, $tag1, $tag2, $tag3, $tag4, $tag5, $tag6, $tag7, $tag8, $min, $max){
        $sql = "INSERT INTO reserve(title,lat,lon,date,tag1,tag2,tag3,tag4,tag5,tag6,tag7,tag8,min,max)
         VALUES(:title,:lat,:lon,:date,:tag1,:tag2,:tag3,:tag4,:tag5,:tag6,:tag7,:tag8,:min,:max)";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindValue(':title',$title);
        $stmt -> bindValue(':lat',$lat);
        $stmt -> bindValue(':lon',$lon);
        $stmt -> bindValue(':date',$date);
        $stmt -> bindValue(':tag1',$tag1);
        $stmt -> bindValue(':tag2',$tag2);
        $stmt -> bindValue(':tag3',$tag3);
        $stmt -> bindValue(':tag4',$tag4);
        $stmt -> bindValue(':tag5',$tag5);
        $stmt -> bindValue(':tag6',$tag6);
        $stmt -> bindValue(':tag7',$tag7);
        $stmt -> bindValue(':tag8',$tag8);
        $stmt -> bindValue(':min',$min);
        $stmt -> bindValue(':max',$max);
        $stmt -> execute();
        $this->pdo = null;
    }


//    public function Comment_add($name, $memo){
//        $sql = "INSERT INTO t_comment(name,memo,time) VALUES(:name,:memo,now())";
//        $stmt = $this->pdo->prepare($sql);
//        $stmt -> bindValue(':name',$name);
//        $stmt -> bindValue(':memo',$memo);
//        $stmt -> execute();
//        $this->pdo = null;
//    }

//    public function comment_view(){
//        $sql = 'SELECT count(*) FROM t_comment';
//        $stmt = $this->pdo->prepare($sql);
//        $row = $stmt->fetch();
//        if ($stmt->execute()) {
//            while ($row = $stmt->fetch()) {
//                if ($row[0] != 0) {
//                    $sql = 'SELECT name,memo FROM t_comment';
//                    $stmt = $this->pdo->prepare($sql);
//                    if ($stmt->execute()) {
//                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//                            echo "<p>名前 ";
//                            print_r($row['name']);
//                            echo "</p>";
//                            echo "<p>メモ<br>";
//                            print_r($row['memo']);
//                            echo "</p>";
//                        }
//                    }
//                }
//            }
//        }
//        $this->pdo = null;
//    }
}
