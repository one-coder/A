<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-14
 */

define('ENVIRONMENT', 'development');

define('ROOT_PATH', dirname(__FILE__));
define('FRAMEWORK_PATH', ROOT_PATH . '/framework');
define('VENDOR_PATH', ROOT_PATH . '/vendor');
define('APPLICATION_PATH', ROOT_PATH . '/application');

switch (ENVIRONMENT) {
    case 'development' :
        break;
    case 'product' :
    case 'test' :
        break;
    default :
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

// composer auto loader
include_once VENDOR_PATH . '/autoload.php';

// register namespace
$loader = new Keradus\Psr4Autoloader();
$loader->register();
$loader->addNamespace('Framework', FRAMEWORK_PATH);
$loader->addNamespace('Vendor', VENDOR_PATH);
$loader->addNamespace('Application', APPLICATION_PATH);

// router
$router = new Framework\Core\Router();

// 加载路由配置
require APPLICATION_PATH . '/Http/routes.php';

$matcher = $router->getMatcher();
$route = $matcher->match($request);

// logger
$logger = new Framework\Core\Logger();

$app = Framework\Core\Application::getInstance();
$app->setLoader($loader);
$app->setRouter($router);
$app->setLogger($logger);


return $app;