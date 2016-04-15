<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-14
 */

namespace Framework\Core;

use \Aura\Router\RouterContainer;
use \Psr\Log\LoggerInterface;
use \Keradus\Psr4Autoloader;

class Application {

    protected static $_instance = null;

    protected $router = null;

    protected $loader = null;

    protected $logger = null;

    private function __construct()
    {
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param RouterContainer $router
     */
    public function setRouter(RouterContainer $router) {
        $this->router = $router;
    }

    /**
     * @return \Aura\Router\RouterContainer $router
     */
    public function getRouter() {
        return $this->router;
    }

    /**
     * @param Psr4Autoloader $loader
     */
    public function setLoader(Psr4Autoloader $loader) {
        $this->loader = $loader;
    }

    /**
     * @return Psr4Autoloader $loader
     */
    public function getLoader() {
        return $this->loader;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * @return LoggerInterface $logger
     */
    public function getLogger() {
        return $this->logger;
    }

    /**
     *
     */
    public function run() {
        echo "hello world!";
    }
}