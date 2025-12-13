DROP DATABASE IF EXISTS yeticave;
CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

DROP TABLE IF EXISTS categories;
CREATE TABLE categories
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) NOT NULL UNIQUE,
    code VARCHAR(64) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    email VARCHAR(64) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    contacts TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS lots;
CREATE TABLE lots
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title CHAR(128) NOT NULL,
    description TEXT NOT NULL,
    img_url VARCHAR(256) NOT NULL,
    start_price INT UNSIGNED NOT NULL,
    end_date DATETIME NOT NULL,
    bid_step INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category_id INT UNSIGNED NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    winner_id INT UNSIGNED,
    FOREIGN KEY (category_id) REFERENCES categories (id),
    FOREIGN KEY (author_id) REFERENCES users (id),
    FOREIGN KEY (winner_id) REFERENCES users (id)
);

DROP TABLE IF EXISTS bids;
CREATE TABLE bids
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount INT UNSIGNED NOT NULL,
    lot_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (lot_id) REFERENCES lots (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE INDEX idx_lots_id ON lots (id);
CREATE INDEX idx_users_id ON users (email);
CREATE INDEX idx_categories_id ON categories (title);
CREATE INDEX idx_lots_active_created ON lots(end_date, winner_id, created_at DESC);
CREATE FULLTEXT INDEX lot_ft_search ON lots(title, description);
