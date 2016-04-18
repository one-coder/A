<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-18
 */
namespace Application\Http\Controllers;

use Framework\Core\Controller;

class TestController extends Controller {

    public function index($params) {
        var_dump($params);
        echo 'index';
    }

    public function test($params) {
        echo "test";
    }

}