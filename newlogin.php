<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2017/02/14
 * Time: 18:38
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>新規会員登録</title>
</head>
<body>
<p>必要事項をご記入ください</p>
<form action="" method="post" enctype="multipart/form-data">
    <dl>
        <dt>ID<font color="red">　必須</font></dt>
        <dd>
            <input type="text" name="ID" size="35" maxlength="255">
        </dd>
        <dt>名前<font color="red">　必須</font></dt>
        <dd>
            <input type="text" name="name" size="35" maxlength="255">
        </dd>
        <dt>パスワード<font color="red">　必須</font></dt>
        <dd>
            <input type="password" name="pass" size="10" maxlength="20">
        </dd>
    </dl>
    <div><input type="submit" value="入力内容を確認"></div>
</form>
</body>
</html>

<?php
session_start();

if (!isset($_POST["id"],$_POST["name"], $_POST["pass"])) {
    $error = 'ユーザーネーム・本文を入力してください';

}elseif (isset($_POST["id"],$_POST["name"], $_POST["pass"])) {
    if ($_POST['id'] == '' || $_POST['name'] == '' || $_POST['pass'] == '') {
        $error = 'blank';

    } elseif (strlen($_POST['id']) || strlen($_POST['name']) || strlen($_POST['pass']) < 20) {
        $error = 'length';

    }
}
if(empty($error)){
$_SESSION['join'] = $_POST;
header('Location: checklogin.php');
}
?>
