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
	
});
var showChar = 172;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Xem đầy đủ";
    var lesstext = "Thu gọn";

	var i = 1 ; 
    $('.moredata').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses moreellipses_'+i+'">' + ellipsestext+ '</span><span class="morecontent morecontent_'+i+'" style="display:none">' + h + '</span></span><span data_id="'+i+'" style="cursor:pointer" class="morelink morelink_'+i+'">' + moretext + '</span>';

            $(this).html(html);
        }
		i++ ; 
    });

    $(".morelink").on( 'click' ,function(){
		console.log(123);
		var id  = $(this).attr('data_id');
        $('.moreellipses_'+id).hide();
		$('.morecontent_' + id ).show();
		$('.morelink_' + id ).hide();
    });

$(function(){
    $(window).scroll(function(){if($(this).scrollTop()!=0){$('#bttop').fadeIn();}else{$('#bttop').fadeOut();}});
    $('#bttop').click(function(){$('body,html').animate({scrollTop:0},800);});});
