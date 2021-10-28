CREATE DATABASE article_service;
USE article_service;

#------------------------------create table------------------------------
CREATE TABLE authors (
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    fullname TEXT,
    address TEXT,
    birthday DATE,
    phone VARCHAR(30) UNIQUE,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE articles (
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title TEXT NOT NULL,
    thumbnail_id INTEGER, #ref to image_id
    content MEDIUMTEXT ,
	page_view INTEGER UNSIGNED DEFAULT 0, #number of view
    created_at DATETIME,
    updated_at DATETIME,
    author_id BIGINT UNSIGNED,
    CONSTRAINT fk_author FOREIGN KEY (author_id) REFERENCES authors(id) #if user deleted, article remained
    ON DELETE SET NULL
);

CREATE TABLE images(
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    src VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    article_id BIGINT UNSIGNED NOT NULL,
    CONSTRAINT fk_article FOREIGN KEY (article_id) REFERENCES articles(id)
    ON DELETE CASCADE
);

CREATE TABLE categories(
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
	category_name VARCHAR(255),
    parent_id BIGINT UNSIGNED DEFAULT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE articles_categories(
	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    article_id BIGINT UNSIGNED NOT NULL,
    category_id BIGINT UNSIGNED NOT NULL,  
    created_at DATETIME,
    updated_at DATETIME, 
    CONSTRAINT uq_article_category UNIQUE (article_id,category_id),
    CONSTRAINT fk_article_category1 FOREIGN KEY (article_id) REFERENCES articles(id)
    ON DELETE CASCADE,
	CONSTRAINT fk_article_category2 FOREIGN KEY (category_id) REFERENCES categories(id)
    ON DELETE CASCADE
);

#------------------------------initial value------------------------------
INSERT INTO authors (email, username, password, fullname, address, birthday, phone)
VALUES ('mrahn1234@gmail.com', 'mrahn1234', '123456', 'Le Hoang Tu', 'Vietnam, Danang', '1998-01-07', '0774455559');
INSERT INTO authors (email, username, password, fullname, address, birthday, phone)
VALUES ('abcedf@gmail.com', 'abcdef', '123456', 'A B C D', 'ABCD, DEF', '1998-01-07', '123456789');

INSERT INTO categories(category_name)
VALUES ('テクノロジー');
INSERT INTO categories(category_name)
VALUES ('モバイル');
INSERT INTO categories(category_name)
VALUES ('アプリ');
INSERT INTO categories(category_name)
VALUES ('エンタメ');
INSERT INTO categories(category_name)
VALUES ('ビューティー');
INSERT INTO categories(category_name)
VALUES ('ファッション');
INSERT INTO categories(category_name)
VALUES ('ライフスタイル');
INSERT INTO categories(category_name)
VALUES ('ビジネス');
INSERT INTO categories(category_name)
VALUES ('グルメ');
INSERT INTO categories(category_name)
VALUES ('スポーツ');

-- INSERT INTO articles(thumbnail_id, title, content, author_id)
-- VALUES (1, 'first article', 'hello everyone', 1);
-- INSERT INTO articles(thumbnail_id, title, content, author_id)
-- VALUES (3, 'second article', 'minna-san konnichiwa', 2);
-- INSERT INTO articles(thumbnail_id, title, content, author_id)
-- VALUES (5, 'fifa vs pes', 'both of them are great', 1);

-- INSERT INTO images(src, article_id)
-- VALUES ('https://bom.to/9ikfNp', 1);
-- INSERT INTO images(src, article_id)
-- VALUES ('https://bom.to/s9ikfNap', 1);
-- INSERT INTO images(src, article_id)
-- VALUES ('https://bom.to/s9ikfNaap', 2);
-- INSERT INTO images(src, article_id)
-- VALUES ('https://bom.to/s9ikfNasdap', 2);
-- INSERT INTO images(src, article_id)
-- VALUES ('https://bom.to/sfNasdap', 3);

-- INSERT INTO articles_categories(article_id, category_id)
-- VALUES (1,2);
-- INSERT INTO articles_categories(article_id, category_id)
-- VALUES (2,2);
-- INSERT INTO articles_categories(article_id, category_id)
-- VALUES (3,3);
-- INSERT INTO articles_categories(article_id, category_id)
-- VALUES (3,4);

#delete from articles where id = 2;
#delete from authors where id = 2;