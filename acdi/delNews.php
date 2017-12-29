<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$id = get('id');
$action = get('action');
if(empty($id)||empty($action)|!in_array($action, array('del','rel'))){
    echo "<script>alert('参数异常');window.location.href='newsList.php';</script>";
}else {
    $mysql = mysqli_connect("localhost", "root", "528813", "blog");
    mysqli_set_charset($mysql, "utf8");
    if($action =='del'){
        $sql = "UPDATE news SET status = 0 WHERE newsid = {$id};";
    }elseif ($action == 'rel'){
        $sql = "UPDATE news SET status = 1 WHERE newsid = {$id};";
    }
    $re = mysqli_query($mysql, $sql);
    if($re){
        header("location:newsList.php");
        var_dump($re);
    }else{
        echo "<script>alert('操作失败');window.location.href='newsList.php';</script>";
    }
}
?>