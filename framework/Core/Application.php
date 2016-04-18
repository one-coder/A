<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-14
 */

namespace Framework\Core;

use Keradus\Psr4Autoloader;
use Aura\Router\RouterContainer;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\ServerRequestFactory;

class Application {

    protected static $_instance = null;

    /**
     * @var RouterContainer
     */
    protected $router = null;

    /**
     * @var Psr4Autoloader
     */
    protected $loader = null;

    /**
     * @var LoggerInterface
     */
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
     * @return RouterContainer $router
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
     * @param $path
     * @param array $server
     * @return \Zend\Diactoros\ServerRequest
     */
    public function newRequest($path, $server = array()) {
        $server['REQUEST_URI'] = $path;
        $server = array_merge($_SERVER, $server);
        return ServerRequestFactory::fromGlobals($server);
    }

    /**
     *
     */
    public function run() {

        // 初始化一些基础路由
        $map = $this->router->getMap();
        $map->get('', '/');
        $map->get('', '/index.php');
        // 加载路由配置
        require APPLICATION_PATH . '/Http/routes.php';

        $matcher = $this->router->getMatcher();
        $route = $matcher->match(ServerRequestFactory::fromGlobals($_SERVER));

        if (! $route) {
            // get the first of the best-available non-matched routes
            $failedRoute = $matcher->getFailedRoute();

            // which matching rule failed?
            switch ($failedRoute->failedRule) {
                case 'Aura\Router\Rule\Allows':
                    // 405 METHOD NOT ALLOWED
                    echo 405;
                    break;
                case 'Aura\Router\Rule\Accepts':
                    // 406 NOT ACCEPTABLE
                    echo 406;
                    break;
                default:
                    // 404 NOT FOUND
                    echo 404;
                    break;
            }

            exit(1);
        }


        // 跳转到特定控制器
        $do = $route->handler == '' ?: explode('.', $route->handler);

        $namespace = "Application\\Http\\Controllers\\";
        if (! is_array($do) || ! count($do)) {
            $className = $namespace  . 'IndexController';
            $actionName = 'index';
        } else if (count($do) < 3) {
            // use default namespace
            $className = $namespace . ucfirst($do[0]) . 'Controller';
            $actionName = isset($do[1]) ? $do[1] : 'index';
        } else {
            $namespace .= ucfirst($do[0]) . "\\";
            $className = $namespace . ucfirst($do[1]) . 'Controller';
            $actionName = isset($do[2]) ? $do[2] : 'index';
        }

        if (! class_exists($className) || ! method_exists($className, $actionName)) {
            echo 'class or action not exists';
            die();
        }

        $class = new $className();
        $class->{$actionName}($route->attributes);
    }
}