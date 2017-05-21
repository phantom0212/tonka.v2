// JavaScript Document

$(function(){
	$('#box_video .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,		
		pagination:true,
		itemWidth: 200,
		itemMargin: 20
	});
	$('#box_slider_banner .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,		
		pagination:true
	});
	$('#box_tinxemnhieu_folder .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,		
		pagination:true,
		itemWidth: 200,
		itemMargin: 20
	});
	$('#box_video_khac .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,		
		pagination:true,
		itemWidth: 200,
		itemMargin: 20
	});
	$('.hamber').click(function(){
		
		if($('.block_menu').css('display') == 'none'){
			$(this).addClass('active');
			$('.block_menu').slideDown();
		}
		else{
			$('.block_menu').slideUp();
			$('.hamber').removeClass('active');
		}
	});
	
})
