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
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/ecogood/domains/ecogoodies.nl/public_html/new/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'ecogood_uwjw1');

/** MySQL database username */
define('DB_USER', 'ecogood_uwjw1');

/** MySQL database password */
define('DB_PASSWORD', 'J&5pO*3hkPM0mVxMDG(89)(8');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_ALLOW_REPAIR', true); 

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ';$r^r$g!n5;z5=X6^o2Pkjfk;1*8-+u*@7&D^~AVHZW=h#v,S.bFS}|q$A:=Y&J~');
define('SECURE_AUTH_KEY',  'uH2SYk|QmFnBrLE~Y_+nK3edIzx4XT>nt2>Y3B10 *_at#nX&Rn{v5ExpiIE;+Bv');
define('LOGGED_IN_KEY',    '}I)cY4B{/rvyI3)7cO7[#mWDgVL^8uI<w/v7]!9.S#U<Np#B6Q}fQ/)x|FMQ4[J#');
define('NONCE_KEY',        'c~MSD?=Gw$4,-R#MgOzR,xdg*>DU:W9z/{t5#S#=^{DfGaOx5T#l{s^D-1RI?0v5');
define('AUTH_SALT',        ']M~K#B5j+4IKU.FTot^GX}8wp2aL~0~T*!&jOXfhqyBuZ1O0Tg #?9*VEI$f|f96');
define('SECURE_AUTH_SALT', 'upYozKe(7yy(>@t[t+#2wsz},IGYdM_dWkjW~;yt {BSc*4GL3b&|CF`_o1&A3q-');
define('LOGGED_IN_SALT',   '*naGhw`Q=L.P{0Kp_hK&#i)$$uKj@h:@emIO il`m04Ij~Hee9b(g6`ycx0GhR,&');
define('NONCE_SALT',       'mfE&tCnqL$OZki%576xfSUQZ8#k@*}tP5FG>x5;yyij;2l*m#q2Fe}@g?*=5#0dY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'u3sr_';

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

define('FORCE_SSL_ADMIN', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');