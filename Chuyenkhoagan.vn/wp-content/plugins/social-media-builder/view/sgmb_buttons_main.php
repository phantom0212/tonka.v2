<?php if (!defined( 'ABSPATH' )) exit; ?>
<?php $sgmbReview = get_option('SGMB_MEDIA_REVIEW_PANEL');?>
<div class="wrap">
<div class="headers-wrapper">
	<?php if(empty($sgmbReview)): ?>
		<div class="updated updated notice is-dismissible reviewPanel">
			<div class="reviewPanelContent"> 
				<span class="reviewPanelSpan">
					Dear user, we always do our best to help you and your opinion is very important for us! 
				</span></br>
				<span class="reviewPanelSpan">
					So if you liked our <b>Social Media Plugin</b> and if our support was helpful for you, we'll be thankful if you go ahead and leave  a review.
				</span>
				<span class="reviewPanelSpan"> 
					Please <a class="reviewPanelHref" href=\"https://wordpress.org/support/view/plugin-reviews/social-media-builder?filter=5\" target=\"_blank\">rate it 5 stars.</a>
				</span>
			</div>
				<span class="reviewPanelClose">Dont show again</span>
				<button type="button" class="notice-dismiss closeButton"></button>
		</div>
	<?php endif; ?>
	<h1 class="h1-for-headers-wrapper">Social Buttons <a href="<?php echo admin_url();?>admin.php?page=create-button" class="add-new-h2">Add New</a>
		<?php if(SGMB_PRO != 1): ?>
			<input type="button" class="sgmbUpgrateProButton" value="Upgrade to PRO version" onclick="window.open('https://sygnoos.com/wordpress-social-media/')">
		<?php endif; ?>
	</h1>	
	<div class="sgmb-export-import-buttons-wrraper">
		<a href= "admin-post.php?action=export_button">
			<input type="button" value="Export" class="button">
		</a>		
		<input id="sgmb-upload-export-file" class="button" type="button" value="Import">
	</div>
	<div class="clear"></div>	
</div>
<?php
	echo $this->table;
	wp_enqueue_media();
?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".reviewPanelClose").on({
			click: function() {
				var data = {
					action: 'close_review_panel',
				}
				$.post(ajaxurl, data, function(response,d) {

				});
				$( ".reviewPanel" ).hide(300);
			}
		});
		var custom_uploader;
		jQuery('#sgmb-upload-export-file').click(function(e) {
			e.preventDefault();

			/* If the uploader object has already been created, reopen the dialog */
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}

			/* Extend the wp.media object */
			custom_uploader = wp.media.frames.file_frame = wp.media({
				titleFF: 'Select Export File',
				button: {
					text: 'Select Export File'
				},
				multiple: false,
				library : { type  :  'text/plain'},
			});
			/* When a file is selected, grab the URL and set it as the text field's value */
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON();

				var data = {
					action: 'import_buttons',
					attachmentUrl: attachment.url
				}
				jQuery(".js-sg-import-gif").removeClass("sg-hide-element");
				jQuery.post(ajaxurl, data, function(response,d) {
					location.reload();
				});
			});
			/* Open the uploader dialog */
			custom_uploader.open();
		});
	});
</script>