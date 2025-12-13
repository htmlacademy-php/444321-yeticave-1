<?php
require_once __DIR__ . '/functions/init.php';
require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/functions/helpers.php';

$isAuth = rand(0, 1);
$userName = 'Дмитрий'; // укажите здесь ваше имя

/** @var mysqli $link */
if ($link == false) {
    $content = includeTemplate('error.php', ['error' => mysqli_error($link)]);
} else {
    $categories = [];
    $lots = [];
    $content = '';
    $categoriesQuery = getCategoriesQuery($link);

    if ($categoriesQuery == false) {
        $content = includeTemplate('error.php', ['error' => mysqli_error($link)]);
    } else {
        $categories = mysqli_fetch_all($categoriesQuery, MYSQLI_ASSOC);
    }

    $lotsQuery = getLotsQuery($link);

    if ($lotsQuery == false) {
        $content = includeTemplate('error.php', ['error' => mysqli_error($link)]);
    } else {
        $lots = mysqli_fetch_all($lotsQuery, MYSQLI_ASSOC);
    }

    if ($categories && $lots) {
        $content = includeTemplate('main.php',
            [
                'categories' => $categories,
                'lots' => $lots,
            ]
        );
    }

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
}