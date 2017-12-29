/**
 * 
 */
$().ready(function(){
	console.log();
	$("#type").change(function(){
		var index = $("#type").val()-1;
		$(".addf:eq("+(index)+")").siblings().removeClass("cur");
		$(".addf:eq("+(index)+")").addClass("cur");
	});
});