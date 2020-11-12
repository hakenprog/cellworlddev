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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'elrojo' );

/** MySQL database password */
define( 'DB_PASSWORD', '-7a&wtxQ-Z8P8t57' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         's}w9]m|7&M fJ8f!*%Xlg8Bs=>2CjU*8)T]n|fwB<P-1I+mD@V,23PJwRwZ`[gif' );
define( 'SECURE_AUTH_KEY',  '<.H8;,;qByEA+q&{qCS2WiF}3fiY2v A$q?X@G|O.=0{+M;20g#:&]@1Lc<G^-u7' );
define( 'LOGGED_IN_KEY',    '!YrGxAw_+]+%%hU]d^q1?8(dIB)X$iZ]1`^!XwQs.C|Gm^2K2|1Kq;I!3?i5#spH' );
define( 'NONCE_KEY',        'n`N>U [^RQQ05IB:y$O.#_>c:b,I{AgDwE0!*ml?LZ44;(Vd4h2NBaVKVkVsN:<C' );
define( 'AUTH_SALT',        '#.~=(K-ZLKobeH*X_-}Dvib+{t2#Zh~)%!8`@&bAco-VN)j[)Z?$u?8{6Hax|C<.' );
define( 'SECURE_AUTH_SALT', '&]5Cj}$S2Dq~&sS?е6Mx62gmq}2Y7h-Uzis-~-|<V*<eU!u!i6ion+aPC*E&]TBi' );
define( 'LOGGED_IN_SALT',   'HU(,:-h5=-eepO@7tP<`H@D=mA3jHD;kyNVWT~&-N`+33BfPTH0rDw0/VHO+0.$9' );
define( 'NONCE_SALT',       '-=Ce72!c=?!1&<pt/HHA|@9C}5]Kp<%L$~|-Y|[|gk5)s-D9QNyg%2DYADSr-taQ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
/** Sets up 'direct' method for wordpress, auto update without ftp */
define('FS_METHOD','direct');

define('FORCE_SSL_ADMIN', true);

