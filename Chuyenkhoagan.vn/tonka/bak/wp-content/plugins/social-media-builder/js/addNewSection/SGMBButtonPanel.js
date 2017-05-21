var $ = jQuery;

function SGMBButtonPanel()
{
	this.selButtons = [];
}

SGMBButtonPanel.prototype.getSelButtons = function()
{
	return this.selButtons;
}

SGMBButtonPanel.prototype.setButton  = function(data)
{
	var that = this;
	jQuery('.sgmb-options-container').find('.sgmb-main-network-order').find('.sgmb-clickable-order').each(function(){
		var elem = jQuery(this);
		elem.click(function(e) {
			var state = elem.is(':checked');
			var socialButton = elem.attr('data-social-button');

			if (state) {

				if (elem.parent().parent().length) {
					elem.parent().parent().addClass('active');
				}
				that.addButtonInSelectList(socialButton);
				elem.trigger('socialButtonShow');
				elem.trigger('dragComplete');
			}
			else {
				if (elem.parent().parent().length) {
					elem.parent().parent().removeClass('active');
					that.deleteButtonInSelectList(socialButton);
					elem.trigger('socialButtonHide');
					elem.trigger('dragComplete');
				}
			}
		});

		if (!data.button && (jQuery(this).attr('data-social-button') == 'facebook' || jQuery(this).attr('data-social-button') == 'twitter' || jQuery(this).attr('data-social-button') == 'googleplus')) {
			setTimeout( function() {
					jQuery(elem).click();
				}, 5
			);
		}
	});
}

SGMBButtonPanel.prototype.sortable  = function()
{
	var that = this;

	var elem = document.getElementById('sgmb-main-network-list');
	Sortable.create(elem, {
		/* options */
		onEnd: function (/**Event*/evt) {
			that.selButtons = [];
			jQuery('.sgmb-options-container').find('.sgmb-main-network-order').find('.sgmb-clickable-order').each(function(){
				var elem = jQuery(this);
				var state = elem.is(':checked');
				var socialButton = elem.attr('data-social-button');

				if (state) {
					that.addButtonInSelectList(socialButton);
					elem.trigger('socialButtonHide');
					elem.trigger('socialButtonShow');
					elem.trigger('dragComplete');
				}
			});
		},
	});
}

SGMBButtonPanel.prototype.setButtonAsSelected  = function(id)
{
	if (id) {
		jQuery('.sgmb-options-container').find('.sgmb-main-network-order').find('.sgmb-clickable-order').each(function(){
			if (jQuery(this).attr('data-social-button') == id) {
				jQuery(this).click();
				jQuery(this).parent().parent().addClass('active');
			}
		});
		this.addButtonInSelectList(id);
	}
}

SGMBButtonPanel.prototype.addButtonInSelectList = function(id)
{
	this.selButtons.push(id);
	$('.select-button').val(this.selButtons.join(','));
}

SGMBButtonPanel.prototype.deleteButtonInSelectList = function(id)
{
	var key = this.selButtons.indexOf(id);
	this.selButtons.splice(key,1);
	$('.select-button').val(this.selButtons.join(','));
}
