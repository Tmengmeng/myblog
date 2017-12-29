<?php
include_once '../functions.php';
if(!empty($_GET)){
    $id = get('id');
    $mysql = mysqli_connect("localhost", 'root', '528813', 'blog');
    mysqli_set_charset($mysql, 'utf8');
    $time = time();
    $sql = "SELECT * FROM news_type WHERE tid={$id}";
    $re = mysqli_query($mysql, $sql);
    $data = mysqli_fetch_assoc($re);
    if($data){
        echo $data['name'];
    }else{
        echo 'no data';
    }
}