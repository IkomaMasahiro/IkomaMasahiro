<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2016/12/08
 * Time: 17:14
 */
?>

<html>
<head>
    <title>電卓</title>
</head>
<body>
<form method="POST" action="dentaku.php">
    計算式：
    <input type="number" name="num1" size="4"/>
    <select name="mark" size="1">
        <option value="＋">＋</option>
        <option value="－">－</option>
        <option value="×">×</option>
        <option value="÷">÷</option>
    </select>

    <input type="number" name="num2" size="4" />
    <input type="submit" value="計算結果"/>
</form>
</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: 将寛
 * Date: 2016/12/10
 * Time: 11:49
 */
//var_dump($_POST);


if (!isset($_POST["num1"],$_POST["num2"],$_POST["mark"])){             //未入力の処理
    return;}


if ($_POST['num1']===''||$_POST['num2']===''){          //未入力の表示
    echo '<span style="color: #fa0000">【注意】　数字の入力をお願いします</span>';
    return;}

if((!ctype_digit($_POST['num2'])) || (!ctype_digit($_POST['num1']))) {      //数字以外が入力された時の処理
    echo '<span style="color: #fa0000">半角数字で入力してください</span>';
    return;}


$num1 = $_POST['num1'];
$mark = $_POST['mark'];
$num2 = $_POST['num2'];



switch ($mark) {
    case "＋":
        $cal = $num1+$num2;
        break;
    case "－":
        $cal = $num1-$num2;
        break;
    case "×":
        $cal = $num1*$num2;
        break;
    case "÷":
        if($num2 === '0'){      //0の割り算の処理
            echo'<span style="color: #fa0000">0の割り算はできません、もう一度やり直してください</span>';
            return;

        }else{$cal = $num1 / $num2;}
        break;

    default:
        print '不適切な値です';

}

echo  $num1,$mark,$num2, "＝", $cal;


?>
