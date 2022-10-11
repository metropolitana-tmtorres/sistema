<?php   
define('SYS_VERSION', '0.0.13');
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

require APP . 'config/config.php';

require APP . 'libs/helper.php';


require APP . 'core/application.php';
require APP . 'core/controller.php';


$app = new Application();

