<?php
  require_once(functions.php);
  session_start();

  $edit = $_POST['edit'];
  $_SESSION['edit'] = $_POST['edit'];

  $dbh = db_conn();
  $data = [];
try{
    $sql = "SELECT * FROM user WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', '$edit', PDO::PARAM_STR);
    $stmt->execute();
    $count = 0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
        $count++;
    }

}catch (PDOException $e){
    echo($e->getMessage());
    die();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header>
       <div>
            <h1>編集画面</h1>
       </div>
    </header>
</div>
<hr>


    <div class="container">
        <form action="update.php" method="POST" class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                    <label for="name"><span class="required">お名前</span> </label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $data[name];?>" required>
                </div>
                <div class="form-group">
                    <label for="email"><span class="required">メールアドレス</span> </label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $data[email];?>" required>
                </div>
                <div class="form-group">
                    <label><span class="required">性別</span> </label>
                    <div>

<p>性別は <?php if( $data[gender] === "1" ){ echo '男性'; }
        elseif( $data[gender] === "2" ){ echo '女性'; }
        elseif( $data[gender] === "9" ){ echo 'その他'; }
?> です。</p>



                        <label class="radio-inline">
                            <input type="radio" name="gender" value="1" required>男性
                        </label>
                    
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="2" required>女性
                        </label>
                    
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="9" required>その他
                        </label>
                    </div>
                </div>
            
                <div class="button-wrapper">
                    <button type="button" onclick="history.back()">戻る</button>
                    <button type="submit" class="btn btn--naby btn--shadow">更新する</button>
                </div>
            </div>
        </form>
    </div>

<hr>
<div class="container">
    <footer>
        <p>CCC.</p>
    </footer>
</div>
</body>
</html>
