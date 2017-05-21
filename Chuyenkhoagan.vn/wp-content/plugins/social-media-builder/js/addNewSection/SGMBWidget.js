var $ = jQuery;
function SGMBWidget() {
	var that = this;
	this.media = '';
	this.options = {
		_getShareUrl: function() {
			var url = jsSocials.Socials.prototype._getShareUrl.apply(this, arguments);
			var title = 'Sharing';
			var w = 700;
			var h = 700;
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);

			if (arguments[0].share == 'email') {
				return url;
			}
			else {
				return "javascript:window.open('" + url + "', '" + title + "','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+w+", height="+h+", top="+top+", left="+left+"'); return false;";
			}

		},
		text: '', showCount: false, showLabel: true, shares: []
	};
	this.id = '';
	this.widgetCounter = 1;
	this.shareText = 'Your share text';
}

SGMBWidget.prototype.setShareUrl = function(shareUrl, postUrl)
{
	if (shareUrl != '') {
		this.options.url = shareUrl;
	}
	else if (postUrl != '') {
		this.options.url = postUrl;
	}
}

SGMBWidget.prototype.show = function(data, widgetCounter, hide, postImage, customImageUrl, postUrl)
{
	var showButtonsOnMobileDirect = true ;
	var showButtonsOnDesktopDirect = true ;
	var isMobile = false;
	// device detection
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
	if(isMobile == true && showButtonsOnMobileDirect == false && hide == '')
	{
		return ;
	}

	if(isMobile == false  && showButtonsOnDesktopDirect == false && hide == '') {
		return ;
	}

	if(data.options.shareText != '') {
		this.shareText = data.options.shareText;
	}
	this.media = postImage;
	if(customImageUrl != '') {
		this.media = customImageUrl;
	}

	var obj =  data.buttonOptions;
	var that = this;
	if(data != '') {
		this.id = data.id;
		this.widgetCounter = widgetCounter;
	}
	if (data.button != '') {
		for (var buttonName in obj) {
			var labelName = obj[buttonName].label;
			var icon =  SGMB_URL+"/img/"+ obj[buttonName].icon +".png";
			var via = obj[buttonName].via;
			var hashtags = obj[buttonName].hashtags;
			this.setSocialOptions(buttonName, labelName, icon, via, hashtags);
		}
		if(obj) {
			this.changeButtonSize(data.options.fontSize);
			this.setShareUrl(data.options.url, postUrl);
			this.changePanelEffect(data.options.buttonsPanelEffect);
		}
	}
	this.jsSocial();
	if(data.options) {
		if(data.options.showCounts == 'on') {
			this.showCounts(true);
		}
		if(data.options.showLabels != 'on') {
			this.showLabels(false);
		}
		if(data.options.roundButton == 'on') {
			this.changeToRoundButtons(true);
		}
		if(data.options.showButtonsAsList == 'on') {
			this.changeColorDropdown(data.options.sgmbDropdownColor);
			this.changeColorDropdownLabel(data.options.sgmbDropdownLabelColor);
			this.changeDropdownLabelSize(data.options.sgmbDropdownLabelFontSize);
			this.showButtonsAsList(true);
		}
		else {
			this.showButtonsAsList(false);
		}
		if(data.options.setButtonsPosition == 'on') {
			this.showButtonsPositionChecked(true);
		}
		else {
			this.showButtonsPositionChecked(false);
		}
		if(data.options.showButtonsOnEveryPost == 'on') {
			this.showButtonsOnEveryPostChecked(true);
		}
		else {
			this.showButtonsOnEveryPostChecked(false);
		}
		if(data.options.showButtonsOnEveryPage == 'on') {
			this.showButtonsOnEveryPageChecked(true);
		}
		else {
			this.showButtonsOnEveryPageChecked(false);
		}
		if(data.options.selectedOrExcluded == 'excluded') {
			this.disabledSelectPostsOption(true);
			this.disabledExcludePostsOption(false);
		}
		else if(data.options.selectedOrExcluded == 'selected') {
			this.disabledSelectPostsOption(false);
			this.disabledExcludePostsOption(true);
		}
		else {
			this.disabledSelectPostsOption(false);
			this.disabledExcludePostsOption(false);
		}
		if(data.options.showButtonsOnCustomPost == 'on') {
			this.showButtonsOnCustomPostChecked(true);
		}
		else {
			this.showButtonsOnCustomPostChecked(false);
		}
		if(data.options.showButtonsInPopup == 'on') {
			this.showButtonsInPopup(true);
		}
		else {
			this.showButtonsInPopup(false);
		}
		this.changeBetweenButtonsSize(data.options.betweenButtons);
		jQuery('.sgmbWidget'+this.id+'-'+this.widgetCounter+' .jssocials-share').unbind('mouseenter mouseleave').hover(function() {
			that.changeButtonsEffect(data.options.buttonsEffect);
		});
		jQuery('.sgmbWidget'+this.id+'-'+this.widgetCounter+' .jssocials-share-logo').unbind('mouseenter mouseleave').hover(function() {
			that.changeIconsEffect(data.options.iconsEffect);
		});
		jQuery('.sgmbWidget'+this.id+'-'+this.widgetCounter+' .jssocials-share-logo').addClass('sgmb-social-img');
		jQuery('.sgmb-dropdown-color .wp-color-result').css({'background-color' : data.options.sgmbDropdownColor});
		jQuery('.sgmb-dropdown-label-color .wp-color-result').css({'background-color' : data.options.sgmbDropdownLabelColor});
	}
	if(obj) {
		if(data.buttonOptions.fbLike) {
			this.setFbLikeLayout(data.buttonOptions.fbLike.fbLikeLayout);
			this.setFbLikeActionType(data.buttonOptions.fbLike.fbLikeActionType);
			this.setFbLikeUrl(data.buttonOptions.fbLike.fbLikeUrl);
		}
		if(data.buttonOptions.twitterFollow) {
			if(data.buttonOptions.twitterFollow.twitterFollowShowCounts == 'on') {
				this.showCountsForTwitterFollow(true);
			}
			else {
				this.showCountsForTwitterFollow(false);
			}

			if(data.buttonOptions.twitterFollow.setLargeSizeForTwitterFollow == 'on') {
				this.setLargeSizeForTwitterFollow(true);
			}
			else {
				this.setLargeSizeForTwitterFollow(false);
			}
			this.setTwitterFollowUserName(data.buttonOptions.twitterFollow.followUserName);
		}
	}
	if(hide == '') {

		this.setPositionForButtonsPanel(data.options.sgmbButtonsPosition);
		jQuery(".jssocials-share-logo").one("load", function() {
			var width = jQuery(".sgmbWidget"+that.id+'-'+that.widgetCounter).width()/2;
			var height = jQuery(".sgmbWidget"+that.id+'-'+that.widgetCounter).height()/2;
			if(data.options.sgmbButtonsPosition == 'floatTopCenter' || data.options.sgmbButtonsPosition == 'floatBottomCenter') {
				jQuery(".sgmbWidget"+that.id+'-'+that.widgetCounter).css({'margin-left' : -(width)+'px'});
			}
			if(data.options.sgmbButtonsPosition == 'floatLeft' || data.options.sgmbButtonsPosition == 'floatRight') {
				jQuery(".sgmbWidget"+that.id+'-'+that.widgetCounter).css({'margin-top' : -(height)+'px'});
			}
		});

		if(data.options.showCenter == 'on') {
			this.showCenter(true);
		}
	}
	this.changeAttrOfButton();
	if(hide == '') {

	}
}

SGMBWidget.prototype.changeAttrOfButton = function()
{
	var that = this;
	jQuery('#sgmbShare'+this.id +'-'+this.widgetCounter+' a').each(function() {

		if (jQuery(this).attr('class') == 'twitter-follow-button' || jQuery(this).parent().is('.jssocials-share-email')) {
			return true;
		}

		var t = jQuery(this);
		t.attr({
			onclick : t.attr('href'),
		});
		t.attr('href','#');
		t.removeAttr('target');
	});
}

SGMBWidget.prototype.twitterFollowLoad = function()
{
	if(typeof twttr !== 'undefined') {
		if(typeof twttr.widgets !== 'undefined') {
			twttr.widgets.load();
		}
	}
}

SGMBWidget.prototype.setSocialOptions = function(socialButtonName, labelName, logo, via, hashtags)
{
	if(socialButtonName == 'fbLike') {
		this.options.shares.push(this.fbLike);
	}
	else {
		if(socialButtonName == 'twitterFollow') {
			this.options.shares.push(this.twitterFollow);
		}
		else {
			if(socialButtonName == 'twitter') {
				this.options.shares.push({'share': socialButtonName, 'label':labelName, 'logo':logo, 'via':via, 'hashtags':hashtags, 'text': this.shareText});
			}
			else {
				this.options.shares.push({'share': socialButtonName,'label': labelName, 'logo': logo, 'media':this.media, 'text': this.shareText});
			}
		}
	}
	this.jsSocial();
}

SGMBWidget.prototype.setPositionForButtonsPanel = function(position)
{
	switch (position) {
		case 'floatLeft':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-left');
			break;
		case 'floatTopRight':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-top-right');
			break;
		case 'floatTopCenter':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-top-center');
			break;
		case 'floatTopLeft':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-top-left');
			break;
		case 'floatRight':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-right');
			break;
		case 'floatBottomLeft':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-bottom-left');
			break;
		case 'floatBottomCenter':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-bottom-center');
			break;
		case 'floatBottomRight':
			jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).addClass('sgmb-floating-bottom-right');
			break;
	}
}

SGMBWidget.prototype.showButtonsPositionChecked = function(inputValue)
{
	if(inputValue == true) {
		jQuery('.options-for-buttons-fixed-position').show();
	}
	else {
		jQuery('.options-for-buttons-fixed-position').hide();
	}
}

SGMBWidget.prototype.disabledSelectPostsOption = function(inputValue)
{
	if(inputValue == true) {
		jQuery('.sgmb-select-posts select').attr('disabled', 'disabled');
		jQuery(".sgmb-select-posts select").val('');
	}
	else {
		jQuery('.sgmb-select-posts select').removeAttr('disabled');
	}
}

SGMBWidget.prototype.disabledExcludePostsOption = function(inputValue)
{
	if(inputValue == true) {
		jQuery('.sgmb-exclude-posts select').attr('disabled', 'disabled');
		jQuery(".sgmb-exclude-posts select").val('');
	}
	else {
		jQuery('.sgmb-exclude-posts select').removeAttr('disabled');
	}
}

SGMBWidget.prototype.showButtonsOnEveryPostChecked = function(inputValue)
{
	if(inputValue == true) {
		jQuery('.showEveryPostOptions').show();
	}
	else {
		jQuery('.showEveryPostOptions').hide();
	}
}

SGMBWidget.prototype.showButtonsOnEveryPageChecked = function(inputValue)
{
	if(inputValue == true) {
		jQuery('.showEveryPageOptions').show();
	}
	else {
		jQuery('.showEveryPageOptions').hide();
	}
}

SGMBWidget.prototype.showButtonsOnCustomPostChecked = function(inputValue)
{

	if(inputValue == true) {
		jQuery('.showCustomPostOptions').show();
	}
	else {
		jQuery('.showCustomPostOptions').hide();
	}
}

SGMBWidget.prototype.showButtonsInPopup = function(inputValue)
{
	if(inputValue == true) {
		jQuery('.sgmb-show-in-popup-options').show();
	}
	else {
		jQuery('.sgmb-show-in-popup-options').hide();
	}
}

SGMBWidget.prototype.changeColorDropdown = function(element)
{
	jQuery('.dropdownWrapper'+this.id).css({'background-color' : element});
}

SGMBWidget.prototype.changeColorDropdownLabel = function(element)
{
	jQuery('.sgmbButtonListLabel'+this.id).css({'color' : element});
}

SGMBWidget.prototype.changePanelEffect = function(newEffect)
{
	jQuery('.sgmbWidget'+this.id+'-'+this.widgetCounter).addClass('sgmb-animated '+'sgmb-'+newEffect).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){
		jQuery(this).removeClass('sgmb-animated '+'sgmb-'+newEffect);
	});
}

SGMBWidget.prototype.changeButtonsEffect = function(newEffect)
{
	jQuery( '.sgmbWidget'+this.id+'-'+this.widgetCounter+' .jssocials-share' ).unbind('mouseenter mouseleave').hover(function() {
		jQuery(this).addClass('sgmb-animated '+'sgmb-'+newEffect).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){
			jQuery(this).removeClass('sgmb-animated '+'sgmb-'+newEffect);
		});
	});
}

SGMBWidget.prototype.changeIconsEffect = function(newEffect)
{
	jQuery( '.sgmbWidget'+this.id+'-'+this.widgetCounter+' .jssocials-share-logo' ).unbind('mouseenter mouseleave').hover(function() {
		jQuery( this ).addClass('sgmb-animated '+'sgmb-'+newEffect).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){
			jQuery(this).removeClass('sgmb-animated '+'sgmb-'+newEffect);
		});
	});
}

SGMBWidget.prototype.setFbLikeLayout = function(fbLikeLayout)
{
	this.fbLikeDataLayout = fbLikeLayout;
	jQuery(".fb-like"+this.id).attr("data-layout", this.fbLikeDataLayout);
	this.fbLikeParse();
}

SGMBWidget.prototype.setFbLikeActionType = function(fbLikeActionType)
{
	this.fbLikeDataAction = fbLikeActionType;
	jQuery(".fb-like"+this.id).attr("data-action", this.fbLikeDataAction);
	this.fbLikeParse();
}

SGMBWidget.prototype.setFbLikeUrl = function(url)
{
	jQuery(".fb-like"+this.id).attr("data-href", url);
	this.fbLikeParse();
}

SGMBWidget.prototype.fbLikeParse = function()
{
	if(typeof FB !== 'undefined') {
		FB.XFBML.parse();
	}
}

SGMBWidget.prototype.jsSocial = function()
{
	if(!this.id) {
		this.id = '';
	}
	return jQuery('#sgmbShare'+this.id +'-'+this.widgetCounter).jsSocials(this.options);
}

SGMBWidget.prototype.changeButtonSize = function(fontSize)
{
	jQuery('#sgmbShare'+this.id +'-'+this.widgetCounter).css({'font-size' : fontSize+"px"});
}

SGMBWidget.prototype.changeDropdownLabelSize = function(fontSize)
{
	jQuery('.sgmbButtonListLabel'+this.id).css({'font-size' : fontSize+"px"});
}

SGMBWidget.prototype.changeBetweenButtonsSize = function(betweenButtonsSize)
{
	if (betweenButtonsSize) {
		if (!betweenButtonsSize.match('px$')) {
			betweenButtonsSize+='px';
		}
	}
	jQuery('.jssocials-share').css({'margin-right' : betweenButtonsSize});
}

SGMBWidget.prototype.showCenter = function(inputValue)
{
	if(inputValue == true) {
		jQuery('#sgmbShare'+this.id+'-'+this.widgetCounter).addClass('widgetShowCenter');
	}
}

SGMBWidget.prototype.changeToRoundButtons = function(inputValue)
{
	if(inputValue == true) {
		jQuery('#sgmbShare'+this.id+'-'+this.widgetCounter+' a').addClass('sgmbBorderRadius');
	}
	else {
		jQuery('#sgmbShare'+this.id+'-'+this.widgetCounter+' a').removeClass('sgmbBorderRadius');
	}

}

SGMBWidget.prototype.showLabels = function(inputValue)
{
	if(inputValue == false) {
		this.options.showLabel = false;
	}
	else {
		this.options.showLabel = true;
	}
	this.jsSocial();
}



SGMBWidget.prototype.showButtonsAsList = function(inputValue)
{
	if(inputValue == true) {
		jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).appendTo( ".dropdownPanel"+this.id+'-'+this.widgetCounter );
		jQuery('.dropdownWrapper'+this.id).show();
		jQuery('.sgmb-dropdown-advance-options').show();
	}
	else {
		jQuery(".sgmbWidget"+this.id+'-'+this.widgetCounter).appendTo( ".sgmbLivePreview" );
		jQuery('.dropdownWrapper'+this.id).hide();
		jQuery('.sgmb-dropdown-advance-options').hide();
	}
}

SGMBWidget.prototype.showCounts = function(inputValue)
{
	if(inputValue == false) {
		this.options.showCount = false;
	}
	else {
		this.options.showCount = true;
	}
	this.jsSocial();
}

SGMBWidget.prototype.changeButtonText = function(buttonText, buttonName)
{
	var socialArray = this.options.shares;
	var nameIndex = '';
	for(index in socialArray) {
		if(socialArray[index] == buttonName && typeof(socialArray[index]) == 'string') {
			nameIndex = index;
		}
		else if(socialArray[index]['share'] == buttonName) {
			nameIndex = index;
		}
	}
	this.options.shares[nameIndex]['label'] =  buttonText;
	this.jsSocial();
}

SGMBWidget.prototype.changeLogo = function(logo)
{
	for(index in this.options.shares) {
		this.options.shares[index]["logo"] = SGMB_URL+"/img/"+ logo+"-"+this.options.shares[index]['share'] +".png" ;
	}
	this.jsSocial();
}

SGMBWidget.prototype.socialButtonsHide = function(socialButtonName)
{
	var sharesLength = this.options.shares.length;
	var that = this;
	var elementIndex = this.options.shares.indexOf(socialButtonName);
	if(elementIndex == -1) {
		for(var i=0; i< sharesLength; i++) {
			if(typeof that.options.shares[i] !== 'string' && that.options.shares[i].share == socialButtonName) {
				elementIndex = i;
			}
		}
	}
	this.options.shares.splice(elementIndex,1);
	this.jsSocial();
}
