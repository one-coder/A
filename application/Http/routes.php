<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-15
 */

$map = $router->getMap();

$map->get('a', '/a', function($request, $response) {
    echo "hello world";
});