<?php
//1. POSTデータ取得
$url = $_POST["url"];

//2. DB接続
// localhostで動かす
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

// さくらサーバで動かす
// try {
//   $db_name =  '**********';       //データベース名
//   $db_host =  '**************';   //DBホスト
//   $db_id =    '**********';       //アカウント名(登録しているドメイン)
//   $db_pw =    '**********';       //さくらサーバのパスワード
  
//   $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
//   $pdo = new PDO($server_info, $db_id, $db_pw);
// } catch (PDOException $e) {
//   exit('DB Connection Error:'.$e->getMessage());
// }

//３．データ登録SQL作成
$sql = "INSERT INTO free_bgm(url,indate)VALUES(:url,sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$status = $stmt->execute(); // true or false

//４．データ登録処理後
if ($status==false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
} else {
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>