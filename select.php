<?php
//1. DB接続
// localhostで動かす
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DB_CONNECT:'.$e->getMessage());
}

// さくらサーバで動かす
// try {
//     $db_name =  '**********';       //データベース名
//     $db_host =  '**************';   //DBホスト
//     $db_id =    '**********';       //アカウント名(登録しているドメイン)
//     $db_pw =    '**********';       //さくらサーバのパスワード
    
//     $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
//     $pdo = new PDO($server_info, $db_id, $db_pw);
// } catch (PDOException $e) {
//   exit('DB Connection Error:'.$e->getMessage());
// }

//２．URL SELECT SQL
$url_sql = "SELECT url AS URL FROM free_bgm;";
$url_stmt = $pdo->prepare($url_sql);
$url_status = $url_stmt->execute();

//3．COUNT SELECT SQL
$count_sql = "SELECT COUNT(*) AS COUNT FROM free_bgm;";
$count_stmt = $pdo->prepare($count_sql);
$count_status = $count_stmt->execute();

//4．URL データ表示
$url_values = "";
if ($url_status==false) {
  $url_error = $url_stmt->errorInfo();
  exit("SQLError:".$url_error[2]);
}
// 全データ取得
$url_values =  $url_stmt->fetchAll(PDO::FETCH_ASSOC);
$url_json = json_encode($url_values,JSON_UNESCAPED_UNICODE);

//5. COUNT データ表示
$count_values = "";
if ($count_status==false) {
  $count_error = $count_stmt->errorInfo();
  exit("SQLError:".$count_error[2]);
}
// 全データ取得
$count_values =  $count_stmt->fetchAll(PDO::FETCH_ASSOC);
$count_json = json_encode($count_values,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>My Favorite Free BGM</title>
</head>
<body>
    <!-- 登録エリア -->
    <div class="container">
        <form method="POST" action="insert.php">
            <!-- タイトル -->
            <h1>My Favorite Free BGM</h1>
            <!-- YouTube URL -->
            <div class="form-group">
                <input type="text" name="url" required="required"/>
                <label for="input" class="control-label">YouTube URL</label><i class="bar"></i>
            </div>
            <!-- Register -->
            <div class="button-container">
                <button type="submit" class="register_btn"><span>Register</span></button>
            </div>
        </form>  
    </div>
    <!-- 動画表示 -->
    <!-- Let's Listen! -->
    <div class="movie-container">
        <button type="button" class="display_btn" onclick="location.href='select.php'"><span>Let's Listen!</span></button>
        <!-- iframe表示 -->
        <div id="iframe"></div>
    </div>
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // URL リスト
        let url_list = '<?php echo $url_json; ?>';
        let url_list_obj = JSON.parse(url_list);
        // COUNT リスト
        let count_list = '<?php echo $count_json; ?>';
        let count_list_obj = JSON.parse(count_list);
        let count_num = count_list_obj[0].COUNT;
        // 乱数作成
        let random_num = Math.floor( Math.random() * (count_num + 1) );
        // URL 取得
        let url_str = url_list_obj[random_num].URL;
        let target = url_str.indexOf('?v=');
        let cut = url_str.substring(target);
        let url_cut_str = cut.replace("?v=", "");
        // iframe作成
        let iframe_tag = '<iframe width="853" height="480" src="https://www.youtube.com/embed/' + url_cut_str + '" frameborder="0" allowfullscreen></iframe>';
        // iframe表示
        $('#iframe').html('');
        $('#iframe').html(iframe_tag);
    </script>
</body>
</html>