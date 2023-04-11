<?php
require_once '../../config.php';



// ⇓===================⇓変数管理⇓===================⇓


$title_error = '';
$volume_error = '';
$price_error = '';
$release_date_error = '';
$purchase_date_error = '';
$file_error = '';
// エラー表示用


$ok_purchase = 0;
$ok_num = 0;
// 登録処理管理


$title_val = '';
$volume_val = '';
$price_val = '';
$release_date_val = '';
$purchase_date_val = '';
// 入力値保存


$r_year = '';
$r_month = '';
$r_day = '';
$p_year = '';
$p_day = '';
$_month = '';
// 日付管理


$upload_file = '';
// ファイルデータ


$title = '';
$volume = '';
$price = '';
$release_date = '';
$purchase_date = '';
// タイトルデータ


$link = '';
// Mysqlのデータ


$file_id = '';
// ファイルID生成


$m_data = '';
// データ格納先


// ⇑===================⇑変数管理⇑===================⇑

// ⇓===============⇓データ入力確認部⇓===============⇓


if (isset($_POST['title'])) {
    if ($_POST['title'] != "") {
        $title_val = $_POST['title'];
        $ok_num++;
    } else {
        $title_error = '&#x26a0;<span>タイトル</span>を入力してください。';
    }
}


if (isset($_POST['volume'])) {
    if ($_POST['volume'] != "") {
        if (is_numeric($_POST['volume'])) {
            $volume_val = $_POST['volume'];
            $ok_num++;
        } else {
            $volume_error = '&#x26a0;<span>半角数値</span>で入力してください。';
        }
    } else {
        $volume_error = '&#x26a0;<span>巻数</span>を入力してください。';
    }
}


if (isset($_POST['price'])) {
    if ($_POST['price'] != "") {
        if (is_numeric($_POST['price'])) {
            $price_val = $_POST['price'];
            $ok_num++;
        } else {
            $price_error = '&#x26a0;<span>半角数値</span>で入力してください。';
        }
    } else {
        $price_error = '&#x26a0;<span>価格</span>を入力してください。';
    }
}


if (isset($_POST['release_date'])) {
    if ($_POST['release_date'] != "") {
        if (is_numeric($_POST['release_date'])) {
            if (strlen($_POST['release_date']) == 8) {
                $r_year = SUBSTR($_POST['release_date'], 0, 4);
                $r_month = SUBSTR($_POST['release_date'], 4, 2);
                $r_day = SUBSTR($_POST['release_date'], 6, 2);
                if (checkdate($r_month, $r_day, $r_year)) {
                    $release_date_val = $_POST['release_date'];
                    $release_date = $_POST['release_date'];
                    $ok_num++;
                } else {
                    $release_date_error = '&#x26a0;<span>正しい日付</span>を入力してください。';
                }
            } else {
                $release_date_error = '&#x26a0;<span>8文字</span>で入力してください。';
            }
        } else {
            $release_date_error = '&#x26a0;<span>半角数値</span>で入力してください。';
        }
    } else {
        $release_date_error = '&#x26a0;<span>発売日</span>を入力してください。';
    }
}


if (isset($_POST['purchase_date'])) {
    if ($_POST['purchase_date'] != "") {
        if (is_numeric($_POST['purchase_date'])) {
            if (strlen($_POST['purchase_date']) == 8) {
                $p_year = SUBSTR($_POST['purchase_date'], 0, 4);
                $p_month = SUBSTR($_POST['purchase_date'], 4, 2);
                $p_day = SUBSTR($_POST['purchase_date'], 6, 2);
                if (checkdate($p_month, $p_day, $p_year)) {
                    $purchase_date_val = $_POST['purchase_date'];
                    $purchase_date = $_POST['purchase_date'];
                    $ok_purchase = 1;
                } else {
                    $ok_num = 0;
                    $purchase_date_error = '&#x26a0;<span>正しい日付</span>を入力してください。';
                }
            } else {
                $ok_num = 0;
                $purchase_date_error = '&#x26a0;<span>8文字</span>で入力してください。';
            }
        } else {
            $ok_num = 0;
            $purchase_date_error = '&#x26a0;<span>半角数値</span>で入力してください。';
        }
    } else {
        // $purchase_date = '';
    }
}


if (isset($_FILES['img'])) {
    $upload_file = $_FILES['img'];
    if ($upload_file['type'] != '') {
        $ok_num++;
        // print_r('<pre>');
        // print_r($upload_file);
        // print_r('</pre>');
        // echo "処理されました";
    } else {
        $file_error = '&#x26a0;<span>ファイル</span>を選択してください。';
    }
}





// ⇑===============⇑データ入力確認部⇑===============⇑

// ⇓===============⇓データ登録⇓===============⇓


if ($ok_num >= 5) {


    $title = $_POST['title'];
    $volume = $_POST['volume'];
    $price = $_POST['price'];


    $link = mysqli_connect(HOST, USER_ID, PASSWORD, DB_NAME);
    mysqli_set_charset($link, 'utf8');
    if ($ok_purchase == 0) {
        mysqli_query(
            $link,
            "INSERT INTO m_book (`title`, `volume`, `price`, `release_date`) VALUES('" . $title . "'," . $volume . "," . $price . ",'" . $release_date . "');"
        );
        // printf("New record has ID %d.\n", mysqli_insert_id($link));
        // echo "INSERT INTO m_book (`title`, `volume`, `price`, `release_date`) VALUES('" . $title . "'," . $volume . "," . $price . ",'" . $release_date . "');";
    } else {
        mysqli_query(
            $link,
            "INSERT INTO m_book (`title`, `volume`, `price`, `release_date`, `purchase_date`) VALUES('" . $title . "'," . $volume . "," . $price . ",'" . $release_date . "','" . $purchase_date . "');"
        );
        // printf("New record has ID %d.\n", mysqli_insert_id($link));
        // echo "INSERT INTO m_book (`title`, `volume`, `price`, `release_date`, `purchase_date`) VALUES('" . $title . "'," . $volume . "," . $price . ",'" . $release_date . "','" . $purchase_date . "');";
    }


    $file_id = mysqli_insert_id($link);

    mysqli_close($link);




    $m_data = DIR_IMG . $file_id . '.' . 'jpg';
    move_uploaded_file($upload_file['tmp_name'], $m_data);
    // echo 'ファイルデータの書き込みが成功しました';



    // echo $upload_file['name'];

    // print_r('<pre>');
    // print_r($upload_file);
    // print_r('</pre>');
    session_start();
    $_SESSION['situation'] = '『' . $title . '』の登録が完了しました';


    header("Location: ./list.php");



    // exit;
}


// ⇑===============⇑データ入力確認部⇑===============⇑

// ⇓===============⇓データ入力確認部⇓===============⇓
// ⇑===============⇑データ入力確認部⇑===============⇑


require_once './tpl/insert.php';
