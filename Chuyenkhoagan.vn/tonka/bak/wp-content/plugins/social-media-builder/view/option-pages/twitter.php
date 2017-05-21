<div>
	<span class="sgmb-single-network-name">Label: </span>
	<input class="input-width-static js-social-btn-text btnLabel" data-social-button="twitter" type='text' name="labeltwitter"
		<?php if(@$data['buttonOptions']['twitter']['label'] == ''): ?>
			value="Tweet"
		<?php else: ?>
			value="<?php echo @$data['buttonOptions']['twitter']['label'] ?>"
		<?php endif;?>
	>
</div>
<div id="twitter-more-options" class="sgmb-more-options">
	<span class="sgmb-more-options-title">Twitter More Options</span>
	<div>
		<span class="sgmb-more-opt-label">Hashtags:</span>
		<input id="twitter-hashtags" class="input-width-static btnLabel" data-social-button="twitter" type='text' value="<?php echo @$data['buttonOptions']['twitter']['hashtags'] ?>">
	</div>
	<div>
		<span class="sgmb-more-opt-label">Via:</span>
		<input id="twitter-via" class="input-width-static btnLabel" data-social-button="twitter" type='text' value="<?php echo @$data['buttonOptions']['twitter']['via'] ?>">
	</div>
	<a href="#" rel="modal:close" class="button-primary sgmb-save-twitter-more-options sgmb-float-right">Save</a>
</div>
<input type="hidden" class="sgmb-twitter-hashtags-val" name="hashtags" value="<?php echo @$data['buttonOptions']['twitter']['hashtags'] ?>">
<input type="hidden" class="sgmb-twitter-via-val" name="via" value="<?php echo @$data['buttonOptions']['twitter']['via'] ?>">
