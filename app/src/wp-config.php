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

require dirname(__DIR__).'/vendor/autoload.php';

try {
	$dotenv = new Dotenv\Dotenv(dirname(__DIR__).'/env');
	$dotenv->load();
}
catch (Exception $e) {
    //echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('MYSQL_DATABASE'));

/** MySQL database username */
define('DB_USER', getenv('MYSQL_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('MYSQL_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('APP_DB_HOST'));

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
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('SECURE_AUTH_KEY'));
define('NONCE_KEY',        getenv('SECURE_AUTH_KEY'));
define('AUTH_SALT',        getenv('SECURE_AUTH_KEY'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = getenv('TABLE_PREFIX');

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
define('WP_DEBUG', getenv('WP_DEBUG'));
define('WP_DEBUG_LOG', getenv('WP_DEBUG_LOG'));
define('WP_DEBUG_DISPLAY', getenv('WP_DEBUG_DISPLAY'));

//for aws s3 storage
define('DBI_AWS_ACCESS_KEY_ID', getenv('DBI_AWS_ACCESS_KEY_ID'));
define('DBI_AWS_SECRET_ACCESS_KEY', getenv('DBI_AWS_SECRET_ACCESS_KEY'));

define('WP_REDIS_HOST', 'redis');

define( 'WP_MEMORY_LIMIT', '1024M' );
define( 'WP_MAX_MEMORY_LIMIT', '1024M' );

// disable file edit
define('DISALLOW_FILE_EDIT', getenv('DISALLOW_FILE_EDIT'));

// disable users being able to use the plugin and theme installation/update functionality from the WordPress admin area
define( 'DISALLOW_FILE_MODS', getenv('DISALLOW_FILE_MODS'));

//if we are using super cache
if(getenv('WP_CACHE') == true){
	define('WP_CACHE', getenv('WP_CACHE'));
	define('WPCACHEHOME', getenv('WPCACHEHOME'));
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
