<?php
//ログインしないと見れなくするのはこの3行！
session_start();
require_once "./dbc.php";
// loginCheck();


$pdo = dbc();
$file = getAllFile();

//データ登録SQL作成
// $stmt = $pdo->prepare('SELECT * FROM file_table2');
$stmt = $pdo->prepare('SELECT * FROM file_table2 ORDER BY dateInput ASC');  //日付順に並べる

$status = $stmt->execute();

//データ表示
$view = '';
if($status === false){
    $error = $stmt->errorInfo();
    exit('SQLerror:' . print_r($error, true));
}else{
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<table>';
        $view .= '<tr>';
        $view .= '<td>' .$result['dateInput'] . '</td>';
        $view .= '<td><a href="' . $result["file_path"] . '">こちら</a></td>';
        $view .= '<td>' .$result['caption'] . '</td>';
        // if($_SESSION['kanri_flg'] === '1'){
        if(!empty($_SESSION['kanri_flg']) && $_SESSION['kanri_flg'] === '1'){  //参考：https://qiita.com/wakahara3/items/bb7c8d7a1673b161abe7
        $view .= '<td>';
        $view .= '<a href="detail.php?id=' .$result['id'] . '" class="btn btn-warning" role="button">';  //クリックするとidを読む
        $view .= '更新';
        $view .= '</a>';
        $view .= '</td>';

        $view .= '<td>';
        $view .= '<a href="delete.php?id=' .$result['id'] . ' " class="btn btn-dark" role="button">';  //クリックするとidを読む
        $view .= '削除';
        $view .= '</a>';
        $view .= '</td>';
        }
        $view .= '</tr>';
        $view .= '</table>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@500&display=swap" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <title>EMSCファイル一覧</title>
</head>
<body>
<img src="./EMSC_logo2.png" alt="EMSC_logo2" class="logo">
    <div>
    <p>56期が大切にしたいこと</p>
    <p class="daiji">「その子自身の昨日と今日」<br>を比べる。</p>
    </div>
    <hr>
    <a href="./login.php" class="btn btn-primary" role="button">Login </a>
    <a href="./form.php" class="btn btn-success" role="button">FileUL</a>

<div class="contents">
    <hr>
    <h2>試合の要項など</h2>
    <?= $view ?>
</div>
    
</body>
</html>
