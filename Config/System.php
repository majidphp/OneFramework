<?php
/**
 * System config file
 */
define('URL','http://localhost/framework');
define('ROOT', '/var/www/html/framework/');
define('PATH', '/framework');
define('SYSTEM_DIR', 'System/');
define('MODELS_DIR', 'Models/');
define('VIEW_DIR', 'Views/');
define('CONTROLLERS', 'Controllers/');
define('PUBLIC_DIR', ROOT.'/Public/');
define('PRIVATE_DIR', ROOT.'/Private/');
define('CONFIG_DIR','Config/');
define('LOG_FILE', PRIVATE_DIR.'log.log');
define('LOG_NAME',' framework');
define('LIBS_DIR', 'Libs/');
define('DOTENV', '.env');
define('DEBUG', true);
define('CACHE', 1);
define('CLI_PATH', $_SERVER["PWD"].'/');
define('CUSTOM_LIBRARY_DIR', 'Libs/Libraries/');
