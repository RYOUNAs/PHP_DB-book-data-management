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
    <h1>DB単行本データ一覧</h1>
    <form action="list.php" method="post">
        <button type="submit" name="download">CSV Download</button>
    </form>
    <!-- <a href="./list.php?download=yes" class="button">CSV Download</a> -->
    <p class="situation"><?php echo $situation ?></p>
    <form action="list.php" method="post" class="search_container">
        <input type="text" size="25" name="search" placeholder="キーワード検索">
        <input type="submit" value="検索">
    </form>
    <p><?php echo $count ?></p>
    <table>
        <tr>
            <th>画像</th>
            <th>タイトル</th>
            <th>巻数</th>
            <th>価格<a href="./list.php?price=up" class="">&#9650;</a><a href="./list.php?price=down" class="">&#9660;</a></th>
            <th>発売日</th>
            <th>購入日</th>
            <th>更新&削除</th>
        </tr>
        <?php foreach ((array)$data_database as $row) : ?>
            <tr>
                <td><img src="<?php echo DIR_IMG ?><?= "{$row['id']}" ?>.jpg" alt="<?= "{$row['id']}" ?>"></td>
                <td><?= "{$row['title']}" ?></td>
                <td><?= "{$row['volume']}" ?></td>
                <td><?= "{$row['price']}" ?></td>
                <td><?= "{$row['release_date']}" ?></td>
                <td><?= "{$row['purchase_date']}" ?></td>
                <!-- <td><?= "{$row['del_date']}" ?></td> -->
                <td>
                    <div class="item-list">
                        <!-- <form method="POST" name="a_upd_form" action="./update.php" class="item">
                            <input type="hidden" name="id" value="<?= "{$row['id']}" ?>"> -->
                        <!-- <input type="submit" value="更新"> -->
                        <a href="./update.php?id=<?= "{$row['id']}" ?>" class="button">更新</a>
                        <!-- </form>
                        <form method="POST" name="a_del_form" action="./delete.php" class="item">
                            <input type="hidden" name="id" value="<?= "{$row['id']}" ?>"> -->
                        <!-- <input type="submit" value="削除"> -->
                        <a href="./delete.php?id=<?= "{$row['id']}" ?>" class="button">削除</a>
                        <!-- </form> -->
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- <a href="./insert.php" class="insert">DB登録</a> -->
    <button class="insert" onclick="location.href='./insert.php'">DB登録</button>
</body>

</html>