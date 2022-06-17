<?php
session_start();
require_once "./dbc.php";
$files = getAllFile();

// ログインしないと見れなくする
loginCheck();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <script src="js/jquery-2.1.3.min.js"></script>

    <title>アップロードフォーム</title>
</head>
<body>
    <h1>日付をつけてファイルアップロード</h1>
    <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
        <table>
            <tr>
                <th>日付を添える</th>
                <td><input type="date" name="dateInput" /></td>
            </tr>
            <tr>
                <th>ファイルを選択</th>
                <td><input type="file" name="img" /></td>
            </tr>
            <tr>
                <th>メモ</th>
                <td><textarea name="caption" placeholder="メモ" id="caption" cols="30" rows="2"></textarea></td>
            </tr>
        </table>
        
        <div class="submit">
            <input type="submit" id="submitBtn" class="btn" value="送信">
        </div>


        <!-- <div class="file-up">
            <input type="date" name="dateInput" />
            <input type="file" name="img" />
        </div>
        <div>
            <textarea name="caption" placeholder="メモ" id="caption" cols="30" rows="2"></textarea>
        </div>
        <div class="submit">
            <input type="submit" class="btn" value="送信">
        </div> -->
    </form>

    <div>
        <hr>
        <table>
            <tr>
                <th>ファイル一覧</th>
                <td><a href="./allFiles.php">こちら</a></td>
            </tr>
            <tr>
                <th>日付で探す</th>
                <td><a href="./selectDL.php">こちら</a></td>
            </tr>
            <tr>
                <th>管理者ログイン</th>
                <td><a href="./login.php">こちら</td>
            </tr>
        </table>
    </div>

<script src="JS/app.js" type="text/javascript"></script>

</body>
</html>