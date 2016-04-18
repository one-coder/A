<?php
/**
 * User: webxding@gmall.com
 * Date: 2016-04-15
 */
//$map->get('index', '/index{/year,m,d}');

// 测试地址这么写  example: domain/test/test/A/B/C
$map->get('test', '/test{/id}');
$map->get('test.test', '/test/test');

//$map->attach('blog.', '/blog', function ($map) {
//
//    $map->tokens([
//        'id'     => '\d+',
//        'format' => '(\.json|\.atom|\.html)?'
//    ]);
//
//    $map->setDefaults([
//        'format' => '.html',
//    ]);
//
//    $map->get('a', '/a');
//    $map->get('browse', '');
//    $map->get('read', '/{id}{format}');
//    $map->patch('edit', '/{id}');
//    $map->put('add', '');
//    $map->delete('delete', '/{id}');
//});