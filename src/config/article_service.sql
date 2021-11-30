-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: db
-- Thời gian đã tạo: Th10 30, 2021 lúc 06:55 AM
-- Phiên bản máy phục vụ: 8.0.27
-- Phiên bản PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `article_service`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `thumbnail_id` int DEFAULT NULL,
  `content` mediumtext,
  `page_view` int UNSIGNED DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`id`, `title`, `thumbnail_id`, `content`, `page_view`, `created_at`, `updated_at`, `author_id`) VALUES
(1, 'Raspberry Pi財団が2021年10月28日に新製品「Raspberry Pi Zero 2 W」を発表、スイッチサイエンスウェブショップでも近く発売予定', 1, 'Raspberry Pi財団は、2021年10月28日にRaspberry Pi製品の中でも小型で手頃なRaspberry Pi Zeroファミリーの最新製品として「Raspberry Pi Zero 2 W」を発表しました。 本製品は、512 MBのRAMと、1 GHz駆動の64 bit Arm Cortex-A53 クアッドコア BCM2710A1を中心としたRaspberry Pi RP3A0 SiPを搭載しており、従来のRaspberry Pi Zeroと比べてシングルスレッド性能が40%、マルチスレッド性能が5倍向上しています。また、2.4 GHz 802.11 b/g/nワイヤレスLANとBluetooth 4.2 / Bluetooth Low Energy（BLE）が利用可能です。 本製品は2021年10月28日現在、工事設計認証を取得していないため、株式会社スイッチサイエンス（本社：東京都新宿区、代表取締役：金本茂）では、工事設計認証を取得され次第取り扱いを開始します。', 17, '2021-11-02 02:36:28', '2021-11-02 02:36:28', 1),
(2, 'スマホアプリ『リーグ・オブ・レジェンド：ワイルドリフト』10月28日でサービス開始から1周年！「ワイリフ1周年記念祭」を11月1日～11月30日に開催', 2, 'Riot Games, Inc.（米国）の日本法人である合同会社ライアットゲームズ（港区六本木、社長/CEO：小宮山 真司）は、スマホ向け（Android / iOS）タイトルの異世界マルチバトル「リーグ・オブ・レジェンド：ワイルドリフト」（以下、ワイルドリフト）が本日10月28日に1周年を迎えることを記念して、「ワイリフ1周年記念祭」を2021年11月1日（月）から11月30日（火）まで開催します。「ワイリフ1周年記念祭」では、ワイルドリフトをプレイして抽選券を貯め、毎週行われる抽選をすることでワイリフ限定グッズやインゲームアイテムが当たる「抽選キャンペーン」や、10万円の賞金サポートする認定大会の開催、公式Twitterでのキャンペーンなどなど、さまざまな企画を実施します。 ワイルドリフトをプレイして抽選券を貯め、毎週行われる抽選をすることでワイリフ限定グッズやインゲームアイテムが当たります。', 5, '2021-11-02 02:36:28', '2021-11-02 02:36:28', 2),
(3, '日向坂46 佐々木美玲がパーソナリティ！リスナーの一週間の疲れを癒やすラジオ番組、始動！『星のドラゴンクエスト presents 日向坂46 佐々木美玲のホイミーぱん』', 3, 'この番組は、10月29日（金）までレギュラー放送をしていた番組『星のドラゴンクエスト presents 日向坂46 小坂菜緒の「小坂なラジオ」』でも代演パーソナリティとして放送を盛り上げてきた日向坂46 佐々木美玲がパーソナリティをつとめ、装いを新たにスタートする番組です。日向坂46のメンバーとして活動する傍ら、雑誌専属モデル、女優、情報番組リポーターとしても活躍している「みーぱん」こと、佐々木美玲が、ゲーム『ドラゴンクエスト』に登場する回復系呪文「ホイミ」のように、「一週間の疲れを癒やす」ことを番組コンセプトに、普段は聴くことのできない素のトークもお届けしていきます。 番組への意気込みを佐々木美玲は、「ラジオの出演経験が少なかったので、最初は不安だったのですが、回数を重ねていくうちに『あっ、私お喋りするの好きだな』って気持ちになり、今は楽しくさせていただいています。『ホイミーぱん』では、新しいコーナーも始まるので、楽しみにしていてください。そして私も、今ハマっている『星ドラ』の主人公と、リスナーの皆さんと共に成長出来ればなと思います。お仕事や学校など1週間の疲れを癒せるよう、ホイミの呪文をかけられるような番組にしていきたいと思います。」と語りました。 さらに、番組では新コーナー「教えて！ガイアス」もスタート。『星のドラゴンクエスト』にまつわるゲーム知識を、初心者にもわかりやすくお伝えします。１１月5日（金）の初回放送を、お楽しみに！', 12, '2021-11-02 02:36:28', '2021-11-02 02:36:28', 1),
(4, 'Tuyết rơi mùa hè, oi ban oi, co cam sung toi day a``', NULL, 'Tuyet Roi Mua He\r\n\r\nNếu anh gặp em từ đầu, có lẽ đã không ai qua bể dâu\r\nNếu anh được sống từ đầu, vẫn muốn bên em như thời thơ ấu\r\nNếu mai rời xa nhìn lại, trong giấc mơ anh, em sẽ hiện ra\r\nNhư tuyết mùa hè rạng ngời trong màu áo trắng phau., o\r\nNếu em rồi ở lại, anh sẽ biết yêu em hơn ngày xưa\r\nNếu những màu sắc nhạt dần, anh sẽ vẽ em với màu nỗi nhớ\r\nVà nếu thời gian trở lại, thì những nhánh sông hay bao con đường\r\nCũng sẽ dẫn về một ngày anh chờ em...\r\nV ngày em đến là ngày tuyết rơi mùa hè\r\nBầu trời lấp lánh những cánh hoa như sao tỏa bay\r\nVà dù anh có trẻ lại vẫn nguyên lời thề\r\nVì màu nơ trắng em cài là hoa tuyết không tàn.あいうえお', 164, '2021-11-02 02:43:57', '2021-11-02 02:43:57', 1),
(5, '【完売御礼】試飲×動画で学ぶ、毎月自宅に届くワインスクール「HOMEWiNE」が大好評！1週間で3ヶ月分の在庫完売につき、『反響への感謝とお詫びの予約販売キャンペーン』を開始。', 4, '株式会社カスタムライフ（本社：東京都千代田区、代表取締役：石矢浩、以下「カスタムライフ」）が業務提携を行う、株式会社WINE TRAIL（本社：東京都新宿区、代表取締役：佐々木健太）の教育×小瓶ワインのサブスクリプション「HOMEWiNE（ホームワイン）」が、新たな予約販売キャンペーンを開始いたします（https://homewine.jp/）。\r\n\r\n10月20日の販売スタートより予測を大幅に上回る反響をいただき、12月発送分まで早くも完売となりました。つきましては、前回の予約販売でご購入いただけなかった皆さまへのお詫びと反響への感謝を込めまして、新たに予約販売キャンペーンを開始いたします。', 74, '2021-11-02 02:46:36', '2021-11-02 02:46:36', 1),
(81, 'neu ngay mai em den \r\nneu ngay mai em den', NULL, 'thi toi se doi, ok chua', 16, '2021-11-09 02:18:22', '2021-11-09 02:18:22', 1),
(85, '<script>alert(1)</script>', NULL, 'asdsadad\r\n<script>alert(2)</script>', 21, '2021-11-09 02:24:39', '2021-11-09 02:24:39', 1),
(88, 'idjqowdjqiowdjioqwdjioqwjdoi', 37, 'oqwjdoiqjwdoi', 14, '2021-11-09 02:47:01', '2021-11-09 02:47:01', 1),
(89, 'phi hanh gia', 38, 'phi hanh giaphi hanh giaphi hanh giaphi hanh giaphi hanh gia', 10, '2021-11-09 02:51:14', '2021-11-09 02:51:14', 1),
(93, 'oi ban oi', 42, 'oi, co cam sung toi day aa', 2, '2021-11-10 07:21:45', '2021-11-10 07:21:45', 1),
(95, 'Khi màn hình tắtrhy', 44, 'ryKhi màn hình tắt\r\nĐóng ngắt hết tâm can\r\nLạnh vắng nơi nhân gian\r\nLại nghẹn đắng trong lầm than\r\nKhi màn hình tắt\r\nÁnh sáng cũng theo chân\r\nChìm đắm bao nhiêu năm\r\nĐề giờ ngắm thân ta điêu tàn\r\nKhi màn hình tắt\r\nĐóng ngắt hết tâm can\r\nLạnh vắng nơi nhân gian\r\nLại nghẹn đắng trong lầm than\r\nKhi màn hình tắt\r\nÁnh sáng cũng theo chân\r\nChìm đắm bao nhiêu năm\r\nĐề giờ ngắm thân ta điêu tàn\r\n(Khi màn hình tắt)\r\nTừ sự dò xét lấn chiếm đời ta\r\nQua biết bao đoạn tít những trang newfeed đẫm tiếng ngợi ca\r\nRồi sinh ra những lý luận gia thiếu niên chỉ biết quyết đoán quyết vội vã\r\nChẳng tha bất cứ một ai, dành trọn kiếp phán xét người lạ (Khi màn hình tắt)\r\nVà người thấy bỗng có chút hả hê\r\nChê nó thêm một lúc để cho đầu óc đỡ nhức cả đêm\r\n\"Còm-men\" mấy câu thô tục người dùng Facebook chắc cũng đã quen\r\nĐể còn che giấu đi hiện thực\r\nBớt đi chút vô dụng hèn kém (khi màn hình tắt)\r\nPhải nghe ai, nghe ai? Sự thật là đâu?\r\nBị dắt mãi sao không tự nhận là trâu?\r\nBị kích dẫn đến xích mích đấu đá nhau\r\nVì internet cho ta được phép không cần giải quyết hậu quả nào (khi màn hình tắt)\r\nMình có lẽ đã là một người thành công (khi màn hình tắt)\r\nBởi cả kho kiến thức mà cuộc đời hằng mong (khi màn hình tắt)\r\nĐâu phải ôm đơn độc chui rúc cuối căn phòng\r\nĐúng không?\r\nKhi màn hình tắt\r\nĐóng ngắt hết tâm can\r\nLạnh vắng nơi nhân gian\r\nLại nghẹn đắng trong lầm than\r\nKhi màn hình tắt\r\nÁnh sáng cũng theo chân\r\nChìm đắm bao nhiêu năm\r\nĐề giờ ngắm thân ta điêu tàn\r\nKhi màn hình tắt\r\nĐóng ngắt hết tâm can\r\nLạnh vắng nơi nhân gian\r\nLại nghẹn đắng trong lầm than\r\nKhi màn hình tắt\r\nÁnh sáng cũng theo chân\r\nChìm đắm bao nhiêu năm\r\nĐề giờ ngắm thân ta điêu tàn (khi màn hình tắt)\r\nCòn ai muốn nghe lời than phiền?\r\nAi khiến ta bình an dù đời tư cứ thế vội lan truyền\r\nTai mắt trong từng trang web đâu bỏ qua những cơ hội đáng tiền\r\nTa sẵn sàng đem bán quyền tự do lấy nơi để tám chuyện (khi màn hình tắt)\r\nChẳng còn ai hóng nghe bị nhắc tên\r\nVẫn còn phảng phất nghe lời cay đắng kia tự cất lên\r\nNgủ đâu ngọt giấc chỉ mong ngày mai sẽ không bị lãng quên\r\nVì khi màn hình tắt, đời sẽ quay về số phận thấp hèn (khi màn hình tắt)\r\nDù muốn chém giết vì nhau\r\nDồn nén đã từ lâu mà giờ đây hết phép nhiệm màu\r\nBao nhiêu hận thù vì sao mà đem nhồi nhét hết trong đầu\r\nNgủ sâu cùng im lặng dẫu lòng ai gào thét rất ồn ào\r\n(Khi màn hình tắt)\r\nĐời có ra sao nhân quả cũng sẽ phải đến\r\nVì trên mạng xã hội dù ai nổi đến đâu thì vẫn đều có thể lại chìm\r\nVà chân lý khó để ta tìm\r\nDối gian thì càng dễ mà kiếm\r\nNên chốn thị phi ta cứ đi làm khỉ chẳng nói chẳng nghe hay nhìn\r\nKhi màn hình tắt\r\nĐóng ngắt hết tâm can\r\nLạnh vắng nơi nhân gian\r\nLại nghẹn đắng trong lầm than\r\nKhi màn hình tắt\r\nÁnh sáng cũng theo chân\r\nChìm đắm bao nhiêu năm\r\nĐề giờ ngắm thân ta điêu tàn\r\nKhi màn hình tắt\r\nKhi màn hình tắt\r\nKhi màn hình tắt\r\nKhi màn hình tắt\r\nAyy\r\nKhi màn hình tắt hình ảnh chúng nó tao coi như chết trong đầu\r\nSinh ra âm nhạc là để kết nối đâu phải để thù ghét lẫn nhau?\r\nVà nó cứ gặt những điều nó gieo cho cả hậu thế đời sau\r\nCòn tao không cần cuộc đời con tao dính vào chém giết đổ máu\r\nNên tao, mang Hiphop tìm cách làm đẹp cho đời\r\nKhi nó không hiểu những điều tao nói việc gì tao phải xem nó chửi?\r\nMồm tự thở ra những điều hôi thối thì cứ tự nghe tự ngửi\r\nVà khi màn hình tắt vị trí của nó cũng chỉ đến thế mà thôi\r\nAy, cái xã hội này\r\nTự hỏi vì sao lại tàn?\r\nCó phải do những điều dơ bẩn cứ đem lên mạng lại bắt đầu lây lan?\r\nHay cuộc đời chịu nhiều đàn áp cho nên bây giờ chuốc thù gây oán?\r\nĐi bịa lời gây hoang mang và để lại đó một lũ bày đàn?\r\nNhưng homie, mày đừng quên gần đèn thì rạng\r\nCùng là chén rượu ép, thằng sang thì né, thằng hèn thì cạn\r\nNgày mai đến, rồi tất cả mọi điều cũng sẽ thành chuyện dĩ vãng\r\nKhi ngồi bên cạnh người vợ trẻ nhìn đời và khẽ nhấp miệng ly vang', 3, '2021-11-30 06:52:39', '2021-11-30 06:52:39', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `articles_categories`
--

INSERT INTO `articles_categories` (`id`, `article_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(2, 1, 2, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(3, 2, 3, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(4, 2, 4, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(5, 3, 5, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(6, 3, 6, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(7, 3, 7, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(8, 4, 2, '2021-11-02 02:43:57', '2021-11-02 02:43:57'),
(9, 5, 4, '2021-11-02 02:46:36', '2021-11-02 02:46:36'),
(10, 5, 6, '2021-11-02 02:46:36', '2021-11-02 02:46:36'),
(11, 5, 9, '2021-11-02 02:46:36', '2021-11-02 02:46:36'),
(71, 81, 2, '2021-11-09 02:18:22', '2021-11-09 02:18:22'),
(76, 85, 1, '2021-11-09 02:24:39', '2021-11-09 02:24:39'),
(79, 88, 3, '2021-11-09 02:47:01', '2021-11-09 02:47:01'),
(80, 89, 1, '2021-11-09 02:51:14', '2021-11-09 02:51:14'),
(84, 93, 2, '2021-11-10 07:21:45', '2021-11-10 07:21:45'),
(90, 95, 4, '2021-11-30 06:52:39', '2021-11-30 06:52:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fullname` text,
  `avatar` varchar(255) DEFAULT NULL,
  `address` text,
  `birthday` date DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`id`, `email`, `username`, `password`, `fullname`, `address`, `birthday`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'mrahn1234@gmail.com', 'mrahn1234', md5('123456'), 'Le Hoang Tu', 'Vietnam, Danang', '1998-01-07', '0774455559', '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(2, 'abcedf@gmail.com', 'abcdef', md5('123456'), 'A B C D', 'ABCD, DEF', '1998-01-07', '123456789', '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(3, 'test1@gmail.com', 'test111', '4297f44b13955235245b2497399d7a93', 'tester', NULL, NULL, NULL, '2021-11-30 06:52:06', '2021-11-30 06:52:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'テクノロジー', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(2, 'モバイル', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(3, 'アプリ', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(4, 'エンタメ', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(5, 'ビューティー', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(6, 'ファッション', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(7, 'ライフスタイル', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(8, 'ビジネス', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(9, 'グルメ', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28'),
(10, 'スポーツ', NULL, '2021-11-02 02:36:28', '2021-11-02 02:36:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` bigint UNSIGNED NOT NULL,
  `src` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `article_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `src`, `created_at`, `updated_at`, `article_id`) VALUES
(1, 'article-1.jpg', '2021-11-02 02:36:28', '2021-11-02 02:36:28', 1),
(2, 'article-2.png', '2021-11-02 02:36:28', '2021-11-02 02:36:28', 2),
(3, 'article-3.jpg', '2021-11-02 02:36:28', '2021-11-02 02:36:28', 3),
(4, 'wine.jpg', '2021-11-02 02:46:36', '2021-11-02 02:46:36', 5),
(37, '6189e1250082b.jpg', '2021-11-09 02:47:01', '2021-11-09 02:47:01', 88),
(38, '6189e22204905.jpg', '2021-11-09 02:51:14', '2021-11-09 02:51:14', 89),
(42, '618b7309685ec.jpg', '2021-11-10 07:21:45', '2021-11-10 07:21:45', 93),
(44, '3a2d5af231fe34f8af36de08de17d42e8a3ff6ca.jpg', '2021-11-30 06:52:39', '2021-11-30 06:52:39', 95),
(45, '572396e863fb682721e739d02c925effb0a25084.jpg', '2021-11-30 06:52:39', '2021-11-30 06:52:39', 95);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author` (`author_id`);

--
-- Chỉ mục cho bảng `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_article_category` (`article_id`,`category_id`),
  ADD KEY `fk_article_category2` (`category_id`);

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article` (`article_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `articles_categories`
--
ALTER TABLE `articles_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD CONSTRAINT `fk_article_category1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_article_category2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
