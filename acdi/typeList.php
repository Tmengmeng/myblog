<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
//当前页码
$page = get("page");
$page =!empty($page) ? $page:1;
//我每页要显示的记录数
$page_num = 5;
$mysql = mysqli_connect("localhost", "root", "528813", "blog");
mysqli_set_charset($mysql, "utf8");

$count_sql = "SELECT COUNT(*) AS count_num FROM news_type";
$re = mysqli_query($mysql, $count_sql);
$count_data = mysqli_fetch_assoc($re);
$count_num = $count_data["count_num"];
var_dump($count_num);
$page_string = fenye($page, $page_num, $count_num);

$start = ($page - 1)*$page_num;
$length = $page_num;



$sql = "SELECT * FROM news_type limit $start,$length";
$re = mysqli_query($mysql, $sql);
$type = array();
while ($data = mysqli_fetch_assoc($re)){
    $type[] = $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>新闻列表</title>
<link rel="stylesheet" href="../css/houtai.css"/>
<style>
.numa{
    width:20px;
    height:20px;
    display: inline-block;
    border:1px solid black;
	text-align: center;
	line-height: 20px;
}
.numa.active{
	background-color: #438EB9;
}
</style>
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
        <table border="1" cellspacing="0" cellpadding="0" width="600">
            <tr align="center">
                <td>ID</td>
                <td>名称</td>
                <td>创建时间</td>
                <td>修改时间</td>
                <td>操作</td>
            </tr>
            <?php foreach ($type as $v){?>
            <tr align="center">
                <td><?php echo $v['tid']?></td>
                <td><?php echo $v['name']?></td>
                <td><?php echo $v['create_time']?></td>
                <td><?php echo $v['update_time']?></td>
                <td>
                    <?php if($v['status']==1){?>
                    <a href="editType.php?id=<?php echo $v['tid'];?>">编辑</a>丨
                    <a href="delType.php?action=del&id=<?php echo $v['tid'];?>">删除</a>
                    <?php }else{?>
                    <a href="delType.php?action=rel&id=<?php echo $v['tid']?>">恢复</a>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
            <tr>
                <td colspan="5">
                    <?php echo $page_string;?>
                </td>
            </tr> 
        </table>
    </div>
    </div>
</body>
</html>