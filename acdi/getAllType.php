<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$mysql = mysqli_connect("localhost", "root", "528813","blog");
mysqli_set_charset($mysql, "utf8");
$sql = "SELECT tid,name FROM news_type WHERE status=1";
$re = mysqli_query($mysql, $sql);
$type = array();
while ($data = mysqli_fetch_assoc($re)){
    $type[] = $data;
}
if(!empty($type)){
    //将从数据库中读出的数据转化成json对象
    echo json_encode(array("status"=>1,"value"=>$type,"msg"=>'ok'));
}else{
    echo json_encode(array("status"=>-1,"value"=>"","msg"=>'no data'));
}
?>