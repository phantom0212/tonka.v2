<?php
define('SGMB_PATH', dirname(__FILE__).'/');
define('SGMB_URL', plugins_url('', __FILE__).'/');
define('SGMB_ADMIN_URL', admin_url());
define('SGMB_VIEW', SGMB_PATH.'view/');
define('SGMB_FILES', SGMB_PATH.'files/');
define('SGMB_CLASSES', SGMB_PATH.'classes/');
define('SGMB_LIBRARY', SGMB_PATH.'library/');
define('SGMB_TABLE_LIMIT', 15);
define('SGMB_SHARE_BUTTON_VERSION', '2.03');
define('SGMB_DEFAULT_SHARE_URL', "http://google.com");
define('SGMB_DEFAULT_THEME', "classic");
define('SGMB_PRO', 0); //  0 -> free, 1 -> pro
define('SGMB_PRO_URL', 'https://sygnoos.com/wordpress-social-media');

global $SGMB_BUTTON_FONT_SIZE;
global $SGMB_WIDGET_THEMES;
global $SGMB_SOCIAL_BUTTONS;
global $SGMB_WIDGET_EFFECTS;
global $SGMB_POSITIONS;
global $SGMB_FLOAT_POSITIONS;
global $SGMB_ADVANCED_NAME_SOCIAL_BUTTONS_PRO;
$SGMB_POSITIONS = array(
	'topLeft' => 'Top Left',
	'topCenter' => 'Top Center',
	'topRight' => 'Top Right',
	'bottomLeft' => 'Bottom Left',
	'bottomCenter' => 'Bottom Center',
	'bottomRight' => 'Bottom Right',
);

$SGMB_FLOAT_POSITIONS = array(
	'floatTopLeft' => 'Float Content From Top Left',
	'floatTopCenter' => 'Float Content From Top Center',
	'floatTopRight' => 'Float Content From Top Right',
	'floatBottomLeft' => 'Float Content From Bottom Left',
	'floatBottomCenter' => 'Float Content From Bottom Center',
	'floatBottomRight' => 'Float Content From Bottom Right',
	'floatLeft' => 'Float Content From Left',
	'floatRight' => 'Float Content From Right'
);

$SGMB_BUTTON_FONT_SIZE = array('8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28');
$SGMB_FONT_SIZE_FOR_SHARE_LIST = array('8', '10', '12', '14', '16', '18');
$SGMB_WIDGET_EFFECTS = array(
	'Free' => array(
		'No Effect',
		'flip'
	),
	'Pro' => array(
		'shake',
		'wobble',
		'swing',
		'flash',
		'bounce',
		'pulse',
		'rubberBand',
		'tada',
		'jello',
		'rotateIn',
		'fadeIn'
	)
);
$SGMB_SOCIAL_BUTTONS = array(
	'facebook',
	'twitter',
	'googleplus',
	'linkedin',
	'email',
	'pinterest',
	'fbLike',
	'twitterFollow',
	'whatsapp',
	'tumblr',
	'reddit',
	'line',
	'vk',
	'stumbleupon',
	'mewe'
);
$SGMB_ADVANCED_NAME_SOCIAL_BUTTONS = array(
	'facebook' => 'Facebook',
	'twitter' => 'Twitter',
	'googleplus' => 'Google Plus',
	'linkedin' => 'Linked In',
	'email' => 'E-mail',
	'pinterest' => 'Pinterest',
	'mewe' => 'MeWe',
);

$SGMB_ADVANCED_NAME_SOCIAL_BUTTONS_PRO = array(
	'fbLike' => 'Facebook Like',
	'twitterFollow' => 'Twitter Follow',
	'whatsapp' => 'Whats App',
	'tumblr' => 'Tumblr',
	'reddit' => 'Reddit',
	'line' => 'Line',
	'vk' => 'VK',
	'stumbleupon' => 'StumbleUpon'
);

$SGMB_WIDGET_THEMES = array(
	'classic' => 0, //  0 -> free
	'cloud' => 0,
	'wood' => 0,
	'toy' => 0,
	'box' => 0,
	'round' => 0,
	'flat' => 1, //  1 -> pro
	'silverround' => 1,
	'goodstaff' => 1,
	'heart' => 1,
	'round-dot' => 1,
	'hex' => 1,
	'cork' => 1,
	'pen' => 1,
	'black' => 1,
	'multi' => 1
);
