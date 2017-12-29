<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions1.php';

$page = get("page");
$page_num = 5;

$mysql = mysqli_connect("localhost", "root", "528813","blog");
mysqli_set_charset($mysql, "utf8");
$count_sql = "SELECT COUNT(*) AS count_num FROM news_type";
$re = mysqli_query($mysql, $count_sql);
$count_data = mysqli_fetch_assoc($re);
$count_num = $count_data["count_num"];
$page_string = fenye($page, $page_num, $count_num);

$start = ($page - 1)*$page_num;
$length = $page_num;
$sql = "SELECT * FROM news_type limit $start,$length";
$re = mysqli_query($mysql, $sql);
$type = array();
while ($data = mysqli_fetch_assoc($re)){
    $type[] = $data;
}
if(!empty($type)){
    //将从数据库中读出的数据转化成json对象
    echo json_encode(array("value"=>$type,"bar"=>$page_string));
}else{
    echo json_encode(array("value"=>"","bar"=>'no data'));
}
?>