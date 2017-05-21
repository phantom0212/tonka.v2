function SGMBLivePreview()
{
	this.widget = '';
	this.roundButton = '';
	this.icon = 'default';
	this.betweenSize = '1px'
	this.iconEffect = jQuery("[name='iconsEffect']").val();
	this.buttonsEffect = jQuery("[name='buttonsEffect']").val();
}

SGMBLivePreview.prototype.getWidget = function()
{
	return this.widget;
}

SGMBLivePreview.prototype.setWidget = function(wdg)
{
	this.widget = wdg;
}

SGMBLivePreview.prototype.addSelectboxValuesIntoInput = function() {

	var selectedPages = [];
	var selectedPosts = [];
	var excludedPosts = [];
	jQuery("#add-form").submit(function(e) {
		var pages = jQuery("select[data-selectbox='sgmbSelectedPages'] > option:selected");
		var posts = jQuery("select[data-selectbox='sgmbSelectedPosts'] > option:selected");
		var excludPosts = jQuery("select[data-selectbox='sgmbExcludedPosts'] > option:selected");
		for(i=0; i<pages.length; i++) {
			selectedPages.push(pages[i].value);
		}
		for(i=0; i<posts.length; i++) {
			selectedPosts.push(posts[i].value);
		}
		for(i=0; i<excludPosts.length; i++) {
			excludedPosts.push(excludPosts[i].value);
		}
		jQuery(".sgmb-all-selected-page").val(selectedPages);
		jQuery(".sgmb-all-selected-post").val(selectedPosts);
		jQuery(".sgmb-all-excluded-post").val(excludedPosts);
	});
}

SGMBLivePreview.prototype.init = function()
{
	var that = this;
	var sgmbColorPicker = '';
	jQuery('.dropdownWrapper').hide();
	jQuery('.sgmb-dropdown-advance-options').hide();
	jQuery('.showEveryPostOptions').hide();
	jQuery('.showCustomPostOptions').hide();
	jQuery('.options-for-buttons-fixed-position').hide();
	jQuery('.sgmb-show-in-popup-options').hide();
	jQuery('.showEveryPageOptions').hide();
	this.roundButton = jQuery('[name = roundButton]');
	this.showLabels = jQuery('[name = showLabels]');
	this.betweenSize = jQuery('.sgmb-betweenButtons').val();
	this.addSelectboxValuesIntoInput();

	jQuery(".js-social-btn-text").bind('input', function() {
		var btnText = jQuery(this).val();
		var btnName = jQuery(this).attr('data-social-button');
		that.widget.changeButtonText(btnText, btnName);
		that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery('[name = roundButton]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
 		that.widget.changeToRoundButtons(inputValue);
 		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery('[name = showLabels]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
 		that.widget.showLabels(inputValue);
 		that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
 		that.widget.changeButtonsEffect(that.buttonsEffect);
		that.widget.changeIconsEffect(that.iconEffect);
		that.widget.fbLikeParse();
		that.widget.twitterFollowLoad();
		that.widget.changeAttrOfButton();
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery('[name = showCounts]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
 		that.widget.showCounts(inputValue);
 		that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
 		that.widget.changeButtonsEffect(that.buttonsEffect);
		that.widget.changeIconsEffect(that.iconEffect);
		that.widget.fbLikeParse();
		that.widget.twitterFollowLoad();
		that.widget.changeAttrOfButton();
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery('[name = showButtonsAsList]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
		if(inputValue == true) {
			jQuery('[name = setButtonsPosition]').attr('checked',false);
			var inputValueSetButtonsPosition = jQuery('[name = setButtonsPosition]').is(':checked');
			that.widget.showButtonsPositionChecked(inputValueSetButtonsPosition);
		}
 		that.widget.showButtonsAsList(inputValue);
	});

	jQuery('[name = selected-or-excluded-posts]').bind('change', function() {
		var inputValue = jQuery(this).val();

		if (inputValue == 'selected') {
			that.widget.disabledSelectPostsOption(false);
			that.widget.disabledExcludePostsOption(true);
		}
		else if (inputValue == 'excluded') {
			that.widget.disabledSelectPostsOption(true);
			that.widget.disabledExcludePostsOption(false);
		}
	});

	jQuery('[name = showButtonsOnEveryPost]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
		that.widget.showButtonsOnEveryPostChecked(inputValue);
	});

	jQuery('[name = setButtonsPosition]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
		if(inputValue == true) {
			jQuery('[name = showButtonsInPopup]').attr('checked', false);
			jQuery('[name = showButtonsAsList]').attr('checked', false);
			var inputValueShowButtonsAsList = jQuery('[name = showButtonsAsList]').is(':checked');
			var inputValueShowButtonsInPopup = jQuery('[name = showButtonsInPopup]').is(':checked');
			that.widget.showButtonsAsList(inputValueShowButtonsAsList);
			that.widget.showButtonsInPopup(inputValueShowButtonsInPopup);
		}
		that.widget.showButtonsPositionChecked(inputValue);
	});

	jQuery('.js-social-btn-status').on('socialButtonShow', function(e){

		that.widget.setShareUrl("http://google.com");
		var socialButtonName = jQuery(this).attr('data-social-button');
		var buttonCustomName = jQuery("input[type='text'][data-social-button="+socialButtonName+"]").val();
    	if(jQuery("[name='logo']").val() != '') {
    		that.icon = jQuery("[name='logo']").val();
    	}
    	else {
    		jQuery("[name='logo']").val('default');
    	}
   		that.widget.setSocialOptions(socialButtonName,buttonCustomName);
		that.widget.changeLogo(that.icon);
		that.widget.showLabels(that.showLabels.is(':checked'));
		that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
		that.widget.changeButtonsEffect(that.buttonsEffect);
		that.widget.changeIconsEffect(that.iconEffect);
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery('.js-social-btn-status').on('dragComplete', function(e){
		that.widget.fbLikeParse();
		that.widget.twitterFollowLoad();
		that.widget.changeAttrOfButton();
	});

	jQuery("[name='fbLikeLayout']").bind('change',function() {
		var fbLikeLayout = jQuery(this).val();
		that.widget.setFbLikeLayout(fbLikeLayout);
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery("[name='fbLikeActionType']").bind('change',function() {
		var fbLikeActionType = jQuery(this).val();
		that.widget.setFbLikeActionType(fbLikeActionType);
		that.widget.twitterFollowLoad();
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery('.js-social-btn-status').on('socialButtonHide', function(e){
    	var socialButtonName = jQuery(this).attr('data-social-button');
		that.widget.socialButtonsHide(socialButtonName);
		that.widget.showLabels(that.showLabels.is(':checked'));
		that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
		that.widget.changeButtonsEffect(that.buttonsEffect);
		that.widget.changeIconsEffect(that.iconEffect);
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery("[name='sgmbSocialButtonSize']").bind('change', function() {
		var fontSize = jQuery(this).val();
		that.widget.changeButtonSize(fontSize);
		that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery("[name='betweenButtons']").bind('input', function() {
		that.betweenSize = jQuery(this).val();
		that.widget.changeBetweenButtonsSize(that.betweenSize);
	});

	jQuery("[name='sgmbDropdownLabelFontSize']").bind('change', function() {
		var fontSize = jQuery(this).val();
		that.widget.changeDropdownLabelSize(fontSize);
	});

	$('.sgmb-image-radio-content').bind('click', function() {
		var theme = jQuery(this).find('input[type="radio"]').val();
		var newTheme = sgmb.theme[theme]['socialTheme'];
		that.icon = sgmb.theme[theme]['icons'];
		that.switchTheme(newTheme,that.icon);
		jQuery("[name='socialTheme']").val(newTheme);
		jQuery("[name='logo']").val(that.icon);
	});

	jQuery("input:radio[name=theme]").bind('change', function() {
		var theme = jQuery(this).val();
		var newTheme = sgmb.theme[theme]['socialTheme'];
		that.icon = sgmb.theme[theme]['icons'];
		that.switchTheme(newTheme,that.icon);
		jQuery("[name='socialTheme']").val(newTheme);
		jQuery("[name='logo']").val(that.icon);
	});

	jQuery("[name='buttonsPanelEffect']").bind('change', function() {
		var newEffect = jQuery(this).val();
		that.widget.changePanelEffect(newEffect);
	});

	jQuery("[name='buttonsEffect']").bind('change', function() {
		that.buttonsEffect = jQuery(this).val();
		that.widget.changeButtonsEffect(that.buttonsEffect);
	});

	jQuery("[name='iconsEffect']").bind('change', function() {
		that.iconEffect = jQuery(this).val();
		that.widget.changeIconsEffect(that.iconEffect);
	});

	jQuery('.sgmbDropdownColor').wpColorPicker({
		change: function() {
			var sgmbColorPickerIsChange = jQuery(this);
			that.widget.changeColorDropdown(sgmbColorPickerIsChange.val());
		}
	});

	jQuery(".wp-picker-holder").bind('click', function() {
		var selectedInput = jQuery(this).prev().find('.sgmbDropdownColor');
		that.widget.changeColorDropdown(selectedInput.val());
	});

	jQuery(".sgmb-dropdown-color .wp-picker-clear").bind('click', function() {
		that.widget.changeColorDropdown('#FC6D58');
	});

	jQuery('.sgmbDropdownLabelColor').wpColorPicker({
		change: function() {
			var sgmbColorPicker = jQuery(this);
			that.widget.changeColorDropdownLabel(sgmbColorPicker.val());
		}
	});

	jQuery(".wp-picker-holder").bind('click', function() {
		var selectedInput = jQuery(this).prev().find('.sgmbDropdownLabelColor');
		that.widget.changeColorDropdownLabel(selectedInput.val());
	});

	jQuery(".sgmb-Dropdown-label-Color .wp-picker-clear").bind('click', function() {
		that.widget.changeColorDropdownLabel('#fff');
	});

	jQuery('[name = twitterFollowShowCounts]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
		that.widget.showCountsForTwitterFollow(inputValue);
	});

	jQuery('[name = setLargeSizeForTwitterFollow]').bind('change', function() {
		var inputValue = jQuery(this).is(':checked');
		that.widget.setLargeSizeForTwitterFollow(inputValue);
	});
}

SGMBLivePreview.prototype.currentTheme = 'classic';

SGMBLivePreview.prototype.switchTheme = function(newTheme, icon) {
	var that = this;
	var $cssLink = jQuery('#jssocials_theme_tm-css');
	var cssPath = $cssLink.attr("href");
	if (jQuery("[name='socialTheme']").val() != '') {
		this.currentTheme = jQuery("[name='socialTheme']").val();
	}
	$cssLink.attr("href", cssPath.replace(this.currentTheme, newTheme));
	this.currentTheme = newTheme;
	that.widget.changeLogo(icon);
	that.widget.changeToRoundButtons(that.roundButton.is(':checked'));
	that.widget.changeButtonsEffect(that.buttonsEffect);
	that.widget.changeIconsEffect(that.iconEffect);
	that.widget.fbLikeParse();
	that.widget.twitterFollowLoad();
	that.widget.changeAttrOfButton();
}
