<?php
//路由配置
$router['list'] = [
    'index'=>[
        'url'=>'/',
        'action'=>'book/index'
    ],
    'chapter'=>[
        'url' => '/[slug:alpha]/[no:alpha].htm',
        'action' => 'index/chapter'
    ],
    'book'=>[
        'url'=>'[slug:alpha].htm',
        'action'=>'book/detail'
    ],
];

$router['single'] = [
    'index'=>[
        'url'=>'/',
        'action'=>'book/chapter'
    ],
    'chapter'=>[
        'url' => '/[slug:alpha]/[no:alpha].htm',
        'action' => 'book/chapter'
    ],
];

$router['singled'] = [
    'index'=>[
        'url'=>'/',
        'action'=>'book/detail'
    ],
    'chapter'=>[
        'url' => '/[slug:alpha].htm',
        'action' => 'book/index'
    ],
];

return $router;

