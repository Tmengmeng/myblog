<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>个人博客管理</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="css/blogManage.css"/>

</head>
<body>
<div class="outer">
    <div class="header">
        <div class="text">
            <h2>个人博客管理</h2>
        </div>
    </div>
    <div class="main">
        <div class="left">
            <ul class="artical-list">
                <li class="cur">添加文章</li>
                <li>修改文章</li>
                <li>删除文章</li>
            </ul>
        </div>
        <div class="right">
            <div class="til">
                    <label>文章所属：</label>
                    <select name="type" id="type">
                        <option value="1">news</option>
                        <option value="2">hottips</option>
                        <option value="3">journey</option>
                        <option value="4">sentence</option>
                        <option value="5">seo</option>
                        <option value="6">web</option>
                    </select>
            </div>
            <form action="opphp/add.php" method="post" class="addf cur">
                
                <ul class="add cur">
                    <li>
                        <label>文章标题：</label>
                        <input type="text" name="title"/>
                    </li>
                    <li>
                        <label>文章作者：</label>
                        <input type="text" name="author"/>
                    </li>
                    <li>
                        <label>发布时间：</label>
                        <input type="date" name="date"/>
                    </li>
                    <li>
                        <label>文章分类：</label>
                        <select name="classfiy">
                            <option>web前端</option>
                            <option>php基础</option>
                            <option>html+css</option>
                            <option>游戏</option>
                            <option>seo优化</option>
                            <option>mysql</option>
                        </select>
                    </li>
                    <li class="content">
                        <label>文章摘要：</label>
                        <textarea rows="10" cols="50" name="content"></textarea>
                    </li>
                    <li>
                        <label>图像文件：</label>
                        <input type="text" name="date"/>
                    </li>
                    <li>
                        <input type="submit" value="提交">
                    </li>
                    
                
                </ul>
            </form>
            <form action="opphp/addhottips.php" method="post" class="addf">
                <ul class="add">
                    <li class="content">
                        <label>新增内容：</label>
                        <textarea rows="10" cols="50" name="content"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="提交">
                    </li>
                </ul>
            </form>
            <form action="opphp/addjourney.php" method="post" class="addf">
                <ul class="add">
                    <li class="content">
                        <label>新增历程：</label>
                        <textarea rows="10" cols="50" name="content"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="提交">
                    </li>
                </ul>
            </form>
            <form action="opphp/addsentence.php" method="post" class="addf">
                <ul class="add">
                    <li class="content">
                        <label>每日一语：</label>
                        <textarea rows="10" cols="50" name="content"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="提交">
                    </li>
                </ul>
            </form>
            <form action="opphp/addseo.php" method="post" class="addf">
                <ul class="add">
                    <li class="content">
                        <label>新增seo：</label>
                        <textarea rows="10" cols="50" name="content"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="提交">
                    </li>
                </ul>
            </form>
            <form action="opphp/addweb.php" method="post" class="addf">
                <ul class="add">
                    <li class="content">
                        <label>新增web：</label>
                        <textarea rows="10" cols="50" name="content"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="提交">
                    </li>
                </ul>
            </form>
            
            
        </div>
    </div>
</div>
<div class="footer">
        <p>Design by：萌萌是真的很萌</p>
</div>
<script type="text/javascript" src="js/manage.js"></script>
</body>
</html>