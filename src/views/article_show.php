<?php
require '../config/db.php';
session_start();
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    try {
        $query = $conn->prepare("SELECT title, content, thumbnail_id, page_view, articles.created_at, src, authors.fullname FROM articles 
        LEFT JOIN images ON articles.thumbnail_id = images.id 
        INNER JOIN authors ON articles.author_id = authors.id 
        WHERE articles.id=:id ");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $article = $query->fetch();

        $pv = intval($article['page_view']) + 1;
        $query_update = $conn->prepare("UPDATE articles SET page_view = :pv WHERE id = :id");
        $query_update->bindValue(':pv', $pv);
        $query_update->bindValue(':id', $id);
        $query_update->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getCode();
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="プレスリリースサイト" />
    <link rel="shortcut icon" type="image/png" href="../public/assets/image/favicon.ico" />
    <link rel="stylesheet" href="../public/assets/sass/main.css" />
    <link rel="stylesheet" href="../public/assets/sass/article/article_show.css?<?php echo time(); ?>" />
    <script src="./../public/assets//js/jquery.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>PR TIMES｜プレスリリース・ニュースリリースNo.1配信サービス</title>
</head>

<body>
    <div class="wrapper">
        <?php include '../views/common/_header.php' ?>
        <div class="main">
            <?php if (!empty($_SESSION['messages'])) : ?>
                <div class="flash flash--success">
                    <?php foreach ($_SESSION['messages'] as $mess) : ?>
                        <p class="message"><?php echo $mess ?></p>
                    <?php endforeach ?>
                    <?php $_SESSION['messages'] = [] ?>
                </div>
            <?php endif ?>
            <div class="article">
                <div class="article-header">
                    <h3 class="article__title"><?php echo $article['title'] ?></h3>
                    <div class="sub-info">
                        <time class="article__time"><?php echo $article['created_at'] ?></time>
                        <p class="article__author">筆者: <?php echo $article['fullname'] ?></p>
                        <p class="article__view">ページビュー: <?php echo $article['page_view'] ?></p>
                    </div>
                </div>
                <div class="article-main">
                    <?php if ($article['thumbnail_id'] !== NULL) : ?>
                        <div class="artcile__image"><img src="../public/assets/image/articles/<?php echo $article['src'] ?>" alt="abc"></div>
                    <?php endif ?>
                    <p class="article__content"><?php echo $article['content'] ?></p>
                </div>
            </div>
            <div class="control">
                <a class="btn btn--warning btn--radius" href="./article_edit.php?id=<?php echo $id ?>">変更</a>
                <a class="btn btn--danger btn--radius" onclick="return confirm('Are you sure?')" href="./../controllers/articles/delete.php?id=<?php echo $id ?>">削除</a>
            </div>
        </div>
        <?php include '../views/common/_footer.php' ?>
    </div>
</body>

</html>