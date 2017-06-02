$(document).ready(function(e) {


	if($(".Con").find('img.aligncenter').attr('src')!=''){
		//alert($("#Singles").find('img.aligncenter').attr('src'));
		$(".Con").find('img.aligncenter').parent().addClass('aligncenter');
	}
	
	$("#searchform").submit(function(){
		if($("#s").val()==""){
			//alert("请输入搜索内容");
			$("#s").focus();
			return false;
		}
	})
	
	$("#Menu").find('li').first().addClass('first');
	$("#Menu").find('li').last().addClass('last');
	
	$(".the_hover img").hover(function(){$(this).fadeTo(250, 0.6);},function(){$(this).fadeTo(250, 1);});
    
	gotoTop();
});



// Goto top function
function gotoTop() {
	var topBtn = jQuery("#to_top");
	jQuery(window).scroll(function() {
		var gotoTop = jQuery(this).scrollTop();		
		if(gotoTop > 100) {
			jQuery(topBtn).fadeIn("500");
		} else {
			jQuery(topBtn).fadeOut("500");
		}
	});
	topBtn.live("click", function() {
		jQuery("body, html").animate({
			scrollTop: 0
		}, 300);
		return false;
	});
}


jQuery(document).ready(function($){
 //===================================存档页面 jQ伸缩
     (function(){
         $('#al_expand_collapse,#archives span.al_mon').css({cursor:"s-resize"});
         $('#archives span.al_mon').each(function(){
             var num=$(this).next().children('li').size();
             var text=$(this).text();
             $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
         });
         var $al_post_list=$('#archives ul.al_post_list'),
             $al_post_list_f=$('#archives ul.al_post_list:first');
         $al_post_list.hide(1,function(){
             $al_post_list_f.show();
         });
         $('#archives span.al_mon').click(function(){
             $(this).next().slideToggle(400);
             return false;
         });
         $('#al_expand_collapse').toggle(function(){
             $al_post_list.show();
         },function(){
             $al_post_list.hide();
         });
     })();
 });