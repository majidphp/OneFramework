<?php
/**
 * System config file
 */
define('URL','http://localhost/framework');
define('ROOT', getenv('PWD'));
define('PATH', '');
define('SYSTEM_DIR', 'System/');
define('MODELS_DIR', 'Models/');
define('VIEW_DIR', 'Views/');
define('CONTROLLERS', 'Controllers/');
define('PUBLIC_DIR', ROOT.'/Public/');
define('PRIVATE_DIR', ROOT.'/Private/');
define('LOG', 1);
define('CONFIG_DIR','Config/');
define('LOG_FILE', PRIVATE_DIR.'log.log');
define('LOG_NAME',' framework');
define('LIBS_DIR', 'Libs/');
define('DOTENV', '.env');
define('DEBUG', true);
define('CACHE', 0);
define('VIEW', 1);
define('USR_LIBRARY_DIR', 'Libs/Libraries/');
