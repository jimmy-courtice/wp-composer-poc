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
define( 'DB_NAME', 'default' );

/** Database username */
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', 'user' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',          '`2MSlFkH&zsX>Y,yDz6uTcB^)dui<n*]9{EFIIAKL6@`?BAl$i@Yu]%28!7g9N[e' );
define( 'SECURE_AUTH_KEY',   'T/,$Rc4 s!gt#fxm+63Izc_=2q%;H1[3mC%?Mz}@ocN`1!ynAMda1?dByilS),D`' );
define( 'LOGGED_IN_KEY',     '*vG4|1Gnsp(^0.4yu448n71Vqhn(PmuZuYO$/m{s=Zj`Hg+)ie=5FQi7q9$Zjaw~' );
define( 'NONCE_KEY',         'DuucLTR8j$,{.N76,-|edk8dL~Y|Ak)%hht}wIy=Ox2C6 ljBhmHtnJ-#63_$,<u' );
define( 'AUTH_SALT',         '=m#EP{fmX<{#.>s%)M{Y3?vXR]Wo{888mMWA(RL(0FUCv0,G=WC34EwI~2h8]w@#' );
define( 'SECURE_AUTH_SALT',  '/Poce.>JQctjwXYt)-`{X1K)s!f`)2mE45^1CrDZtdfKWbR)Vo.u0&K4oSTX*?Uw' );
define( 'LOGGED_IN_SALT',    'IWJa~$qy>l9=jjk5 nA720$[q`1Q<!z:)B7R]Q]x|Jc^!2b#+tc.qTM:aMb#Lb&`' );
define( 'NONCE_SALT',        '5lD`7ej#iS=9n,0Ns:T8IS7kF0k?MpS>x)Gh||SI9tW,v-4h[5N/~j)4^JJ/c>-3' );
define( 'WP_CACHE_KEY_SALT', 'jct7g7[qWYod+(m4z<b/.5[?jcenE$FR7D0|P=?gD]fsyq1n459 up~8}_d`a~Fw' );


/**#@-*/

/**
 * WordPress database table prefix.
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


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
