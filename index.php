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
            <h1>My Favorite Free BGM</h1>
            <!-- YouTube URL -->
            <div class="form-group">
                <input type="text" name="url" required>
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
</body>
</html>