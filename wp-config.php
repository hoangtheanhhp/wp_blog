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
define( 'DB_NAME', 'wp_anhht' );

/** MySQL database username */
define( 'DB_USER', 'anhht' );

/** MySQL database password */
define( 'DB_PASSWORD', '1' );

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
define( 'AUTH_KEY',         ';n.7Td31Lf-~].N]Z_+:vL4Qt<Q:1wSAFxO3ai<+6F~>>SLEWowRsQQo`Px:4 qr' );
define( 'SECURE_AUTH_KEY',  '*LbU3/G->dSCp}fko46-|&2dw3k5IZiau8fOXec=]NIA.hZpOC#V 5{R{k*,{1&J' );
define( 'LOGGED_IN_KEY',    '^/sv=DF`}6Kz%}f0qw@ ++XxYy~(b|#7z}=R=I8[B]m1rf1[dR0:hth5:BeJB[+F' );
define( 'NONCE_KEY',        'PGY$d5H+(Vnw{Uh#=B.e;,hs;>bAfisX}F&<g5}<on #J`#>?g#|?Tqv;6_8wbVO' );
define( 'AUTH_SALT',        'eI(JJgSi3:6r:BR|=;JMX`tiJ`hl&)qTBqb^zPJWTU@Z2wU[9ei7V[Cn|2|QAEov' );
define( 'SECURE_AUTH_SALT', '3igMsH,(]d0qS*aRp{Dl9=-#]en$qg;|e/+^xN@`5u,D-f!H]XK*5[Hk>=y5D*t!' );
define( 'LOGGED_IN_SALT',   '~@*(kd)+H{E?kbj%8}0qOv=_0{z|GIot_TA*K|K~.r/K5Bg/]#c?m^w,wmM,>T2%' );
define( 'NONCE_SALT',       '$J$1PP~uKp~>a7|+TK1gjB3WOY=vy`g<8>?tlodNCn-&R-o*S1@zpC.{<qkI+!#A' );

/**#@-*/
define('FS_METHOD', 'direct');
define('FTP_BASE', '/usr/home/username/public_html/my-site.example.com/wordpress/');
define('FTP_CONTENT_DIR', '/usr/home/username/public_html/my-site.example.com/wordpress/wp-content/');
define('FTP_PLUGIN_DIR ', '/usr/home/username/public_html/my-site.example.com/wordpress/wp-content/plugins/');
// define('FTP_PUBKEY', '/home/username/.ssh/id_rsa.pub');
// define('FTP_PRIKEY', '/home/username/.ssh/id_rsa');
define('FTP_USER', 'my-ftp-username');
define('FTP_PASS', 'my-ftp-password');
define('FTP_HOST', 'ftp.my-site.example.com');
// define('FTP_SSL', false);
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'blog_';

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
