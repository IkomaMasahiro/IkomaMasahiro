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
        <dt>ID<font color="red">　必須</font></dt>
        <dd>
            <input type="text" name="id" size="35" maxlength="255">
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
    $error = 'ID・名前・本文はそれぞれ20文字以内の半角で、
               IDは数字の入力し、パスワードと被らない入力をお願いします';


}elseif(isset($_POST["id"],$_POST["name"], $_POST["pass"])) {
    if ($_POST['id'] == '' || $_POST['name'] == '' || $_POST['pass'] == '') {
        $error = 'すべての項目を入力してください';

    } elseif  (!preg_match('/^[0-9]+$/',$_POST['id'])) {//idが数字かどうか
        $error = "IDは半角数字の入力をお願いします";

    } elseif (mb_strlen($_POST['id']) > 20) {//文字数制限
        $error = "IDは20文字以内で入力してください";

    } elseif (mb_strlen($_POST['name']) > 20) {//文字数制限
        $error = "名前は20文字以内で入力してください";

    } elseif (mb_strlen($_POST['pass']) > 20) {//文字数制限
        $error = "パスワードは20文字以内で入力してください";

    } elseif ($_POST['id'] == $_POST['pass']) {//パスワードとIDの同一化を防ぐ
        $error = "IDとパスワードは違うものを選択してください";

    } elseif (!preg_match("/^[0-9]+$/", $_POST['name'])){
        $error = "全項目は半角で記入してください";

    }elseif(!preg_match("/^[0-9]+$/", $_POST['pass'])){
        $error = "全項目は半角で記入してください";
    }
}
if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: checklogin.php');
}
?>
<span style="color: #fa0000"><b><?php print $error ?><br><br></b></span>