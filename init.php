<?php
/** @var array $config */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/functions/helpers.php';
require_once __DIR__ . '/functions/db.php';

$config = require_once __DIR__ . '/config.php';

if (!$config) {
    exit('Не удалось загрузить файл конфигурации');
}

$dbConnection = dbConnect($config['db']);
