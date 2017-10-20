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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'scotchbox' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'PJZ<!#ff;*|Nj)3tbI,9nSi44]:1>+beRzA4j&o8=7PFs/C!*hRaiCw1@ng@Rlej' );
define( 'SECURE_AUTH_KEY',  ';]JJfD=<D;)Ky}IPSM1hX[]gy/b6oXf.,Oyq&kI5DfYx$34PA.rUO)%3427#IU_h' );
define( 'LOGGED_IN_KEY',    '95v=y?P@9|upN*6R4V }{A[AFF^Ryr=nS>0Ryj=I/Kf69oJiCsaRLasC@CeOHKp|' );
define( 'NONCE_KEY',        'k:|8$l;)(7.tB=L%?i8CU`K<lmV~;qYQJ,8v`]1v51-}t xjMQ+Pk.YICC&?,vH|' );
define( 'AUTH_SALT',        'dR?8I](Ic:zF5Fzn@3k]E6e6<Ban$}XneXOY.OtBbRN5**OYz,t u(iDupY&I=<8' );
define( 'SECURE_AUTH_SALT', 'FDo*K0!$A9sIILGQz~tF^S=7!vuu]u_#uz$a=r;=bdG ^mVhbJh_zh6, a0fFOLz' );
define( 'LOGGED_IN_SALT',   'i42v2@Cuh$wYL*1U+L_^SKEliJ^Nv)>51rmqX+9^l{Jo)4<$<LA>W?/Kj>~d-T82' );
define( 'NONCE_SALT',       'S~HVM]2e`__QwHox(]-PD6<zx.7B.r&|Gnf*q4gw;9>j0_6_~2H;NkIBBSVbv< E' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
