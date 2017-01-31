<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2017/01/17
 * Time: 17:06
 */
?>

<html>
<head>
    <title>掲示板</title>
</head>
<body>
<form method="POST" action="upload.php">
    <div align="center"><br><br>

        ユーザネーム:
        <input type="text" name="name" size="25" maxlength="30" /><br/><br/>

        本文<br>
        <textarea name = "contents" rows = "10" cols = "100" maxlength = "200"></textarea><br><br>

    <input type="submit" name="bottom" value="投稿"/>

    </div>
</form>
</body>
</html>

<?php
require_once 'DbManager.php';
require_once 'encodek1.php';
$db = getDb();

if (isset($_POST["name"],$_POST["contents"])) {

    if ($_POST['name'] === '' || $_POST["contents"] === '') {          //未入力の表示
        echo '<span style="color: #fa0000">【注意】　すべての項目を入力してください</span>';
        return;
    }

    if ($_POST['name']>30){ //文字数制限の処理
        echo '<span style="color: #fa0000">文字数は30字までです</span>';
        return;

    }elseif ($_POST['contents']>200){
        echo '<span style="color: #fa0000">文字数は200文字までです</span>';
        return;
    }
    try {
        $db = getDb();
// INSERT命令の準備
        $stt = $db->prepare('INSERT INTO post3(name,contents) VALUES(:name,:contents)');
//INSERT命令を実行
        $stt->bindValue(':name', $_POST['name']);
        $stt->bindValue(':contents', $_POST['contents']);
        $stt->execute();
        $db = NULL;
    } catch (PDOException $e) {
        die("エラーメッセージ:{$e->getMessage()}");
    }
}
?>
    <div align="center">投稿表示
<body>
<table border="2">
    <tr>
    <th>ID</th><th>name</th><th>contents</th>
    </tr>
    </div>
<?php
try {
    $db = getDb();
    $stt = $db->prepare('SELECT * FROM post3 ORDER BY id DESC ');
    $stt->execute();
    while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?php print($row['id']); ?></td>
            <td><?php print($row['name']); ?></td>
            <td><?php print($row['contents']); ?></td>
        </tr>
        <?php
    }
    $db = NULL;
} catch (PDOException $e) {
    die("エラーメッセージ :{$e->getMessage()}");
}
?>
</table>
</body>