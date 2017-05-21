<?php

class SGMBButton
{
	public $id;
	public $title;
	public $options = array();

	public function init()
	{
		add_action('admin_post_save_button',array($this,'widgetSave'));
		add_action('wp_ajax_delete_button', array($this,'widgetDelete'));
		add_action('wp_ajax_clone_button', array($this,'widgetClone'));
		add_action('admin_post_export_button', array($this,'exportButtons'));
		add_action('wp_ajax_close_review_panel', array($this,'closeReviewPanel'));
		add_action('wp_ajax_import_buttons', array($this,'importButtons'));
	}

	public function exportButtons()
	{
		$allButtons = self::findAll();
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"sgmb-export-data.txt\";" );
		header("Content-Transfer-Encoding: binary");
		echo serialize($allButtons);
	}

	public function importButtons()
	{
		global $wpdb;
		$url = $_POST['attachmentUrl'];
		$contents = unserialize(file_get_contents($url));
		foreach ($contents as $content) {
			$title = $content->title;
			$options = $content->options;
			$sql = $wpdb->prepare("INSERT INTO ".$wpdb->prefix.'sgmb_widget'."(title, options) VALUES (%s, %s)", $title, $options);
			$res = $wpdb->query($sql);
			echo 'MainRes: '.$res;
		}
	}

	public function closeReviewPanel()
	{
		update_option('SGMB_MEDIA_REVIEW_PANEL', 1);
	}

	public function widgetDelete()
	{
		check_ajax_referer('sgmb-delete-action');
		$id = intval($this->sanitize('button_id'));
		if (!$id) {
			return;
		}
		self::delete($id);
	}

	public function widgetClone()
	{
		check_ajax_referer('sgmb-clone-action');
		$id = intval($this->sanitize('button_id'));
		if (!$id) {
			return;
		}
		$data = self::findById($id);
		$this->setTitle($data->getTitle());
		$this->setOptions($data->getOptions());
		$this->save();
	}

	public function sanitize($optionsKey)
	{
		if (isset($_POST[$optionsKey])) {
			if($optionsKey == 'url' && $_POST['currentUrl'] == 1) {
				return '';
			}
			return sanitize_text_field($_POST[$optionsKey]);
		}
		else {
			return "";
		}
	}

	public function widgetSave()
	{
		//CSRF check
		if(!check_admin_referer('save_button', 'wp-nonce-token')) {
			wp_die('Security check fail');
		}
		$options = array();
		$buttons = array();
		$selectedPosts = array();
		$sgmbSelectedCustomPosts = array();

		if(isset($_POST['sgmbSelectedCustomPosts'])) {
			foreach ($_POST['sgmbSelectedCustomPosts'] as  $post) {
				$sgmbSelectedCustomPosts[] = sanitize_text_field($post);
			}
		}

		$sgmbSelectedPosts = explode(",", $this->sanitize('sgmb-all-selected-post'));
		$sgmbSelectedPages = explode(",", $this->sanitize('sgmb-all-selected-page'));
		$sgmbExcludedPosts = explode(",", $this->sanitize('sgmb-all-excluded-post'));

		$button = explode(',',sanitize_text_field($_POST['button']));
		foreach ($button as $value) {
			if($value == 'twitterFollow') {
				$buttons[$value] = array(
					'twitterFollowShowCounts'=>$this->sanitize('twitterFollowShowCounts'),
					'setLargeSizeForTwitterFollow'=>$this->sanitize('setLargeSizeForTwitterFollow'),
					'followUserName'=>$this->sanitize('followUserName')
				);
			}
			else {
				if($value == 'fbLike') {
					$buttons[$value] = array(
						'fbLikeLayout'=>$this->sanitize('fbLikeLayout'),
						'fbLikeActionType'=>$this->sanitize('fbLikeActionType'),
						'fbLikeUrl'=>$this->sanitize('fbLikeUrl')
					);
				}
				else {
					if($value == 'twitter') {
						$buttons[$value] = array(
							'label'=> $this->sanitize('label'.$value),
							'icon' => $this->sanitize('logo').'-'.$value,
							'via'=>$this->sanitize('via'),
							'hashtags'=>$this->sanitize('hashtags')
						);
					}
					else {
						$buttons[$value] = array(
							'label'=> $this->sanitize('label'.$value),
							'icon' => $this->sanitize('logo').'-'.$value
						);
					}
				}
			}
		}

		$shareText = htmlentities(stripslashes(@$_POST['shareText']), ENT_QUOTES);
		$_POST['shareText'] = $shareText;
		$options = array(
			'currentUrl'  => $this->sanitize('currentUrl'),
			'url'=>$this->sanitize('url'),
			'shareText'=>$this->sanitize('shareText'),
			'fontSize' => $this->sanitize('sgmbSocialButtonSize'),
			'betweenButtons' => $this->sanitize('betweenButtons'),
			'theme' => $this->sanitize('theme'),
			'sgmbButtonsPosition' => $this->sanitize('sgmb-buttons-position'),
			'socialTheme' => $this->sanitize('socialTheme'),
			'icon' => $this->sanitize('logo'),
			'buttonsPanelEffect' => $this->sanitize('buttonsPanelEffect'),
			'buttonsEffect' => $this->sanitize('buttonsEffect'),
			'iconsEffect' => $this->sanitize('iconsEffect'),
			'buttons' =>json_encode($buttons),
			'roundButton' => $this->sanitize('roundButton'),
			'showLabels' => $this->sanitize('showLabels'),
			'showCounts' => $this->sanitize('showCounts'),
			'showCenter' => $this->sanitize('showCenter'),
			'showButtonsAsList' => $this->sanitize('showButtonsAsList'),
			'sgmbDropdownColor' => $this->sanitize('sgmbDropdownColor'),
			'sgmbDropdownLabelFontSize' => $this->sanitize('sgmbDropdownLabelFontSize'),
			'sgmbDropdownLabelColor' => $this->sanitize('sgmbDropdownLabelColor'),
			'theme' => $this->sanitize('theme'),
			'showButtonsOnEveryPost' => $this->sanitize('showButtonsOnEveryPost'),
			'selectedOrExcluded' => $this->sanitize('selected-or-excluded-posts'),
			'showButtonsOnEveryPage' => $this->sanitize('showButtonsOnEveryPage'),
			'textOnEveryPost' => $this->sanitize('textOnEveryPost'),
			'showButtonsOnCustomPost' => $this->sanitize('showButtonsOnCustomPost'),
			'textOnCustomPost' => $this->sanitize('textOnCustomPost'),
			'showButtonsOnMobileDirect' => $this->sanitize('showButtonsOnMobileDirect'),
			'showButtonsOnDesktopDirect' => $this->sanitize('showButtonsOnDesktopDirect'),
			'sgmbSelectedPosts' => $sgmbSelectedPosts,
			'sgmbSelectedPages' => $sgmbSelectedPages,
			'sgmbExcludedPosts' => $sgmbExcludedPosts,
			'sgmbSelectedCustomPosts' => $sgmbSelectedCustomPosts,
			'showButtonsInPopup' => $this->sanitize('showButtonsInPopup'),
			'titleOfPopup' => $this->sanitize('titleOfPopup'),
			'descriptionOfPopup' => $this->sanitize('descriptionOfPopup'),
			'showPopupOnLoad' => $this->sanitize('showPopupOnLoad'),
			'showPopupOnScroll' => $this->sanitize('showPopupOnScroll'),
			'showPopupOnExit' => $this->sanitize('showPopupOnExit'),
			'openSecondsOfPopup' => $this->sanitize('openSecondsOfPopup'),
			'googleAnaliticsAccount' => $this->sanitize('googleAnaliticsAccount')
		);

		$id = $this->sanitize('hidden_button_id');
		$title = $this->sanitize('post_title');
		$jsonDataArray = json_encode($options);
		$this->setTitle($title);
		$this->setId($id);
		$this->setOptions($jsonDataArray);
		$this->backwardCompatibilityConvertation($id);
		$this->save();
		$id = $this->getId();
		$optionsAsArray = json_decode($this->getOptions(), true);

		if(@$optionsAsArray['showButtonsOnEveryPost'] == 'on') {
			update_option('SGMB_SHARE_BUTTON_ID', $id);
		}
		if(@$optionsAsArray['showButtonsOnCustomPost'] == 'on') {
			update_option('SGMB_BUTTON_ID_FOR_CUSTOM_POST', $id);
		}
		if(@$optionsAsArray['showButtonsOnEveryPage'] == 'on') {
			update_option('SGMB_BUTTON_ID_FOR_EVERY_PAGE', $id);
		}
		wp_redirect(SGMB_ADMIN_URL."admin.php?page=create-button&id=$id&saved=1");
		exit();
	}

	public function backwardCompatibilityConvertation($id)
	{
		$result = false;
		if ($id) {
			$result = SGMBButton::findById($id);
		}

		if ($result) {
			$data = json_decode($result->getOptions(), true);
		}

		if (isset($data['sgmbPostionOnEveryPost']) && $data['sgmbPostionOnEveryPost'] != null) {
			$optionsAsArray = json_decode($this->getOptions(), true);
			switch (@$data['sgmbPostionOnEveryPost']) {
				case 'Left':
					$optionsAsArray['sgmbButtonsPosition'] = 'bottomLeft';
					break;
				case 'Center':
					$optionsAsArray['sgmbButtonsPosition'] = 'bottomCenter';
					break;
				case 'Right':
					$optionsAsArray['sgmbButtonsPosition'] = 'bottomRight';
					break;
			}
			$jsonDataArray = json_encode($optionsAsArray);
			$this->setOptions($jsonDataArray);
		}
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setOptions($options)
	{
		$this->options = $options;
	}

	public function getOptions()
	{
		return $this->options;
	}

	public static function getDataList()
	{
		global $wpdb;
		$arr = $wpdb->get_results("SELECT id,title FROM ". $wpdb->prefix ."sgmb_widget " . "ORDER BY id DESC" ,ARRAY_A);
		if(!$arr) return false;
		return $arr;
	}

	public static function findById($id)
	{
		global $wpdb;
		$st = $wpdb->prepare("SELECT * FROM ". $wpdb->prefix ."sgmb_widget WHERE id = %d",$id);
		$arr = $wpdb->get_row($st,ARRAY_A);
		if(!$arr) return false;
		return self::buttonObjectFromArray($arr);
	}

	public static function findAll($orderBy = null, $limit = null, $offset = null) {

		global $wpdb;
		$query = "SELECT * FROM ". $wpdb->prefix ."sgmb_widget";
		if ($orderBy) {
			$query .= " ORDER BY ".$orderBy;
		}
		if ($limit) {
			$query .= " LIMIT ".intval($offset).','.intval($limit);
		}
		$buttons = $wpdb->get_results($query, ARRAY_A);
		$arr = array();
		foreach ($buttons as $button) {
			$arr[] = self::buttonObjectFromArray($button);
		}
		return $arr;
	}

	private static function buttonObjectFromArray($arr, $obj = null)
	{
		$jsonData = json_decode($arr['options'], true);
		if ($obj===null) {
			$obj = new SGMBButton();
		}
		$obj->setTitle($arr['title']);
		$obj->setOptions($arr['options']);
		if (@$arr['id']) $obj->setId($arr['id']);
		return $obj;
	}

	public function save()
	{
		$id = $this->getId();
		$title = $this->getTitle();
		$options = $this->getOptions();
		global $wpdb;
		if(!$id) {
			$sql = $wpdb->prepare( "INSERT INTO ". $wpdb->prefix ."sgmb_widget (title, options)
		 		VALUES (%s,%s)", $title.'', ''.$options);
				$res = $wpdb->query($sql);
			if ($res) {
				$id = $wpdb->insert_id;
				$this->setId($id);
			}
			return $res;
		}
		else {
			$sql = $wpdb->prepare("UPDATE ". $wpdb->prefix ."sgmb_widget SET title=%s,options=%s WHERE id=%d", $title, $options, $id);
			$res = $wpdb->query($sql);
			if(!$wpdb->show_errors()) {
				$res = 1;
			}
			return $res;
		}
	}

	public static function delete($id)
	{
		global $wpdb;
		$wpdb->query(
			$wpdb->prepare("DELETE FROM ". $wpdb->prefix ."sgmb_widget WHERE id = %d", $id)
		);
	}
}
