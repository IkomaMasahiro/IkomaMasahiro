<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2016/12/10
 * Time: 11:49
 */

function getDb() {
    $dsn = 'mysql:dbname=board2; host=127.0.0.1';
    $usr = 'root';
    $passwd = '';

    try {
        $db = new PDO($dsn, $usr, $passwd);
        $db->exec('SET NAMES utf8');
    } catch (PDOException $e) {
        die("接続エラー:{$e->getMessage()}");
    }
    return $db;
}
?>
