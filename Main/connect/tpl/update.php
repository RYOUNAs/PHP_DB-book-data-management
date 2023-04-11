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
    <h1>DB単行本データ更新</h1>
    <div class="form_simple1">

        <form method="POST" action="./update.php?id=<?php echo $upd_id; ?>" enctype="multipart/form-data">
            <div>
                <h2>タイトル<span>必須</span></h2>
                <input type="text" placeholder="" name="title" value="<?php echo $title_val; ?>">
                <p class="error"><?php echo $title_error; ?></p>
            </div>
            <div>
                <h2>巻数<span>必須</span></h2>
                <div class="display-flex">
                    <input type="text" placeholder="" name="volume" value="<?php echo $volume_val; ?>">
                    <p>巻</p>
                </div>
                <p class="error"><?php echo $volume_error; ?></p>
            </div>
            <div>
                <h2>価格<span>必須</span></h2>
                <div class="display-flex">
                    <input type="text" placeholder="" name="price" value="<?php echo $price_val; ?>">
                    <p>円</p>
                </div>
                <p class="error"><?php echo $price_error; ?></p>
            </div>
            <div>
                <h2>発売日<span>必須</span></h2>
                <input type="text" placeholder="例) 20220409" name="release_date" value="<?php echo $release_date_val; ?>">
                <p class="error"><?php echo $release_date_error; ?></p>
            </div>
            <div>
                <h2>購入日</h2>
                <input type="text" placeholder="例) 20211216" name="purchase_date" value="<?php echo $purchase_date_val; ?>">
                <p class="error"><?php echo $purchase_date_error; ?></p>
            </div>
            <div>
                <h2>画像</h2>
                <img src="<?php echo DIR_IMG ?><?php echo $upd_id; ?>.jpg" alt="<?php echo $upd_id; ?>">
                <input type="file" name="img" class="fileinput">
                <p class="error"><?php echo $file_error; ?></p>
            </div>
            <button type="submit" name="send" value="form_simple1">送信</button>
        </form>
    </div>
</body>

</html>