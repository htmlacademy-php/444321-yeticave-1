/* добавление информации в categories */
INSERT INTO yeticave.categories (title, code)
VALUES ('Доски и лыжи', 'boards'),
       ('Крепления', 'attachment'),
       ('Ботинки', 'boots'),
       ('Одежда', 'clothing'),
       ('Инструменты', 'tools'),
       ('Разное', 'other');

/* добавление информации в users */
INSERT INTO yeticave.users (name, email, password, contacts)
VALUES ('Дмитрий', 'boards@yandex.ru', 'djhsfg$^%234', 'г. Вологда, тел.: 51-27-40'),
       ('Юлия', 'bergs@yandex.ru', '^%234djhsfg$', 'г. Вологда, тел.: 51-27-40');

/* добавление информации в lots */
INSERT INTO yeticave.lots (title, description, img_url, start_price, end_date, bid_step, category_id, author_id)
VALUES ('2014 Rossignol District Snowboard', 'Товар в отличном состоянии', '/img/lot-1.jpg', 10999, '2025-11-29', 100,
        1, 1),
       ('DC Ply Mens 2016/2017 Snowboard', 'Товар в отличном состоянии', '/img/lot-2.jpg', 159999, '2025-12-29', 200, 1,
        2),
       ('Крепления Union Contact Pro 2015 года размер L/XL', 'Товар в отличном состоянии', '/img/lot-3.jpg', 8000,
        '2025-12-29', 300, 2, 1),
       ('Ботинки для сноуборда DC Mutiny Charcoal', 'Товар в отличном состоянии', '/img/lot-4.jpg', 10999, '2025-12-30',
        400, 3, 1),
       ('Куртка для сноуборда DC Mutiny Charcoal', 'Товар в отличном состоянии', '/img/lot-5.jpg', 7500, '2025-12-29',
        500, 4, 2),
       ('Маска Oakley Canopy', 'Товар в отличном состоянии', '/img/lot-6.jpg', 5400, '2025-12-29', 600, 6, 1);

/* добавление информации в bids */
INSERT INTO yeticave.bids (amount, lot_id, user_id)
VALUES (11099, 1, 1),
       (12099, 1, 2),
       (12499, 1, 1),
       (160099, 2, 2),
       (161199, 2, 1),
       (162399, 2, 2);

/* запрос на получиние всех категорий */
SELECT *
FROM categories;

/* запрос на получить самых новых, открытых лотов */
SELECT l.title,
       l.start_price,
       l.img_url,
       l.created_at,
       l.end_date,
       c.title as category
FROM lots l
       LEFT JOIN categories c
                 ON l.category_id = c.id
WHERE l.end_date > NOW()
  AND l.winner_id IS NULL
ORDER BY l.created_at DESC;

/* запрос на получить самых новых, открытых лотов с актуальной ценой */
SELECT l.title,
       l.start_price,
       COALESCE(MAX(b.amount), l.start_price) AS current_price,
       l.img_url,
       l.created_at,
       l.end_date,
       c.title                                as category
FROM lots l
       LEFT JOIN categories c
                 ON l.category_id = c.id
       LEFT JOIN bids b
                 ON l.id = b.lot_id
WHERE l.end_date > NOW()
  AND l.winner_id IS NULL
GROUP BY l.id, l.title, l.start_price, l.img_url, l.created_at, l.end_date, c.title
ORDER BY l.created_at DESC;

/* запрос показ лота по его ID */
SELECT l.title,
       l.start_price,
       l.img_url,
       l.created_at,
       c.title as category
FROM lots l
       LEFT JOIN categories c ON l.category_id = c.id
WHERE l.id = 2;

/* запрос на обновление названия лота по его ID */
UPDATE lots
SET title = 'Новое название лота'
WHERE id = 1;

/* запрос на получиние списка ставок для лота по его идентификатору с сортировкой по дате */
SELECT l.title,
       u.name,
       b.amount,
       b.created_at
FROM bids b
       LEFT JOIN lots l
                 ON l.id = b.lot_id
       LEFT JOIN users u
                 ON b.user_id = u.id
WHERE l.id = 1
ORDER BY b.created_at DESC;



