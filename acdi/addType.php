<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
if(!empty($_GET)){
    $name = get("name");
    $mysql = mysqli_connect("localhost", "root", "528813", "blog");
    mysqli_set_charset($mysql, "utf8");
    $time = time();
    $sql = "INSERT news_type(name,create_time,update_time) values('{$name}',{$time},{$time})";
    $re = mysqli_query($mysql, $sql);
    if($re){
        header("location:typeList.php");
    }else{
        echo "<script>alert('添加失败')</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>添加新闻类型</title>
<link rel="stylesheet" href="../css/houtai.css"/>
</head>
<body>
<div class="top">
    <h1>博客后台管理系统</h1>
</div>
<div class="main clear">
    <div class="left">
        <ul>
            <li>
                <a href="#">文章管理</a>
                <ul>
                    <li><a href="addNews.php">发布文章</a></li>
                    <li><a href="newsList.php">文章列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#">类型管理</a>
                <ul>
                    <li><a href="addType.php">添加类型</a></li>
                    <li><a href="typeList.php">类型列表</a></li>
                    <li><a href="typeList_y.php">类型列表（异步）</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="right">
        <form action="" method="get">
            <div><span>类型名称</span><input type="text" name="name"></div>
            <input type="submit" value="添加">
        </form>
    </div>
    </div>
</body>
</html>