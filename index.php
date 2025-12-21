<?php
require_once __DIR__ . '/init.php';

$isAuth = rand(0, 1);
$userName = 'Дмитрий'; // укажите здесь ваше имя

/** @var mysqli $dbConnection */
if ($dbConnection == false) {
    exit('Не удалось подключиться к базе данных');
}

$categories = getCategories($dbConnection);

if (!$categories) {
    exit('Не удалось получить категории лотов');
}

$lots = getLots($dbConnection);

if (!$lots) {
    exit('Не удалось получить лоты');
}

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
