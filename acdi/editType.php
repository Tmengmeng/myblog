<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$mysql = mysqli_connect("localhost", "root", "528813", "testblog");
mysqli_set_charset($mysql, "utf8");
$id = get("id");
if(empty($id)){
    //参数错误就会返回类型列表的界面
    echo "<script>alert('参数异常');window.location.href='typeList.php'</script";
}else{
    $sql = "SELECT * FROM news_type WHERE tid={$id} AND status=1";
    $re = mysqli_query($mysql, $sql);
    $data = mysqli_fetch_assoc($re);
    if(!$data){
        echo "<script>alert('未找到数据');window.loaction.href='typeList.php';</script>";
    }
}
if(!empty($_POST)){
    $name = post("name");
    $tid = post("id");
    $time = time();
    $sql = "UPDATE news_type SET name='{$name}',update_time='{$time}' WHERE tid={$tid};";
    $re = mysqli_query($mysql, $sql);
    if($re){
        header("location:typeList.php");
    }else{
        echo "<script>alert('操作失败');window.location.href='editType.php?id='{$tid}';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>发布新闻</title>
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
        <form action="" method="post">
            <div><span>类型名称</span>
                <input type="text" name="name" value="<?php echo $data['name'];?>">
                <input type="hidden" name="id" value="<?php echo $data['tid'];?>">
            </div>
            <input type="submit" value="编辑">
        </div>
        </form>
    </div>
</div>
</body>
</html>