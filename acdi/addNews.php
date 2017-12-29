<?php 
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>发布新闻</title>
<link rel="stylesheet" href="../css/houtai.css"/>
<script src="../js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="top">
    <h1>博客后台管理系统</h1>
</div>
<div class="main clear">
    <div class="left">
        <ul class="menu-list">
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
        <div>
            <form action="" method="get">
                <span>文章类型：</span><select name="type">
                <option value="0">选择全部</option>
                <?php ?>
            </form>
        
        </div>
        
        </select>
        <form action="" method=get>
            <div class="box"><span>标题</span><input type="text" name="title"></div>
            <div class="box"><span>配图</span><input type="file" name="news_img"></div>
            <div class="box"><span>时间</span><input type="date" name="date"></div>
            <div class="box"><span>类型</span>
                <select name="type" id="type">
                </select>
            </div>
            <div class="box"><span>作者</span><input type="text" name="author"></div>
            <div class="box"><span>内容</span>
            <textarea name="content" rows="5" cols="10"></textarea>
            <input type="submit" value="立即发布">
        </div>
        </form>
    </div>
    <a href="javascript:;" onclick="fun1()">点击</a>
</div>
<script type="text/javascript">
function getAllType(){
	$.ajax({
	    url:"getAllType.php",
	    data:'',
	    dataType:'json',
	    type:'post',
	    success:function(e){
	    	if(e.status ==1){
		    	var data = e.value;
		    	$.each(data,function(i){
		    	    $("#type").append("<option value='"+data[i].tid+"'>"+data[i].name+"</option>");
			    	});
		    	}else{
			    	alert(e.msg);
			    	}
		    }
		});
}
$().ready(function(){
	getAllType();
});
</script>
</body>
</html>