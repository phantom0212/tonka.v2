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
    $("#to_top").click(function () {
        $("body,html").animate({
            scrollTop: 0
        }, "normal");
        $("#page").animate({
            scrollTop: 0
        }, "normal");
        return !1
    })

})


$(document).ready(function() {
	// Configure/customize these variables.
	var showChar = 172;  // How many characters are shown by default
	var ellipsestext = "...";
	var moretext = "Xem đầy đủ";
	var lesstext = "Thu gọn";

	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});

});
$(document).ready(function () {
	var url = window.location.href;
	$('.menu_web > li').each(function () {
		if($(this).children('a').attr('href') === url){
			$(this).addClass('active');
		}
	});
});
