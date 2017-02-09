<html>
<head>
    <title>掲示板</title>
</head>
<body>
<form method="POST" action="upload.php">
    <div align="center"><br><br>

        ユーザネーム<span style="color: #2636fa">（30字まで）</span>:
        <input type="text" name="name" size="25" maxlength="30" /><br/><br/>


        本文　<span style="color: #2636fa">(200字まで)<br></span>
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
if (!isset($_POST["name"], $_POST["contents"])) {
    $error = 'ユーザーネーム・本文を入力してください';

}elseif (isset($_POST["name"], $_POST["contents"])) {
    if ($_POST['name'] === '' || $_POST["contents"] === '') {          //未入力の表示
        $error = '【注意】　すべての項目を入力してください';

    } elseif (mb_strlen($_POST['name']) > 30) { //文字数制限の処理
        $error = '【注意】 ユーザーネームは30文字・本文は200以内で入力してください';

    } elseif (mb_strlen($_POST['contents']) > 200) {
        $error = '【注意】　ユーザーネームは30字・本文は200文字以内で入力してください';

    } else {
        try {
            $db = getDb();
            // INSERT命令の準備

            $stt = $db->prepare('INSERT INTO post(name,contents) VALUES(:name,:contents)');
            //INSERT命令を実行
            $stt->bindValue(':name', $_POST['name']);
            $stt->bindValue(':contents', $_POST['contents']);
            $stt->execute();
            $db = NULL;
            $error = '投稿完了';

        } catch (PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }
    }
}


    ?>

    <div align="center">
        <span style="color: #fa0000"><b><?php print $error ?><br><br></b></span>
        【投稿表示】<br>

        <body>
        <table border="2">
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>contents</th>
            </tr>
    </div>

    <?php
    try {
        $db = getDb();
        $stt = $db->prepare('SELECT * FROM post ORDER BY id DESC ');
        $stt->execute();
        while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php print e($row['id']); ?></td>
                <td><?php print e($row['name']); ?></td>
                <td><?php print e($row['contents']); ?></td>
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