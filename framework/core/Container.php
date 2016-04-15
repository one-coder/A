<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-14
 */

namespace framework\core;

class Container {

    private static $_instance = null;

    private static $_objMaps = array();

    private function __construct()
    {
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function register($key, $obj) {
        self::$_objMaps[$key] = $obj;
    }

    public function unregister($key) {
        unset(self::$_objMaps[$key]);
    }

    public function exists($key) {
        return isset(self::$_objMaps[$key]);
    }

}