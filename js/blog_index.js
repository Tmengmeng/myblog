$().ready(function(){
	//文字移动
	$(".meng").show().animate({right:"100px"},1000);
	$(".descr").show().animate({left:"150px"},1000,function(){
		$(".tlp").show().animate({right:"150px"},1000);
	});
	//点击导航切换样式
	$(".n_ul li").click(function(){
		$(this).siblings().removeClass("cur");
		$(this).addClass("cur");
	});
	$(".n_ul li a").animate({top:"0px"},1000);
	//轮播图
	var timer = setInterval(function(){
/*		var curIndex=$(".big_pic li.cur").index();
		if(curIndex<$(".big_pic li").length-1){
			curIndex++;
		}else{
			console.log(curIndex);
			curIndex=0;
		}*/
		var curIndex = getCurIndex();
		autolunbo(curIndex);
		autoSlid(curIndex);
		$(".min_ul li").mouseover(function(){
			var index = $(this).index();
			console.log(index);
			clearInterval(timer);
			$(".big_pic li").eq(index).siblings().hide();
			$(".big_pic li").eq(index).addClass("cur").show();
			autoSlid(index);
		});
	},3000);
	
	//界面加载，让中间的块回到正常的位置
	$(".mine .left").show().animate({left:"0px"},500);
	$(".mine .right").show().animate({right:"0px"},500);
});
//获得下标
function getCurIndex(){
	var curIndex=$(".big_pic li.cur").index();
	if(curIndex<$(".big_pic li").length-1){
		curIndex++;
	}else{
		console.log(curIndex);
		curIndex=0;
	}
	return curIndex;
}
//切换图片
function autolunbo(num){
	$(".big_pic li").removeClass("cur").hide();
	$(".big_pic li").eq(num).fadeIn().addClass("cur");
}
window.onload=function(){
	//回到顶部
	var timer=null;
	var obtn =document.getElementById("btn");
	obtn.onclick=function(){
		timer = setInterval(function(){
			var osTop = document.documentElement.scrollTop || document.body.scrollTop;
			var ispeed = Math.floor(osTop /6);
			document.documentElement.scrollTop = document.body.scrollTop = osTop-ispeed;
			if(osTop == 0){
				clearInterval(timer);
			}
		},30);
	}
}
//切换小图的边框
function autoSlid(num){
	var newTop = 60*num;
	$(".slid").css("top",newTop+"px")
}
