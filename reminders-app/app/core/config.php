<?php

define('VERSION', '0.7.0');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('APPS', ROOT . DS . 'app');
define('CORE', ROOT . DS . 'core');
define('LIBS', ROOT . DS . 'lib');
define('MODELS', ROOT . DS . 'models');
define('VIEWS', ROOT . DS . 'views');
define('CONTROLLERS', ROOT . DS . 'controllers');
define('LOGS', ROOT . DS . 'logs');	
define('FILES', ROOT . DS. 'files');

// ---------------------  DATABASE CONFIGURATION -------------------------
// Use Render environment variables for PostgreSQL.
// These are automatically set by Render when linked to a PostgreSQL database.
define('DB_HOST', getenv('RENDER_DATABASE_HOST'));
define('DB_USER', getenv('RENDER_DATABASE_USER'));
define('DB_PASS', getenv('RENDER_DATABASE_PASSWORD'));
define('DB_DATABASE', getenv('RENDER_DATABASE_NAME'));
define('DB_PORT', getenv('RENDER_DATABASE_PORT'));

// Verify that all required environment variables are set
if (!DB_HOST || !DB_USER || !DB_PASS || !DB_DATABASE || !DB_PORT) {
    die('Error: Missing required database configuration. Please check your environment variables.');
}
?>