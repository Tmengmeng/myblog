<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>新闻列表</title>
<link rel="stylesheet" href="../css/houtai.css"/>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
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
        <table border="1" cellspacing="0" cellpadding="0" width="600" id="table">
            <tr align="center">
                <td>ID</td>
                <td>名称</td>
                <td>创建时间</td>
                <td>修改时间</td>
                <td>操作</td>
            </tr>
        </table>
    </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(e){
        $.ajax({
           url:"yibuchuli.php?page=1",
           data:"",
           type:"post",
           dataType:"json",
           success:function(e){
               var data = e.value;
               $.each(data,function(i){
           	    $("#table").append("<tr align='center'><td>"+data[i].tid+"</td><td>"+data[i].name+"</td><td>"+data[i].create_time+"</td><td>"+data[i].update_time+"</td></tr>");
                   });
               $("#table").append("<tr align='center'><td colspan='5'>"+e.bar+"</td></tr>");
               }
           });
        $(".numa").live("click",function(){
        	var goIndex = $(this).attr("name");
            console.log(goIndex);
            $.ajax({
                url:"yibuchuli.php?page="+goIndex,
                data:"",
                type:"post",
                dataType:"json",
                success:function(e){
                    $("#table tr:gt(0)").empty();
                    var data = e.value;
                    $.each(data,function(i){
                    	$("#table").append("<tr align='center'><td>"+data[i].tid+"</td><td>"+data[i].name+"</td><td>"+data[i].create_time+"</td><td>"+data[i].update_time+"</td></tr>");
                        });
                    $("#table").append("<tr align='center'><td colspan='5'>"+e.bar+"</td></tr>");
                    }
                });
            });
        $("#first_page").live("click",function(){
        	$.ajax({
                url:"yibuchuli.php?page="+$(this).attr("name"),
                data:"",
                type:"post",
                dataType:"json",
                success:function(e){
                    $("#table tr:gt(0)").empty();
                    var data = e.value;
                    $.each(data,function(i){
                    	$("#table").append("<tr align='center'><td>"+data[i].tid+"</td><td>"+data[i].name+"</td><td>"+data[i].create_time+"</td><td>"+data[i].update_time+"</td></tr>");
                        });
                    $("#table").append("<tr align='center'><td colspan='5'>"+e.bar+"</td></tr>");
                    }
                });
            });
        $("#end_page").live("click",function(){
        	$.ajax({
                url:"yibuchuli.php?page="+$(this).attr("name"),
                data:"",
                type:"post",
                dataType:"json",
                success:function(e){
                    $("#table tr:gt(0)").empty();
                    var data = e.value;
                    $.each(data,function(i){
                    	$("#table").append("<tr align='center'><td>"+data[i].tid+"</td><td>"+data[i].name+"</td><td>"+data[i].create_time+"</td><td>"+data[i].update_time+"</td></tr>");
                        });
                    $("#table").append("<tr align='center'><td colspan='5'>"+e.bar+"</td></tr>");
                    }
                });
            });
        $("#prev_page").live("click",function(){
            var curIndex = $(".active").attr("name");
            curIndex = curIndex > 1 ? curIndex - 1 : 1;
        	$.ajax({
                url:"yibuchuli.php?page="+curIndex,
                data:"",
                type:"post",
                dataType:"json",
                success:function(e){
                    $("#table tr:gt(0)").empty();
                    var data = e.value;
                    $.each(data,function(i){
                    	$("#table").append("<tr align='center'><td>"+data[i].tid+"</td><td>"+data[i].name+"</td><td>"+data[i].create_time+"</td><td>"+data[i].update_time+"</td></tr>");
                        });
                    $("#table").append("<tr align='center'><td colspan='5'>"+e.bar+"</td></tr>");
                    }
                });
            });
        $("#next_page").live("click",function(){
            var index = $("#end_page").attr("name");
        	var cur = $(".active").attr("name");
            cur = cur < index ? parseInt(cur) + 1 : cur;
        	$.ajax({
                url:"yibuchuli.php?page="+cur,
                data:"",
                type:"post",
                dataType:"json",
                success:function(e){
                    $("#table tr:gt(0)").empty();
                    var data = e.value;
                    $.each(data,function(i){
                    	$("#table").append("<tr align='center'><td>"+data[i].tid+"</td><td>"+data[i].name+"</td><td>"+data[i].create_time+"</td><td>"+data[i].update_time+"</td></tr>");
                        });
                    $("#table").append("<tr align='center'><td colspan='5'>"+e.bar+"</td></tr>");
                    }
                });
            });
        
        });
    </script>
</body>
</html>