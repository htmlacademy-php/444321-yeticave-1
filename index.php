<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'functions/helpers.php';

$is_auth = rand(0, 1);

$user_name = 'Дмитрий'; // укажите здесь ваше имя

$categories = [
    [
        'name' => 'Доски и лыжи',
        'code' => 'boards'
    ],
    [
        'name' => 'Крепления',
        'code' => 'attachment'
    ],
    [
        'name' => 'Ботинки',
        'code' => 'boots'
    ],
    [
        'name' => 'Одежда',
        'code' => 'clothing'
    ],
    [
        'name' => 'Инструменты',
        'code' => 'tools'
    ],
    [
        'name' => 'Разное',
        'code' => 'other'
    ],
];

$lots = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '10999',
        'imgUrl' => 'img/lot-1.jpg',
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '159999',
        'imgUrl' => 'img/lot-2.jpg',
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'imgUrl' => 'img/lot-3.jpg',
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charcoal',
        'category' => 'Ботинки',
        'price' => '10999',
        'imgUrl' => 'img/lot-4.jpg',
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charcoal',
        'category' => 'Одежда',
        'price' => '7500',
        'imgUrl' => 'img/lot-5.jpg',
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400',
        'imgUrl' => 'img/lot-6.jpg',
    ],
];

$content = includeTemplate('main.php',
    [
        'categories' => $categories,
        'lots' => $lots,
    ]
);

$layout = includeTemplate('layout.php',
    [
        'title' => 'Главная',
        'user_name' => $user_name,
        'is_auth' => $is_auth,
        'content' => $content,
        'categories' => $categories,
    ]
);

print($layout);