<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2016/12/26
 * Time: 13:03
 */
session_start()
?>

<html>
<head>
    <title>掲示板</title>
</head>
<body>
<form method="POST" action="login.php">

    <div align="center">
        <p>
        <div style="font-size:x-large;">
            <span style="color: #0000FF">ログイン画面</span></div></p>

        名前         ：<input type="name" name="name" size="50" maxlength="20"/><br><br>
        パスワード：<input type="name" name="password" size="50" maxlength="20"/><br><br>
                    <input type="submit" value="ログイン"/><br><br>
                    <a href="newlogin.php">新規登録はこちら</a>
    </div>

</form>
</body>
</html>

<?php
require_once 'DbManager.php';
require_once 'encodek1.php';
$db = getDb();

if (!isset($_POST["name"], $_POST["password"])) {
    $message = '';
    return;

}elseif (isset($_POST["name"], $_POST["password"])) {
    if ($_POST["name"] === ''|| $_POST["password"] === '') {          //未入力の表示
        $message = '【注意】　すべての項目を入力してください';

    } elseif (mb_strlen($_POST['name']) > 20) {
        $message = '【注意】 名前・パスワードは20以内で入力してください';

    } elseif (mb_strlen($_POST['password']) > 20) {
        $message = '【注意】 名前・パスワードは20以内で入力してください';

    } else {
        $userid = htmlspecialchars($_POST['name']);
        $pw = htmlspecialchars($_POST['password']);

        try {
            $db = getDb();
            $stt = $db->prepare('SELECT * FROM menber WHERE id = :id');
            $stt->bindParam(':id', $id);
            $stt->execute();

            if ($row = $stt->fetch(PDO::FETCH_ASSOC)) {

                    // 入力したIDのユーザー名を取得
                    $sql = "SELECT * FROM menber WHERE id = $userid";  //入力したIDからユーザー名を取得
                    $stt = $db->query($sql);
                    foreach ($stt as $row) {
                        $row['id'];
                        $row['name'];
                    }
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["name"] = $row['name'];

                    header("Location: upload.php");
                    $message='ログイン完了';

            }
        } catch
        (PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }
    }
}
?>
<span style="color: #fa0000"><b><?php print $message ?><br><br></b></span>