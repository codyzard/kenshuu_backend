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
INSERT INTO authors (email, username, password, fullname, address, birthday, phone, created_at, updated_at)
VALUES ('mrahn1234@gmail.com', 'mrahn1234', '123456', 'Le Hoang Tu', 'Vietnam, Danang', '1998-01-07', '0774455559', now(), now());
INSERT INTO authors (email, username, password, fullname, address, birthday, phone, created_at, updated_at)
VALUES ('abcedf@gmail.com', 'abcdef', '123456', 'A B C D', 'ABCD, DEF', '1998-01-07', '123456789', now(), now());

INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('テクノロジー', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('モバイル', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('アプリ', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('エンタメ', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('ビューティー', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('ファッション', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('ライフスタイル', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('ビジネス', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('グルメ', now(), now());
INSERT INTO categories(category_name, created_at, updated_at)
VALUES ('スポーツ', now(), now());

INSERT INTO articles(thumbnail_id, title, content, author_id, created_at, updated_at)
VALUES (1, 'Raspberry Pi財団が2021年10月28日に新製品「Raspberry Pi Zero 2 W」を発表、スイッチサイエンスウェブショップでも近く発売予定', 'Raspberry Pi財団は、2021年10月28日にRaspberry Pi製品の中でも小型で手頃なRaspberry Pi Zeroファミリーの最新製品として「Raspberry Pi Zero 2 W」を発表しました。 本製品は、512 MBのRAMと、1 GHz駆動の64 bit Arm Cortex-A53 クアッドコア BCM2710A1を中心としたRaspberry Pi RP3A0 SiPを搭載しており、従来のRaspberry Pi Zeroと比べてシングルスレッド性能が40%、マルチスレッド性能が5倍向上しています。また、2.4 GHz 802.11 b/g/nワイヤレスLANとBluetooth 4.2 / Bluetooth Low Energy（BLE）が利用可能です。 本製品は2021年10月28日現在、工事設計認証を取得していないため、株式会社スイッチサイエンス（本社：東京都新宿区、代表取締役：金本茂）では、工事設計認証を取得され次第取り扱いを開始します。', 1, now(), now());
INSERT INTO articles(thumbnail_id, title, content, author_id, created_at, updated_at)
VALUES (2, 'スマホアプリ『リーグ・オブ・レジェンド：ワイルドリフト』10月28日でサービス開始から1周年！「ワイリフ1周年記念祭」を11月1日～11月30日に開催', 'Riot Games, Inc.（米国）の日本法人である合同会社ライアットゲームズ（港区六本木、社長/CEO：小宮山 真司）は、スマホ向け（Android / iOS）タイトルの異世界マルチバトル「リーグ・オブ・レジェンド：ワイルドリフト」（以下、ワイルドリフト）が本日10月28日に1周年を迎えることを記念して、「ワイリフ1周年記念祭」を2021年11月1日（月）から11月30日（火）まで開催します。「ワイリフ1周年記念祭」では、ワイルドリフトをプレイして抽選券を貯め、毎週行われる抽選をすることでワイリフ限定グッズやインゲームアイテムが当たる「抽選キャンペーン」や、10万円の賞金サポートする認定大会の開催、公式Twitterでのキャンペーンなどなど、さまざまな企画を実施します。 ワイルドリフトをプレイして抽選券を貯め、毎週行われる抽選をすることでワイリフ限定グッズやインゲームアイテムが当たります。', 2, now(), now());
INSERT INTO articles(thumbnail_id, title, content, author_id, created_at, updated_at)
VALUES (3, '日向坂46 佐々木美玲がパーソナリティ！リスナーの一週間の疲れを癒やすラジオ番組、始動！『星のドラゴンクエスト presents 日向坂46 佐々木美玲のホイミーぱん』', 'この番組は、10月29日（金）までレギュラー放送をしていた番組『星のドラゴンクエスト presents 日向坂46 小坂菜緒の「小坂なラジオ」』でも代演パーソナリティとして放送を盛り上げてきた日向坂46 佐々木美玲がパーソナリティをつとめ、装いを新たにスタートする番組です。日向坂46のメンバーとして活動する傍ら、雑誌専属モデル、女優、情報番組リポーターとしても活躍している「みーぱん」こと、佐々木美玲が、ゲーム『ドラゴンクエスト』に登場する回復系呪文「ホイミ」のように、「一週間の疲れを癒やす」ことを番組コンセプトに、普段は聴くことのできない素のトークもお届けしていきます。 番組への意気込みを佐々木美玲は、「ラジオの出演経験が少なかったので、最初は不安だったのですが、回数を重ねていくうちに『あっ、私お喋りするの好きだな』って気持ちになり、今は楽しくさせていただいています。『ホイミーぱん』では、新しいコーナーも始まるので、楽しみにしていてください。そして私も、今ハマっている『星ドラ』の主人公と、リスナーの皆さんと共に成長出来ればなと思います。お仕事や学校など1週間の疲れを癒せるよう、ホイミの呪文をかけられるような番組にしていきたいと思います。」と語りました。 さらに、番組では新コーナー「教えて！ガイアス」もスタート。『星のドラゴンクエスト』にまつわるゲーム知識を、初心者にもわかりやすくお伝えします。１１月5日（金）の初回放送を、お楽しみに！', 1, now(), now());

INSERT INTO images(src, article_id, created_at, updated_at)
VALUES ('article-1.jpg', 1, now(), now());
INSERT INTO images(src, article_id, created_at, updated_at)
VALUES ('article-2.png', 2, now(), now());
INSERT INTO images(src, article_id, created_at, updated_at)
VALUES ('article-3.jpg', 3, now(), now());

INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (1,1, now(), now());
INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (1,2, now(), now());
INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (2,3, now(), now());
INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (2,4, now(), now());
INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (3,5, now(), now());
INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (3,6, now(), now());
INSERT INTO articles_categories(article_id, category_id, created_at, updated_at)
VALUES (3,7, now(), now());
