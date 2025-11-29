<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/functions/helpers.php';

$isAuth = rand(0, 1);

$userName = 'Дмитрий'; // укажите здесь ваше имя

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
        'imgUrl' => '/img/lot-1.jpg',
        'expirationDate' => '2025-11-29',
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '159999',
        'imgUrl' => '/img/lot-2.jpg',
        'expirationDate' => '2025-11-30',
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'imgUrl' => '/img/lot-3.jpg',
        'expirationDate' => '2025-12-01',
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charcoal',
        'category' => 'Ботинки',
        'price' => '10999',
        'imgUrl' => '/img/lot-4.jpg',
        'expirationDate' => '2025-12-02',
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charcoal',
        'category' => 'Одежда',
        'price' => '7500',
        'imgUrl' => '/img/lot-5.jpg',
        'expirationDate' => '2025-12-03',
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400',
        'imgUrl' => '/img/lot-6.jpg',
        'expirationDate' => '2025-12-04',
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
        'userName' => $userName,
        'isAuth' => $isAuth,
        'content' => $content,
        'categories' => $categories,
    ]
);

print($layout);