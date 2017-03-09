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
<form method="post" action="newlogin.php">
    <dl>
        <dt>名前(20文字以内）<font color="red">　必須</font></dt>
        <dd>
            <input type="text" name="name" size="35" maxlength="20">
        </dd>
        <dt>パスワード(20文字以内）<font color="red">　必須</font></dt>
        <dd>
            <input type="password" name="password" size="10" maxlength="20">
        </dd>
    </dl>
    <div><input type="submit" value="入力内容を確認"></div>
</form>
</body>
</html>

<?php
session_start();
$error = '';
if (!isset($_POST["name"], $_POST["password"])) {
    $error = '文字を入力してください';

}
//var_dump($_SERVER['REQUEST_METHOD']);
if($_SERVER['REQUEST_METHOD']=="POST") {
    if ($_POST['name'] == '' || $_POST['password'] == '') {
        $error = 'すべての項目を入力してください';

    } else if (mb_strlen($_POST['name']) > 20) {//文字数制限
        $error = "名前は20文字以内で入力してください";

    } else if (mb_strlen($_POST['password']) > 20) {//文字数制限
        $error = "パスワードは20文字以内で入力してください";

    } else if ($_POST['name'] == $_POST['password']) {//パスワードとIDの同一化を防ぐ
        $error = "名前とパスワードは違うものを選択してください";

    } else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['name'])) {
        $error = "全項目は半角で記入してください";

    } else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])) {
        $error = "全項目は半角で記入してください";

    }
}
//var_dump($error);
if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: checklogin.php');
}

?>
<span style="color: #fa0000"><b><?php print $error ?><br><br></b></span>