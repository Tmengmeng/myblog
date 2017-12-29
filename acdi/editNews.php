<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$mysql = mysqli_connect("localhost", "root", "528813", "blog");
mysqli_set_charset($mysql, "utf8");
$id = get("id");
if(empty($id)){
    //参数错误就会返回类型列表的界面
    echo "<script>alert('参数异常');window.location.href='newsList.php'</script";
}else{
    $sql = "SELECT * FROM news WHERE newsId={$id} AND status=1";
    $re = mysqli_query($mysql, $sql);
    $data = mysqli_fetch_assoc($re);
    if(!$data){
        echo "<script>alert('未找到数据');window.loaction.href='newsList.php';</script>";
    }
    var_dump($data);
}
if(!empty($_POST)){
    $title= post("title");
    $id = post("id");
    $type = post("type");
    $author = post("author");
    $content = post("content");
    $date = post("date");
    $time = time();
    $sql = "UPDATE news SET title='{$title}',author='{$author}',type='{$type}',content='{$content}' WHERE newsId={$id};";
    $re = mysqli_query($mysql, $sql);
    if($re){
        header("location:newsList.php");
    }else{
        echo "<script>alert('操作失败');window.location.href='editNews.php?id='{$id}';</script>";
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
            <div><span>标题</span><input type="text" name="title" value="<?php echo $data["title"];?>"></div>
            <div><span>配图</span><input type="file" name="news_img"></div>
            <div class="box"><span>时间</span><input type="date" name="date"></div>
            <div><span>类型</span>
                <select name="type">
                    <?php 
                    $sql = "SELECT * FROM news_type";
                    $rety = mysqli_query($mysql, $sql);
                    $temp = array();
                    while ($data1 = mysqli_fetch_assoc($rety)){
                        $temp[] = $data1;
                    }
                    foreach ($temp as $v){
                    ?>
                    <option selected="selected"><?php echo $v["name"];?></option>
                    <?php }?>
                </select>
            </div>
            <div><span>作者</span><input type="text" name="author" value="<?php echo $data["author"]?>"></div>
            <div><span>内容</span>
            <textarea name="content" rows="5" cols="10" ><?php echo $data["content"]?></textarea>
            <input type="text" name="id" value="<?php echo $data['newsId'];?>">
            <input type="submit" value="编辑文章">
        </div>
        </form>
    </div>
</div>
</body>
</html>