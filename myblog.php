<?php
header("content-type:text/html;charset=utf-8");
include_once 'functions.php';
$mysql = mysqli_connect('localhost', 'root', '', 'blog');
mysqli_set_charset($mysql, 'utf8');
//从数据库中读取每日一语
$sql = "select * from sententce as s where s.sentenceId=1";
$re = mysqli_query($mysql, $sql);
$temp_sentence = array();
while($data = mysqli_fetch_assoc($re)){
    $temp_sentence[] = $data;
}
//从数据库中读取文章信息
$sqlnews = "select * from news";
$renews = mysqli_query($mysql, $sqlnews);
$temp_news = array();
while ($data_news = mysqli_fetch_assoc($renews)){
    $temp_news[] = $data_news;
}
//从数据库中读取热门推荐的信息
$sqlhot = "select * from hottips";
$rehot = mysqli_query($mysql, $sqlhot);
$temp_hot = array();
while ($data_hot = mysqli_fetch_assoc($rehot)){
    $temp_hot[] = $data_hot;
}
//从数据库中读出历程
$sqljo = "select * from journey";
$rejo = mysqli_query($mysql, $sqljo);
$temp_jo = array();
while ($data_jo = mysqli_fetch_assoc($rejo)){
    $temp_jo[] = $data_jo;
}
//从web表中读取
$sqlwe = "select * from web";
$rewe = mysqli_query($mysql, $sqlwe);
$temp_we = array();
while ($data_we = mysqli_fetch_assoc($rewe)){
    $temp_we[] = $data_we;
}
//从seo表中读取
$sqlse = "select * from seo";
$rese = mysqli_query($mysql, $sqlse);
$temp_se = array();
while ($data_se = mysqli_fetch_assoc($rese)){
    $temp_se[] = $data_se;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>萌萌是真的很萌的博客</title>
<link rel="stylesheet" href="css/blog_index.css"/>
<link rel="stylesheet" href="css/comm.css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
</head>
<body>
<div class="outer">
    <div class="header">
        <div class="head">
            <div class="h_text">
                <p class="meng"></p>
                <p class="descr">言兮枣擅长辅助，喜欢36d</p>
                <p class="tlp">——by tlp</p>
            </div>
        </div>
    </div>
    <div class="main">
    <div class="nav">
        <ul class="n_ul">
            <li class="cur"><a href="myblog.php">首页</a></li>
            <li><a href="javascript:;">游戏人生</a></li>
            <li><a href="javascript:;">程序人生</a></li>
            <li><a href="javascript:;">个人日记</a></li>
            <li><a href="aboutme.html">关于言兮枣</a></li>
            <li><a href="leaveAnote.html">留言板</a></li>
        </ul>
    </div>
    <div class="lunbo">
        <div class="left">
            <div class="big_pic">
                <ul class="big_ul">
                    <li class="cur"><a href="javascript:;"><img src="img/s-banner1.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-banner2.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-banner3.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-banner4.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-banner5.png"/></a></li>
                </ul>
            </div>
            <div class="min_pic">
                <ul class="min_ul">
                    <li class="cur"><a href="javascript:;"><img src="img/s-b1.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-b2.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-b3.png" style="width:100%;"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-b4.png"/></a></li>
                    <li><a href="javascript:;"><img src="img/s-b5.png"/></a></li>
                </ul>
                <div class="slid"></div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="sentence">
            <p class="sen_title">每日一语</p>
            <p class="sen_title juzi"><?php echo $temp_sentence[0]["content"];?></p>
        </div>
        <div class="con">
            <div class="con_left">
                <p class="p hotp">文章推荐<span class="span-1"></span><span class="span-2"></span></p>
                <ul class="list">
                    <?php $length = mysqli_num_rows($renews)-1;
                    for ($i = $length;$i>$length - 8;$i--){?>
                    <li class="li-text">
                        <div class="img-box" style="width:150px;height:142px;float:left;"><a href="javascript:;"><img alt="" src="img/<?php echo $temp_news[$i]["img"];?>"/></a></div>
                        <div class="news-content">
                            <a class="news-title" href="#"><?php echo $temp_news[$i]["title"];?></a>
                            <div class="news-author">
                                <span class="span">作者：<?php echo $temp_news[$i]["author"];?></span>
                                <span class="span">发布时间：<?php echo $temp_news[$i]["publish_time"];?> </span>
                                <span class="span">分类：<?php echo $temp_news[$i]["type"];?></span>
                            </div>
                            <div class="news-text">
                                <p><?php echo $temp_news[$i]["content"];?></p>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="con_right">
                <p class="p" style="margin-top:0px;">热门推荐</p>
                <div class="hot-tips">
                    <ol class="hot-list" type="1">
                        <span class="minhot-1"></span>
                        <span class="minhot-2"></span>
                        <span class="minhot-3"></span>
                        <?php $length = mysqli_num_rows($rehot)-1;
                        for ($i = $length;$i>$length - 6;$i--){?>
                        <li><a href="#"><?php echo $temp_hot[$i]["content"];?></a></li>
                        <?php }?>
                    </ol>
                </div>
                
                
                <p class="p">WEB前端</p>
                <ol class="web" type="1">
                        <span class="webhot-1"></span>
                        <span class="webhot-2"></span>
                        <span class="webhot-3"></span>
                        <?php $length = mysqli_num_rows($rewe)-1;
                        for ($i = $length;$i>$length - 6;$i--){?>
                        <li><a href="#"><?php echo $temp_we[$i]["content"];?></a></li>
                        <?php }?>
                </ol>
                <p class="p" type="1">SEO优化</p>
                <ol class="seo">
                        <span class="seohot-1"></span>
                        <span class="seohot-2"></span>
                        <span class="seohot-3"></span>
                    <?php $length = mysqli_num_rows($rese)-1;
                        for ($i = $length;$i>$length - 6;$i--){?>
                        <li><a href="#"><?php echo $temp_se[$i]["content"];?></a></li>
                        <?php }?>
                </ol>
                <p class="p">一路走来</p>
                <ul class="walk">
                    <?php $length = mysqli_num_rows($rejo)-1;
                        for ($i = $length;$i>$length - 5;$i--){?>
                    <li>
                        <span class="w-time"><?php echo $temp_jo[$i]["date"];?></span>
                        <span class="w-text"><?php echo $temp_jo[$i]["content"];?></span>
                    </li>
                    <?php }?>
                </ul>
                <p class="p">关注博客</p>
                <ul class="guanzhu">
                    <li><span>邮箱订阅：</span><a href="javascript:;" class="a-1">订阅到邮箱</a></li>
                    <li><span>联系萌萌：</span><a href="javascript:;" class="a-2">在线交谈</a></li>
                    <li><span>加入群聊：</span><a href="javascript:;" class="a-3">加入群聊</a></li>
                    <li><span>关注微博：</span><a href="javascript:;" class="a-4">加关注</a></li>
                </ul>
            </div>
        </div>
        
    </div>
    <a class="top" href="javascript:;" id="btn"></a>
    <div class="lianjie">
        <a href="http://lpl.qq.com/">英雄联盟官方网站</a>
        <a href="http://bbs.ngacn.cc/">NGA玩家社区</a>
        <a href="http://bbs.ngacn.cc/thread.php?fid=-202020&rand=3">一只IT喵的自我修养</a>
        <a href="javacript:;">叫璐璐的小仙女</a>
        <a href="javacript:;">近未来</a>
        <a href="http://miaoxiaoer.com/index.html">绘画爱好者</a>
    </div>
    <div class="footer">
        <p>Design by：言兮枣</p>
    </div>
    </div>
</div>
<script type="text/javascript" src="js/blog_index.js"></script>
</body>
</html>