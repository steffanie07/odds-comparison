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


define('AUTH_KEY',         'fs8Pc3rehbLPQ9RCYYVoJJBGV89hoKf43RKHz0nbOnC8PNNuvR7QKkHLjBJLmKAbpwkogtLtwMuwJowNuBsJDg==');
define('SECURE_AUTH_KEY',  'yAhu/XkLejDtQCHeDPTqchLujLCUf3nKEIFPsV5FY+fI8p/lD+7hNKw/sdvHCvgJ4Z4QssF7+ytfOf7odSSMAQ==');
define('LOGGED_IN_KEY',    '8yJkKi0Ht0ILQyRd1sVa6ywY8tWW0J+2ob4qJk2EVq/fbB2JdzKGpmCkEbuVGmyF9hhN1iLnZgAzK/N8NUZj6w==');
define('NONCE_KEY',        'PYl1/N7nJJ5kgSmb75zRokk6yKaFeTSkduxRpM2CeN0jxAGM2xY/G+QJeHpj/tOjv3lGDZWKhewrCDNdl5ae+w==');
define('AUTH_SALT',        'ijBtY+XCpKjdLKeZPkAyhMANCe7tIXK7QldSq4xIaFlL/BMSYbxzpknFNJrF5USCp96ATWiWfDxI7Pr1hI5cCA==');
define('SECURE_AUTH_SALT', 'yEDkk5z5gMQutJ78PXhGk1q/pzu4DWJ2PMIL1Aa6cXzJC26lVGv+z5WY6L36BM46wTZ81qI0koFGBLS34NCB2g==');
define('LOGGED_IN_SALT',   'TZIaX2C3kaRpbm57akdlh1Sfj0etTa2DEB+ZW1dhGRyN9LdEWX9ksrXvqQUdaD87LK2sIz4AXg7zW2W1V0V5Vg==');
define('NONCE_SALT',       'ULe5lnfZUMTxBGJbHSn2GOVCUVVTpfDfISlSEUG61/LUougbVPJjD3aGXmYwUhCSxoZke3qwyKmXbDFOlkObUw==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
