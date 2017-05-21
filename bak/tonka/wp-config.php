<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'xknn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l3EBA5SczUhw@qry*kv{7:xYa9]$6jLIyc#$Uool*8UbTTIl:i2*[al=xh:-4+Zt');
define('SECURE_AUTH_KEY',  'Bk[.ato:5}-Q*Zft=f.5qfS)!RxL&zeGxWvdJMgK}x@Kp{,aC?+;Qk__ ZYHN.%Z');
define('LOGGED_IN_KEY',    'Y}RTTX_#Tv9kXQA&^$o=0D*f3RC}j,[&lD9[uc_4R%LnTO ]llpDIc1+Mtw#{rc5');
define('NONCE_KEY',        'd+>MsPEre~?~fas(f#zJsxpYa+1|ky#8:?T$6)`xdxy% sEnhL}q2GO-]+Ud/ayY');
define('AUTH_SALT',        'Is5_xHn#P+Un*6_?]Y|a>mF:r!uvbiNY M3AU02AiN.L^ep0!tH6n}T%.?>$VKh^');
define('SECURE_AUTH_SALT', 'bhAW/>i&[>lLA&Hjkxe`]yYG(ZsIbtLGka<= :Z%Yi+>_2=zH~(X^KkMXB6HYa9Q');
define('LOGGED_IN_SALT',   'bO#.(WoJ%5hC[g<Y!,F~yw?7GgTZJYQw-u*<J*4I2%Tc!(;<u{qp=EL)-*{XYql6');
define('NONCE_SALT',       'Km^qc8.f/JzT+zyEG,O=,x-K-m<!jJL!m-}ib,wzWu5x7sRQfh.B++_Xav(!0,?b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
