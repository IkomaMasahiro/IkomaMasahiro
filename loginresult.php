<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2017/02/21
 * Time: 18:40
 */
require_once 'DbManager.php';

session_start();

// 入力したユーザIDを格納
$name = $_SESSION['join']['name'];
$pass = $_SESSION['join']['password'];

if (!empty($name) && !empty($pass)) {
    $dsn = 'mysql:dbname=board2; host=127.0.0.1';
    $usr = 'root';
    $passwd = '';

    try {
        $db = getDb();
        // INSERT命令の準備
        $stt = $db->prepare('INSERT INTO member(name,password) VALUES(:name,:pass)');
        //INSERT命令を実行
        $stt->bindValue(':name', $name);
        $stt->bindValue(':pass',$pass);
        $stt->execute();
        $db = NULL;
        $error = '新規登録完了';
    } catch (PDOException $e) {
        die("エラーメッセージ:{$e->getMessage()}");
    }

}else{
    $error='error';
}

?>

<span style="color: #fa0000"><b><?php print $error ?><br><br></b></span>

<a href="login.php">ログイン画面</a>
