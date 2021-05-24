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
define( 'DB_NAME', 'wpdb' );

/** MySQL database username */
define( 'DB_USER', 'wpuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dbpassword' );

/** MySQL hostname */
define( 'DB_HOST', 'mariadb:3306' );

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
define('AUTH_KEY',         '|.(_v:CM`L+Oa+UfZMi^ECPESMv^)U-abs6(S) &`keLV:M-7%@~tT:V~wIrAWni');
define('SECURE_AUTH_KEY',  'iyV=M: _ i2FG}?1gV1w=?_(*pk(+Z1h1wvD/DY[KAEZ+--oilD/r>^3AODe@KBM');
define('LOGGED_IN_KEY',    'pN!3`?s;GFXLY^QbQtQTMSD:*6~F|HI^?+-C:Y!g2-=g4nr5nDZ!f?!K?G|FEb](');
define('NONCE_KEY',        'A$PyuPahayT[/Nr)H!Ooz^.@4{rMl52d;9DsJ%:nLQAh;+b`f4IQ,n4scF[|nb]V');
define('AUTH_SALT',        'Q_O}e+W]r-.0IJXbvna=qyFxj WF-Zh%^ }_XVBocU=l84;d!TBwAdcL; X|d/{F');
define('SECURE_AUTH_SALT', 'A)({[|G$nt5}NQb&Wn+e-?sgPOc 4BFIg m!Yk#)>]|KL>{5o1.sM}/@cQ%gXO;{');
define('LOGGED_IN_SALT',   '|I<q+xXU,-,_!>|o#l?&Vx5{]> `Lt+q,&O}X4*H3z-J7k%E/wgK@RAsR^JX|AnN');
define('NONCE_SALT',       'PyOe+At|z!p/+{8:|T>b98_CTFB 0:mg/YW$UR -7%uA-=Fsh8t!fg$+OwKkaec:');


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
