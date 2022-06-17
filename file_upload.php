<?php
require_once "./dbc.php";

//1. POSTされたファイルデータ取得
//日付を取得
$dateInput = $_POST['dateInput'];
// var_dump($dateInput);
echo $dateInput;
//キャプションを取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);
// var_dump($caption);
echo $caption;
//画像ファイルを取得
$file = $_FILES['img'];                                                 //imgはフォームで指定した名前。これをPHPの機能である$_FILESで受け取る。                               
$filename = basename($file['name']);                                    //PHPのbasename()関数は絶対パスの文字列からファイル名だけ抜き出す
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
// $upload_dir = '/Applications/MAMP/htdocs/kadai07_phpFileUpload/images/';     //これはMac上のパス
$upload_dir = 'documents/';                                                        //MAMP上のパスを指定する。MAMPの場合トップのディレクトリはkadai06_upload/
// $save_filename = date('YmdHis').$filename;
// $save_path = $upload_dir.$save_filename;
$save_path = $upload_dir.$filename;



//tmp_pathがある（＝ファイルがアップロードされている）なら、ファイルを指定のディレクトリに移動する
if(is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path, $save_path)){
            echo $filename . 'を' . $upload_dir . 'にアップしました。';
            echo '<br>';
            //ファイルのアップロードが成功したら、DBに保存する。それはdbc.phpに書く。
            //DBに保存する関数fileSave（ファイル名、ファイルパス、キャプション）
            $result = fileSave($dateInput, $filename, $save_path, $caption);
            if($result)
                {
                    echo 'データベースに保存しました';
                    echo '<br>';

                }else
                {
                    echo 'データベースの保存に失敗しました';
                    echo '<br>';

                }
        }
        else
        {
            echo 'ファイルが保存できませんでした';
            echo '<br>';

        }
    }
    else
    {
            echo 'ファイルが選択されていません';
            echo '<br>';

    }
    
?>
<div>
<a href="./form.php">ファイルアップロードフォームに戻る</a>
</div>