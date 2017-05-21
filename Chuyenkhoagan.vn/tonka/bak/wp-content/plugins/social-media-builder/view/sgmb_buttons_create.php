<?php
	if (!defined( 'ABSPATH' )) exit;
	$buttonsForThemesShowed = array(
		'facebook',
		'twitter',
		'googleplus'
	);
	global  $SGMB_ADVANCED_NAME_SOCIAL_BUTTONS;
	global $SGMB_FLOAT_POSITIONS;
	$savedButtons = @$data['button'];
	$socialButtons = $SGMB_ADVANCED_NAME_SOCIAL_BUTTONS;

	if ($savedButtons != null) {
		foreach ($savedButtons as $savedButton) {
			$sortedButtons[$savedButton] = $socialButtons[$savedButton];
			unset($socialButtons[$savedButton]);
		}

		$socialButtons = $sortedButtons + $socialButtons;
	}
?>
<form method="POST" action="<?php echo admin_url();?>admin-post.php" id="add-form">
<input type="hidden" name="action" value="save_button">
<input type="hidden"  class="select-button" name="button" value="">
<input type="hidden" class="button-primary" value="<?php echo esc_attr(@$_GET['id']); ?>" name="hidden_button_id" />
<?php wp_nonce_field('save_button', 'wp-nonce-token'); ?>
<div class="sgmb-container">
	<div class="sgmb-content">
		<?php if (isset($_GET['saved']) && $_GET['saved']==1): ?>
			<div id="default-message" class="updated notice notice-success is-dismissible " ><p>Changes were saved</p></div>
		<?php endif; ?>
		<div class="create-title">
			<div >
				<h1 class="title-crud"> Create new social buttons </h1>
			</div>
			<div id="titlediv" class="title-input">
				<div id="titlewrap">
					<label class="screen-reader-text" id="title-prompt-text" for="title">Enter title here</label>
					<input type="text" name="post_title" size="30" value="<?php echo esc_attr(@$data['title']) ?>" id="title" class="sgmb-title" required="required" spellcheck="true" autocomplete="off" placeholder="Enter title here" />
				</div>
				<div class="inside">
					<div id="edit-slug-box" class="hide-if-no-js">
					</div>
				</div>
			</div>
		</div>
		<div>
		<div class="wrapper">
			<div class="sgmbLivePreview" id="sgmbLivePreview">
				<h1>Live preview</h1>
				<div class="sgmbWidget<?php echo esc_attr(@$data['id']); ?>-1">
					<div class="sgmbShare" id="sgmbShare<?php echo esc_attr(@$data['id']); ?>-1"></div>
				</div>
				<?php if($data): ?>
				<div class="conteiner-shortcode-inside-livePreview">
					<span class="shortcode-title-inside-livePreview">Shortcode: </span>
					<span class="sgmb-shortcode">[sgmb id=<?php echo esc_attr(@$data['id']); ?>] </span>
				</div>
				<?php endif;?>
				<div class="dropdownWrapper dropdownWrapper<?php echo esc_attr(@$data['id']); ?> dropdownWrapper-for-livePreview ">
					<div class="dropdownLabel"><span class="sgmbButtonListLabel<?php echo esc_attr(@$data['id']); ?>">Share List</span> </div>
					<div class="dropdownPanel  dropdownPanel<?php echo esc_attr(@$data['id']); ?>-1">
					</div>
				</div>
			</div>

			<?php global $SGMB_BUTTON_FONT_SIZE, $SGMB_WIDGET_THEMES, $SGMB_SOCIAL_BUTTONS, $SGMB_ADVANCED_NAME_SOCIAL_BUTTONS_PRO,
				$SGMB_WIDGET_EFFECTS, $SGMB_ADVANCED_NAME_SOCIAL_BUTTONS, $SGMB_FONT_SIZE_FOR_SHARE_LIST, $SGMB_POSITIONS; ?>
			<div id="sgmb-create-button-wizard" class="sgmb-create-button-wizard">
				<ul>
					<li>
						<a href="#step-1">
							<label class="stepNumber">1</label>
							<span class="stepDesc">
								Template<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-2">
							<label class="stepNumber">2</label>
							<span class="stepDesc">
								Social Buttons<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-3">
							<label class="stepNumber">3</label>
							<span class="stepDesc">
								Button Style<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-4">
							<label class="stepNumber">4</label>
							<span class="stepDesc">
								Display Buttons On<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-5">
							<label class="stepNumber">5</label>
							<span class="stepDesc">
								Position Of Buttons<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-6">
							<label class="stepNumber">6</label>
							<span class="stepDesc">
								Share Url<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-7">
							<label class="stepNumber">7</label>
							<span class="stepDesc">
								Effects<br />
							</span>
						</a>
					</li>
					<li>
						<a href="#step-8">
							<label class="stepNumber">8</label>
							<span class="stepDesc">
								Google Analytics<br />
							</span>
						</a>
					</li>
				</ul>
				<div id="step-1">
					<h2 class="StepTitle">Step 1 Template</h2>
					<div class='sgmb-buttons-position-div create-button-wizard-content'>
						<div class="sgmb-margin-left-10">
							<?php foreach ($SGMB_WIDGET_THEMES as $theme => $sgmbIsPro):  ?>
								<?php if($sgmbIsPro != 1 && SGMB_PRO != 1): ?>
									<div class="sgmb_radio">
										<div class="sgmb_image_radio sgmb-image-radio-content sgmb-padding-right-30" data-field="<?=$theme?>">
											<span class="checkbox-image theme-checkbox-image">
												<?php foreach ($buttonsForThemesShowed as $button): ?>
													<?php if($button != 'fbLike' && $button != 'twitterFollow'): ?>
														<img src="<?php echo SGMB_URL."/img/"."$theme"."$button".".png"?>" class="img-for-theme">
													<?php endif; ?>
												<?php endforeach; ?>
											</span>
											<span class="checkbox-state sgmb-padding-right-30"><i class="fa fa-lg fa-check-circle sgmb-margin-left-30"></i></span>
											<input type="radio" name="theme" id="sgmb_options_<?=$theme?>" value="<?php echo esc_attr($theme); ?>"
												<?php if(empty($data['options']['theme']) && $theme =='classic'): ?>
													checked
												<?php endif; ?>
												<?php if( @$data['options']['theme'] ==  $theme ): ?>
													checked
												<?php endif; ?>
											>
										</div>
									</div>
								<?php endif;?>
							<?php endforeach; ?>
							<div>
								<span class="pro-themes-title">The Following Themes Are</span><a href="<?php echo SGMB_PRO_URL; ?>" target="_blank" class="sgmb-pro-label">PRO</a>
							</div>
							<?php foreach ($SGMB_WIDGET_THEMES as $theme => $sgmbIsPro):  ?>
								<?php if($sgmbIsPro == 1 && SGMB_PRO != 1): ?>
									<div class="sgmb_radio">
										<div class="sgmb_image_radio_pro sgmb-padding-right-30" data-field="<?=$theme?>">
											<span class="checkbox-image theme-checkbox-image">
												<?php foreach ($buttonsForThemesShowed as $button): ?>
													<?php if($button != 'fbLike' && $button != 'twitterFollow'): ?>
														<img src="<?php echo SGMB_URL."/img/"."$theme"."$button".".png"?>" class="img-for-theme">
													<?php endif; ?>
												<?php endforeach; ?>
											</span>
										</div>
									</div>
								<?php endif;?>
							<?php endforeach; ?>
							<input name = "socialTheme" type="hidden" value="<?php echo esc_attr(@$data['options']['socialTheme']); ?>">
							<input name = "logo" type="hidden" value="<?php echo esc_attr(@$data['options']['icon']); ?>">
						</div>
					</div>
				</div>
				<div id="step-2">
					<h2 class="StepTitle">Step 2 Social Buttons</h2>
					<div class="create-button-wizard-content sgmb-options-container">
						<ul class="sgmb-main-network-order" id="sgmb-main-network-list">
							<?php foreach ($socialButtons as $socialButton => $socialButtonName): ?>
								<li class="sgmb-network-select"  id="">
									<span>
										<input type="checkbox" value="facebook" class="sgmb-clickable-order js-social-btn-status" data-social-button="<?php echo esc_attr($socialButton); ?>">
										<span class="sgmb_icon fa fa-<?=$socialButton?>"></span>
										<span class="sgmb-sns-name"><?=$socialButtonName?></span>
										<?php if ($socialButton == 'twitter' || $socialButton == 'fbLike' || $socialButton == 'twitterFollow'): ?>
											<a href="#<?=$socialButton?>-more-options" rel="modal:open" class="<?=$socialButton?>-more-opt-link">More</a>
										<?php endif;?>
										<input type="checkbox" checked="checked" style="display:none;">
										<?php
											$sgmbAddNewSection = new SgmbAddNewSection();
											$sgmbAddNewSection->renderOptions($socialButton);
										?>
									</span>
								</li>
							<?php endforeach; ?>
							<?php foreach ($SGMB_ADVANCED_NAME_SOCIAL_BUTTONS_PRO as $socialButton => $socialButtonName): ?>
								<li class="sgmb-network-select"  id="">
									<span>
										<input type="checkbox" disabled="disabled">
										<span class="sgmb_icon fa fa-<?=$socialButton?>"></span>
										<span class="sgmb-sns-name"><?=$socialButtonName?></span>
										<a href="<?php echo SGMB_PRO_URL; ?>" target="_blank" class="pro-buttons-label">PRO</a>
										<?php
											$sgmbAddNewSection = new SgmbAddNewSection();
											$sgmbAddNewSection->renderOptions($socialButton);
										?>
									</span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div id="step-3">
					<h2 class="StepTitle">Step 3 Button Style</h2>
					<div class="create-button-wizard-content">
						<div>
							<?php
								$fieldName = "sgmbSocialButtonSize";
								$classes = "sgmb-font-size-selector";
							?>
							<span class="sgmb-label-checkbox">Font size:</span>
							<?php echo SgmbAddNewSection::createSelect($fieldName, $SGMB_BUTTON_FONT_SIZE, @$data, 'fontSize', '', false, $classes); ?>
						</div>
						<div class="sgmb-checkbox">
							<span class="sgmb-label-checkbox">Use round buttons:</span>
							<input type="checkbox" name="roundButton" id="checkbox-round-buttons"
							<?php if(@$data['options']['roundButton'] == 'on'): ?>
							checked
							<?php endif; ?>>
						</div>
						<div class="sgmb-checkbox">
							<span class="sgmb-label-checkbox">Show labels:</span>
							<?php $checked = "checked";?>
							<?php
								if(isset($data['options']['showLabels']) && $data['options']['showLabels'] == '') {
									$checked = "";
								}
							?>
							<input type="checkbox" id="checkbox-show-labels"name="showLabels" <?php echo $checked ?> >
						</div>
						<div class="sgmb-checkbox">
							<span class="sgmb-label-checkbox">Show counts:</span>
							<input type="checkbox" name="showCounts" id="checkbox-show-counts"
							<?php if(@$data['options']['showCounts'] == 'on'): ?>
								checked
							<?php endif; ?>>
						</div>
						<div class="sgmb-checkbox">
							<span class="sgmb-label-checkbox">Center Buttons:</span>
							<input type="checkbox" name="showCenter" id="checkbox-show-counts"
							<?php if(@$data['options']['showCenter'] == 'on'): ?>
								checked
							<?php endif; ?>>
						</div>
						<div class="sgmb-checkbox">
							<span class="sgmb-label-checkbox">Space between buttons:</span>
							<input class="sgmb-betweenButtons"  type='text' name="betweenButtons"
								<?php if( @$data['options']['betweenButtons'] == ''): ?>
									value="1px"
								<?php else: ?>
									value="<?php echo esc_attr(@$data['options']['betweenButtons']); ?>"
								<?php endif;?>
							>
						</div>
						<div class="sgmb-checkbox">
							<span class="sgmb-label-checkbox">Toggle dropdown to show buttons:</span>
							<input type="checkbox" name="showButtonsAsList" id="checkbox-show-widget-in-dropdown"
								<?php if(@$data['options']['showButtonsAsList'] == 'on'): ?>
								checked
								<?php endif; ?>
							>
						</div>
						<div class="sgmb-dropdown-color sgmb-dropdown-advance-options">
							<span class="sgmb-changeColor-label">Change button color:</span>
							<div id="color-picker" class="div-color-picker">
								<?php if(SGMB_PRO != 1): ?>
									<div class="div-for-free-color-picker"></div>
								<?php endif;?>
								<input  class="sgmbDropdownColor" id="sgmbDropdownColor" type="text" name="sgmbDropdownColor" value="<?php echo esc_attr(@$data['options']['sgmbDropdownColor']) ?>" />
							</div>
							<?php if(SGMB_PRO != 1): ?>
								<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual">PRO</a>
							<?php endif;?>
						</div>
						<div class="sgmb-dropdown-label-color sgmb-dropdown-advance-options" disabled='true'>
							<span class="sgmb-changeColor-label">Change label color:</span>
							<div id="color-picker" class="div-color-picker">
								<?php if(SGMB_PRO != 1): ?>
									<div class="div-for-free-color-picker"></div>
								<?php endif;?>
								<input  class="sgmbDropdownLabelColor" id="sgmbDropdownLabelColor" type="text"  name="sgmbDropdownLabelColor" value="<?php echo esc_attr(@$data['options']['sgmbDropdownLabelColor']) ?>" />
							</div>
							<?php if(SGMB_PRO != 1): ?>
								<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual">PRO</a>
							<?php endif;?>
						</div>
						<div class="sgmb-dropdown-advance-options">
							<?php
								$fieldName = "sgmbDropdownLabelFontSize";
								$classes = "selectOption";
							?>
							<span class="sgmb-label-checkbox">Label font size:</span>
							<?php echo SgmbAddNewSection::createSelect($fieldName, $SGMB_FONT_SIZE_FOR_SHARE_LIST, @$data, 'sgmbDropdownLabelFontSize', '', false, $classes); ?>
						</div>
					</div>
				</div>
				<div id="step-4">
					<h2 class="StepTitle">Step 4 Display Buttons On</h2>
					<div  class="create-button-wizard-content">
						<div class="sgmb-inline">
							<span class="sgmb-label-checkbox">Show Buttons On All Posts:</span>
							<?php if(@$data['id'] != get_option( 'SGMB_SHARE_BUTTON_ID' )) { @$data['options']['showButtonsOnEveryPost'] = ''; } ?>
							<input type="checkbox" name="showButtonsOnEveryPost"
							<?php if(@$data['options']['showButtonsOnEveryPost'] == 'on'): ?>
								checked
							<?php endif; ?>>
						</div>
						<div class="sgmb-margin-left-18 sgmb-inline-table showEveryPostOptions">
							<div class="sgmb-margin-bottom-20">
								<span class="sgmb-label-checkbox sgmb-display-btn-options-label">Text before the sharing buttons:</span>
								<input class="sgmb-textOnEveryPost sgmb-input"  type='text' name="textOnEveryPost" value="<?php echo esc_attr(@$data['options']['textOnEveryPost']); ?>" >
							</div>

							<div class="sgmb-selctor-position-every-post sgmb-select-posts">
								<input type="radio" name="selected-or-excluded-posts" value="selected"
									<?php if(@$data['options']['selectedOrExcluded'] == 'selected'): ?>
										checked
									<?php endif; ?>
								>
								<span class="sgmb-label-selected-posts">Select Posts:</span>
								<input type="hidden" class="sgmb-all-selected-post" name="sgmb-all-selected-post" value="">
								<?php
									$classes = 'sgmb-input';
									$args = array('posts_per_page' => -1); // Set to -1 to remove the limit, default 5
									$posts = get_posts($args);
									foreach ($posts as $post) {
										$selectedKeys[$post->ID] = $post->post_title;
									}
									echo SgmbAddNewSection::createMultiSelect('sgmbSelectedPosts', $selectedKeys, @$data, $classes);
								?>
							</div>
							<div class="sgmb-selctor-position-every-post sgmb-exclude-posts">
								<input type="radio" name="selected-or-excluded-posts" value="excluded"
									<?php if(@$data['options']['selectedOrExcluded'] == 'excluded'): ?>
										checked
									<?php endif; ?>
								>
								<span class="sgmb-label-selected-posts">Exclude Posts:</span>
								<input type="hidden" class="sgmb-all-excluded-post" name="sgmb-all-excluded-post" value="">
								<?php
									$classes = 'sgmb-input';
									$args = array('posts_per_page' => -1); // Set to -1 to remove the limit, default 5
									$posts = get_posts($args);
									foreach ($posts as $post) {
										$selectedKeys[$post->ID] = $post->post_title;
									}
									echo SgmbAddNewSection::createMultiSelect('sgmbExcludedPosts', $selectedKeys, @$data, $classes);
								?>
							</div>
						</div><br>
						<div class="sgmb-inline">
							<span class="sgmb-label-checkbox sgmb-margin-top-25">Show Buttons On All Custom Posts:</span>
							<?php if(@$data['id'] != get_option( 'SGMB_SHARE_BUTTON_ID' )) { @$data['options']['showButtonsOnEveryPost'] = ''; } ?>
							<input type="checkbox" name="showButtonsOnCustomPost"
							<?php if(@$data['options']['showButtonsOnCustomPost'] == 'on'): ?>
								checked
							<?php endif; ?>
							<?php if(SGMB_PRO != 1): ?>
								disabled>
								<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual" target="_blanck">PRO</a>
							<?php else: ?>
								>
							<?php endif; ?>
						</div><br>
						<div class="sgmb-inline">
							<span class="sgmb-label-checkbox sgmb-margin-top-25">Show Buttons On All Pages:</span>
							<?php if(@$data['id'] != get_option( 'SGMB_BUTTON_ID_FOR_EVERY_PAGE' )) { @$data['options']['showButtonsOnEveryPage'] = ''; } ?>
							<input type="checkbox" name="showButtonsOnEveryPage"
							<?php if(@$data['options']['showButtonsOnEveryPage'] == 'on'): ?>
								checked
							<?php endif; ?>
							<?php if(SGMB_PRO != 1): ?>
								disabled>
								<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual" target="_blanck">PRO</a>
							<?php else: ?>
								>
							<?php endif; ?>
						</div><br>
						<div class="sgmb-show-in-popup sgmb-inline">
							<span class="sgmb-label-checkbox sgmb-margin-top-25">Show Buttons Inside a Popup:</span>
							<input type="checkbox" name="showButtonsInPopup"
							<?php if(@$data['options']['showButtonsInPopup'] == 'on'): ?>
								checked
							<?php endif; ?>
							<?php if(SGMB_PRO != 1): ?>
								disabled>
								<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual">PRO</a>
							<?php else: ?>
								>
							<?php endif; ?>
						</div>
						<div class="show-mobile-direct">
							<div>
								<span class="sgmb-label-checkbox">Show Buttons On Mobile:</span>
								<input type="checkbox" name="showButtonsOnMobileDirect"
								<?php if(@$data['options']['showButtonsOnMobileDirect'] == 'on' || @$data['id'] == null): ?>
									checked
								<?php endif; ?>
								<?php if(SGMB_PRO != 1): ?>
									disabled>
									<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual">PRO</a>
									<input type="hidden" name="showButtonsOnMobileDirect" value="on">
								<?php else: ?>
									>
								<?php endif; ?>
							</div>
						</div>
						<div class="show-mobile-direct">
							<div>
								<span class="sgmb-label-checkbox">Show Buttons On Desktop:</span>
								<input type="checkbox" name="showButtonsOnDesktopDirect"
								<?php if(@$data['options']['showButtonsOnDesktopDirect'] == 'on' || @$data['id'] == null): ?>
									checked
								<?php endif; ?>
								<?php if(SGMB_PRO != 1): ?>
									disabled>
									<a href="<?php echo SGMB_PRO_URL; ?>" class="sgmb-pro-label-for-visual">PRO</a>
									<input type="hidden" name="showButtonsOnDesktopDirect" value="on">
								<?php else: ?>
									>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div id="step-5">
					<h2 class="StepTitle">Step 5 Position Of Buttons</h2>
					<div class='sgmb-buttons-position-div create-button-wizard-content'>
						<div class="sgmb-margin-left-10">
							<?php foreach ($SGMB_POSITIONS as $position => $posName):  ?>
								<div class="sgmb_radio">
									<div class="sgmb_image_radio" data-field="<?=$position?>">
										<span class="checkbox-image">
											<img src="<?php echo SGMB_URL."img/positions/"."$position".".png"?>">
										</span>
										<span class="checkbox-state"><i class="fa fa-lg fa-check-circle"></i></span>
										<input type="radio" id="sgmb_options_<?=$position?>" name="sgmb-buttons-position" value="<?=$position?>"
											<?php if(!isset($data['options']['sgmbButtonsPosition']) && $position == 'topLeft'): ?>
												checked="checked"
											<?php endif;?>
											<?php if(@$data['options']['sgmbButtonsPosition'] ==  $position): ?>
												 checked="checked"
											<?php endif; ?>
										>
									</div>
									<div class="sgmb_radio_label" style="width: 160px;"><?=$posName?></div>
								</div>
							<?php endforeach; ?>
							<div>
								<span class="pro-themes-title">The Floating Positions Are</span><a href="<?php echo SGMB_PRO_URL; ?>" target="_blank" class="sgmb-pro-label">PRO</a>
							</div>
							<?php foreach ($SGMB_FLOAT_POSITIONS as $position => $posName):  ?>
								<div class="sgmb_radio_pro">
									<div class="sgmb_image_radio_pro" data-field="<?=$position?>">
										<span class="checkbox-image">
											<img src="<?php echo SGMB_URL."img/positions/"."$position".".png"?>">
										</span>
									</div>
									<div class="sgmb_radio_label" style="width: 160px;"><?=$posName?></div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div id="step-6">
					<h2 class="StepTitle">Step 6 Share Url</h2>
					<div class="create-button-wizard-content">
						<h3>Share the following url:</h3>
						<div class="sgmb-margin-bottom-20">
							<input type="radio" name="currentUrl" value="1" <?php if( @$data['options']['currentUrl'] != '0' ): ?>checked<?php endif; ?> >
							<span class="">Current Page Url</span>
							<i class="fa fa-info sgmb-margin-left-20 share-url-info" title="This is the page URL on which your buttons are." ></i>
						</div>
						<div class="sgmb-margin-bottom-20">
							<input type="radio"   value="0" name="currentUrl" <?php if(@$data['options']['currentUrl'] == '0'): ?>checked<?php endif; ?> >
							<span class="custom-url-label">Custom Url:</span>
							<input id="inputUrl" name="url" class="js-url-input custom-url-input" type="text" value="<?php echo @$data['options']['url'] ?>">
							<i class="fa fa-info sgmb-margin-left-20 share-url-info" title="You can add any URL to be shared, no matter on which page your buttons are." ></i>
						</div>
						<div class="div-share-text">
							<span class="sgmb-label-share-text">Your share text:</span>
							<input id="shareText" name="shareText" class="js-share-text-input" type="text" value="<?php echo @$data['options']['shareText'] ?>">
						</div>
					</div>
				</div>
				<div id="step-7">
					<h2 class="StepTitle">Step 7 Effects</h2>
					<div class="create-button-wizard-content">
						<?php
							$buttonsPanelEffect = "buttonsPanelEffect";
							$buttonsEffect = "buttonsEffect";
							$iconsEffect = "iconsEffect";
							$classes = "selectOption";
						?>
						<div class="sgmbEffectsContent sgmb-margin-bottom-20">
							<span class="sgmbEffectsLabel">Panel effect type:</span>
							<?php echo SgmbAddNewSection::createSelect($buttonsPanelEffect, $SGMB_WIDGET_EFFECTS, @$data, $buttonsPanelEffect, '', false, $classes); ?>
						</div>
						<div class="sgmbEffectsContent sgmb-margin-bottom-20">
							<span class="sgmbEffectsLabel">Button hover effects:</span>
							<?php echo SgmbAddNewSection::createSelect($buttonsEffect, $SGMB_WIDGET_EFFECTS, @$data, 'buttonsEffect', '', true, $classes); ?>
						</div>
						<div class="sgmbEffectsContent sgmb-margin-bottom-20">
							<span class="sgmbEffectsLabel">Icon hover effects:</span>
							<?php echo SgmbAddNewSection::createSelect($iconsEffect, $SGMB_WIDGET_EFFECTS, @$data, 'iconsEffect', '', true, $classes); ?>
						</div>
					</div>
				</div>
				<div id="step-8">
					<h2 class="StepTitle">Step 8 <span class="sgmb-color-green">Google Analytics Is A <a href="<?php echo SGMB_PRO_URL; ?>" target="_blank" class="sgmb-ga-pro-label">PRO</a> Feature.</span></h2>
					<div class="create-button-wizard-content">
						<div class="sgmb-title-analytics sgmb-color-green">
							<span>Why and How to use</span>
						</div>
						<div class="sgmb-text-about-analytics">
							<span>This tool will help you to track the number of clicks on your social buttons from every page they are on.So you will know how many times your buttons are clicked.</span>
						</div>
						<div class="sgmb-text-about-analytics">
							<span>
							The only thing you need to do is to create an account in  <a href="https://analytics.google.com" target="_blank" class="sgmb-color-green">Google Analytics</a>. After, simply insert the account number into the <a href="https://support.google.com/analytics/answer/1032385?hl=en" class="sgmb-color-green" target="_blank">"Set Account Number" </a> field.
							</span>
						</div>
						<div class="">
							<span class="sgmb-analytics-options-label">Set Account Number:</span>
							<input class="" disabled="disabled" type='text' name="googleAnaliticsAccount" value="<?php echo esc_attr(@$data['options']['googleAnaliticsAccount']); ?>" >
						</div>
						<div class="sgmb-text-about-analytics">
							<span>
							As a result, you will have the statistics of your social buttons clicks on Google Analytics, like in the picture below.
							</span>
						</div>
						<div class="sgmb-text-about-analytics">
							<img src="<?php echo SGMB_URL."/img/analytics.png"; ?>" class="sgmb-image-analytics">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<script>
jQuery(document).ready(function($){
	var data = <?php echo json_encode($data); ?>;
	var sgmbIsPro = <?php echo SGMB_PRO; ?>;
	sgmb = new SGMB();
	sgmb.init(data, sgmbIsPro);
	var widget = new SGMBWidget();
	widget.setShareUrl("<?php echo esc_url(SGMB_DEFAULT_SHARE_URL); ?>");
	var lp = sgmb.getLivePreview();
	lp.setWidget(widget);
	widget.show(data, 1, '1');
});
SGMB_URL = "<?php echo esc_url(SGMB_URL); ?>";
</script>
