<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Style.css">
    <title>Original</title>
</head>

<body>
    <h1>DB単行本データ削除</h1>
    <div class="form_simple1">

        <form method="POST" action="./insert.php" enctype="multipart/form-data">
            <div>
                <h2>タイトル</h2>
                <p><?php echo $del_title; ?></p>
            </div>
            <div>
                <h2>巻数</h2>
                <p><?php echo $del_volume; ?></p>
            </div>
            <div>
                <h2>価格</h2>
                <p><?php echo $del_price; ?></p>
            </div>
            <div>
                <h2>発売日</h2>
                <p><?php echo $del_release_date; ?></p>
            </div>
            <div>
                <h2>購入日</h2>
                <p><?php echo $del_purchase_date; ?></p>
            </div>
            <div>
                <h2>画像</h2>
                <p><img src="<?php echo DIR_IMG ?><?php echo $del_id; ?>.jpg" alt="<?php echo $del_id; ?>"></p>
            </div>
            <a href="./delete.php?id=<?php echo $del_id ?>&del=del" class="button">単行本の情報を削除</a>
        </form>
    </div>
</body>

</html>