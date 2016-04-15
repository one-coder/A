<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-14
 */

include_once 'environment.php';

define('ROOT_PATH', dirname(__FILE__));
define('APP_PATH', ROOT_PATH . '/application');
define('FRAMEWORK_PATH', ROOT_PATH . '/framework');
define('VENDOR_PATH', ROOT_PATH . '/vendor');

switch (ENVIRONMENT) {
    case 'development' :
        break;
    default :
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

// auto loader
include_once VENDOR_PATH . '/Psr/Loader/Psr4AutoLoader.php';
$loader = new \Psr\Loader\Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('framework', FRAMEWORK_PATH);
$loader->addNamespace('vendor', VENDOR_PATH);
$loader->addNamespace('application', APP_PATH);