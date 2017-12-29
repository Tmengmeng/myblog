<?php
header("content-type:text/html;charset=utf-8");
include_once '../functions.php';
$mysql = mysqli_connect("localhost", "root", "528813", "blog");
mysqli_set_charset($mysql, "utf8");
$sql = "SELECT * FROM news";
$re = mysqli_query($mysql, $sql);
$news = array();
while ($data = mysqli_fetch_assoc($re)){
    $news[] = $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>新闻列表</title>
<link rel="stylesheet" href="../css/houtai.css"/>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
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
        <table border="1" cellspacing="0" cellpadding="0" width="1120">
            <tr align="center">
                <td>ID</td>
                <td>标题</td>
                <td>类型</td>
                <td>配图</td>
                <td>作者</td>
                <td>内容</td>
                <td>操作</td>
            </tr>
            <?php foreach ($news as $v){?>
            <tr align="center">
                <td><?php echo $v['newsId']?></td>
                <td><?php echo $v['title']?></td>
                <td><?php echo $v['type']?></td>
                <td><?php echo $v['img']?></td>
                <td><?php echo $v['author']?></td>
                <td><?php echo $v['content']?></td>
                <td>
                    <?php if($v['status']==1){?>
                    <a href="editNews.php?id=<?php echo $v['newsId'];?>">编辑</a>丨
                    <a href="javascript:;" class="dele" id="<?php echo $v['newsId'];?>">删除</a>
                    <?php }else{?>
                    <a href="javascript:;" class="rel" id="<?php echo $v['newsId'];?>">恢复</a>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
    </div>
<script type="text/javascript">
$().ready(function(){
	$(".dele").click(function(){
		 $.ajax({
			async:false,
		    url:"delNews.php?action=del&id="+$(this).attr("id"),
		    data:'',
		    dataType:'json',
		    type:'post',
		    success:function(e){
		    	if(e.status ==1){
			    	alert("删除成功");
			    	
			    	}else{
				    	alert(e.msg);
				    	}
			    }
			});
			window.location.reload(true);
		});
	$(".rel").click(function(){
		 $.ajax({
			async:false,
		    url:"delNews.php?action=rel&id="+$(this).attr("id"),
		    data:'',
		    dataType:'json',
		    type:'post',
		    success:function(e){
		    	if(e.status ==1){
			    	var data = e.value;
			    	$.each(data,function(i){
				    	});
			    	}else{
				    	alert(e.msg);
				    	}
			    }
			});
			
		 window.location.reload(true);
		});
}); 
</script>
</body>
</html>