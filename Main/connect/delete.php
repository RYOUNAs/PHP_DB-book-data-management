<?php
require_once '../../config.php';





$link = mysqli_connect(HOST, USER_ID, PASSWORD, DB_NAME);



// echo '取得データ:'.$_POST['id'];
$del_id = $_GET['id'];

$del_list = $link->query("SELECT * FROM m_book WHERE id =  " . $del_id . "");

mysqli_close($link);



// print_r('<pre>');
// print_r($del_list);
// print_r('</pre>');

foreach ($del_list as $val) {
    $del_id = $val['id'];
    $del_title = $val['title'];
    $del_volume = $val['volume'] . '巻';
    $del_price = number_format($val['price']) . '円';
    $del_release_date = date("Y" . '年' . "m" . '月' . "d" . '日', strtotime($val['release_date']));
    if ($val['purchase_date'] != '') {
        $del_purchase_date = date("Y" . '年' . "m" . '月' . "d" . '日', strtotime($val['purchase_date']));;
    } else {
        $del_purchase_date = '-';
    }
    // print_r('<pre>');
    // print_r($value);
    // print_r('</pre>');
}


$delete_date = date("Y-m-d");

if (isset($_GET['del']) && $_GET['del'] == 'del') {
    $link = mysqli_connect(HOST, USER_ID, PASSWORD, DB_NAME);
    mysqli_set_charset($link, 'utf8');
    mysqli_query(
        $link,
        "UPDATE m_book SET del_date='" . $delete_date . "' WHERE id='" . $del_id . "';"
    );
    session_start();
    $_SESSION['situation'] = '『' . $del_title . '』の削除が完了しました';


    header("Location: ./list.php");
}
// echo "UPDATE m_book SET del_date='" . $delete_date . "' WHERE id='" . $del_id . "';";
// echo date_default_timezone_get();

require_once './tpl/delete.php';
