<?php

$id = $_GET['id'];
require_once('dbc.php');
$pdo = dbc();

//２．削除指定
$stmt = $pdo->prepare('DELETE FROM file_table2 WHERE id = :id');
$stmt -> bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('allFiles.php');
}


?>