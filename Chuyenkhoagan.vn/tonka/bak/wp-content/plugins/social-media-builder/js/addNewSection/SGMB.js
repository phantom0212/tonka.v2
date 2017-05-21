var $ = jQuery;

function SGMB() {
	this.buttons = ['facebook', 'googleplus', 'twitter', 'email', 'linkedin', 'pinterest', 'twitterFollow', 'fbLike', 'whatsapp', 'tumblr', 'reddit', 'line', 'vk', 'stumbleupon', 'mewe'];
	this.theme = {
		"classic" : {
			"socialTheme":"classic",
			"icons":"default"
		},
		"flat" : {
			"socialTheme":"flat",
			"icons":"default"
		},
		"cloud" : {
			"socialTheme":"minima",
			"icons":"cloud"
		},
		"toy" : {
			"socialTheme":"minima",
			"icons":"toy"
		},
		"wood" : {
			"socialTheme":"plain",
			"icons":"wood"
		},
		"box" : {
			"socialTheme":"plain",
			"icons":"box"
		},
		"round" : {
			"socialTheme":"minima",
			"icons":"round"
		},
		"silverround" : {
			"socialTheme":"plain",
			"icons":"silverround"
		},
		"goodstaff" : {
			"socialTheme":"minima",
			"icons":"goodstaff"
		},
		"heart" : {
			"socialTheme":"minima",
			"icons":"heart"
		},
		"round-dot" : {
			"socialTheme":"minima",
			"icons":"round-dot"
		},
		"hex" : {
			"socialTheme":"minima",
			"icons":"hex"
		},
		"cork" : {
			"socialTheme":"minima",
			"icons":"cork"
		},
		"pen" : {
			"socialTheme":"minima",
			"icons":"pen"
		},
		"black" : {
			"socialTheme":"minima",
			"icons":"black"
		},
		"multi" : {
			"socialTheme":"minima",
			"icons":"multi"
		}
	};
	this.livePreview = new SGMBLivePreview();
	this.buttonPanel = new SGMBButtonPanel();
}

SGMB.prototype.init = function(data, sgmbIsPro)
{
	this.initWizardTabs(data);
	this.livePreview.init();
	this.setButtonAsSelected(data);
	this.setButton(data);
	this.sortable();
	this.tooltip();
	this.setValueInModal();
}

SGMB.prototype.getLivePreview = function()
{
	return this.livePreview;
}

SGMB.prototype.setButtonAsSelected = function(data)
{
	for (var buttonName in data.button) {
		var button = data.button[buttonName];
		this.buttonPanel.setButtonAsSelected(button);
	}
}

SGMB.prototype.setButton = function(data)
{
	this.buttonPanel.setButton(data);
}

SGMB.prototype.initWizardTabs = function(data)
{
	if (data.id) {
		$('#sgmb-create-button-wizard').smartWizard({transitionEffect:'slide', enableAllSteps:true, labelFinish:'Save Changed'});
	}
	else {
		$('#sgmb-create-button-wizard').smartWizard({transitionEffect:'slide', labelFinish:'Save Changed'});
	}
}

SGMB.prototype.sortable = function()
{
	this.buttonPanel.sortable();
}

SGMB.prototype.tooltip = function()
{
	jQuery('.share-url-info').tooltip({
		position: {
			my: "center bottom-20",
			at: "center top",
			using: function( position, feedback ) {
				$( this ).css( position );
				$("<div>")
				.addClass("arrow")
				.addClass(feedback.vertical)
				.addClass(feedback.horizontal)
				.appendTo(this);
			}
		}
	});
}

SGMB.prototype.setValueInModal = function()
{
	jQuery(".sgmb-save-twitter-more-options").bind('click', function() {
		jQuery(".sgmb-twitter-hashtags-val").val(jQuery("#twitter-hashtags").val());
		jQuery(".sgmb-twitter-via-val").val(jQuery("#twitter-via").val());
	});

	jQuery(".sgmb-save-fbLike-more-options").bind('click', function() {
		jQuery(".sgmb-fbLikeLayout-val").val(jQuery("select[name='fbLikeLayout']").val());
		jQuery(".sgmb-fbLikeActionType-val").val(jQuery("select[name='fbLikeActionType']").val());
	});

	jQuery(".sgmb-save-twitterFollow-more-options").bind('click', function() {
		jQuery("[name='twitterFollowShowCounts']").attr('checked', jQuery("#twitterFollowShowCounts").is(":checked"));
		jQuery("[name='setLargeSizeForTwitterFollow']").attr('checked', jQuery("#setLargeSizeForTwitterFollow").is(":checked"));
	});
}
