<div>
	<span class="sgmb-single-network-name">Url:</span>
	<input class="btnLabel" name="fbLikeUrl" type="text" value="<?php echo @$data['buttonOptions']['fbLike']['fbLikeUrl'] ?>" disabled="disabled">
</div>
<div id="fbLike-more-options" class="sgmb-more-options">
	<span class="sgmb-more-options-title">Facebook Like More Options</span>
	<div class="fbLikeOption">
		<span class="fbLikeOptionLabel">Layout:</span>
		<?php
			$classes = "selectOption";
			$fieldName = "fbLikeLayout";
			$sgmbFbLikeLayout = array(
				'button',
				'button_count',
				'standard',
				'box_count'
			);
			echo SgmbAddNewSection::createSelect($fieldName, $sgmbFbLikeLayout, @$data, 'fbLikeLayout', 'fbLike', false, $classes);
		?>
	</div>
	<div class="fbLikeOption">
		<span class="fbLikeOptionLabel">Action Type:</span>
		<?php
			$fieldName = "fbLikeActionType";
			$fbLikeActionType = array(
				'like',
				'recommend'
			);
			echo SgmbAddNewSection::createSelect($fieldName, $fbLikeActionType, @$data, 'fbLikeActionType', 'fbLike', false, $classes);
		?>
	</div>
	<a href="#" rel="modal:close" class="button-primary sgmb-save-fbLike-more-options sgmb-float-right">Save</a>
</div>
<input type="hidden" class="sgmb-fbLikeLayout-val" name="fbLikeLayout" value="<?php echo @$data['buttonOptions']['fbLike']['fbLikeLayout'] ?>">
<input type="hidden" class="sgmb-fbLikeActionType-val" name="fbLikeActionType" value="<?php echo @$data['buttonOptions']['fbLike']['fbLikeActionType'] ?>">
