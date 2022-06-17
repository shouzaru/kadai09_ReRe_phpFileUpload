<?php
require_once "./dbc.php";
$files = getAllFile();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>日付で選択してDL</title>
</head>
<body>

<div>
<form action="" method="POST">                                  <!--自分自身にPOSTする-->
    <input type="date" name="searchDate" id="date"/>
    <button type="submit">この日付で探す</button>
</form>


<?php $searchDate = ''; ?>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST") :?>            <!--自分自身にPOSTした時にこう書く？-->
<?php $searchDate = $_POST['searchDate']; ?>
<?php endif; ?>

<?php foreach($files as $file): ?>                <!--セミコロン方式！参考：https://www.flatflag.nir87.com/if-257#endifHTML-->
<?php if($searchDate === $file['dateInput']): ?>
    <?php $a = $file['dateInput'] ?>             <!--変数aに入れちゃえ！-->
    <p><?php echo "{$file['dateInput']}";?></p> 
    <img src="<?php echo "{$file['file_path']}";?>" alt="">
    <p><?php echo h("{$file['caption']}");?></p> 
<?php endif; ?>
<?php endforeach; ?>
<?php if (empty($a)){echo 'ありません';} ?>  <!--変数aがない時-->
</div>

<hr>
<table>
    <tr>
        <th>ファイルのアップロード：</th>
        <td><a href="./form.php">こちらから</a></td>
    </tr>
</table>


    
</body>
</html>