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
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '-ok_@7-5z.pGn#3hu}N(uxcIaa/&K_^17hwFuUYW..NRet&fkG[2n6`kP=6=Y}1z' );
define( 'SECURE_AUTH_KEY',  'ySHZi/Zm?k1p9BrVZX^S`k(]9Xk`HH?p|q8V#*E;lLCh>Z!!1f7%p%mMLW*|1@^r' );
define( 'LOGGED_IN_KEY',    '$7#|H,ef/pLIkodf0(dh<jvIQ%+9~2Jc%QK@.Fqeyh#,z{V/=g1rl/FVUtcs^YCW' );
define( 'NONCE_KEY',        'ybB&U~(L[e?)&wsvX+}>5;`SjlAC7x/&0xVocV#~1wyR]jp,s%@8y-z:*aOsx`nV' );
define( 'AUTH_SALT',        'bw0QzN6PIB[qpp7l$K~YL|oYYL>Q(.fcPJ};X@GZ7w=@v=PS5S`7>GLGWOAEQ,r~' );
define( 'SECURE_AUTH_SALT', 'EE&S}rx-W(Qf{grTfE.K]!^0bf,(%,:TP/nFr&yl^![%PidB;^&#K|`*#wTH.(}n' );
define( 'LOGGED_IN_SALT',   'qV`eI#&sCj<s~_Bu?t6dz2KNL`<VnGoqmncxIZB+Z^ Ip4KPh#KQ:QQ#YBDVV9sL' );
define( 'NONCE_SALT',       '<b;_*NR>E06Q_ohH]qiwBLn!!y[.6=oo<#ZOE//]XnmmlI*DUE7QATIksJ^7O,J|' );

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
require_once ABSPATH . 'wp-settings.php';
