<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2017/01/14
 * Time: 17:20
 */
function getDb()
{
    $dsn = 'mysql:dbname=keijibandb; host=127.0.0.1';
    $usr = 'root';
    $passwd = '';

    try {
        $db = new PDO($dsn, $usr, $passwd);
        $db->exec('SET NAMES utf8');
        echo '接続に成功しました';
        $db = NULL;
    } catch (PDOException $e) {
        die("接続エラー:{$e->getMessage()}");
    }
    return $db;
}