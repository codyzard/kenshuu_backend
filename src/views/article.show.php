<?php
require '../config/db.php';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $query = $conn->prepare("SELECT title, content, thumbnail_id, page_view, articles.created_at, src, authors.fullname FROM articles 
                       INNER JOIN images ON articles.thumbnail_id = images.id 
                       INNER JOIN authors ON articles.author_id = authors.id 
                       WHERE articles.id=:id ");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch();
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
    <link rel="stylesheet" href="../public/assets/sass/article/article_show.css" />
    <script src="./../public/assets//js/jquery.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>PR TIMES｜プレスリリース・ニュースリリースNo.1配信サービス</title>
</head>

<body>
    <div class="wrapper">
        <?php include '../views/common/_header.php' ?>
        <div class="article">
            <div class="article-header">
                <h3 class="article__title"><?php echo $article['title']?></h3>
                <div class="sub-info">
                    <time class="article__time"><?php echo $article['created_at']?></time>
                    <p class="article__author"><?php echo $article['fullname'] ?></p>
                    <p class="article__view"><?php echo $article['page_view']?></p>
                </div>
            </div>
            <div class="article-main">
                <p class="article__content"><?php echo $article['content']?></p>
                <div class="artcile__image"><img src="../public/assets/image/articles/<?php echo $article['src']?>" alt="abc"></div>
            </div>

        </div>
        <?php include '../views/common/_footer.php' ?>
    </div>
</body>

</html>