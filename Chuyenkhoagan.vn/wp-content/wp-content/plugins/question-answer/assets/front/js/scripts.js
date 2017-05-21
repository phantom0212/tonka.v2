jQuery(document).ready(function($) {
	
	
	
	
	
	
	
	
	
	$(document).on('click', ".qa-polls li", function() {
		
		data_id = $(this).attr('data-id');
		q_id = $(this).attr('q_id');		
		$('.qa-polls li').removeClass('active');
		
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			}
		else{
			$(this).addClass('active');
			}
		//alert(data_id);
		$('.poll-result').fadeIn();
		$('.poll-result .loading').fadeIn();
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"		: "qa_ajax_poll", 
			"data_id"	: data_id,
			"q_id"	: q_id,			

		},
		success: function(data) {
				
						var response 		= JSON.parse(data)
						var html 	= response['html'];	
						var error 	= response['error'];								
				
				
					$('.poll-result .results').html(html);
					$('.poll-result .loading').fadeOut();
					
					if ( error ) {
						$('.toast').text(error);
						$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
						return;
					} 
					
					
					
				}
			});
		
		
		
		
		
		})	
	
	
	
	
	
	
	
	$(document).on('keyup', ".question-submit #post_title", function() {
		

		$(this).attr('autocomplete','off');
		title = $(this).val();
		$('.suggestion-title, .loading').fadeIn();
		
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"		: "qa_ajax_question_suggestion", 
			"title"	: title,

		},
		success: function(data) {
				
					$('.suggestions-list').html(data);
					$('.loading').fadeOut();
				}
			});
		
		
		})
	
	
	
	
	
	
	

	
	
	$(".qa_question_status .question_status").change(function() {
		
		QuestionID = $('.qa_question_status .question_status').attr('question_id');
		SelectedOption = this.value;
		
		if( QuestionID.length < 1 || SelectedOption.length < 1 ) return;
		$('html').css( 'opacity', '0.4' );
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"		: "qa_ajax_change_question_status", 
			"question_id"	: QuestionID,
			"selected"		: SelectedOption,
		},
		success: function(data) {
			
			if( data.length > 0 ) 
			window.location.href = data;			
		}
			});
		
	});
	
	
	$(document).on('click', '.notify-mark', function() {		
		
		var notify_id = $(this).attr('notify_id');
		//alert(notify_id);
		// return;
		
		bubble_count = parseInt($('.bubble').text());
		
		
		//alert(bubble_count);
		
		if(bubble_count==0){
			$('.bubble').fadeOut();
			}
		
		
		//alert(bubble_count);
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_ajax_notify_mark", 
			"notify_id"	: notify_id,
		},
		success: function(data) {
			
			//alert(data);
			
			var response = JSON.parse(data)
			
			status = response['status'];
			icon = response['icon'];			
			
			if(status=='read'){
				
				//$(this).parent().fadeOut();
				
				bubble_count = (bubble_count-1);
				$('.bubble').text(bubble_count);
				$(this).html(icon);
				}
			else if(status=='unread'){
				$(this).html(icon);
				
				bubble_count = (bubble_count+1);
				$('.bubble').text(bubble_count);
				
				}
			
			//alert(status);
		
			
			//$('.toast').html( response['toast'] );
			//$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
		
			}
		});
	})	

	$(document).on('click', '.qa-best-answer', function() {		
		
		$(this).find( 'i' ).addClass('fa-spin');
		
		var answer_id = $(this).attr('answer_id');
		
		// return;
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_ajax_best_answer", 
			"answer_id"	: answer_id,
		},
		success: function(data) {
			
			var response = JSON.parse(data)
			
			$(this).find( 'i' ).removeClass('fa-spin');
			$('body').find( '.best_answer' ).removeClass('best_answer');
			$('.all-single-answer').find( '.single-answer' ).removeClass('list_best_answer');
	
			if( response['status'] == 'updated' ) {
			
				$(this).addClass('best_answer');
				$( '#single-answer-' + answer_id ).addClass('list_best_answer');
			}
			$('.toast').html( response['toast'] );
			$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
		
		}
			});
	})	
	
	$(document).on('click', '.qa-featured', function() {		
		
		_HTML = $(this).html();
		$(this).html( '<i class="fa fa-star fa-spin"></i>' );
		
		var post_id = $(this).attr('post_id');
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_ajax_featured_switch", 
			"post_id"	: post_id,
		},
		success: function(data) {
			
			var response = JSON.parse(data)
			
			
			if( $(this).hasClass('qa-featured-yes') ) {
				
				$(this).removeClass('qa-featured-yes');
				$(this).addClass( response['featured_class'] );
				
			}
			
			if( $(this).hasClass('qa-featured-no') ) {
			
				$(this).removeClass('qa-featured-no');
				$(this).addClass( response['featured_class'] );
				
			}

			$(this).html(_HTML);
			
			$('.toast').html( response['toast'] );
			$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
		}
			});
	})	
	
	
	
	$(document).on('click', '.qa-breadcrumb .bubble ', function() {		
		
		if($(this).hasClass('pending')){
			$(this).removeClass('pending');
			$(this).addClass('hide');			
			
			
			}
		
		
	})	
	
	
	
	
	$(document).on('change', '.qa_sort_answer', function() {		
		$('#qa_sort_answer_form').submit();
	})
	
	$(document).on('click', '.qa_load_more', function() {
		
		var _paged 		= $(this).attr('_paged');
		var _answer_id 	= $(this).attr('_answer_id');
		var _HTML 		= $(this).html();
		
		$(this).html('<i class="fa fa-asterisk fa-spin"></i>');
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_ajax_load_more_answer", 
			"_paged"	: _paged,
			"_answer_id": _answer_id,
		},
		success: function(data) {
			
			if( data.length > 0 ) {
				
				_paged++;
				$('.all-single-answer').append(data);
				$(this).attr( '_paged', _paged );
				
				var div_pos		= _paged + 1;
				var answer_id 	= $('.single-answer:nth-child('+div_pos+')').attr('id');
				
				$('html, body').animate({
					scrollTop: $("#"+answer_id).offset().top
				}, 2000);
			
			}
			$(this).html(_HTML);
		}
			});
		

	})
	
	
	
	$(document).on('click', '.qa-add-comment', function() {

		$(this).fadeOut();
		$('.qa-comment-form').fadeIn();
		$('.qa-cancel-comment').fadeIn();

	})

	$(document).on('click', '.qa-cancel-comment', function() {

		$(this).fadeOut();
		$('.qa-comment-form').fadeOut();
		$('.qa-add-comment').fadeIn();

	})
	
	$(document).on('click', '.qa_answer_voted ', function() {

		$( ".all-single-answer .single-answer" ).each(function( index ) {
			
			if( !$(this).hasClass('reviewd') ) $(this).fadeOut();
			
		});

	})
	
	$(document).on('click', '.qa_answer_all ', function() {

		$( ".all-single-answer .single-answer" ).each(function( index ) {
			
			$(this).fadeIn();
			
		});

	})
		
	$(document).on('click', '.qa-comment-action', function() {

		var _status 	= $(this).attr('status');
		if( _status 	== 0 ) return;
		
		var comment_id 	= $(this).attr('comment_id');
		var user_id 	= $(this).attr('user_id');
		var action 		= $(this).attr('action');

		$(this).html('<i class="fa fa-cog red fa-spin"></i>');
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_do_comment_flag_action", 
			"act"		: action,
			"comment_id": comment_id,
			"user_id"	: user_id
		},
		success: function(data) {
			
			if( action == 'flag' ) $(this).attr('action','unflag');
			if( action == 'unflag' ) $(this).attr('action','flag');
			
			$(this).html(data);
		
		}
			});
	})
	
	$(document).on('click', '.answer-post-header', function() {
		
		var _status = $(this).attr('_status');
		
		if( _status == 1 ) {
			$('.apost_header_status').removeClass('fa-compress');
			$('.apost_header_status').addClass('fa-expand');
			$('.answer-post form').fadeOut();
			$(this).attr('_status','0');
		} else {
			$('.apost_header_status').addClass('fa-compress');
			$('.apost_header_status').removeClass('fa-expand');
			$('.answer-post form').fadeIn();
			$(this).attr('_status','1');
		}

	})
	
	$(document).on('click', '.qa-answer-reply', function() {
		var post_id 	= $(this).attr('post_id');
		$('.qa-reply-popup-' + post_id ).fadeIn();
	})		
		
	$(document).on('click', '.qa-reply-popup .close', function() {
		
		$('.qa-reply-popup').fadeOut();
	})




	// is solved 	
	$(document).on('click', '.qa-subscribe', function() {
		
		var post_id 	= $(this).attr('post_id');
		var _HTML 		= $(this).html();
		$(this).html('<i class="fa fa-cog red fa-spin"></i>');		
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_subscribe_action", 
			"post_id"	: post_id,
		},
		success: function(data) {
			
			var html = JSON.parse(data)
			
			$(this).html( html['html'] );
						
			subscribe_class = html['subscribe_class'];
			//alert(is_solved);
			
			
			if(subscribe_class == 'not-subscribed'){
				$(this).removeClass('subscribed');
				$(this).addClass('not-subscribed');
		
				}
			else if(subscribe_class == 'subscribed'){
				
				$(this).removeClass('not-subscribed');
				$(this).addClass('subscribed');	

				}
				
				
			$('.toast').text( html['toast'] );
			$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
			
		}
			});
	})







	// is solved 	
	$(document).on('click', '.qa-is-solved', function() {
		
		var post_id 	= $(this).attr('post_id');
		var _HTML 		= $(this).html();
		$(this).html('<i class="fa fa-cog red fa-spin"></i>');		
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_is_solved_action", 
			"post_id"	: post_id,
		},
		success: function(data) {
			
			var html 	= JSON.parse(data)
			
			$(this).html( html['html'] );
						
			is_solved 	= html['is_solved'];
			qa_ttt 		= html['qa_ttt'];
			//alert(is_solved);
			
			$(this).parent().find('.qa_ttt').text(qa_ttt);
			
			// alert( qa_ttt );
			
			
			if(is_solved == 'solved'){
				$(this).removeClass('not-solved');
				$(this).addClass('solved');
			}
			else if(is_solved == 'not-solved'){
				
				$(this).removeClass('solved');
				$(this).addClass('not-solved');	
			}
				
				
			$('.toast').text( html['toast'] );
			$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
			
		}
			});
	})
	
	$(document).on('click', '.qa-reply-form-submit', function() {
		
		var post_id 	= $(this).attr('id');
		var reply_msg 	= $( '#qa-answer-reply-' +  post_id ).val();
		
		if( reply_msg.length === 0 ) {
			
			$(this).prev('textarea').css( 'border', '1px solid red');
			
			$('.toast').text('Empty data !');
			$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
			return;
		}
		
		
		var _HTML 		= $(this).html();
		$(this).html('<i class="fa fa-cog red fa-spin"></i>');		
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_answer_reply_action", 
			"post_id"	: post_id,
			"reply_msg"	: reply_msg
		},
		success: function(data) {
			
			$(this).prev('textarea').val('');
			
			$('.qa-reply-popup').fadeOut();
			$('.qa-answer-comment-reply-' + post_id).append( data );
			$(this).html(_HTML);
			
			
			
		}
			});
	})
		
	$(document).on('click', '.qa-thumb-down', function() {
		
		var post_id 	= $(this).attr('post_id');
		var _HTML 		= $(this).html();
		$(this).html('<i class="fa fa-cog fa-spin"></i>');		
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_answer_thumbsdown_action", 
			"post_id"	: post_id,
		},
		success: function(data) {
			$(this).html(_HTML);
			var response 		= JSON.parse(data)
			var review_value 	= response['review_value'];
			var error 			= response['error'];
			var status 			= response['status'];
			
			if ( error ) {
				$('.toast').text(error);
				$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
				return;
			} 
			$('.net-vote-count-' + post_id).text( review_value );			
			
			_ID = '#' + $(this).parent().parent().attr('id');
			
			
			$( _ID + ' .qa-thumb-up').removeClass('votted');
			$( _ID + ' .qa-thumb-down').removeClass('votted');
			
			( status == 'up' ) ? $( _ID + ' .qa-thumb-down').addClass('votted') : $( _ID + ' .qa-thumb-up').addClass('votted');
			
		}
			});
	})
		
	$(document).on('click', '.qa-thumb-up', function() {
		
		var post_id 	= $(this).attr('post_id');
		
		var _HTML 		= $(this).html();
		$(this).html('<i class="fa fa-cog fa-spin"></i>');		
		
		$.ajax(
			{
		type: 'POST',
		context: this,
		url:qa_ajax.qa_ajaxurl,
		data: {
			"action"	: "qa_answer_thumbsup_action", 
			"post_id"	: post_id,
		},
		success: function(data) {
			$(this).html(_HTML);
			var response 		= JSON.parse(data)
			var review_value 	= response['review_value'];
			var error 			= response['error'];
			var status 			= response['status'];
		
			if ( error ) {
				$('.toast').text(error);
				$('.toast').stop().fadeIn(400).delay(3000).fadeOut(400);
				return;
			} 
			$('.net-vote-count-' + post_id).text( review_value );			
			
			_ID = '#' + $(this).parent().parent().attr('id');
			
			$( _ID + ' .qa-thumb-up').removeClass('votted');
			$( _ID + ' .qa-thumb-down').removeClass('votted');
			
			
			( status == 'up' ) ?  $( _ID + ' .qa-thumb-down').addClass('votted') : $( _ID + ' .qa-thumb-up').addClass('votted');
			
			
			
			
		}
			});
	})

});	


