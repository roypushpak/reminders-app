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

// ---------------------  NEW DATABASE TABLE -------------------------
// Use Render environment variables.
define('DB_HOST', getenv('RENDER_DATABASE_HOST'));
define('DB_USER', getenv('RENDER_DATABASE_USER'));
define('DB_PASS', getenv('RENDER_DATABASE_PASSWORD'));
define('DB_DATABASE', getenv('RENDER_DATABASE_NAME'));
define('DB_PORT', getenv('RENDER_DATABASE_PORT'));
?>