<div>
	<span class="sgmb-single-network-name">User:</span>
	<input id="" class="btnLabel"  type='text' name="followUserName" disabled="disabled">
</div>
<div id="twitterFollow-more-options" class="sgmb-more-options">
	<span class="sgmb-more-options-title">Twitter Follow More Options</span>
	<div class="sgmb-checkbox">
		<span class="twitter-follow-label-checkbox">Show Counts:</span>
		<input type="checkbox" name="twitterFollowShowCounts" id="twitterFollowShowCounts"
		<?php if(@$data['buttonOptions']['twitterFollow']['twitterFollowShowCounts'] == 'on'): ?>
			checked
		<?php endif; ?>>
	</div>
	<div class="sgmb-checkbox">
		<span class="twitter-follow-label-checkbox">Set large size on button:</span>
		<input type="checkbox" name="setLargeSizeForTwitterFollow" id="setLargeSizeForTwitterFollow"
		<?php if(@$data['buttonOptions']['twitterFollow']['setLargeSizeForTwitterFollow'] == 'on'): ?>
			checked
		<?php endif; ?>>
	</div>
	<a href="#" rel="modal:close" class="button-primary sgmb-save-twitterFollow-more-options sgmb-float-right">Save</a>
</div>
<input type="checkbox" name="twitterFollowShowCounts" id="" class="sgmb-display-none"
	<?php if(@$data['buttonOptions']['twitterFollow']['twitterFollowShowCounts'] == 'on'): ?>
		checked
	<?php endif; ?>
>
<input type="checkbox" name="setLargeSizeForTwitterFollow" id="set-large-size-twitter-follow" class="sgmb-display-none"
	<?php if(@$data['buttonOptions']['twitterFollow']['setLargeSizeForTwitterFollow'] == 'on'): ?>
		checked
	<?php endif; ?>
>
