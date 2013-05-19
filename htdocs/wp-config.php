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

if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
  include( dirname( __FILE__ ) . '/wp-config-local.php' );

// Otherwise use the below settings (on live server)
} else {

    //LIVE SERVER SETTINGS!
    /** The name of the database for WordPress */
    define('DB_NAME', 'pooch');
    /** MySQL database username */
    define('DB_USER', 'root');
    /** MySQL database password */
    define('DB_PASSWORD', 'root');
    /** MySQL hostname */
    define('DB_HOST', 'localhost');

}

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
define('AUTH_KEY',         'R1jAvrDU@8 XmU2j~-%~w``ZurWl#,f0Ak8|QXBf|ebeU~N<#-u.b!N>:GN@cpQ,');
define('SECURE_AUTH_KEY',  'x>n@[CUm;vw.or;S;@(Nmbt?O.(aC{V3E7mF6l6<@tcEUyH`6=4XJCm@dyF/|n7d');
define('LOGGED_IN_KEY',    'U]R%ltNpGA6Y;Rp?dOH,i;k@[&MKuyclinbt+@6,uvZZ%mbnBN>Dop|D$=jNy8=X');
define('NONCE_KEY',        'YaaDyJe4^8a53blX1.+]k-Yo RS&D4>hq;>M]8HoBNfO5tzpl SyaIB8XNF#=hFb');
define('AUTH_SALT',        'd>22B#ns$| 3Xw1L-,V{>*+lGVdWiSeVeYs`=pE;= v*{z|xf Cj-|EQc=PT_Hl1');
define('SECURE_AUTH_SALT', '6l01Im.&~u0@F*nB5@~<9K9U#,b/M8+w=Nra8$>I|aW:.xL1~%*_BwL+`HiA2v7%');
define('LOGGED_IN_SALT',   'RtYsqn)b+#8+Zh.3xP9|AALahbKq7]KcBR+pmcp]~+_+%ttD/ 6Il+QJ1NAcTam5');
define('NONCE_SALT',       '</|}^%f^)niJgX7?_GVv(n;WZB2vYZ=4rSyB|z@p;FO;(g|Uh_h1mQyD|WV+%,WJ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
