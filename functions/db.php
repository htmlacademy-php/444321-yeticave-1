<?php
/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function dbGetPrepareStmt(mysqli $link, string $sql, array $data = []): mysqli_stmt
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Получает список всех категорий лотов
 * @param mysqli $link
 * @return mysqli_result|bool|string
 */
function getCategoriesQuery(mysqli $link): mysqli_result|bool|string
{
    $sql = 'SELECT * FROM categories';

    return mysqli_query($link, $sql);
}

/**
 * Получает самые новые, открытые лоты
 * @param mysqli $link
 * @return mysqli_result|bool|string
 */
function getLotsQuery(mysqli $link): mysqli_result|bool|string
{
    $sql = 'SELECT l.title, l.start_price, l.img_url, l.created_at, l.end_date, c.title as category FROM lots l LEFT JOIN categories c ON l.category_id = c.id WHERE l.end_date > NOW() AND l.winner_id IS NULL ORDER BY l.created_at DESC';

    return mysqli_query($link, $sql);
}