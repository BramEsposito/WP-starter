<?php
// ======================================================
// wp-config + .env
// ======================================================

require_once(__DIR__ . '/vendor/autoload.php');
(\Dotenv\Dotenv::createImmutable( __DIR__ . '/' ))->load();

// =======================================================
// Load database info and development parameters from .env
// =======================================================

// $envs is needed for the wp-stage-switcher

$envs = [
    'local'       => $_ENV['URL_LOCAL'],
    'staging'     => $_ENV['URL_STAGING'],
    'production'  => $_ENV['URL_PRODUCTION']
];

define('WP_ENV', $_ENV['ENVIRONMENT']);
define('ENVIRONMENTS', $envs );
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_HOST', $_ENV['DB_HOST']);
define('WP_HOME', $_ENV['WP_HOME']);
define('WP_SITEURL', $_ENV['WP_SITEURL']);
define('WP_DEBUG', $_ENV['WP_DEBUG'] );
define('SCRIPT_DEBUG', $_ENV['SCRIPT_DEBUG'] );
define('WP_DEBUG_DISPLAY', $_ENV['WP_DEBUG_DISPLAY'] );
define('WP_DEBUG_LOG', $_ENV['WP_DEBUG_LOG'] );
define('DISALLOW_FILE_EDIT', $_ENV['DISALLOW_FILE_EDIT'] );
define('AUTOMATIC_UPDATER_DISABLED', $_ENV['AUTOMATIC_UPDATER_DISABLED'] );
define('CLIENT_WORKS_ON', $_ENV['CLIENT_WORKS_ON'] );
define('WP_REDIS_DISABLED', $_ENV['WP_REDIS_DISABLED'] );

// =======================================================
// Settings for local environment only
// =======================================================
if ( $_ENV['ENVIRONMENT'] == 'local') {
    // See updates
    define('DISALLOW_FILE_MODS', 0 );
    // Allow all file types
    define('ALLOW_UNFILTERED_UPLOADS', true);
} else {
    define('DISALLOW_FILE_MODS', $_ENV['DISALLOW_FILE_MODS'] );
}

// ======================================================
// Spinupwp settings for cache
// ======================================================
define( 'WP_CACHE_KEY_SALT', $_ENV['URL_PRODUCTION'] );
define( 'WP_REDIS_SELECTIVE_FLUSH', true );
define( 'SPINUPWP_CACHE_PATH', '/cache/' . $_ENV['URL_PRODUCTION'] );

// ======================================================
// You almost certainly do not want to change these
// ======================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// =======================================================
// Load salts from salts.php if file exists
// =======================================================

if( file_exists( __DIR__ . '/salts.php' ) ) {
	require_once __DIR__ . '/salts.php';
	if( ! defined( 'AUTH_KEY' ) || strlen( AUTH_KEY ) == 0 || AUTH_KEY == 'a value' ) {
		echo 'This recipe needs some salt'; die;
	}
} else {
	echo 'This recipe needs some salt'; die;
}

// ========================
// Custom Content Directory
// ========================
define('WP_CONTENT_URL', WP_HOME .  '/wp-content' );
define('WP_CONTENT_DIR', dirname( ABSPATH ) . '/wp-content' );

// =====================================================
// Load WordPress Settings - please change table prefix
// =====================================================
$table_prefix  = 'wp_';
define('WP_POST_REVISIONS', 3);
define('DISABLE_WP_CRON', $_ENV['DISABLE_WP_CRON'] );

// ====================================================
// Inserted by Local by Flywheel
// ====================================================
if (isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

// ====================================================
// Absolute path to the WordPress directory
// ====================================================
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/core' );

// ====================================================
// Sets up WordPress vars and included files
// ====================================================
require_once ABSPATH . 'wp-settings.php';
