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
define('DB_NAME', 'chuyenkhoaxuongkhop');

/** MySQL database username */
define('DB_USER', 'nhatnhat');

/** MySQL database password */
define('DB_PASSWORD', 'N4J1NH2@1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'VS*UA6>%v2/.R~RPHv>.]*Z@gJTKi)eGnWNDHgALh20x1kb_ocZ89@D=)|24.28X');
define('SECURE_AUTH_KEY',  'd(i2ER5/nW[+UuF8Q6_{s[mdt-126tC8Gn_(j=+;Pvx<o-%k+pBQWl Suxj1i#$+');
define('LOGGED_IN_KEY',    '!bD<k*:JnnBuk(7G162wb50aa))jdb2PXpM9harpr]cyYV;4ED&_bgY3*Mxomnu>');
define('NONCE_KEY',        '4ty,!Q&Iku+1pq/X^:U%L_{RJ`PKVh.#a$cBxQjRFF%r6a2Bsb{oa+w0I={YgUda');
define('AUTH_SALT',        'c;3hh?H<v9IZ]Qq_(,|3lM|n-3`e9GCk<JGsr)rSu$zL~0DY]Z8tU!O} my{@s&I');
define('SECURE_AUTH_SALT', 'Gk@<Cu5`;T~k*+u-rsFdv)&{& .y<X@V&ffQQ%QcIePx*yRNrHKaFc_+)fQo|MQ ');
define('LOGGED_IN_SALT',   'C;ArdJVAp8v])j(/Xp:q[U`V87:R(=Z^L%E#v%wK0ZNEMrqmg-/m`A60Y~>G;8rx');
define('NONCE_SALT',       ')F(>^bC~_M(?Xp^Q:rkF&3QuSE~a$Q$)9tc#D0ya:Ek`;mxm:!n$$:M>GsV<(|@N');

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
define('WP_HOME','http://chuyenkhoaxuongkhop.vn');
define('WP_SITEURL','http://chuyenkhoaxuongkhop.vn');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define ('WPLANG', 'vi_VI');