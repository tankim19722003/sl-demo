<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'b}j*ql8*h b_&aiJ@vYYI#&l9|D){al[uH!L`W?nz82X|5S)!]+h1u_)X=O1W&[a' );
define( 'SECURE_AUTH_KEY',   'u}^gS#q~j+Uhe.i!>8_w?ihPm#}LmNb{m*,Q3=UcTz9fj8,_3np`C}s2}e+]L<.d' );
define( 'LOGGED_IN_KEY',     'mQyzs@FCgPG4guW%_^juH=<YRm)e{gi{s=dW~y,3,3/-Xd_ppqE_-D#9R_>2Cj:q' );
define( 'NONCE_KEY',         'j/%4sGONArFAERi,>2?BU$K*Naa_MYlq6LEtSK(Z3Jtg~S8s8xWr[-l,Q(j58a%@' );
define( 'AUTH_SALT',         'H3)ctH k[Yt,EU,lDMbGj+78tUzN_XI#%$q-CIufLN}B-~GC :h.KvmHU}N?ab3(' );
define( 'SECURE_AUTH_SALT',  ']$z_o_hv r/Arl;m~1 (B4/;(*|9K(RziC&X1`uLqqK+G MC][/4iUospTQ0 pqD' );
define( 'LOGGED_IN_SALT',    'oLy&f2,u|9f$u4tT!ojiapXq!L`v:k9bLB~YR1ST!Im1Smjz}9[80&h7R[xrKLb.' );
define( 'NONCE_SALT',        'h}V9fI/5iQW^m=MZnaY/3v>e|}T!%&23V^_{s){Xy[zOSg5q.$r7ark4$km^8[{%' );
define( 'WP_CACHE_KEY_SALT', '^3JW!U:f$:[s6V`PZfiE2[jJ6HwM*np@46].s?xAg[t:D&2o2G-4& 0iaK7c_:;m' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
