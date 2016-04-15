<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-15
 */
namespace Framework\Core;

use Aura\Router\RouterContainer;

class Router extends RouterContainer {

    public function __construct($basepath = null)
    {
        parent::__construct($basepath);
    }

}