<?php
$id = $_GET['id'];

require_once('dbc.php');
$pdo = dbc();

$stmt = $pdo->prepare('SELECT * FROM file_table2 WHERE id = :id');
$stmt -> bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

$view = '';
if($status == false){
    sql_error($stmt);
}else{
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //     $view .= '<img src="';
    //     $view .= $result['file_path'] . '" alt="">';
    // }
}
$view .= '<p>';
$view .= $result['dateInput'] . '</p>';
$view .= '<img src="';
$view .= $result['file_path'] . '" alt="">';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>アップロードフォーム</title>
</head>
<body>
    <h1>キャプションの更新</h1>
    <form enctype="multipart/form-data" action="./updateFile.php" method="POST">
        <div class="file-up">
            <!-- <input type="date" name="dateInput" /> -->
            <?= $view ?>
        </div>
        <div>
            <textarea name="caption" placeholder="キャプション（140文字以下）" id="caption" cols="30" rows="10"></textarea>
        </div>
        
        <input type="hidden" name="id" value="<?= $result['id']?>"><br>
        <div class="submit">
            <input type="submit" class="kbtn" value="更新">
        </div>
    </form>

    <div>
        <hr>
        <table>
            <tr>
                <th>ファイル一覧を見る：</th>
                <td><a href="./allFiles.php">こちら</a></td>
            </tr>
            <tr>
                <th>日付を選んでファイルを見る：</th>
                <td><a href="./selectDL.php">こちら</a></td>
            </tr>
        </table>
    </div>

    
</body>
</html>