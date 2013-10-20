<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gemmedia_meghanwalterWP');

/** MySQL database username */
define('DB_USER', 'gemmedia_mwWP');

/** MySQL database password */
define('DB_PASSWORD', 'wp_m3gh4n20120912');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '3Z3u9- ill.gOoK@`J,dvKd{4Cw&sayU8)#Emg+CSm!1m, Ib}oe*jG,T|=74BO]');
define('SECURE_AUTH_KEY',  'B^I1LpX_VUdtnQ=VCCt9!=nK)Pl@<}&,GYsv0M/{9R8<Fzre&5&p>!*FF~5%fn_W');
define('LOGGED_IN_KEY',    'W+%&@<8W+)j-eLBFzlu7wRJme.8n.@d)c?|bxD*OsZ5C5;vq+(wla-j&C-|rNI%{');
define('NONCE_KEY',        '=j$:)u< xrbadg54 e3L6( #GA=iENCT8ddAuw})%i8XeT[~1oU$;!!<Av@nOI1|');
define('AUTH_SALT',        '-F)sa9e>v~DMg.g&2tgyZqNm5Q-m}6om/)Sl19~o6+BpTS *_<^(df#`KAX/e1j+');
define('SECURE_AUTH_SALT', '-0GzXGM8qhe#r5c&M=_-G)hZXc*bi*S^l]]t|Rml2_.k1a2]7.=v=T{Dz[ry^A s');
define('LOGGED_IN_SALT',   'gPw6,> uug^_czk58+Bhg}5rB-RLt|NK:Dv1C9%~.5+v0%vb&Zx6:@L|Oqp+a;DA');
define('NONCE_SALT',       '^<|>si0y{--[m[L2L@I1w7-9Ul9O*oH~s=h%{=/P?gU7V{};-TMXe=XPV@qakea%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpmw_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
