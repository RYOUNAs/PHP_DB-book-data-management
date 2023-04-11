<?php
require_once '../../config.php';




$data_database = [];


$search = '';

$result_list = '';
$count = '';
$situation = '';





if (isset($_POST['download'])) {
    //ダウンロードされるファイル名
    $filename = 'book_' . date("Ymdhis") . '.csv';

    //ファイルタイプにMIMEタイプを指定
    header('Content-Type: application/octet-stream');

    //ファイルのダウンロード、リネームの指示
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    //ここから下の出力内容がダウンロードされる。


    $link = mysqli_connect(HOST, USER_ID, PASSWORD, DB_NAME);

    $csv_list = $link->query('SELECT * FROM m_book');
    foreach ($csv_list as $value) {
        echo $value['id'].','.$value['title'].','.$value['volume'].','.$value['price'].','.$value['release_date'].','.$value['purchase_date'].','.$value['del_date']."\n";
    }
    return;
    session_start();
    $_SESSION['situation'] = 'CSVダウンロー中';
}






$link = mysqli_connect(HOST, USER_ID, PASSWORD, DB_NAME);



if (isset($_GET['price'])) {
    if ($_GET['price'] == 'up') {
        $result_list = $link->query('SELECT * FROM m_book WHERE del_date IS NULL ORDER BY price DESC');
        // echo '昇順で実行しました';
    } elseif ($_GET['price'] == 'down') {
        $result_list = $link->query('SELECT * FROM m_book WHERE del_date IS NULL ORDER BY price ASC');
        // echo '降順で実行しました';
    }
} else {
    $result_list = $link->query('SELECT * FROM m_book WHERE del_date IS NULL ORDER BY release_date DESC');
}


if (isset($_POST['search'])) {
    if ($_POST['search'] != '') {

        // echo $_POST['search'];
        $search = $_POST['search'];
        $result_list = $link->query("SELECT * FROM m_book WHERE title LIKE  '%" . $search . "%' AND del_date IS NULL");


        $count = mysqli_num_rows($result_list) . '件';
    }
}
// ⇑作成中のデータ
// SELECT * FROM `m_book` WHERE del_date IS NULL;



foreach ($result_list as $key => $value) {
    $data_database[$key] = $value;
    $data_database[$key]['volume'] = $value['volume'] . '巻';
    $data_database[$key]['price'] = number_format($value['price']) . '円';
    $data_database[$key]['release_date'] = date("Y" . '年' . "m" . '月' . "d" . '日', strtotime($value['release_date']));
    if ($value['purchase_date'] != '') {
        $data_database[$key]['purchase_date'] = date("Y" . '年' . "m" . '月' . "d" . '日', strtotime($value['purchase_date']));
        // echo $value['purchase_date'].'<br>';
    }

    // print_r('<pre>');
    // print_r($value);
    // print_r('</pre>');
}


// print_r('<pre>');
// print_r($data_database);
// print_r('</pre>');

mysqli_close($link);



// echo date('m', strtotime('2020-05-01'));

session_start();
if (isset($_SESSION['situation'])) {
    $situation = $_SESSION['situation'];
}


require_once './tpl/list.php';



unset($_SESSION['situation']);
